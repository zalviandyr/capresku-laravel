<?php

namespace App\Helpers;

use Carbon\Carbon;

class DateHelper
{
    public static function parseDate(string $value): Carbon
    {
        return Carbon::parse($value);
    }
}
