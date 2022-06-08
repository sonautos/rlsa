<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductCategoryServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_category_service', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_3052821')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id', 'product_category_id_fk_3052821')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }
}
