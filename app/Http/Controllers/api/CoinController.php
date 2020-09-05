<?php

namespace App\Http\Controllers\api;

use App\Components\ApiHelper;
use App\Course;
use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CoinController extends Controller
{
    /**
     * Получение курса валют
     * @param Request $request
     * @param string $coinFromName
     * @return Response
     */
    public function getCourse(Request $request, $coinFromName)
    {
        $coinToName = $request->get('currency');

        if (!$currencyFrom = Currency::where('name', $coinFromName)->first()) {
            return ApiHelper::sendError("Не найдена валюта с именем {$coinFromName}");
        }

        if (!$currencyTo = Currency::where('name', $coinToName)->first()) {
            return ApiHelper::sendError("Не найдена валюта с именем {$coinToName}");
        }

        if (!$course = Course::where([
            'fromCurrencyId' => $currencyFrom->id,
            'toCurrencyId' => $currencyTo->id
        ])->first()) {
            return ApiHelper::sendError("Курса указанных валют нет в системе");
        }

        return ApiHelper::sendResponse([
            'currencyFrom' => $currencyFrom->name,
            'currencyTo' => $currencyTo->name,
            'lastUpdated' => $course->updatedAt,
            'course' => $course->value,
        ]);
    }
}