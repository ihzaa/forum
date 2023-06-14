<?php

namespace App\Utils\Date;

use Carbon\Carbon;

class LocalCarbon
{
    public static function now($timezone = NULL)
    {
        if ($timezone == NULL)
            return Carbon::now(config('app.timezone'));
        else
            return Carbon::now($timezone);
    }

    public static function createFromFormat($format = 'd-m-Y', $time, $timezone = NULL)
    {
        if ($timezone == NULL)
            return Carbon::createFromFormat($format, $time, config('app.timezone'));
        else
            return Carbon::createFromFormat($format, $time, $timezone);
    }

    public static function parse($date, $timezone = NULL)
    {

        if ($timezone == NULL)
            return Carbon::parse($date, config('app.timezone'));
        else
            return Carbon::parse($date, $timezone);
    }
}
