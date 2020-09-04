<?php

namespace App\Console\Commands;

use App\Components\WebServices\CoingeckoService;
use App\Components\WebServices\CrexService;
use App\Components\WebServices\WebService;
use App\Course;
use App\Currency;
use Carbon\Carbon;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Console\Command;

class UpdateCourses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:courses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление курсов валют';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Обновляет все курсы валют
     *
     * @return mixed
     */
    public function handle()
    {
        $fromCurrencies = Currency::all();

        // Сейчас взял сравнение только с BTC, но можно сделать и любую другую выборку
        $toCurrencies = Currency::where('name', 'BTC')->get();

        // Доступные веб-сервисы, с которых можно взять курсы
        $webServices = [
            new CrexService(),
            new CoingeckoService(),
        ];

        /**
         * @var WebService $webService
         * @var Currency $toCurrency
         */
        foreach ($webServices as $webService) {
            foreach ($fromCurrencies as $fromCurrency) {
                foreach ($toCurrencies as $toCurrency) {

                    if ($fromCurrency->id == $toCurrency->id)
                        continue;

                    try {

                        $courseValue = $webService->getCourse($fromCurrency->name, $toCurrency->name);

                        if ($courseValue) {
                            Course::updateOrCreate(
                                ['fromCurrencyId' => $fromCurrency->id, 'toCurrencyId' => $toCurrency->id],
                                ['value' => $courseValue, 'updatedAt' => Carbon::now()->format('Y-m-d H:i:s')]
                            );
                        }
                    } catch (ClientException $e) {
                        // Пропускаем пока все ошибки от веб-сервисов
                        continue;
                    }
                }
            }
        }
    }
}
