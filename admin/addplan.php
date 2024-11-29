<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if (isset($_POST['btn_save'])) {
    // Retrieve data from POST request
    $ID = $_POST['id'];
    $Name = $_POST['name'];
    $Weight = $_POST['weight'];
    $Goal = $_POST['goal'];
    $Skill = $_POST['skill'];
    $Duration = $_POST['duration'];
    $Days = $_POST['days'];

    // Validation
    $errors = array();
    if (empty($Name)) {
        $errors[] = "Name is required";
    } elseif (strlen($Name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($Name) > 50) {
        $errors[] = "Name cannot contain more than 50 characters";
    }

    if (empty($Weight)) {
        $errors[] = "Weight is required";
    } elseif (!is_numeric($Weight)) {
        $errors[] = "Weight must be a number";
    }

    if (empty($Goal)) {
        $errors[] = "Goal is required";
    } elseif (strlen($Goal) < 3) {
        $errors[] = "Goal must have at least 3 characters";
    } elseif (strlen($Goal) > 50) {
        $errors[] = "Goal cannot contain more than 50 characters";
    }

    if (empty($Skill)) {
        $errors[] = "Skill is required";
    } elseif (strlen($Skill) < 3) {
        $errors[] = "Skill must have at least 3 characters";
    } elseif (strlen($Skill) > 50) {
        $errors[] = "Skill cannot contain more than 50 characters";
    }

    if (empty($Duration)) {
        $errors[] = "Duration is required";
    } elseif (!is_numeric($Duration)) {
        $errors[] = "Duration must be a number";
    }

    if (empty($Days)) {
        $errors[] = "Days is required";
    } elseif (!is_numeric($Days)) {
        $errors[] = "Days must be a number";
    }

    if (count($errors) == 0) {
        // Prepare the SQL statement for the admin_plan table
        $stmt = $con->prepare("INSERT INTO `admin_plan`(`ID`, `Name`, `Weight`, `Goal`, `Skill`, `Duration`, `Days`) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("issssss", $ID, $Name, $Weight, $Goal, $Skill, $Duration, $Days);

        // Execute the statement
        if ($stmt->execute()) {
            // Redirect to classes.php on success
            header("Location: plan.php"); 
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


      <!-- End Navbar -->
    <!-- End Navbar -->
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add Plan</h4>
            <p class="card-category">Complete Admin Plan profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
               </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                    <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                        <span style="color: red;">Name is required</span>
                    <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Name must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Name cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Name cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
              
              </div>
              <div class="row">
                <div class="col-md -6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Weight</label>
                    <input type="number" name="weight" id="weight" class="form-control">
                    <?php if (isset($errors) && in_array("Weight is required", $errors)) { ?>
                        <span style="color: red;">Weight is required</span>
                    <?php } elseif (isset($errors) && in_array("Weight must be a number", $errors)) { ?>
                        <span style="color: red;">Weight must be a number</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Goal</label>
                    <input type="text" name="goal" id="goal" class="form-control">
                    <?php if (isset($errors) && in_array("Goal is required", $errors)) { ?>
                        <span style="color: red;">Goal is required</span>
                    <?php } elseif (isset($errors) && in_array("Goal must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Goal must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Goal cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Goal cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Skill</label>
                    <input type="text" name="skill" id="skill" class="form-control">
                    <?php if (isset($errors) && in_array("Skill is required", $errors)) { ?>
                        <span style="color: red;">Skill is required</span>
                    <?php } elseif (isset($errors) && in_array("Skill must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Skill must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Skill cannot contain more than 50 characters", $errors)) { ?>
                        <span style="color: red;">Skill cannot contain more than 50 characters</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Duration</label>
                    <input type="number" name="duration" id="duration" class="form-control">
                    <?php if (isset($errors) && in_array("Duration is required", $errors)) { ?>
                        <span style="color: red;">Duration is required</span>
                    <?php } elseif (isset($errors) && in_array("Duration must be a number", $errors)) { ?>
                        <span style="color: red;">Duration must be a number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Days</label>
                    <input type="number" name="days" id="days" class="form-control">
                    <?php if (isset($errors) && in_array("Days is required", $errors)) { ?>
                        <span style="color: red;">Days is required</span>
                    <?php } elseif (isset($errors) && in_array("Days must be a number", $errors)) { ?>
                        <span style="color: red;">Days must be a number</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

                </div>
                </div>
                </div>
              
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Add Plan</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>


<?php
include "footer.php";
?>3