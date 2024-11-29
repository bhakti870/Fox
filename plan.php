<?php
include('header.php');
include('config.php'); // Assuming you have a file to handle database connection

// Fetch membership data from the database where status is 'active'
$query = "SELECT Id, Name, Image, Description FROM admin_membership WHERE status = 'active'";
$result = mysqli_query($conn, $query);
$memberships = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!doctype html>
<html lang="en">
<body>
<div class="container-fluid pl-0 pr-0 bg-img clearfix parallax-window2" data-parallax="scroll" data-image-src="images/banner2.jpg">
</div>

<?php

foreach ($memberships as $membership) {
  if ($membership['Id'] % 2 == 0) { // Ensure 'Id' is properly referenced here
    // Basic Membership Section
    echo '<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="images/about-us-bg.jpg">
      <div class="container">
        <div class="col-sm-6 offset-sm-6">
          <h2 class="wow bounceInLeft" data-wow-delay=".25s">' . strtoupper($membership['Name']) . '</h2>
          <hr/>
          <p>' . nl2br($membership['Description']) . '</p>
          <a href="membership_d.php?Id=' . $membership['Id'] . '" class="btn btn-lg btn-outline-danger d-inline-block text-center mx-auto wow bounceInDown">GET STARTED</a>
        </div>
      </div>
    </div>';
    
    echo '<div class="container-fluid fh5co-content-box">
      <div class="container">
        <div class="row">
          <div class="col-md-5 pr-0">
            <img src="images/' . $membership['Image'] . '" alt="gym" class="img-fluid wow bounceInLeft" />
          </div>
          <div class="col-md-7 pl-0 d-flex align-items-center">
            
          </div>
        </div>
      </div>
    </div>';
  } else {
    // Premium Membership Section
    echo '<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="images/about-us-bg.jpg">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <h2 class="wow bounceInLeft" data-wow-delay=".25s">' . strtoupper($membership['Name']) . '</h2>
            <hr/>
            <p>' . nl2br($membership['Description']) . '</p>
            <a href="membership_d.php?Id=' . $membership['Id'] . '" class="btn btn-lg btn-outline-danger d-inline-block text-center mx-auto wow bounceInDown">GET STARTED</a>
          </div>
          <div class="col-md-5 pl-0">
            <img src="images/' . $membership['Image'] . '" alt="gym" class="img-fluid wow bounceInLeft" style="height: 400px; object-fit: cover;" />
          </div>
        </div>
      </div>
    </div>';
  }

      // echo '<div class="container-fluid fh5co-content-box">
      //   <div class="container">
      //     <div class="row">
      //       <div class="col-md-7 pr-0 d-flex align-items-center">
      //         <div class="wow bounceInRight" data-wow-delay=".25s" style="color: white;">
      //           // <p>Elevate your fitness experience with our ' . $membership['Name'] . '. Gain exclusive access to advanced classes, personal training sessions, and premium amenities, ensuring a comprehensive approach to your wellness journey.</p>
      //         </div>
      //       </div>
           
      //     </div>
      //   </div>
      // </div>';
  }

?>

<!-- <!doctype html>
<html lang="en">
<body>
<div class="container-fluid pl-0 pr-0 bg-img clearfix parallax-window2" data-parallax="scroll" data-image-src="images/banner2.jpg">
  

<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="images/about-us-bg.jpg">
  <div class="container">
    <div class="col-sm-6 offset-sm-6">
      <h2 class="wow bounceInLeft" data-wow-delay=".25s">BASIC MEMBERSHIP</h2>
      <hr/>
      <p> 1. Access to cardio and strength training equipment.<BR></BR>
2. Locker room and shower facilities.<br></br>
3. Open gym access during regular hours.<br></br>
4. Complimentary fitness assessment.<br></br>

</p>
      <a href="membership_d.php" class="btn btn-lg btn-outline-danger d-inline-block text-center mx-auto wow bounceInDown">GET STARTED</a>

    </div>
  </div>
</div>

<div class="container-fluid fh5co-content-box">
  <div class="container">
    <div class="row">
      <div class="col-md-5 pr-0">
        <img src="images/rode-gym.jpg" alt="gym" class="img-fluid wow bounceInLeft" /> 
      </div>
      <div class="col-md-7 pl-0 d-flex align-items-center">
        <div class="wow bounceInRight" data-wow-delay=".25s" style="color: white;">
          <p>Unlock your fitness potential with our Basic Membership. Enjoy access to all gym equipment, group classes, and personalized workout plans designed to help you achieve your fitness goals.</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div id="about-us" class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window" data-parallax="scroll" data-image-src="images/about-us-bg.jpg">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <h2 class="wow bounceInLeft" data-wow-delay=".25s">PREMIUM MEMBERSHIP

</h2>
        <hr/>
        <p>1. Includes all Basic Membership benefits.<br></br>
2. Access to group fitness classes (e.g., yoga, spinning, Zumba).<br></br>
3. 24/7 gym access.<br></br>
4. Discount on personal training sessions.<br></br>
5. Access to sauna and steam room. </p>
<a href="membership_D.php" class="btn btn-lg btn-outline-danger d-inline-block text-center mx-auto wow bounceInDown">GET STARTED</a>
      </div>
      <div class="col-sm-6">
      </div>
    </div>
  </div>
</div>

<div class="container-fluid fh5co-content-box">
  <div class="container">
    <div class="row">
      <div class="col-md-7 pr-0 d-flex align-items-center">
        <div class="wow bounceInRight" data-wow-delay=".25s" style="color: white;">
          <p>Elevate your fitness experience with our Premium Membership. Gain exclusive access to advanced classes, personal training sessions, and premium amenities, ensuring a comprehensive approach to your wellness journey.</p>
        </div>
      </div>
      <div class="col-md-5 pl-0">
        <img src="images/rode-gym.jpg" alt="gym" class="img-fluid wow bounceInLeft" /> 
      </div>
    </div>
  </div>
</div> -->

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/wow.js"></script>
<script src="js/main.js"></script>
</body>
</html>

<?php
include('footer.php');
?>
