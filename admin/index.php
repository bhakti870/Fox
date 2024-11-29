<?php
session_start();
include("config.php");

include "sidenav.php";
include "topheader.php";
?>
<?php
// Define database connection parameters
$host = 'localhost';
$user = 'root';
$pwd = '';
$db = 'fox';

// Create a connection to the database
$conn = mysqli_connect($host, $user, $pwd, $db);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>

<?php


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Retrieve total users
$result_users = mysqli_query($conn, "SELECT COUNT(*) as total_users FROM registration");
$total_users = mysqli_fetch_assoc($result_users)['total_users'];

// Retrieve new users today
$result_new_users = mysqli_query($conn, "SELECT COUNT(*) as new_users_today FROM registration WHERE created_at >= CURDATE()");
$new_users_today = mysqli_fetch_assoc($result_new_users)['new_users_today'];

// Retrieve total plans
$result_plans = mysqli_query($conn, "SELECT COUNT(*) as Name FROM admin_membership");
$total_plans = mysqli_fetch_assoc($result_plans)['Name'];

// Retrieve new plans today
$result_new_plans = mysqli_query($conn, "SELECT COUNT(*) as new_plans_today FROM admin_membership WHERE created_at >= CURDATE()");
$new_plans_today = mysqli_fetch_assoc($result_new_plans)['new_plans_today'];

// Retrieve total trainers
$result_trainers = mysqli_query($conn, "SELECT COUNT(*) as total_trainers FROM trainers");
$total_trainers = mysqli_fetch_assoc($result_trainers)['total_trainers'];

// Retrieve new trainers today
$result_new_trainers = mysqli_query($conn, "SELECT COUNT(*) as new_trainers_today FROM trainers WHERE created_at >= CURDATE()");
$new_trainers_today = mysqli_fetch_assoc($result_new_trainers)['new_trainers_today'];

// Retrieve total classes
$result_classes = mysqli_query($conn, "SELECT COUNT(*) as total_classes FROM classes");
$total_classes = mysqli_fetch_assoc($result_classes)['total_classes'];

// Retrieve new classes today
$result_new_classes = mysqli_query($conn, "SELECT COUNT(*) as new_classes_today FROM classes WHERE created_at >= CURDATE()");
$new_classes_today = mysqli_fetch_assoc($result_new_classes)['new_classes_today'];

// Close database connection
mysqli_close($conn);
?>

<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
<!-- 
      <div class="col-md-3">
        <div class="card card-widget">
          <div class="card-header">
            <h3 class="card-title">Users</h3>
          </div>
          <div class="card-body">
            <h1>100</h1>
            <p>New Users Today: 5</p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card card-widget">
          <div class="card-header">
            <h3 class="card-title">Membership</h3>
          </div>
          <div class="card-body">
            <h1>20</h1>
            <p>New Membership Today: 2</p>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card card-widget">
          <div class="card-header">
            <h3 class="card-title">Trainers</h3>
          </div>
          <div class="card-body">
            <h1>15</h1>
            <p>New Trainers Today: 1</p>
          </div>
        </div>
      </div>


      <div class="col-md-3">
        <div class="card card-widget">
          <div class="card-header">
            <h3 class="card-title">Classes</h3>
          </div>
          <div class="card-body">
            <h1>50</h1>
            <p>New Classes Today: 3</p>
          </div>

        </div>
      </div> -->

      <!-- ... -->

<div class="col-md-3">
  <div class="card card-widget">
    <div class="card-header">
      <h3 class="card-title">Users</h3>
    </div>
    <div class="card-body">
      <h1><?php echo $total_users; ?></h1>
      <p>New Users Today: <?php echo $new_users_today; ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card card-widget">
    <div class="card-header">
      <h3 class="card-title">Membership</h3>
    </div>
    <div class="card-body">
      <h1><?php echo $total_plans; ?></h1>
      <p>New Membership Today: <?php echo $new_plans_today; ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card card-widget">
    <div class="card-header">
      <h3 class="card-title">Trainers</h3>
    </div>
    <div class="card-body">
      <h1><?php echo $total_trainers; ?></h1>
      <p>New Trainers Today: <?php echo $new_trainers_today; ?></p>
    </div>
  </div>
</div>

<div class="col-md-3">
  <div class="card card-widget">
    <div class="card-header">
      <h3 class="card-title">Classes</h3>
    </div>
    <div class="card-body">
      <h1><?php echo $total_classes; ?></h1>
      <p>New Classes Today: <?php echo $new_classes_today; ?></p>
    </div>
  </div>
</div>

<!-- ... -->

      <div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h4 class="card-title">Charts</h4>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <canvas id="feedbackPieChart" width="200" height="200"></canvas>
        </div>
        <div class="col-md-6">
          <canvas id="membershipBarChart" width="200" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
var ctx = document.getElementById('feedbackPieChart').getContext('2d');
  var feedbackPieChart = new Chart(ctx, {
    type: 'pie',
    data: {
      labels: ['Positive', 'Negative', 'Neutral'],
      datasets: [{
        label: 'Feedback',
        data: [40, 30, 30],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Feedback Pie Chart'
      }
    }
  });

  // Membership Bar Chart
  var ctx = document.getElementById('membershipBarChart').getContext('2d');
  var membershipBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Basic', 'Premium', 'Elite'],
      datasets: [{
        label: 'Membership',
        data: [10, 20, 30],
        backgroundColor: [
          'rgba(255, 99, 132, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)'
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: true,
        text: 'Membership Bar Chart'
      }
    }
  });
  </script>





<?php
include "footer.php";
?>