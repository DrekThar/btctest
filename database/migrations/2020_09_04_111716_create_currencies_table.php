<?php

use App\Currency;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        // Добавляю сразу валюты для удобства, обычно так не делаю
        $startingCurrencyList = ['BTC', 'TRTT', 'XORN', 'ETH', 'TRON', 'BEAR'];
        foreach ($startingCurrencyList as $name) {
            $currency = new Currency();
            $currency->name = $name;
            $currency->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
    }
}
