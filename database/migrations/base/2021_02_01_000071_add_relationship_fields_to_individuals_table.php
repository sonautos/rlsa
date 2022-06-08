<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToIndividualsTable extends Migration
{
    public function up()
    {
        Schema::table('individuals', function (Blueprint $table) {
            $table->unsignedBigInteger('societe_id')->nullable();
            $table->foreign('societe_id', 'societe_fk_3051820')->references('id')->on('companies');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_fk_3051906')->references('id')->on('entities');
            $table->unsignedBigInteger('user_create_id');
            $table->foreign('user_create_id', 'user_create_fk_3051919')->references('id')->on('users');
            $table->unsignedBigInteger('user_modif_id');
            $table->foreign('user_modif_id', 'user_modif_fk_3051920')->references('id')->on('users');
        });
    }
}
