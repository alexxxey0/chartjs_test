<?php

$csv_data = file_get_contents("students_data.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$hobbies = array();

for ($i = 1; $i < sizeof($json_data) - 1; $i++) {
    $hobby = $json_data[$i][8];

    if (!array_key_exists($hobby, $hobbies)) $hobbies[$hobby] = 1;
    else $hobbies[$hobby]++;
}

//print_r($hobbies);
echo json_encode($hobbies);