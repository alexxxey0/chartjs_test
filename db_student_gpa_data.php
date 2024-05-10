<?php

$conn = new mysqli("localhost", "root", "", "students");

$get_gpa_sql = "SELECT gpa FROM students";
$gpa_data = $conn->query($get_gpa_sql);

$gpas = array("2.0-2.4" => 0, "2.5-2.9" => 0, "3.0-3.4" => 0, "3.5-3.9" => 0);

while ($row = $gpa_data->fetch_assoc()) {
    $gpa = $row["gpa"];

    if ($gpa >= 2.0 and $gpa <= 2.4) $gpas["2.0-2.4"]++;
    else if ($gpa >= 2.5 and $gpa <= 2.9) $gpas["2.5-2.9"]++;
    else if ($gpa >= 3.0 and $gpa <= 3.4) $gpas["3.0-3.4"]++;
    else if ($gpa >= 3.5 and $gpa <= 3.9) $gpas["3.5-3.9"]++;
}
$conn->close();

echo json_encode($gpas);