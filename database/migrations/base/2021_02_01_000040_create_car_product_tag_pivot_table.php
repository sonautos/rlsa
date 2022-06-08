<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarProductTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('car_product_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id', 'car_id_fk_3052049')->references('id')->on('cars')->onDelete('cascade');
            $table->unsignedBigInteger('product_tag_id');
            $table->foreign('product_tag_id', 'product_tag_id_fk_3052049')->references('id')->on('product_tags')->onDelete('cascade');
        });
    }
}
