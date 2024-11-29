<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if(isset($_POST['btn_save']))
{
    $first_name=$_POST['first_name'];
    $email=$_POST['email'];
    $user_password=$_POST['password'];

    // Validation
    $errors = array();
    if (empty($first_name)) {
        $errors[] = "Name is required";
    } elseif (strlen($first_name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($first_name) > 20) {
        $errors[] = "Name cannot contain more than 20 characters";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (empty($user_password)) {
        $errors[] = "Password is required";
    } elseif (strlen($user_password) < 8) {
        $errors[] = "Password must have at least 8 characters";
    }

    if (count($errors) == 0) {
        mysqli_query($con,  "INSERT INTO `users`( `name`,  `email`, `password`)
        VALUES('$first_name','$email','$user_password')") ;
        header('location:manageuser.php');
        exit();
        // exit;
        mysqli_close($con);


    }
}
?>
<html>
<head>
<script src="Validation.js"></script>
<style>
.form-control:focus {
  background-color: transparent; /* Remove white background */
  border-color: #3f51b5; /* Change border color on focus */
  box-shadow: none; /* Remove box shadow */
}
</style>

      <!-- End Navbar -->
</head>
      <body>
      <div class="content">
        <div class="container-fluid">
          <!-- your content here -->
          <!-- <div class="col-md-6"> -->
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Add Users</h4>
                  <p class="card-category">Complete User profile</p>
                </div>
                <div class="card-body">
                  <form action="" method="post" name="form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group ">
                          <label class=""> Name</label>
                          <input type="text" id="name" name="first_name" class="form-control">
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
                        <div class="form-group ">
                          <label class="">Email</label>
                          <input type="text" name="email" id="email" class="form-control" >
                          <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                            <span style="color: red;">Email is required</span>
                          <?php } elseif (isset($errors) && in_array("Invalid email address", $errors)) { ?>
                            <span style="color: red;">Invalid email address</span>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="">Password</label>
                          <input type="password" id="password" name="password" class="form-control">
                          <?php if (isset($errors) && in_array("Password is required", $errors)) { ?>
                            <span style="color: red;">Password is required</span>
                          <?php } elseif (isset($errors) && in_array("Password must have at least 8 characters", $errors)) { ?>
                            <span style="color: red;">Password must have at least 8 characters</span>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
</div>
                      
                    </div>
                    
                    <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Add User</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
        </div>
      </div>
      
  <script>
        function User() 
        {
            event.preventDefault();

            let validate = true;

            var name = document.getElementById('name');
            var name1 = document.getElementById('name1');
            var email = document.getElementById('email');
            var email1 = document.getElementById('email1');
            var password = document.getElementById('password');
            var password1 = document.getElementById('password1');

            nameValidate(name, name1);
            emailValidate (email, email1);
            passwordValidate(password, password1);

            return validate;
        }
       
    </script>
      <?php
include "footer.php";
?>
</body>
</html>