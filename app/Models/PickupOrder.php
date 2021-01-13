<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PickupOrder extends Model
{
    use HasFactory;
    protected $table = 'pickup_orders';
    protected $fillable = [
        'tracking_id',
        'user_id',
        'branch_area',
        'product_name',
        'product_price',
        'customer_name',
        'customer_phone',
        'product_type',
        'product_weight',

        'pickup_district',
        'pickup_zone',
        'pickup_address_line',

        'delivery_district',
        'delivery_zone',
        'delivery_address_line',

        'delivery_type',
        'delivery_charge',
        'delivery_charge_type',
        'delivery_date',
        'remarks',
        'shipment_status',
        'assign_driver',
        'created_by',
        'updated_by',
        'order_info_updated_by'
    ];
}
