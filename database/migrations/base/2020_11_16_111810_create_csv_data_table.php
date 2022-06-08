<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCsvDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_data', function (Blueprint $table) {
            $table->id();
            $table->string('csv_filename');
            $table->integer('entity');
            $table->integer('seller_id')->nullable();
            $table->date('dispo');
            $table->foreignId('make_id')->nullable();
            $table->foreignId('modele_id')->nullable();
            $table->foreignId('version_id')->nullable();
            $table->decimal('comseller');
            $table->boolean('qty');
            $table->boolean('increasePrice');
            $table->longText('csv_data');
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
        Schema::dropIfExists('csv_data');
    }
}
