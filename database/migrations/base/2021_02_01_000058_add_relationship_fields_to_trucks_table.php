<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTrucksTable extends Migration
{
    public function up()
    {
        Schema::table('trucks', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->foreign('supplier_id', 'supplier_fk_3052402')->references('id')->on('companies');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3052410')->references('id')->on('users');
            $table->unsignedBigInteger('shippment_id')->nullable();
            $table->foreign('shippment_id', 'shippment_fk_3052411')->references('id')->on('shippmentslists')->onDelete('cascade');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3052416')->references('id')->on('teams');
        });
    }
}
