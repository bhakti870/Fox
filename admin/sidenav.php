<!doctype html>
<html lang="en">

<head>
  <title>Fox Admin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="assets/css/Material+Icons.css" />
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
  <link href="assets/css/black-dashboard.css" rel="stylesheet" />

  <!-- Bootstrap CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

  
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="black" data-image="./assets/img/sidebar-2.jpg">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a href="" class="simple-text logo-normal"> 
         
        </a>
      </div>
      <div class="sidebar-wrapper ps-container ps-theme-default" data-ps-id="3a8db1f4-24d8-4dbf-85c9-4f5215c1b29a">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>


          

             
          <li class="nav-item ">
            <a class="nav-link" href="manageuser.php">
              <i class="material-icons">person</i>
              <p>Attendence</p>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="contactlist.php">
              <i class="material-icons">list</i>
              <p>contact list</p>
            </a>
            
          </li>

         

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="planDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">event_note</i>
              <p>Membership</p>
            </a>
            <div class="dropdown-menu" aria-labelledby="planDropdown">
              <a class="dropdown-item" href="admin_membership.php">
                <i class="material-icons">add</i> Admin Membership
              </a>
              <a class="dropdown-item" href="user_membership.php">
                <i class="material-icons">add</i> Workout
              </a>
            </div>
            </li>

          <!--plan-->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="planDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="material-icons">event_note</i>
              <p>Plan</p>
            </a>
            <div class="dropdown-menu" aria-labelledby="planDropdown">
              <a class="dropdown-item" href="plan.php">
                <i class="material-icons">add</i> Plan Details
              </a>
              <a class="dropdown-item" href="user_plan.php">
                <i class="material-icons">add</i> User Plan
              </a>
            </div>
            </li>



            <style>
            /* Change background color of the dropdown menu */
            .nav-item .dropdown-menu {
              background-color: #00bcd4; /* Set your preferred background color */
              border: none; /* Optional: remove border */
            }

            /* Change the text color to black and make it bold for the dropdown items */
            .nav-item .dropdown-menu .dropdown-item {
              color: black; /* Set text color to black */
              font-weight: bold; /* Make text bold */
            }

            /* Change the hover effect for the dropdown items */
            .nav-item .dropdown-menu .dropdown-item:hover {
              background-color: #45a049; /* Set your preferred hover background color */
              color: #fff; /* Set the hover text color */
            }
          </style>


          
          <li class="nav-item ">
            <a class="nav-link" href="classes.php">
              <i class="material-icons">class</i>
              <p>Classes</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="trainer.php">
              <i class="material-icons">fitness_center</i>
              <p>Trainer</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="feedback.php">
              <i class="material-icons">feedback</i>
              <p>Feedback</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="admin_manage_about.php">
              <i class="material-icons">info</i>
              <p>About Us</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="admin_manage_contact.php">
              <i class="material-icons">phone</i>
              <p>Contact Us</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="promo.php">
              <i class="material-icons">account_circle</i>
              <p>Promo Code</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="profile.php">
              <i class="material-icons">account_circle</i>
              <p>Profile</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="http://localhost/fox/fox/login_form.php">
              <i class="material-icons">logout</i>
              <p>Logout</p>
            </a>
          </li>
          <!-- <li class="nav-item active-pro ">
                <a class="nav-link" href="./upgrade.html">
                    <i class="material-icons">unarchive</i>
                    <p>Upgrade to PRO</p>
                </a>
            </li> -->
        </ul> 
        
      </div>
    </div>