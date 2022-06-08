<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToFeaturesTable extends Migration
{
    public function up()
    {
        Schema::table('features', function (Blueprint $table) {
            $table->unsignedBigInteger('make_id');
            $table->foreign('make_id', 'make_fk_3049936')->references('id')->on('makes');
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id', 'modele_fk_3049937')->references('id')->on('modeles');
        });
    }
}
