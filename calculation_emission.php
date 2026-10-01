<?php

include "db.php";

/* 1. Get latest activity */
$activity_query = "SELECT activity_id, user_id, category, type, quantity, unit
                   FROM activities
                   ORDER BY activity_id DESC
                   LIMIT 1";

$activity_result = $conn->query($activity_query);

if ($activity_result->num_rows == 0) {
    die("No activity found.");
}

$activity = $activity_result->fetch_assoc();

$activity_id = $activity["activity_id"];
$user_id = $activity["user_id"];
$category = $activity["category"];
$type = $activity["type"];
$quantity = $activity["quantity"];
$unit = $activity["unit"];


/* 2. Find emission factor */
$factor_query = "SELECT factor
                 FROM emission_factors
                 WHERE category = '$category'
                 AND type = '$type'
                 AND unit = '$unit'
                 LIMIT 1";

$factor_result = $conn->query($factor_query);

if ($factor_result->num_rows == 0) {
    die("No emission factor found for this activity.");
}

$factor_data = $factor_result->fetch_assoc();

$emission_factor = $factor_data["factor"];


/* 3. Calculate emission */
$total_emission = $quantity * $emission_factor;


/* 4. Check if calculation already exists */
$check_query = "SELECT calculation_id, total_emission
                FROM calculations
                WHERE activity_id = $activity_id
                LIMIT 1";

$check_result = $conn->query($check_query);


/* 5. Save calculation */
if ($check_result->num_rows > 0) {

    $existing = $check_result->fetch_assoc();

    $total_emission = $existing["total_emission"];

    echo "Calculation already exists!<br><br>";

} else {

    $insert_query = "INSERT INTO calculations
                     (activity_id, user_id, quantity, emission_factor, total_emission)
                     VALUES
                     ($activity_id, $user_id, $quantity, $emission_factor, $total_emission)";

    if ($conn->query($insert_query) === TRUE) {

        echo "Calculation successful!<br><br>";

    } else {

        echo "Error: " . $conn->error;
    }
}


/* 6. Display result */
echo "Activity ID: $activity_id<br>";
echo "Category: $category<br>";
echo "Type: $type<br>";
echo "Quantity: $quantity $unit<br>";
echo "Emission Factor: $emission_factor<br>";
echo "Total Emission: $total_emission kg CO2<br><br>";


/* 7. Generate insight automatically */
$insight = "";

if ($total_emission <= 2) {

    $insight = "Your carbon emission is currently low. Keep maintaining sustainable activities.";

} elseif ($total_emission <= 5) {

    $insight = "Your carbon emission is moderate. Consider reducing unnecessary transport activities.";

} else {

    $insight = "Your carbon emission is relatively high. Try using public transport or reducing unnecessary travel.";
}


/* 8. Save insight */
$insight = $conn->real_escape_string($insight);

$insight_query = "INSERT INTO ai_insights
                  (user_id, insight)
                  VALUES
                  ($user_id, '$insight')";

if ($conn->query($insight_query) === TRUE) {

    echo "AI Insight:<br>";
    echo $insight;

} else {

    echo "Insight Error: " . $conn->error;
}

?>