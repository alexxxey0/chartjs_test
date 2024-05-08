<?php

$csv_data = file_get_contents("students_data.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$stress_levels = array("Good" => 0, "Bad" => 0, "Awful" => 0, "Fabulous" => 0);

for ($i = 1; $i < sizeof($json_data) - 1; $i++) {
    $stress_level = $json_data[$i][16];

    if ($stress_level === "Good") $stress_levels["Good"]++;
    else if ($stress_level === "Bad") $stress_levels["Bad"]++;
    else if ($stress_level === "Awful") $stress_levels["Awful"]++;
    else if ($stress_level === "fabulous") $stress_levels["Fabulous"]++;
}

//print_r($stress_levels);
echo json_encode($stress_levels);