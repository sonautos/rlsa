<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVersionsTable extends Migration
{
    public function up()
    {
        Schema::create('versions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description');
            $table->string('slug')->unique();
            $table->string('motor');
            $table->longText('equipment');
            $table->integer('kw')->nullable();
            $table->integer('ch')->nullable();
            $table->integer('co_2')->nullable();
            $table->string('energy')->nullable();
            $table->string('gear')->nullable();
            $table->float('conso', 5, 2)->nullable();
            $table->decimal('prix', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
