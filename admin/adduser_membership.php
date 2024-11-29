<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if(isset($_POST['btn_save'])) {
    $Name = $_POST['Name'];
    $Amount = $_POST['Amount'];
    
    $Date = $_POST['Date'];

    // Validation
    $errors = array();
    if (empty($Name)) {
        $errors[] = "Name is required";
    } elseif (strlen($Name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($Name) > 20) {
        $errors[] = "Name cannot contain more than 20 characters";
    }

    if (empty($Amount)) {
        $errors[] = "Amount is required";
    } elseif (!is_numeric($Amount)) {
        $errors[] = "Amount must be a number";
    }

    if (empty($Date)) {
        $errors[] = "Date is required";
    }

    if (count($errors) == 0) {
        $stmt = $con->prepare("INSERT INTO `user_membership`(`id`, `Name`, `Amount`,`Date`) VALUES (NULL, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Amount,  $Date);

        $stmt->execute();

        @header("location:user_membership.php"); 
        mysqli_close($con);
    }
}
?>


      <!-- End Navbar -->
    <!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add User Membership</h4>
            <p class="card-category">Complete Membership profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
             

                </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="text" name="Name" id="Name" class="form-control">
                    <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                        <span style="color: red;">Name is required</span>
                    <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                        <span style="color: red;">Name must have at least 3 characters</span>
                    <?php } elseif (isset($errors) && in_array("Name cannot contain more than 20 characters", $errors)) { ?>
                        <span style="color: red;">Name cannot contain more than 20 characters</span>
                    <?php } ?>
                  </div>
                </div>
              
              </div>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Amount</label>
                    <input type="number" name="Amount" id="Amount" class="form-control">
                    <?php if (isset($errors) && in_array("Amount is required", $errors)) { ?>
                        <span style="color: red;">Amount is required</span>
                    <?php } elseif (isset($errors) && in_array("Amount must be a number", $errors)) { ?>
                        <span style="color: red;">Amount must be a number</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Date</label>
                    <input type="date" name="Date" id="Date" class="form-control">
                    <?php if (isset($errors) && in_array("Date is required", $errors)) { ?>
                        <span style="color: red;">Date is required</span>
                    <?php } ?>
                  </div>
                </div>
              </div>

           
                  </div>
                </div>
                
              </div>
              
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Add User Membership</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



<?php
include "footer.php";
?>