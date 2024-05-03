<?php
include "convert_date.php";
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));
$payments = array("Cash" => 0, "Credit card" => 0, "Ewallet" => 0);

for ($i = 1; $i < sizeof($json_data); $i++) {
    $date = convert_date($json_data[$i][10]);

    if (isset($_POST["date_from"]) and isset($_POST["date_until"]) and $_POST["date_from"] !== "" and $_POST["date_until"] !== "") {
        $selected_date_from = $_POST["date_from"];
        $selected_date_until = $_POST["date_until"];

        if (strtotime($date) < strtotime($selected_date_from) or strtotime($date) > strtotime($selected_date_until)) continue;
    }

    $payment = $json_data[$i][12];
    $payments[$payment]++;
}

// print_r($payments);
echo json_encode($payments);