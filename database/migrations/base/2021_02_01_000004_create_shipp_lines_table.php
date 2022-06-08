<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippLinesTable extends Migration
{
    public function up()
    {
        Schema::create('shipp_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('modele');
            $table->string('vin');
            $table->string('color')->nullable();
            $table->string('plates');
            $table->string('loading_place');
            $table->string('delivery_place');
            $table->date('cmr_date')->nullable();
            $table->boolean('paid')->default(0)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
