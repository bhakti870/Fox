<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if (isset($_POST['btn_save'])) {
    // Retrieve data from POST request
    // $id = $_POST['id'];
    $exercise = $_POST['exercise'];
    $equipment = $_POST['equipment'];
    $reps = $_POST['reps'];

    // Validation
    $errors = array();
    if (empty($id)) {
        $errors[] = "ID is required";
    } elseif (!is_numeric($id)) {
        $errors[] = "ID must be a number";
    }

    if (empty($exercise)) {
        $errors[] = "Exercise is required";
    } elseif (strlen($exercise) < 3) {
        $errors[] = "Exercise must have at least 3 characters";
    } elseif (strlen($exercise) > 50) {
        $errors[] = "Exercise cannot contain more than 50 characters";
    }

    if (empty($equipment)) {
        $errors[] = "Equipment is required";
    }

    if (empty($reps)) {
        $errors[] = "Reps is required";
    } elseif (!strlen($reps)) {
        $errors[] = "Reps cannot contain more than 50 characters";
    }

    if (count($errors) == 0) {
        // Prepare the SQL statement
        $stmt = $con->prepare("INSERT INTO `exercise_plan`(`ID`, `Exercise`, `Equipment`, `Reps`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $id, $exercise, $equipment, $reps);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to exercise_plan.php on success
            @header("location:user_plan.php");
            exit();
        } else {
            // Handle error
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        mysqli_close($con);
    }
}
?>

<!-- Form UI -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add Exercise Plan</h4>
            <p class="card-category">Complete Exercise Profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              
              <div class="row">
              
              
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Exercise</label>
                    <input type="text" name="exercise" id="exercise" class="form-control">
                    <?php if (isset($errors) && in_array("Exercise is required", $errors)) { ?>
                        <span style="color: red;">Exercise is required</span>
                    <?php } elseif (isset($errors) && in_array("Exercise must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Exercise must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Exercise cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Exercise cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
              </div>
              
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Equipment</label>
                    <input type="text" name="equipment" id="equipment" class="form-control">
                    <?php if (isset($errors) && in_array("Equipment is required", $errors)) { ?>
                        <span style="color: red;">Equipment is required</span>
                    <?php } ?>
                  </div>
                </div>
              
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Reps</label>
                    <input type="text" name="reps" id="reps" class="form-control">
                    <?php if (isset($errors) && in_array("Reps is required", $errors)) { ?>
                        <span style="color: red;">Reps is required</span>
                    <?php } elseif (isset($errors) && in_array("Reps must be a number", $errors)) { ?>
                        <span style="color: red;">Reps must be a number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Save Exercise Plan</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include "footer.php"; ?>
