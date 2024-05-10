<?php

$conn = new mysqli("localhost", "root", "", "students");

$get_gender_sql = "SELECT gender FROM students";
$gender_data = $conn->query($get_gender_sql);

$genders = array();

while ($row = $gender_data->fetch_assoc()) {
    $gender = $row["gender"];
    if ($gender === "F") $gender = "Female";
    else if ($gender === "M") $gender = "Male";

    if (!array_key_exists($gender, $genders)) $genders[$gender] = 1;
    else $genders[$gender]++;
}
$conn->close();

//print_r($genders);
echo json_encode($genders);
