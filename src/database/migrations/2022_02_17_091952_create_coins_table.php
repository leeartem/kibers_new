<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('uuid');
            $table->string('symbol');
            $table->string('name');
            $table->string('nameRussian')->nullable();
            $table->string('color')->nullable();
            $table->string('iconUrl')->nullable();
            $table->bigInteger('marketCap');
            $table->string('price');
            $table->integer('listedAt');
            $table->integer('tier');
            $table->string('change');
            $table->boolean('changeNegative');
            $table->integer('rank');
            $table->json('sparkline');
            $table->bigInteger('24hVolume');
            $table->string('btcPrice');
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
        Schema::dropIfExists('coins');
    }
}
