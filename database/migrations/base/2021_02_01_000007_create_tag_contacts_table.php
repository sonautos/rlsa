<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagContactsTable extends Migration
{
    public function up()
    {
        Schema::create('tag_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tag')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
