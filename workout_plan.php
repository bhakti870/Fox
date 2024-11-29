<?php
include('header.php');
include('config.php'); // Ensure this file establishes your database connection
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}

// Get the logged-in user's ID
$user_id = $_SESSION['id'];



// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workout Plan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #2b2b2b;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .simple-row {
            display: flex;
            justify-content: space-around;
            margin-bottom: 10px;
            text-align: left;
            font-size: 1.1em;
        }
        .simple-row div {
            margin: 0 99px;
        }
        .simple-row div {
            flex: 1;
            font-weight: bold;
        }
        .week-plan h2 {
            margin-bottom: 20px;
            font-size: 1.5em;
            font-weight: bold;
            color: #fff;
            border-bottom: 1px solid #444;
            padding-bottom: 10px;
        }
        .day-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            color: #000;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .day-card h3 {
            margin: 0;
            font-size: 1.2em;
            font-weight: bold;
        }
        .day-card p {
            margin: 5px 0;
        }
        .day-details {
            flex: 1;
            display: flex;
            justify-content: flex-start;
            gap: 10px;
            padding-left: 15px;
        }
        .day-info {
            margin-right: 145px;
        }
        .day-details div {
            margin-right: 15px;
        }
        .start-button p {
            color: red;
            font-weight: bold;
            text-decoration: none;
        }
        .rest-day {
            background-color: #f0f0f0;
            color: #aaa;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 20px 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>FULL BODY</h2>
        <div class="simple-row">
            <div>EXERCISE</div>
            <div>EQUIPMENT</div>
            <div>REPS</div>
        </div>

        <div class="week-plan">
            <?php
            // Prepared statement to fetch workout data based on the logged-in user
            $stmt = $conn->prepare("
                SELECT w.*
                FROM workout w
                JOIN admin_plan_exercise ape ON w.id = ape.workout_id
                JOIN admin_plan ap ON ape.admin_plan_id = ap.id
                WHERE ap.user_id = ?
            ");
            // Bind the user ID to the prepared statement
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check for SQL errors
            if (!$result) {
                echo "Error: " . $conn->error;
            }

            if ($result->num_rows > 0) {
                // Loop through the workout data and create cards
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="day-card">';
                    echo '<div class="day-info">';
                    echo '<h3>' . htmlspecialchars($row["Exercise"]) . '</h3>';
                    echo '</div>';
                    echo '<div class="day-details">';
                    echo '<p>' . htmlspecialchars($row["Equipment"]) . '</p>';
                    echo '</div>';
                    echo '<div class="start-button">';
                    echo '<p>' . htmlspecialchars($row["Reps"]) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "<p>No workouts available for this user</p>";
            }

            // Close the prepared statement
            $stmt->close();
            ?>
        </div>
    </div>
</body>
</html>

<?php
include('footer.php');
$conn->close(); // Close the database connection
?>
