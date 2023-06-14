<?php

namespace App\Utils\Date;


class DateSelect{
    public static function date($value){
        $day = $value->format('d');
        $month  = $value->format("m");
        $year = $value->format('Y');
        $months = [
            'Januari','Febuari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'
        ];
        $hasil=ltrim($month,'0');
        return $day." ".$months[$hasil-1]." ".$year;
    }
}
