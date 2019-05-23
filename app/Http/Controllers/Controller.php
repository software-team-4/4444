<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getSessionDateTime($date, $time)
    {

        $times = explode('|', $time);
        $dates = explode(',', $date);
        $start_date = $dates['0'];
        $end_date = $dates['1'];
        $dateTime = [];
        while ($start_date <= $end_date) {

            for ($i = 0; $i < count($times); $i++) {
                $week = explode(',', $times[$i])[0];
                $star = explode(',', $times[$i])[1];
                $end = explode(',', $times[$i])[2];
                //   dd(date('w', strtotime($start_date)));
                if (date('w', strtotime($start_date)) == $week) {
                    $str = "$start_date $star|$start_date $end";
                    array_push($dateTime, $str);
                }
            }
            $start_date = date('Y-m-d', strtotime('+1days', strtotime($start_date)));
        }
        return $dateTime;
    }
}
