<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTagServicePivotTable extends Migration
{
    public function up()
    {
        Schema::create('product_tag_service', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id', 'service_id_fk_3052822')->references('id')->on('services')->onDelete('cascade');
            $table->unsignedBigInteger('product_tag_id');
            $table->foreign('product_tag_id', 'product_tag_id_fk_3052822')->references('id')->on('product_tags')->onDelete('cascade');
        });
    }
}
