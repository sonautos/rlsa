<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersListsTable extends Migration
{
    public function up()
    {
        Schema::create('orders_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->unique();
            $table->date('date_valid')->nullable();
            $table->decimal('total_ht', 15, 2)->nullable();
            $table->decimal('tva', 15, 2)->nullable();
            $table->decimal('total_ttc', 15, 2)->nullable();
            $table->decimal('remise', 15, 2)->nullable();
            $table->float('remise_percent', 5, 2)->nullable();
            $table->longText('note_private')->nullable();
            $table->longText('note_public')->nullable();
            $table->date('date_livraison')->nullable();
            $table->date('date_created');
            $table->boolean('signed')->default(0)->nullable();
            $table->string('ref_order_client')->nullable();
            $table->string('ref_order_seller')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
