<?php
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));
$categories = array();

for ($i = 1; $i < sizeof($json_data); $i++) {
    $category = $json_data[$i][5];
    if (!array_key_exists($category, $categories)) $categories[$category] = 1;
    else $categories[$category]++;
}

// print_r($categories);
echo json_encode($categories);