<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if(isset($_POST['btn_save'])) {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Message = $_POST['Message'];

    // Validation
    $errors = array();
    if (empty($Name)) {
        $errors[] = "Name is required";
    } elseif (strlen($Name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($Name) > 20) {
        $errors[] = "Name cannot contain more than 20 characters";
    }

    if (empty($Email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (empty($Message)) {
        $errors[] = "Message is required";
    }

    

    if (count($errors) == 0) {
        $stmt = $con->prepare("INSERT INTO `contacts`(`Name`, `Email`, `Message`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $Name, $Email, $Message);

        $stmt->execute();

        @header("location:contactlist.php"); 
        exit;
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
            <h4 class="card-title">Add Contact</h4>
            <p class="card-category">Complete Contact profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
             

                </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
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
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control">
                    <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                        <span style="color: red;">Email is required</span>
                    <?php } elseif (isset($errors) && in_array("Invalid email address", $errors)) { ?>
                        <span style="color: red;">Invalid email address</span>
                    <?php } ?>
                  </div>
                </div>
                
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Message</label>
                    <textarea name="Message" id="Message" class="form-control"></textarea>
                    <?php if (isset($errors) && in_array("Message is required", $errors)) { ?>
                        <span style="color: red;">Message is required</span>
                    <?php } ?>
                  </div>
                </div>

               

</div>

</div>
                </div>
                
              </div>
              
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Add Contact</button>
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