<?php
session_start();
include("config.php");

if (!isset($_REQUEST['id'])) {
    die("User ID is not specified.");
}

$id = intval($_REQUEST['id']); // Ensure $id is an integer

// Debug: Check the user ID
echo "User ID: $id<br>";

// Fetch user details from the database
$user_result = mysqli_query($con, "SELECT `id`, `name` FROM `attendance` WHERE id=$id");

if (!$user_result) {
    die("Error fetching user details: " . mysqli_error($con));
}

// Debug: Print the number of rows returned
echo "Number of user records found: " . mysqli_num_rows($user_result) . "<br>";

if (mysqli_num_rows($user_result) == 0) {
    die("User not found.");
}

// Fetch user details
$user_row = mysqli_fetch_array($user_result);
$id = $user_row['id'];
$name = $user_row['name']; // Ensure $name is set
 // Ensure $user_password is set

// Fetch attendance details for the user
$attendance_result = mysqli_query($con, "SELECT * FROM `attendance` WHERE id = $id");

if (!$attendance_result) {
    die("Error fetching attendance details: " . mysqli_error($con));
}

if (mysqli_num_rows($attendance_result) == 0) {
    die("Attendance record not found.");
}

$attendance_row = mysqli_fetch_array($attendance_result);

// Check if the form is submitted
if (isset($_POST['edit'])) {
    $first_name = $_POST['name'];
  

    // Update user details in the database
    $update_user_query = "UPDATE `attendance` SET `name`='$name' WHERE id=$id";

    if (mysqli_query($con, $update_user_query)) {
        // Update attendance details if provided
        $attendance_date = $_POST['attendance_date'];
        $check_in_time = $_POST['check_in_time'];
        $check_out_time = $_POST['check_out_time'];
        $status = $_POST['status'];

        // Update attendance
        $update_attendance_query = "UPDATE `attendance` SET 
            date='$attendance_date', 
            check_in_time='$check_in_time', 
            check_out_time='$check_out_time', 
            status='$status' 
            WHERE id=$id"; // Update based on the correct attendance ID

        if (!mysqli_query($con, $update_attendance_query)) {
            die("Error updating attendance: " . mysqli_error($con));
        }

        // Redirect to manageuser.php after successful update
        header("Location: manageuser.php");
        exit; // Ensure no further code is executed after redirection
    } else {
        die("Error updating user details: " . mysqli_error($con));
    }
}

mysqli_close($con);

include "sidenav.php";
include "topheader.php";
?>

<!-- HTML Form and other content -->

<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="float-right">
                <a href="manageuser.php" class="btn btn-primary">Back</a><br><br><br>
            </div>
            <div class="card">
                <div class="card-header card-header-primary">
                    <h5 class="title">Edit User & Attendance</h5>
                </div>
                <form action="edituser.php?id=<?php echo $id; ?>" name="form" method="post" enctype="multipart/form-data">
                   
                        
                        <!-- Attendance Details -->
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Date</label>
                                <input type="date" name="attendance_date" class="form-control" value="<?php echo htmlspecialchars($attendance_row['date']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Check-In Time</label>
                                <input type="time" name="check_in_time" class="form-control" value="<?php echo htmlspecialchars($attendance_row['check_in_time']); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Check-Out Time</label>
                                <input type="time" name="check_out_time" class="form-control" value="<?php echo htmlspecialchars($attendance_row['check_out_time']); ?>">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="status" class="form-control" required>
                                    <option value="Present" <?php echo ($attendance_row['status'] == 'Present') ? 'selected' : ''; ?>>Present</option>
                                    <option value="Absent" <?php echo ($attendance_row['status'] == 'Absent') ? 'selected' : ''; ?>>Absent</option>
                                    <option value="On Leave" <?php echo ($attendance_row['status'] == 'On Leave') ? 'selected' : ''; ?>>On Leave</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" id="btn_save" name="edit" class="btn btn-fill btn-primary">Update</button>
                    </div>
                </form>    
            </div>
        </div>         
    </div>
</div>

<?php
include "footer.php";
?>
