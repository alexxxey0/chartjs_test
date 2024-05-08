<?php

$csv_data = file_get_contents("students_data.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$genders = array("Male" => 0, "Female" => 0);

for ($i = 1; $i < sizeof($json_data) - 1; $i++) {
    $gender = $json_data[$i][1];
    if ($gender === "Male") $genders["Male"]++;
    else if ($gender === "Female") $genders["Female"]++;
}

// print_r($genders);
echo json_encode($genders);