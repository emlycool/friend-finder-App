 id="register-form" action="engine/reg_val.php"
 <?php
    // function timeago($date)
    // {
    //     $timestamp = strtotime($date);

    //     $strTime = array("second", "minute", "hour", "day", "month", "year");
    //     $length = array("60", "60", "24", "30", "12", "10");

    //     $currentTime = time();
    //     if ($currentTime >= $timestamp) {
    //         $diff     = time() - $timestamp;
    //         for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
    //             $diff = $diff / $length[$i];
    //         }

    //         $diff = round($diff);
    //         return $diff . " " . $strTime[$i] . "(s) ago ";
    //     }
    // }
    // echo timeago("2019-11-2 13:05:05");


    function get_timeago($ptime)
    {
        $estimate_time = time() - $ptime;

        if ($estimate_time < 1) {
            return 'less than 1 second ago';
        }

        $condition = array(
            12 * 30 * 24 * 60 * 60  =>  'year',
            30 * 24 * 60 * 60       =>  'month',
            24 * 60 * 60            =>  'day',
            60 * 60                 =>  'hour',
            60                      =>  'minute',
            1                       =>  'second'
        );

        foreach ($condition as $secs => $str) {
            $d = $estimate_time / $secs;

            if ($d >= 1) {
                $r = round($d);
                return 'about ' . $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }
    echo get_timeago(date(strtotime("2019-11-2 12:33:05"))) . "</br>";
    $time = date("2019-11-2 14:32:05");
    $now = date("Y-m-d H:i:s");
    echo $d = strtotime($now) - strtotime($time);
    ?>
 <form class="form-inline" method="POST" id="register-form">