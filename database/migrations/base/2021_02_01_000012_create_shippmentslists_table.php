<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippmentslistsTable extends Migration
{
    public function up()
    {
        Schema::create('shippmentslists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ref')->unique();
            $table->date('date_delivery');
            $table->longText('note_public')->nullable();
            $table->longText('note_private')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
