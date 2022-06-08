<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMandatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mandats', function (Blueprint $table) {
            $table->id();
            // Client
            $table->string('company')->nullable();
            $table->string('vatnumber')->nullable();
            $table->string('firstname')->nullable();
            $table->string('name')->nullable();
            $table->string('birthday')->nullable();
            $table->string('birthday_place')->nullable();
            $table->string('dni')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('phone_client')->nullable();
            // Mandataire
            $table->string('seller_name')->nullable();
            $table->string('seller_vatnumber')->nullable();
            $table->string('seller_siren')->nullable();
            $table->string('seller_address')->nullable();
            $table->string('seller_country')->nullable();
            $table->string('seller_phone')->nullable();
            $table->string('seller_email')->nullable();
            // Véhicule descriptif
            $table->string('make')->nullable();
            $table->string('modele')->nullable();
            $table->string('vin')->nullable();
            $table->string('plates')->nullable();
            $table->string('start_guarantee')->nullable();
            $table->string('delay_guarantee')->nullable();
            $table->foreignId('car_id')->nullable()->contrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mandats');
    }
}
