<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAddressesTable extends Migration
{
    public function up()
    {
        Schema::table('addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->foreign('societe_id', 'societe_fk_3051927')->references('id')->on('companies');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_fk_3051928')->references('id')->on('entities');
            $table->unsignedBigInteger('user_create_id');
            $table->foreign('user_create_id', 'user_create_fk_3051942')->references('id')->on('users');
            $table->unsignedBigInteger('user_modif_id');
            $table->foreign('user_modif_id', 'user_modif_fk_3051943')->references('id')->on('users');
            $table->unsignedBigInteger('individual_id')->nullable();
            $table->foreign('individual_id', 'individual_fk_3051950')->references('id')->on('individuals');
        });
    }
}
