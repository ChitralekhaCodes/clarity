<?php

include "db.php";

$name = "Chitralekha";
$email = "chitra@example.com";
$password = "123456";

$sql = "INSERT INTO users (name, email, password)
        VALUES ('$name', '$email', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "User added successfully!";
} else {
    echo "Error: " . $conn->error;
}

?>