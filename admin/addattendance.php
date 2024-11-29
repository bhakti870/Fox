<?php
include("config.php");
include "sidenav.php"; // This includes the sidebar
include "topheader.php";

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    
    // Fetch the user's name based on the user_id
    $user_result = mysqli_query($con, "SELECT name FROM registration WHERE id = '$user_id'");
    $user_row = mysqli_fetch_assoc($user_result);
    $user_name = $user_row['name']; // Get the name from the query

    $date = $_POST['date'];
    $check_in_time = $_POST['check_in_time'];
    $check_out_time = $_POST['check_out_time'];
    $status = $_POST['status'];

    // Insert attendance into the database
    $query = "INSERT INTO attendance (user_id, name, date, check_in_time, check_out_time, status) 
              VALUES ('$user_id','$user_name', '$date', '$check_in_time', '$check_out_time', '$status')";
    
    if (mysqli_query($con, $query)) {
        // Only show the alert and redirect if the query is successful
        echo "<script>alert('Attendance added successfully'); window.location.href='manageuser.php';</script>";
    } else {
        // Optional: Handle query failure (you can customize the error message)
        echo "<script>alert('Failed to add attendance: " . mysqli_error($con) . "');</script>";
    }
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Form will be placed on the right side of the sidebar -->
            <div class="col-md-10 ml-auto custom-form-container">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Add Attendance</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="user_id">Select User:</label>
                                <select class="form-control" name="user_id" required>
                                    <option value="">Choose User</option>
                                    <?php
                                    $user_result = mysqli_query($con, "SELECT id, name FROM registration");
                                    while ($row = mysqli_fetch_assoc($user_result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="date">Date:</label>
                                <input type="date" class="form-control" name="date" required>
                            </div>

                            <div class="form-group">
                                <label for="check_in_time">Check-In Time:</label>
                                <input type="time" class="form-control" name="check_in_time" required>
                            </div>

                            <div class="form-group">
                                <label for="check_out_time">Check-Out Time:</label>
                                <input type="time" class="form-control" name="check_out_time">
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select class="form-control" name="status" required>
                                    <option value="Present">Present</option>
                                    <option value="Absent">Absent</option>
                                    <option value="On Leave">On Leave</option>
                                </select>
                            </div>

                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            <a href="manageuser.php" class="btn btn-secondary">Back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-form-container {
        margin-top: 100px; /* Adjust this value for spacing from the top */
        padding-left: 180px; /* Spacing from the sidebar */
        width: 80%; /* Increase width of the form container */
        margin-right: auto; /* Keep form centered from left */
    }

    select {
        background-color: black; /* Dropdown background black */
        color: white; /* Text color white */
        border: 1px solid #ccc; /* Border color */
    }

    option {
        background-color: black; /* Dropdown options background black */
        color: white; /* Text color white */
    }

    .date-picker-icon {
        font-size: 24px; /* Icon size */
        width: 24px; 
        height: 24px;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        width: 24px; /* Icon width */
        height: 24px; /* Icon height */
    }
    input[type="time"]::-webkit-calendar-picker-indicator {
        width: 24px; /* Width of the time icon */
        height: 24px; /* Height of the time icon */
    }
</style>

<?php include "footer.php"; ?>
