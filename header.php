<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start session if not already started
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Gym</title>
  <link href="css/animate.css" rel="stylesheet">
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  </head>

<body>

<div class="container-fluid pl-0 pr-0 bg-img clearfix parallax-window2" data-parallax="scroll" data-image-src="images/banner2.jpg">
  <nav class="navbar navbar-expand-md navbar-dark">
    <div class="container"> 
      <a class="navbar-brand mr-auto" href="index.php"><img src="images/logo.png" alt="FoxPro" /></a> 
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"> <a class="nav-link" href="index.php">Home</a> </li>
          <li class="nav-item"> <a class="nav-link" href="about.php">About</a> </li>
          <li class="nav-item"> <a class="nav-link" href="Trainer.php">Trainer</a> </li>
         <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="#" id="membershipDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Membership</a>
<div class="dropdown-menu nav-item" aria-labelledby="membershipDropdown" style="background-color: black; border: none;">
    <a class="dropdown-item nav-item" href="plan.php" style="color: white;">All Memberships</a>
    <?php if (isset($_SESSION['id'])): ?>
            <a class="dropdown-item nav-item" href="show_membership.php" style="color: white;">Your Membership</a>
        <?php endif; ?></div>
          </li>	
          <li class="nav-item"> <a class="nav-link" href="feedback.php">Feedback</a> </li>
<li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="membershipDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Classes</a>
            <div class="dropdown-menu" aria-labelledby="membershipDropdown" style="background-color: black; border: none;">
              <a class="dropdown-item nav-item" href="classes.php" style="color: white;">All Classes</a>
              <?php if (isset($_SESSION['id'])): ?>
            <a class="dropdown-item nav-item" href="your_classes.php" style="color: white;">Your Classes</a>
        <?php endif; ?>            </div>
          </li><li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="membershipDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Plan</a>
    <div class="dropdown-menu" aria-labelledby="membershipDropdown" style="background-color: black; border: none;">
        <a class="dropdown-item nav-item" href="personal_plan.php" style="color: white;">All Plan</a>
        <?php if (isset($_SESSION['id'])): ?>
            <a class="dropdown-item nav-item" href="plan_Detail.php" style="color: white;">Your Plan</a>
        <?php endif; ?>
    </div>
</li>

 <!-- <li class="nav-item"> <a class="nav-link" href="attandance.php">Account</a> </li> -->


 <li class="nav-item" style="margin-left: 27px;">
  <a href="attandance.php">
    <?php if (isset($_SESSION['image']) && isset($_SESSION['name'])): ?>
      <div style="background-color: white; border-radius: 50%; display: inline-block; padding: 5px;">
    <img src="<?php echo "images/profile_pictures/" . htmlspecialchars($_SESSION['image']); ?>" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px;">
</div>
      <span class="ml-2"><?php echo htmlspecialchars($_SESSION['name']); ?></span>
    <?php else: ?>
      <a href="login_form.php">
        <img src="images/user.png" alt="Login Icon" class="rounded-circle" style="width: 40px; height: 40px;">
        <span class="ml-2">Guest</span>
      </a>
    <?php endif; ?>
  </a>
</li>


<!-- 
        </ul>
        <ul class="navbar-nav ml-5">
<li class="nav-item">
  <a class="nav-link btn btn-danger" href="login_form.php">
    <i class="fas fa-user"></i> 
  </a>
</li>
        </ul> -->
      </div>
    </div>
  </nav>
</body>
</html>