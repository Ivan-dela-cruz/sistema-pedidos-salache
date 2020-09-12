<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRequestProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_request_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_request');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->double('price')->nullable();
            $table->integer('stock')->nullable();
            $table->string('category')->nullable();
            $table->string('url_image')->nullable();
            $table->timestamps();
            $table->foreign('id_request')->references('id')->on('request_products')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_request_products');
    }
}
