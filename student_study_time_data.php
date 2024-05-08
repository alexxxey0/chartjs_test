<?php

$csv_data = file_get_contents("students_data.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$times = array("Morning" => 0, "Night" => 0, "Anytime" => 0);

for ($i = 1; $i < sizeof($json_data) - 1; $i++) {
    $time = $json_data[$i][10];
    if ($time === "Morning") $times["Morning"]++;
    else if ($time === "Night") $times["Night"]++;
    else if ($time === "Anytime") $times["Anytime"]++;
}

//print_r($times);
echo json_encode($times);