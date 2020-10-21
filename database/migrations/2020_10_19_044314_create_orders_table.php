<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('released')->nullable();
            $table->string('need_re')->nullable();
            $table->string('order_number')->nullable();
            $table->string('po_number')->nullable();
            $table->string('quantity')->nullable();
            $table->string('thick')->nullable();
            $table->string('width')->nullable();
            $table->string('length')->nullable();
            $table->string('grade')->nullable();
            $table->string('mill')->nullable();
            $table->string('frt')->nullable();
            $table->string('total')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
