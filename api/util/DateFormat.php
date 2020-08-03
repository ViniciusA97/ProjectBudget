<?php

namespace Api\Util;

use DateTime;

class DateFormat{

    public function createDateInFormat(){
        date_default_timezone_set("America/recife");
        $date = date('Y-m-d H:i:s');
        return $date;
    }

    public function format($date){
        $date_time = date($date,'Y-m-d H:i:s');
        return $date_time;
    }
}
?>