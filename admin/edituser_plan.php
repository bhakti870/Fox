<?php
session_start();
include("config.php");

// Get the ID from the request
$id = $_REQUEST['id'];

// Fetch existing data for the provided ID
$result = mysqli_query($con, "SELECT `id`, `Exercise`, `Equipment`, `Reps` FROM `workout` WHERE id = $id");
$row = mysqli_fetch_assoc($result);

$Exercise = $row['Exercise'];
$Equipment = $row['Equipment'];
$Reps = $row['Reps'];

// Handle the form submission
if (isset($_POST['edit'])) {
    $Exercise = $_POST['Exercise'];
    $Equipment = $_POST['Equipment'];
    $Reps = $_POST['Reps'];

    // Update the workout record in the database
    $update_query = "UPDATE `workout` SET `Exercise`='$Exercise', `Equipment`='$Equipment', `Reps`='$Reps' WHERE id=$id";
    if (mysqli_query($con, $update_query)) {
        header("location: user_plan.php");
        exit();
    } else {
        die("Error updating record: " . mysqli_error($con));
    }

    mysqli_close($con);
}

// Include navigation and header files
include "sidenav.php";
include "topheader.php";
?>

<!-- Form UI for Editing the Workout Plan -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="title">Edit Workout Plan</h5>
            </div>
            <form action="edituser_plan.php" name="form" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    
                    <!-- Exercise Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Exercise</label>
                            <input type="text" id="Exercise" name="Exercise" class="form-control" value="<?php echo $Exercise; ?>" >
                        </div>
                    </div>
                    
                    <!-- Equipment Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Equipment</label>
                            <input type="text" id="Equipment" name="Equipment" class="form-control" value="<?php echo $Equipment; ?>" >
                        </div>
                    </div>
                    
                    <!-- Reps Field -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Reps</label>
                            <input type="text" id="Reps" name="Reps" class="form-control" value="<?php echo $Reps; ?>" >
                        </div>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <div class="card-footer">
                    <button type="submit" id="btn_save" name="edit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include "footer.php";
?>
