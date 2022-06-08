<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToColorsTable extends Migration
{
    public function up()
    {
        Schema::table('colors', function (Blueprint $table) {
            $table->unsignedBigInteger('make_id')->nullable();
            $table->foreign('make_id', 'make_fk_3049927')->references('id')->on('makes');
            $table->unsignedBigInteger('modele_id')->nullable();
            $table->foreign('modele_id', 'modele_fk_3049928')->references('id')->on('modeles');
        });
    }
}
