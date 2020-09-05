<?php


namespace App\Components;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;

/**
 * Вспомогательный класс для работы с запросами
 * @package App\Components
 */
class ApiHelper
{
    protected $client;

    public function __construct($baseUrl)
    {
        $this->client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => $baseUrl
        ]);
    }

    /**
     * Отправляет запрос на указанный адрес
     * @param string $uri
     * @return mixed
     * @throws GuzzleException
     */
    public function get($uri)
    {
        $response = $this->client->get($uri)->getBody()->getContents();
        return json_decode($response, true);
    }

    /**
     * @param array $result
     * @return Response
     */
    public static function sendResponse($result)
    {
        return new Response([
            'version' => '1.0',
            'result' => $result,
        ]);
    }

    /**
     * @param string $message
     * @return Response
     */
    public static function sendError($message)
    {
        return new Response([
            'version' => '1.0',
            'error' => $message,
        ]);
    }
}