<?php


namespace App\Components;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Illuminate\Http\Response;

/**
 * Вспомогательный класс для работы с запросами
 * @package App\Components
 */
class ApiHelper
{
    protected $client;

    public function __construct($baseUrl, $params = [])
    {
        $this->client = new Client(array_merge([
            'headers' => ['Content-Type' => 'application/json'],
            'base_uri' => $baseUrl
        ], $params));
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
     * @param string $uri
     * @param string $method
     * @param integer $id
     * @param array $params
     * @return array
     * @throws GuzzleException
     */
    public function post($uri, $method, $id, $params = [])
    {
        $response = $this->client
            ->post($uri, [
                RequestOptions::JSON => [
                    'jsonrpc' => '1.0',
                    'id' => $id,
                    'method' => $method,
                    'params' => $params
                ]
            ])->getBody()->getContents();

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