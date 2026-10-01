<?php

include "db.php";

$user_id = 1;
$category = "Transport";
$type = "Car";
$quantity = 10;
$unit = "km";
$activity_date = "2026-09-28";

$sql = "INSERT INTO activities
        (user_id, category, type, quantity, unit, activity_date)
        VALUES
        ('$user_id', '$category', '$type', '$quantity', '$unit', '$activity_date')";

if ($conn->query($sql) === TRUE) {
    echo "Activity added successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>