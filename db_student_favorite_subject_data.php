<?php

$conn = new mysqli("localhost", "root", "", "students");

$get_subject_sql = "SELECT favorite_subject FROM students";
$subject_data = $conn->query($get_subject_sql);

$subjects = array();

while ($row = $subject_data->fetch_assoc()) {
    $subject = $row["favorite_subject"];

    if (!array_key_exists($subject, $subjects)) $subjects[$subject] = 1;
    else $subjects[$subject]++;
}

$conn->close();

// print_r($subjects);
echo json_encode($subjects);