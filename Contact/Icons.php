<?php

// User IP Function
function ip()
{
    if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    } else {
        $ip = $_SERVER["REMOTE_ADDR"];
    }
    return $ip;
}

// Load An Icon
$color = "Light";
if (isset($_GET['color'])) {
    if ($_GET['color'] == "Dark") {
        $color = "Dark";
    }
}
if (is_file('Data/Data') && isset($_GET['number'])) {
    if ($_GET['number'] == 0 || $_GET['number'] == 1 || $_GET['number'] == 2) {
        $data  = array_reverse(file('Data/Data'));
        $count = count($data);
        $i     = 0;
        $stop  = '';
        $ip    = md5(ip());
        while ($i < $count && $stop !== 'stop') {
            if ($data[$i] == $ip . "contactF_0\r\n" || $data[$i] == $ip . "contactF_1\r\n" || $data[$i] == $ip . "contactF_2\r\n") {
                $icons = str_replace("\r\n", '', $data[$i - 1]);
                $icons = explode('#', $icons);
                header('Content-type: image/jpeg');
                echo implode(file("Icons $color/" . $icons[$_GET['number']]));
                $stop = 'stop';
            }
            $i++;
        }
    }
}

?>