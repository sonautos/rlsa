<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToInvoicesListsTable extends Migration
{
    public function up()
    {
        Schema::table('invoices_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('entity_id');
            $table->foreign('entity_id', 'entity_fk_3053003')->references('id')->on('entities');
            $table->unsignedBigInteger('task_id')->nullable();
            $table->foreign('task_id', 'task_fk_3053005')->references('id')->on('tasks');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id', 'author_fk_3053008')->references('id')->on('users');
            $table->unsignedBigInteger('valid_id')->nullable();
            $table->foreign('valid_id', 'valid_fk_3053009')->references('id')->on('users');
            $table->unsignedBigInteger('user_updated_id')->nullable();
            $table->foreign('user_updated_id', 'user_updated_fk_3053010')->references('id')->on('users');
            $table->unsignedBigInteger('status_id')->nullable();
            $table->foreign('status_id', 'status_fk_3053011')->references('id')->on('order_statuses');
            $table->unsignedBigInteger('cond_reglement_id')->nullable();
            $table->foreign('cond_reglement_id', 'cond_reglement_fk_3053017')->references('id')->on('cond_reglements');
            $table->unsignedBigInteger('mode_reglement_id')->nullable();
            $table->foreign('mode_reglement_id', 'mode_reglement_fk_3053018')->references('id')->on('mode_reglements');
            $table->unsignedBigInteger('shipping_method_id')->nullable();
            $table->foreign('shipping_method_id', 'shipping_method_fk_3053022')->references('id')->on('shipping_methods');
            $table->unsignedBigInteger('delivery_address_id')->nullable();
            $table->foreign('delivery_address_id', 'delivery_address_fk_3053023')->references('id')->on('addresses');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_3054985')->references('id')->on('teams');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id', 'client_fk_3099738')->references('id')->on('companies');
            $table->unsignedBigInteger('seller_id');
            $table->foreign('seller_id', 'seller_fk_3100227')->references('id')->on('companies');
        });
    }
}
