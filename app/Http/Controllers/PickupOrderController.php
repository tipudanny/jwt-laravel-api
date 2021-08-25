<?php

namespace App\Http\Controllers;

use App\Http\Requests\PickupOrderCreate;
use App\Http\Requests\PickupOrderUpdate;
use App\Models\PickupOrder;
use Illuminate\Support\Facades\Auth;

class PickupOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }

    /**
     * Create a new Pickup Order.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(PickupOrderCreate $request): \Illuminate\Http\JsonResponse
    {
        $new_pickup = new PickupOrder;
        $data = $request->all();

        $data['tracking_id']        = 'TOC-'.time();
        $data['user_id']            = Auth::id();
        $data['created_by']         = Auth::id();
        $new_pickup->create($data);
        return response()->json(['message'=> 'New order create successful.']);
    }

    /**
     * Update pickup Order by Admin and user himself.
     *
     * @param PickupOrderUpdate $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(PickupOrderUpdate $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $order = PickupOrder::findOrFail($request->id);
        if(Auth::user()->user_type != 'super-admin' || Auth::id() != $order->user_id){
            return response()->json(['message'=> 'Are you kidding with me ? - STUPID.']);
        }
        $data =  $request->except('id','product_name','product_price','product_type');
        $data['order_info_updated_by']  = Auth::id();
        $order->update($data);
        return response()->json(['result'=>$order,'message'=> 'Order update successful.']);
    }

}
