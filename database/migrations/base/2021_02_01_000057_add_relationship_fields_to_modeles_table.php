<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToModelesTable extends Migration
{
    public function up()
    {
        Schema::table('modeles', function (Blueprint $table) {
            $table->unsignedBigInteger('make_id');
            $table->foreign('make_id', 'make_fk_3049900')->references('id')->on('makes');
        });
    }
}
