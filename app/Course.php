<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * @package App
 * @property int fromCurrencyId
 * @property int toCurrencyId
 * @property string value
 * @property int updatedAt
 */
class Course extends Model
{

    public $timestamps = false;

    protected $fillable = ['fromCurrencyId', 'toCurrencyId', 'value', 'updatedAt'];

    public function fromCurrency()
    {
        return $this->belongsTo(Currency::class, 'fromCurrencyId');
    }

    public function toCurrency()
    {
        return $this->belongsTo(Currency::class, 'toCurrencyId');
    }
}
