<?php
include "convert_date.php";
$csv_data = file_get_contents("supermarket_sales.csv");
$json_data = array_map("str_getcsv", explode("\n", $csv_data));
$ratings = array();

function higher_rating($rating1, $rating2) {
    preg_match("/^[0-9]+-/", $rating1, $match1);
    preg_match("/^[0-9]+-/", $rating2, $match2);

    $rating1 = intval($match1[0]);
    $rating2 = intval($match2[0]);

    return $rating1 - $rating2;
}

for ($i = 1; $i < sizeof($json_data); $i++) {
    $date = convert_date($json_data[$i][10]);

    if (isset($_POST["date_from"]) and isset($_POST["date_until"]) and $_POST["date_from"] !== "" and $_POST["date_until"] !== "") {
        $selected_date_from = $_POST["date_from"];
        $selected_date_until = $_POST["date_until"];

        if (strtotime($date) < strtotime($selected_date_from) or strtotime($date) > strtotime($selected_date_until)) continue;
    }

    $rating = $json_data[$i][16];
    $rating = floor($rating);

    if ($rating === floatval(10)) {
        if (!array_key_exists("9-10", $ratings)) $ratings["9-10"] = 1;
        else $ratings["9-10"]++;
    } else {
        if (!array_key_exists($rating . "-" . ($rating + 1), $ratings)) $ratings[$rating . "-" . ($rating + 1)] = 1;
        else $ratings[$rating . "-" . ($rating + 1)]++;
    }
}
uksort($ratings, "higher_rating");

echo json_encode($ratings);
