<?php
// Include the header
include('header.php');
include('config.php');

// Fetch the goal from admin_plan table
$sql = "SELECT goal, duration, skill, days FROM admin_plan LIMIT 1"; // Adjust the query as needed
$result = $conn->query($sql);

$goal = "";
$days = 0; // Initialize $days to ensure it's always defined
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $goal = $row['goal'];
        $duration = $row['duration'];
        $skill = $row['skill'];
        $days = (int)$row['days']; // Convert to integer for safer use
    }
} else {
    $goal = "Goal not found"; // Default message if no goal is found
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Your Page Title</title>
</head>
<body>

<div class="plan-details">
    <div class="detail">
        <p>GOAL</p>
        <p><strong><?php echo htmlspecialchars($goal); ?></strong></p>
    </div>
    <div class="detail">
        <p>DURATION</p>
        <p><strong><?php echo htmlspecialchars($duration); ?></strong></p>
    </div>
    <div class="detail">
        <p>SKILL LEVEL</p>
        <p><strong><?php echo htmlspecialchars($skill); ?></strong></p>
    </div>
    <div class="detail">
        <p>DAYS PER WEEK</p>
        <p><strong><?php echo htmlspecialchars($days); ?></strong></p>
    </div>
    <div class="detail">
        <p>TYPE</p>
        <p><strong>Muscle Endurance, Strength Training</strong></p>
    </div>
</div>

<div class="week-plan">
    <h2>Week 1 to <?php echo($duration); ?> | Full-Body Split</h2>
    
    <?php 
    for ($i = 1; $i <= $days; $i++) {
        if ($i % 2 == 0) {
            // Show rest days on even-numbered days
            echo '
            <div class="day-card rest-day">
                <h3>DAY ' . $i . '</h3>
                <p>REST</p>
            </div>';
        } else {
            // Show workout days on odd-numbered days
            echo '
            <div class="day-card">
                <div class="day-info">
                    <h3>DAY ' . $i . '</h3>
                    <p>Full Body</p>
                </div>
                <div class="day-details">
                    <p>📅 9</p>
                    <p>🔒 Yes</p>
                </div>
                <div class="start-button">
                    <a href="workout_plan.php">START</a>
                </div>
            </div>';
        }
    }
    ?>
</div>

<style>
/* Your existing CSS styles */
.plan-details {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  background-color: #2b2b2b;
  padding: 20px;
  color: #fff;
  font-family: Arial, sans-serif;
}

.plan-details .detail {
  flex: 1 1 45%;
  margin-bottom: 20px;
}

.plan-details p {
  margin: 0;
}

.plan-details p:first-child {
  font-size: 0.9em;
  color: #ccc;
}

.plan-details p strong {
  font-size: 1.2em;
  color: #fff;
}

body {
    font-family: Arial, sans-serif;
    background-color: #2b2b2b;
    color: #fff;
}

.week-plan {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}

.week-plan h2 {
    margin-bottom: 20px;
    font-size: 1.5em;
    font-weight: bold;
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

.day-info {
    flex: 2;
}

.day-details {
    flex: 1;
    display: flex;
    justify-content: space-around;
}

.start-button a {
    color: red;
    font-weight: bold;
    text-decoration: none;
}

.rest-day {
    background-color: #f0f0f0;
    color: #aaa;
    text-align: center;
}
</style>

<?php
// Include the footer
include('footer.php');
?>
</body>
</html>
