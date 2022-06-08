<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndividualTagContactPivotTable extends Migration
{
    public function up()
    {
        Schema::create('individual_tag_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('individual_id');
            $table->foreign('individual_id', 'individual_id_fk_3052034')->references('id')->on('individuals')->onDelete('cascade');
            $table->unsignedBigInteger('tag_contact_id');
            $table->foreign('tag_contact_id', 'tag_contact_id_fk_3052034')->references('id')->on('tag_contacts')->onDelete('cascade');
        });
    }
}
