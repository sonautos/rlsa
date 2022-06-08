<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProformaLinesTable extends Migration
{
    public function up()
    {
        Schema::table('proforma_lines', function (Blueprint $table) {
            $table->unsignedBigInteger('proforma_id');
            $table->foreign('proforma_id', 'proforma_fk_3052981')->references('id')->on('proforma_lists')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id', 'product_fk_3052982')->references('id')->on('products');
            $table->unsignedBigInteger('service_id')->nullable();
            $table->foreign('service_id', 'service_fk_3052983')->references('id')->on('services');
            $table->unsignedBigInteger('vehicle_id')->nullable();
            $table->foreign('vehicle_id', 'vehicle_fk_3052984')->references('id')->on('cars');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3052996')->references('id')->on('order_statuses');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3053000')->references('id')->on('teams');
        });
    }
}
