<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('vin')->unique();
            $table->string('plates')->nullable();
            $table->string('idv')->nullable();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('private_note')->nullable();
            $table->string('make')->nullable();
            $table->string('modele')->nullable();
            $table->string('motor')->nullable();
            $table->integer('ch')->nullable();
            $table->integer('co_2')->nullable();
            $table->string('energy')->nullable();
            $table->string('gear')->nullable();
            $table->float('conso', 5, 2)->nullable();
            $table->date('mec')->nullable();
            $table->float('kms')->nullable();
            $table->string('color')->nullable();
            $table->string('interior')->nullable();
            $table->longText('serie')->nullable();
            $table->longText('feature')->nullable();
            $table->decimal('price_new', 15, 2)->nullable();
            $table->decimal('frevo', 15, 2)->nullable();
            $table->decimal('real_frevo', 15, 2)->nullable();
            $table->string('link_frevo')->nullable();
            $table->decimal('discount', 15, 2)->nullable();
            $table->datetime('last_price_update')->nullable();
            $table->decimal('price_ht', 15, 2)->nullable();
            $table->decimal('price_ttc', 15, 2)->nullable();
            $table->decimal('tax', 15, 2)->nullable();
            $table->boolean('impuesto')->default(0)->nullable();
            $table->decimal('cost_price', 15, 2)->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->date('dispo')->nullable();
            $table->integer('qty')->nullable();
            $table->string('warehouse')->nullable();
            $table->decimal('comseller', 15, 2)->nullable();
            $table->string('import_key')->nullable();
            $table->boolean('draft')->default(0)->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
