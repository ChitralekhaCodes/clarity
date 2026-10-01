<?php

include "db.php";

$category = "Transport";
$type = "Car";
$unit = "km";
$factor = 0.21;

$sql = "INSERT INTO emission_factors
        (category, type, unit, factor)
        VALUES
        ('$category', '$type', '$unit', '$factor')";

if ($conn->query($sql) === TRUE) {
    echo "Emission factor added successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>