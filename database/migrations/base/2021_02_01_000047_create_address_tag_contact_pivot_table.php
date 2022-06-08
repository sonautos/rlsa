<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressTagContactPivotTable extends Migration
{
    public function up()
    {
        Schema::create('address_tag_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id', 'address_id_fk_3052035')->references('id')->on('addresses')->onDelete('cascade');
            $table->unsignedBigInteger('tag_contact_id');
            $table->foreign('tag_contact_id', 'tag_contact_id_fk_3052035')->references('id')->on('tag_contacts')->onDelete('cascade');
        });
    }
}
