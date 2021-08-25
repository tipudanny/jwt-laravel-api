<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\PickupOrder;
use App\Models\User;
use App\Traits\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    use OrderStatus;
    public function __construct()
    {
        $this->middleware('jwt');
    }
    /*
     * Get orders with search options
     * @return \Illuminate\Http|JsonResponse
     * */
    public function index():object
    {
        $page = ( request()->get( 'page' ) ) ? request()->get( 'page' ) : 1;
        $type = ( request()->get( 'type' ) ) ? request()->get( 'type' ) : null;
        return $this->orders($type,$page);
    }

    /**
     * Get all Pickup Order  .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrder()
    {
        $orders = PickupOrder::where('user_id',Auth::id())->get();
        return response()->json(['orders'=>$orders]);
    }

    /**
     * Get Single Pickup Order info .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSingleOrder($id)
    {
        $order = PickupOrder::with('user_order')->where('id',$id)->get();
        return response()->json(['order'=>$order]);
    }

    /**
     * Pickup Order Status update .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function statusUpdate(Request $request)
    {
        //return $request->all();
        $order = PickupOrder::findOrFail($request->order_id);
        $data =  $request->except('order_id');
        $data['updated_by'] = Auth::id();

        if (Auth::user()->user_type == 'customer' && $request->shipment_status == 'cancel')
        {
            $order->update($data);
            return response()->json(['message'=> 'Shipment status update successful.']);
        }
        if (Auth::user()->user_type == 'customer' && $request->shipment_status != 'cancel')
        {
            return response()->json(['message'=> 'Error:: You are not Authorized.']);
        }
        else {
            $order->update($data);
            return response()->json(['message'=> 'Shipment status update successful.']);
        }

    }

    /**
     * Assign a Driver for shipment .
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRider(Request $request)
    {
        //return $request->all();
        $order = PickupOrder::findOrFail($request->order_id);
        $user = User::findOrFail($request->assign_driver)->user_type;
        if ( $user != 'rider')
            return response()->json(['message'=> 'Rider not found.']);

        $data =  $request->except('order_id');
        $data['updated_by'] = Auth::id();
        $order->update($data);
        return response()->json(['message'=> 'Rider assign successful.']);
    }
}
