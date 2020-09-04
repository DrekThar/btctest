<?php


namespace App\Components\WebServices;


interface WebServiceInterface
{
    /**
     * Получает курс валют относительно друг друга
     * @param string $from Обозначение валюты
     * @param string $to
     * @return float|false
     */
    public function getCourse($from, $to);
}