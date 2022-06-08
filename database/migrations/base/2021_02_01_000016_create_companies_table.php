<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('alias')->nullable();
            $table->boolean('supplier')->default(0)->nullable();
            $table->integer('status');
            $table->integer('parent')->nullable();
            $table->string('code_client')->nullable();
            $table->string('code_supplier')->nullable();
            $table->string('address');
            $table->string('address_2')->nullable();
            $table->string('zip');
            $table->string('city');
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('siren')->nullable();
            $table->string('siret')->nullable();
            $table->string('ape')->nullable();
            $table->string('vatnumber');
            $table->decimal('capital', 15, 2)->nullable();
            $table->longText('note_private')->nullable();
            $table->longText('note_public')->nullable();
            $table->boolean('active')->default(0)->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('url_place')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
