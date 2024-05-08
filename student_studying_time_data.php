<?php

$csv_data = file_get_contents("students_data.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$studying_times = array();

for ($i = 1; $i < sizeof($json_data) - 1; $i++) {
    $studying_time = $json_data[$i][9];

    if (!array_key_exists($studying_time, $studying_times)) $studying_times[$studying_time] = 1;
    else $studying_times[$studying_time]++;
}

echo json_encode($studying_times);