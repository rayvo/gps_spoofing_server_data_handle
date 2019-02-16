<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-20
 * Time: 00:25
 */


function computeTimeDiff($strCurrentTime, $strLastTime) {
    $currentTime = strtotime($strCurrentTime);
    $lastTime = strtotime($strLastTime);
    $interval = $currentTime - $lastTime;
    return $interval;
}

function formatDateTime($dateTime) {
    return date("Y-m-d H:i:s");
}
