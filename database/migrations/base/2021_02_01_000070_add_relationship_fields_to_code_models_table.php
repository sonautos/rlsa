<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCodeModelsTable extends Migration
{
    public function up()
    {
        Schema::table('code_models', function (Blueprint $table) {
            $table->unsignedBigInteger('make_id');
            $table->foreign('make_id', 'make_fk_3049943')->references('id')->on('makes');
            $table->unsignedBigInteger('modele_id');
            $table->foreign('modele_id', 'modele_fk_3049944')->references('id')->on('modeles');
            $table->unsignedBigInteger('version_id');
            $table->foreign('version_id', 'version_fk_3049945')->references('id')->on('versions');
        });
    }
}
