<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToShippmentslistsTable extends Migration
{
    public function up()
    {
        Schema::table('shippmentslists', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_fk_3052349')->references('id')->on('entities');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_fk_3052350')->references('id')->on('users');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3052354')->references('id')->on('teams');
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id', 'status_fk_3052371')->references('id')->on('shipp_statuses');
        });
    }
}
