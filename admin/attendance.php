<?php
include("config.php");
include "sidenav.php";
include "topheader.php";

if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $date = $_POST['date'];
    $check_in_time = $_POST['check_in_time'];
    $check_out_time = $_POST['check_out_time'];
    $status = $_POST['status'];

    $query = "INSERT INTO attendance (user_id, date, check_in_time, check_out_time, status) VALUES ('$user_id', '$date', '$check_in_time', '$check_out_time', '$status')";
    mysqli_query($con, $query) or die("Query Failed: " . mysqli_error($con));
    
    echo "<script>alert('Attendance added successfully');window.location.href='manageuser.php';</script>";
}
?>

<div class="content">
    <div class="container-fluid">
        <div class="col-md-8">
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
                                $user_result = mysqli_query($con, "SELECT id, name FROM users");
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

<?php include "footer.php"; ?>
