<?php

include "db.php";

$user_id = 1;

$sql = "SELECT total_emission
        FROM calculations
        WHERE user_id = $user_id
        ORDER BY calculation_id DESC
        LIMIT 1";

$result = $conn->query($sql);

if ($result->num_rows > 0) {

    $data = $result->fetch_assoc();
    $emission = $data["total_emission"];

    if ($emission <= 2) {
        $insight = "Your carbon emission is currently low. Keep maintaining sustainable activities.";
    } elseif ($emission <= 5) {
        $insight = "Your carbon emission is moderate. Consider reducing unnecessary transport activities.";
    } else {
        $insight = "Your carbon emission is relatively high. Try using public transport or reducing unnecessary travel.";
    }

    $insert = "INSERT INTO ai_insights (user_id, insight)
               VALUES ($user_id, '$insight')";

    if ($conn->query($insert) === TRUE) {
        echo "Insight generated successfully!<br>";
        echo $insight;
    } else {
        echo "Error: " . $conn->error;
    }

} else {
    echo "No calculation found.";
}

?>