<?php
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$dates = array();
$day_regex = "/\/[0-9]+\//";
$month_regex = "/^[0-9]+\//";
$year_regex = "/\/[0-9]+$/";

function compare_date_keys($dt1, $dt2) {
    return strtotime($dt1) - strtotime($dt2);
}

for ($i = 1; $i < sizeof($json_data); $i++) {
    $date = $json_data[$i][10];

    preg_match($day_regex, $date, $day_match);
    preg_match($month_regex, $date, $month_match);
    preg_match($year_regex, $date, $year_match);
    
    $date = str_replace("/", "", $year_match[0]) . "-" . str_replace("/", "", $month_match[0]) . "-" . str_replace("/", "", $day_match[0]);
    if (!array_key_exists($date, $dates)) $dates[$date] = 1;
    else $dates[$date]++;

    uksort($dates, "compare_date_keys");
}

//print_r($dates);

echo json_encode($dates);