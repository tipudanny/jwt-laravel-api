<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pickup_orders', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_id');
            $table->string('user_id');
            $table->string('branch_area');
            $table->string('product_name');
            $table->decimal('product_price',10,2)->nullable();
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->string('product_type');
            $table->string('product_weight');

            $table->string('pickup_district');
            $table->string('pickup_zone');
            $table->string('pickup_address_line');

            $table->string('delivery_district');
            $table->string('delivery_zone');
            $table->string('delivery_address_line');


            $table->string('delivery_type');
            $table->decimal('delivery_charge',10,2)->nullable();
            $table->string('delivery_charge_type')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('delivery_charge_status')->nullable();
            $table->date('payment_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->decimal('user_income',10,2)->default(0);
            $table->string('remarks')->nullable();
            $table->string('shipment_status')->default('0');
            $table->string('assign_driver')->default('0');
            $table->integer('created_by');
            $table->integer('updated_by')->default('0');
            $table->integer('order_info_updated_by')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pickup_orders');
    }
}
