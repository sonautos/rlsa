<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToOrderLinesTable extends Migration
{
    public function up()
    {
        Schema::table('order_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_fk_3052829')->references('id')->on('orders_lists')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3052830')->references('id')->on('products');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id', 'vehicle_fk_3052831')->references('id')->on('cars');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3052843')->references('id')->on('teams');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id', 'service_fk_3052856')->references('id')->on('services');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3052860')->references('id')->on('order_statuses');
        });
    }
}
