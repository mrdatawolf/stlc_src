<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTMCTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmc', function (Blueprint $table) {
            $table->id();
            $table->string('origin_state')->nullable();
            $table->string('origin_city')->nullable();
            $table->string('origin_county')->nullable();
            $table->string('origin_zip_code')->nullable();
            $table->string('destination_state')->nullable();
            $table->string('destination_city')->nullable();
            $table->string('proposed_rate_mile_flatbed')->nullable();
            $table->string('minimum')->nullable();
            $table->string('fsc_7_18')->nullable();
            $table->string('six_thirteen')->nullable();
            $table->string('meet_minimum')->nullable();
            $table->string('miles')->nullable();
            $table->string('dollar_value')->nullable();
            $table->string('cost_no_tarp')->nullable();
            $table->string('cost_tarped')->nullable();
            $table->string('per_m')->nullable();
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
        Schema::dropIfExists('tmc');
    }
}
