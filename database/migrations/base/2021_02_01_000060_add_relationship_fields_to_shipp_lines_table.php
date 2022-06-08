<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToShippLinesTable extends Migration
{
    public function up()
    {
        Schema::table('shipp_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id', 'seller_fk_3052378')->references('id')->on('companies');
            $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id', 'client_fk_3052379')->references('id')->on('companies');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3052387')->references('id')->on('shipp_statuses');
            $table->unsignedBigInteger('shippment_id');
            $table->foreign('shippment_id', 'shippment_fk_3052388')->references('id')->on('shippmentslists')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_3052389')->references('id')->on('users');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id', 'vehicle_fk_3052398')->references('id')->on('cars');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id', 'order_fk_3052399')->references('id')->on('orders_lists');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3052400')->references('id')->on('teams');
        });
    }
}
