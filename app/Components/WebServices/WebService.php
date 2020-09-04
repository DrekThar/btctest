<?php


namespace App\Components\WebServices;

/**
 * Базовый класс для веб-сервисов для разной реализации получения одних данных
 * @package App\Components\WebServices
 */
abstract class WebService implements WebServiceInterface
{
    private $name;
    private $baseUri;
    private $getCourseUri;
}