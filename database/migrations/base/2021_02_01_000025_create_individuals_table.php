<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualsTable extends Migration
{
    public function up()
    {
        Schema::create('individuals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname')->nullable();
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('address_2')->nullable();
            $table->integer('zip')->nullable();
            $table->string('city')->nullable();
            $table->string('poste')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->longText('note_private')->nullable();
            $table->longText('note_public')->nullable();
            $table->string('civility')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('url_place')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
