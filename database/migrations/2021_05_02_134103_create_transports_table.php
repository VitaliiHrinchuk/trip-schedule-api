<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transports', function (Blueprint $table) {
          $table->uuid('uuid')->primary();
          $table->string('name');
          $table->string('slug')->unique();
          $table->string('model')->nullable();
          $table->uuid('type_uuid');
          $table->foreign('type_uuid')->references('uuid')->on('transport_types');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transports');
    }
}
