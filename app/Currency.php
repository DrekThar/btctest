<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Currency
 * @package App
 * @property string name
 */
class Currency extends Model
{
    public $timestamps = false;

    /**
     * Выбор всех курсов по валюте
     * @return HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
