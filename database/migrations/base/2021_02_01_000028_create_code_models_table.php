<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCodeModelsTable extends Migration
{
    public function up()
    {
        Schema::create('code_models', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
