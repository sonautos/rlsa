<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarProductCategoryPivotTable extends Migration
{
    public function up()
    {
        Schema::create('car_product_category', function (Blueprint $table) {
            $table->unsignedBigInteger('car_id');
            $table->foreign('car_id', 'car_id_fk_3049956')->references('id')->on('cars')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_3049956')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
