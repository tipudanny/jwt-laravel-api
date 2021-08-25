<?php

namespace App\Traits;

use App\Models\PickupOrder;

trait OrderStatus
{
    public function orders( $type,$page):object
    {
        if ($type)
        {
            return response()->json(PickupOrder::where('shipment_status',$type)->paginate(5));
        }else return response()->json(PickupOrder::paginate(5));

    }


}
