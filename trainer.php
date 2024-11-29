<?php

include('header.php');
include('config.php');

// Update the SQL query to fetch only active trainers
$sql = "SELECT Name, Image, bio FROM trainers WHERE status = 'active'";
$result = $conn->query($sql);

?>
<div class="container-fluid fh5co-content-box">
  <div class="container">
    <div class="row">
      <div class="col-md-7 pl-0">
        <div class="wow bounceInRight" data-wow-delay=".25s">
          <div class="card-img-overlay">
          </div>
      </div>
    </div>
    <div class="row trainers pl-0 pr-0">
      <div class="col-12 bg-50">
        <div class="quote-box2 wow bounceInDown" data-wow-delay=".25s">
          <h2> TRAINERS </h2>
        </div>
      </div>

      <?php
       if ($result->num_rows > 0) {
        // Output data for each trainer
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-md-6 pr-5 pl-5">';
            echo '  <div class="card text-center wow bounceInLeft" data-wow-delay=".25s">';
            echo '    <img class="card-img-top rounded-circle img-fluid" src="images/' . htmlspecialchars($row['Image']) . '" alt="Card image">';
            echo '    <div class="card-body mb-5">';
            echo '      <h4 class="card-title">' . htmlspecialchars($row['Name']) . '</h4>';
            echo '      <p class="card-text">' . htmlspecialchars($row['bio']) . '</p>';
            echo '    </div>';
            echo '  </div>';
            echo '</div>';
        }
    } else {
        echo '<div class="col-12">No trainers found.</div>';
    }
    ?>


      <!-- <div class="col-md-6 pr-5 pl-5">
        <div class="card text-center wow bounceInLeft" data-wow-delay=".25s"> <img class="card-img-top rounded-circle img-fluid" src="images/trainers1.jpg" alt="Card image">
          <div class="card-body mb-5">
            <h4 class="card-title">JENIFERR</h4>
            <p class="card-text">Trainers, athletes and serious clients alike are looking for the toughest, most brutally productive training techniques to spice up their workouts and provide a truly unique challenge</p>
          </div>
        </div>
      </div>
      <div class="col-md-6 pl-5 pr-5">
        <div class="card text-center wow bounceInRight" data-wow-delay=".25s"> <img class="card-img-top rounded-circle img-fluid" src="images/trainers2.jpg" alt="Card image">
          <div class="card-body mb-5">
            <h4 class="card-title">JHON</h4>
            <p class="card-text">Trainers, athletes and serious clients alike are looking for the toughest, most brutally productive training techniques to spice up their workouts and provide a truly unique challenge</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row gallery">
      <div class="col-md-4">
        <div class="card">
          <div class="card-body mb-4 wow bounceInLeft" data-wow-delay=".25s">
            <h4 class="card-title">FILEX</h4>
            <p class="card-text">I just wanted to sincerely thank you for the opportunity to represent Precision Nutrition and the US at such an amazing event. </p>
          </div>
          <img class="card-img-top img-fluid wow bounceInRight" data-wow-delay=".25s" src="images/g1.jpg" alt="Card image"> </div>
      </div>
      <div class="col-md-4">
        <div class="card"> <img class="card-img-top img-fluid wow bounceInUp" data-wow-delay=".25s" src="images/g2.jpg" alt="Card image">
          <div class="card-body mt-4 wow bounceInDown" data-wow-delay=".25s">
            <h4 class="card-title">IGNITING</h4>
            <p class="card-text">I just wanted to sincerely thank you for the opportunity to represent Precision Nutrition and the US at such an amazing event. </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <div class="card-body mb-4 wow bounceInRight" data-wow-delay=".25s">
            <h4 class="card-title">PASSION</h4>
            <p class="card-text">I just wanted to sincerely thank you for the opportunity to represent Precision Nutrition and the US at such an amazing event. </p>
          </div>
          <img class="card-img-top img-fluid wow bounceInLeft" data-wow-delay=".25s" src="images/g3.jpg" alt="Card image"> </div>
      </div>
    </div>
  </div>-->
</div> 
<?php
 include('footer.php');
?>