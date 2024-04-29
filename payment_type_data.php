<?php
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));
$payments = array("Cash" => 0, "Credit card" => 0, "Ewallet" => 0);

for ($i = 1; $i < sizeof($json_data); $i++) {
    $payment = $json_data[$i][12];
    $payments[$payment]++;
}

// print_r($payments);
echo json_encode($payments);