<?php

include "db.php";

$user_id = 1;

$category = $_POST["category"];
$type = $_POST["type"];
$quantity = $_POST["quantity"];
$unit = $_POST["unit"];
$activity_date = $_POST["activity_date"];

$sql = "INSERT INTO activities
        (user_id, category, type, quantity, unit, activity_date)
        VALUES
        ('$user_id', '$category', '$type', '$quantity', '$unit', '$activity_date')";

if ($conn->query($sql) === TRUE) {

    header("Location: calculation_emission.php");
    exit();

} else {

    echo "Error: " . $conn->error;
}

?>