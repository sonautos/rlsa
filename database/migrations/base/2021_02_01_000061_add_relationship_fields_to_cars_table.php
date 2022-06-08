<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarsTable extends Migration
{
    public function up()
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_3049950')->references('id')->on('users');
            $table->unsignedBigInteger('code_model_id')->nullable();
            $table->foreign('code_model_id', 'code_model_fk_3049959')->references('id')->on('code_models');
            $table->unsignedBigInteger('version_id')->nullable();
            $table->foreign('version_id', 'version_fk_3049962')->references('id')->on('versions');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3054949')->references('id')->on('teams');
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_fk_3081623')->references('id')->on('entities');
            $table->unsignedBigInteger('seller_id')->nullable();
            $table->foreign('seller_id', 'seller_fk_3081624')->references('id')->on('companies');
        });
    }
}
