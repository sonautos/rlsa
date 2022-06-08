<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTagContactPivotTable extends Migration
{
    public function up()
    {
        Schema::create('company_tag_contact', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id', 'company_id_fk_3052033')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('tag_contact_id');
            $table->foreign('tag_contact_id', 'tag_contact_id_fk_3052033')->references('id')->on('tag_contacts')->onDelete('cascade');
        });
    }
}
