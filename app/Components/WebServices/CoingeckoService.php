<?php


namespace App\Components\WebServices;


use App\Components\ApiHelper;

class CoingeckoService extends WebService
{

    private $name = 'coingecko';
    private $baseUri = 'https://api.coingecko.com';
    private $getCourseUri = '/api/v3/coins/markets?vs_currency=';

    private $currencyCache = [];

    /**
     * @inheritDoc
     */
    public function getCourse($from, $to)
    {

        // Записываю в кэш, т.к. сервис отдаёт большой массив данных по многим валютам
        if (!array_key_exists($to, $this->currencyCache)) {
            $parser = new ApiHelper($this->baseUri);
            $this->currencyCache[$to] = $parser->get($this->getCourseUri . strtolower($to));
        }

        $currencyInfo = collect($this->currencyCache[$to])->first(function ($i) use ($from) {
            return $i['symbol'] == strtolower($from);
        });

        if (!$currencyInfo)
            return false;

        return $currencyInfo['current_price'];
    }
}