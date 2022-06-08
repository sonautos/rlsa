<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrucksTable extends Migration
{
    public function up()
    {
        Schema::create('trucks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('plates')->nullable();
            $table->string('chauffeur')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->date('date_load')->nullable();
            $table->date('date_cmr')->nullable();
            $table->integer('status')->nullable();
            $table->boolean('paid')->default(0)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
