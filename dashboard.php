<?php

include "db.php";

$user_id = 1;


/* Get user details */
$user_query = "SELECT name, email
               FROM users
               WHERE user_id = $user_id
               LIMIT 1";

$user_result = $conn->query($user_query);

if ($user_result->num_rows > 0) {
    $user = $user_result->fetch_assoc();
    $name = $user["name"];
    $email = $user["email"];
} else {
    $name = "User";
    $email = "";
}


/* Get latest activity */
$activity_query = "SELECT category, type, quantity, unit, activity_date
                   FROM activities
                   WHERE user_id = $user_id
                   ORDER BY activity_id DESC
                   LIMIT 1";

$activity_result = $conn->query($activity_query);


/* Get latest calculation */
$calculation_query = "SELECT total_emission
                      FROM calculations
                      WHERE user_id = $user_id
                      ORDER BY calculation_id DESC
                      LIMIT 1";

$calculation_result = $conn->query($calculation_query);

if ($calculation_result->num_rows > 0) {
    $calculation = $calculation_result->fetch_assoc();
    $total_emission = $calculation["total_emission"];
} else {
    $total_emission = 0;
}


/* Get latest AI insight */
$insight_query = "SELECT insight
                  FROM ai_insights
                  WHERE user_id = $user_id
                  ORDER BY insight_id DESC
                  LIMIT 1";

$insight_result = $conn->query($insight_query);

if ($insight_result->num_rows > 0) {
    $insight_data = $insight_result->fetch_assoc();
    $insight = $insight_data["insight"];
} else {
    $insight = "No insight available yet.";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>Clarity Dashboard</title>

</head>

<body>

    <h1>CLARITY</h1>

    <h2>Carbon Activity Dashboard</h2>

    <hr>

    <h3>User Information</h3>

    <p>
        <strong>Name:</strong>
        <?php echo $name; ?>
    </p>

    <p>
        <strong>Email:</strong>
        <?php echo $email; ?>
    </p>

    <hr>

    <h3>Latest Activity</h3>

    <?php

    if ($activity_result->num_rows > 0) {

        $activity = $activity_result->fetch_assoc();

    ?>

        <p>
            <strong>Category:</strong>
            <?php echo $activity["category"]; ?>
        </p>

        <p>
            <strong>Type:</strong>
            <?php echo $activity["type"]; ?>
        </p>

        <p>
            <strong>Quantity:</strong>
            <?php echo $activity["quantity"]; ?>
            <?php echo $activity["unit"]; ?>
        </p>

        <p>
            <strong>Date:</strong>
            <?php echo $activity["activity_date"]; ?>
        </p>

    <?php

    } else {

        echo "<p>No activity found.</p>";

    }

    ?>

    <hr>

    <h3>Carbon Emission</h3>

    <h2>
        <?php echo $total_emission; ?> kg CO2
    </h2>

    <hr>

    <h3>AI Insight</h3>

    <p>
        <?php echo $insight; ?>
    </p>

    <hr>

    <p>
        <a href="activity_form.php">
            Add New Activity
        </a>
    </p>

</body>

</html>
