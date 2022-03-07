<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_stats', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('total');
            $table->bigInteger('totalCoins');
            $table->bigInteger('totalMarkets');
            $table->bigInteger('totalExchanges');
            $table->bigInteger('totalMarketCap');
            $table->bigInteger('total24hVolume');
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
        Schema::dropIfExists('general_stats');
    }
}
