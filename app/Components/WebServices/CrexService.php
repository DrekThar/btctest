<?php


namespace App\Components\WebServices;


use App\Components\ApiHelper;

class CrexService extends WebService
{

    private $name = 'crex24';
    private $baseUri = 'https://api.crex24.com/';
    private $getCourseUri = '/v2/public/tickers?instrument=';

    /**
     * @inheritDoc
     */
    public function getCourse($from, $to)
    {
        $parser = new ApiHelper($this->baseUri);
        $data = $parser->get($this->getCourseUri . "{$from}-{$to}");

        $currencyInfo = $data[0];

        if (!$currencyInfo)
            return false;

        return $currencyInfo['bid'];
    }
}