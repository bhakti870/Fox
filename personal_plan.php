<?php
include('header.php');
include('config.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    echo "<script>var isLoggedIn = false;</script>";
} else {
    echo "<script>var isLoggedIn = true;</script>";
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id']; 
    $exercise_id = $_SESSION['id'];// Assuming user_id is stored in session after login

    // Get form data and sanitize it
    $name = $conn->real_escape_string(trim($_POST['name']));
    $weight = $conn->real_escape_string(trim($_POST['weight']));
    $goal = $conn->real_escape_string(trim($_POST['goal']));
    $skillLevel = $conn->real_escape_string(trim($_POST['skillLevel']));
    $duration = $conn->real_escape_string(trim($_POST['duration']));
    $days = $conn->real_escape_string(trim($_POST['days']));

    // Debug: Print values to check what is being captured (Remove or comment out in production)
    // echo "Name: $name, Weight: $weight, Goal: $goal, Skill Level: $skillLevel, Duration: $duration, Days: $days";

    // Check if weight is valid
    if ($weight === '' || !is_numeric($weight) || floatval($weight) <= 0) {
        echo "<script>alert('Please enter a valid weight greater than 0.');</script>";
    } else {
        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO admin_plan (Name, Weight, Goal, Skill, Duration, Days, user_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssssi", $name, $weight, $goal, $skillLevel, $duration, $days, $user_id);

        // Execute the statement
        if ($stmt->execute()) {
            // echo "<script>alert('Data inserted successfully!');</script>";
            header('Location: plan_detail.php?id=' . $user_id);
            exit;
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Close statement
        $stmt->close();
    }
}

// Close connection
$conn->close();
?>


<!doctype html>
<html lang="en">
<head>
<style>
  body {
    background-color: #d3f0ff; /* Light blue color for the whole page */
  }

  .form-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
  }

  .form-box {
    background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
  }

  .form-box h4 {
    text-align: center;
    color: orange;
    margin-bottom: 20px;
  }

  .rating {
    display: flex;
    justify-content: space-between;
  }

  .rating label {
    margin-right: 10px;
  }

  .emoji-feedback {
    display: flex;
    justify-content: space-between;
    margin-top: 10px;
  }

  .emoji-feedback label {
    cursor: pointer;
  }

  .emoji-feedback input {
    display: none;
  }

  .emoji-feedback img {
    width: 40px;
    height: 40px;
    transition: transform 0.2s;
  }

  .emoji-feedback img:hover {
    transform: scale(1.2);
  }

  .error-message {
    color: red;
    font-size: 12px;
    margin-top: 5px;
  }
</style>
</head>
<body>

  <div class="container-fluid form-container">
    <div class="col-md-6 footer2 wow bounceInUp" data-wow-delay=".25s" id="contact">
      <div class="form-box">
        <h4>PLAN FORM</h4>
        <form id="contactForm" method="POST">
          <table class="table table-responsive d-table">
            <tr>
              <td>
                <input type="text" class="form-control pl-0" placeholder="NAME" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>" />
                <div id="name-error" class="error-message"></div>
              </td>
              <td>
                <input type="number" class="form-control pl-0" placeholder="WEIGHT (kg)" step="0.1" id="weight" name="weight" value="<?php echo isset($_SESSION['weight']) ? $_SESSION['weight'] : ''; ?>" />
                <div id="weight-error" class="error-message"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <div class="radio-group">
                  <label>GOAL:</label>
                  <label><input type="radio" name="goal" value="Fat Loss" /> Fat Loss</label>
                  <label><input type="radio" name="goal" value="Strength" /> Strength</label>
                  <label><input type="radio" name="goal" value="Hypertrophy" /> Hypertrophy</label>
                </div>
                <div id="goal-error" class="error-message"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="skillLevel">SKILL LEVEL:</label>
                <select id="skillLevel" name="skillLevel" class="form-control pl-0">
                  <option value="" disabled selected>Select Skill Level</option>
                  <option value="beginner">Beginner</option>
                  <option value="intermediate">Intermediate</option>
                  <option value="advanced">Advanced</option>
                </select>
                <div id="skillLevel-error" class="error-message"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="duration">DURATION:</label>
                <select id="duration" name="duration" class="form-control pl-0">
                  <option value="" disabled selected>Select Duration</option>
                  <option value="1month">1 Month</option>
                  <option value="3months">3 Months</option>
                  <option value="6months">6 Months</option>
                  <option value="12months">12 Months</option>
                </select>
                <div id="duration-error" class="error-message"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                <label for="days">DAYS:</label>
                <select id="days" name="days" class="form-control pl-0">
                  <option value="" disabled selected>Select Days</option>
                  <option value="1">1-6</option>
                  <option value="2">2-6</option>
                  <option value="3">3-6</option>
                  <option value="4">4-6</option>
                  <option value="5">5-6</option>
                  <option value="6">6-6</option>
                </select>
                <div id="days-error" class="error-message"></div>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center pl-0">
                <button type="submit" class="btn btn-dark">Start this plan</button>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/wow.js"></script>
<script src="js/main.js"></script>
<script>
  $(document).ready(function() {
    $('#contactForm').submit(function(event) {
      var isValid = true;

      // Clear previous error messages
      $('.error-message').text('');

      // Validate NAME
      if ($('#name').val().trim() === '') {
        $('#name-error').text('Name is required.');
        isValid = false;
      }

      // Validate WEIGHT
      var weightValue = $('#weight').val().trim();
      if (weightValue === '' || isNaN(weightValue) || parseFloat(weightValue) <= 0) {
        $('#weight-error').text('Please enter a valid weight greater than 0.');
        isValid = false;
      }

      // Validate GOAL
      if (!$('input[name="goal"]:checked').val()) {
        $('#goal-error').text('Please select a goal.');
        isValid = false;
      }

      // Validate Skill Level
      if ($('#skillLevel').val() === null) {
        $('#skillLevel-error').text('Please select a skill level.');
        isValid = false;
      }

      // Validate Duration
      if ($('#duration').val() === null) {
        $('#duration-error').text('Please select a duration.');
        isValid = false;
      }

      // Validate Days
      if ($('#days').val() === null) {
        $('#days-error').text('Please select the number of days.');
        isValid = false;
      }

      // If not valid, prevent form submission
      if (!isValid) {
        event.preventDefault();
        return;
      }

      // Redirect to login if not logged in
      if (!isLoggedIn) {
        event.preventDefault();
        window.location.href = 'login_form.php'; // Redirect to login page
      }
    });
  });
</script>
</body>
</html>
