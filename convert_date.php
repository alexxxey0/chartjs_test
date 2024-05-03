<?php

// Convert date from m/d/y to y-m-d
function convert_date($date) {
    $day_regex = "/\/[0-9]+\//";
    $month_regex = "/^[0-9]+\//";
    $year_regex = "/\/[0-9]+$/";

    preg_match($day_regex, $date, $day_match);
    preg_match($month_regex, $date, $month_match);
    preg_match($year_regex, $date, $year_match);
    
    $date = str_replace("/", "", $year_match[0]) . "-" . str_replace("/", "", $month_match[0]) . "-" . str_replace("/", "", $day_match[0]);
    return $date;
}