<?php

include "convert_date.php";

$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));

$sales = array();
$sales_by_gender = array();
$day_regex = "/\/[0-9]+\//";
$month_regex = "/^[0-9]+\//";
$year_regex = "/\/[0-9]+$/";


function compare_date_keys($dt1, $dt2) {
    return strtotime($dt1) - strtotime($dt2);
}

for ($i = 1; $i < sizeof($json_data); $i++) {
    $date = convert_date($json_data[$i][10]);

    if (isset($_POST["date_from"]) and isset($_POST["date_until"]) and $_POST["date_from"] !== "" and $_POST["date_until"] !== "") {
        $selected_date_from = $_POST["date_from"];
        $selected_date_until = $_POST["date_until"];

        if (strtotime($date) < strtotime($selected_date_from) or strtotime($date) > strtotime($selected_date_until)) continue;
    }

    if (!array_key_exists($date, $sales)) $sales[$date] = 1;
    else $sales[$date]++;
}

uksort($sales, "compare_date_keys");

/*if (isset($_POST["date_from"]) and isset($_POST["date_until"]) and $_POST["date_from"] !== "" and $_POST["date_until"] !== "") {
    $selected_date_from = $_POST["date_from"];
    $selected_date_until = $_POST["date_until"];

    $sales_for_selected_period = array();
    foreach ($sales as $date => $date_sales) {
        if (strtotime($date) >= strtotime($selected_date_from) and strtotime($date) <= strtotime($selected_date_until)) {
            $sales_for_selected_period[$date] = $date_sales;
        }
    }
    echo json_encode(array("total_sales" => $sales_for_selected_period));
    return;
}

//print_r($sales_by_gender);
*/
echo json_encode(array("total_sales" => $sales));
return;
