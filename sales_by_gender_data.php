<?php
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));
$genders = array("Male" => 0, "Female" => 0);

for ($i = 1; $i < sizeof($json_data); $i++) {
    $gender = $json_data[$i][4];
    $genders[$gender]++;
}

//print_r($genders);
echo json_encode($genders);