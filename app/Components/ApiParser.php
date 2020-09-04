<?php


namespace App\Components;

use GuzzleHttp\Client;

/**
 * Вспомогательный класс для работы с запросами
 * @package App\Components
 */
class ApiParser
{
    protected $client;

    public function __construct($baseUrl)
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => $baseUrl
        ]);
    }

    public function get($uri)
    {
        $response = $this->client->get($uri)->getBody()->getContents();
        $result = json_decode($response, true);
        return $result;
    }
}