<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\PickupOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
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
        $order->update($data);
        return response()->json(['message'=> 'Shipment status update successful.']);
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
