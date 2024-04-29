<?php
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
    $date = $json_data[$i][10];

    preg_match($day_regex, $date, $day_match);
    preg_match($month_regex, $date, $month_match);
    preg_match($year_regex, $date, $year_match);
    
    $date = str_replace("/", "", $year_match[0]) . "-" . str_replace("/", "", $month_match[0]) . "-" . str_replace("/", "", $day_match[0]);
    if (!array_key_exists($date, $sales)) $sales[$date] = 1;
    else $sales[$date]++;

    if (!array_key_exists($date, $sales_by_gender)) {
        $sales_by_gender[$date]["Male"] = 0;
        $sales_by_gender[$date]["Female"] = 0;
    }
    if ($json_data[$i][4] === "Male") $sales_by_gender[$date]["Male"]++;
    else $sales_by_gender[$date]["Female"]++;

}

uksort($sales, "compare_date_keys");
uksort($sales_by_gender, "compare_date_keys");

//print_r($sales_by_gender);

echo json_encode(array("total_sales" => $sales, "sales_by_gender" => $sales_by_gender));