<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
          $table->uuid('uuid')->primary();
          $table->integer('seats');
          $table->dateTime('departure_date');
          $table->dateTime('return_date')->nullable();
          $table->uuid('company_uuid');
          $table->uuid('departure_city_uuid');
          $table->uuid('arrival_city_uuid');
          $table->uuid('transport_uuid');
          $table->foreign('transport_uuid')->references('uuid')->on('transports');
          $table->foreign('departure_city_uuid')->references('uuid')->on('cities');
          $table->foreign('arrival_city_uuid')->references('uuid')->on('cities');
          $table->foreign('company_uuid')->references('uuid')->on('companies');
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
        Schema::dropIfExists('trips');
    }
}
