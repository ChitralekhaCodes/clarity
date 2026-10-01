<!DOCTYPE html>
<html>
<head>
    <title>Clarity - Add Activity</title>
</head>

<body>

<h2>Add Your Activity</h2>

<form action="save_activity.php" method="POST">

    <label>Category:</label><br>
    <input type="text" name="category" placeholder="e.g. Transport" required>
    <br><br>

    <label>Type:</label><br>
    <input type="text" name="type" placeholder="e.g. Car" required>
    <br><br>

    <label>Quantity:</label><br>
    <input type="number" step="0.01" name="quantity" required>
    <br><br>

    <label>Unit:</label><br>
    <input type="text" name="unit" placeholder="e.g. km" required>
    <br><br>

    <label>Date:</label><br>
    <input type="date" name="activity_date" required>
    <br><br>

    <button type="submit">Add Activity</button>

</form>

</body>
</html>