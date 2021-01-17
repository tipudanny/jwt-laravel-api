<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\PickupOrder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderConfirmController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Order Confirmation.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function orderDeliver(Request $request)
    {
        //return $request->all();
        $order = PickupOrder::findOrFail($request->order_id);
        if ($order->shipment_status == 'delivered')
            return response()->json(['message' => 'This shipment already delivered.']);
        if ( Auth::user()->user_type == 'rider' ||
            Auth::user()->user_type == 'super-admin' ||
            Auth::user()->user_type == 'manager')
        {
            $data =  $request->except('order_id');
            $data['delivery_date'] = Carbon::now('+06:00')->format('Y-m-d H:i:s');
            $order->update($data);
            return response()->json(['message'=> 'Shipment Delivered successfully.']);
        }
        else return response()->json(['message' => 'Unknown Request.']);
    }
}
