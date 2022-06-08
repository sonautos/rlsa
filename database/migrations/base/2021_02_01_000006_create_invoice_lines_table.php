<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceLinesTable extends Migration
{
    public function up()
    {
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('qty');
            $table->float('tva_tx', 5, 2)->nullable();
            $table->float('remise_percent', 5, 2)->nullable();
            $table->decimal('remise', 15, 2)->nullable();
            $table->decimal('total_ht', 15, 2)->nullable();
            $table->decimal('total_tva', 15, 2)->nullable();
            $table->decimal('total_ttc', 15, 2)->nullable();
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->decimal('comclient', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
