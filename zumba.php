<?php include('header.php'); ?>

<!doctype html>
<html lang="en">
  <head>
    <style>
      /* CSS for one-time zoom-in effect */
      @keyframes zoom-in-once {
        0% {
          transform: scale(0.5);
          opacity: 0;
        }
        100% {
          transform: scale(1);
          opacity: 1;
        }
      }

      body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif; /* Optional: Set a default font */
      }

      /* Increased space between header and content */
      .main-content {
        padding: 60px 20px; /* Adjusted padding for more space */
        margin-bottom: 40px; /* Increased space between content and footer */
      }

      .container {
        display: flex;
        gap: 20px; /* Space between the two sections */
      }

      .section {
        flex: 1; /* Allow each section to take available space */
        text-align: center;
      }

      .image-box {
        margin-bottom: 20px; /* Space between the image and text */
        overflow: hidden; /* Hide any overflow content */
      }

      .image-box img {
        width: 1200px; /* Set image width to 1200px */
        height: auto; /* Adjust height to maintain aspect ratio */
        display: block; /* Remove any extra space below the image */
        object-fit: cover; /* Ensure the image covers the entire area */
        opacity: 0;
        animation: zoom-in-once 1.5s ease-out forwards; /* One-time zoom-in effect */
      }

      .text-box {
        color: white; /* Set text color to white */
        text-align: center; /* Center text and buttons */
      }

      .text-box h2 {
        margin-bottom: 20px; /* Space between the text and content */
      }

      .text-box p {
        margin-bottom: 20px; /* Space between the content and button */
        font-size: 16px; /* Adjust font size */
        line-height: 1.6; /* Line height for readability */
        max-width: 800px; /* Limit the width of the content */
        margin: 0 auto; /* Center the content */
      }

      .text-box .btn {
        margin: 5px; /* Space between the buttons */
        color: #f0f0f0; /* Light color for button text */
        border: 2px solid white; /* Set button border to white */
        background-color: transparent; /* Ensure the background is transparent */
        transition: background-color 0.3s, color 0.3s; /* Smooth transition */
      }

      /* Change button background color on hover */
      .text-box .btn:hover {
        background-color: orange; /* Orange background on hover */
        color: white; /* Button text color when hovered */
        border-color: orange; /* Button border color when hovered */
      }

      /* Change button background color on click */
      .text-box .btn:active {
        background-color: #d35400; /* Darker orange background on click */
        color: white; /* Button text color when clicked */
        border-color: #d35400; /* Button border color when clicked */
      }
    </style>

    <script>
      // JavaScript function to display a message on button click
      function showJoinMessage() {
        alert("You can join successfully");
      }
    </script>
  </head>

  <body>
    <div class="main-content">
      <div class="container">
        <!-- First Section -->
        <div class="section">
          <div class="image-box">
            <img src="images/zumba.AVIF" alt="Yoga Classes">
          </div>
          <div class="text-box">
            <h2> Zumba Classes </h2>
            <p>
              Join our exhilarating Zumba classes and experience a dance fitness workout that feels like a party! Zumba combines Latin and international music with dance moves to create a dynamic and fun exercise routine. Whether you're a beginner or an experienced dancer, our classes are designed to energize and motivate you. Burn calories, improve your cardiovascular health, and boost your mood while dancing to the beats of lively music. Get ready to shake it, sweat, and have an amazing time!
            </p>
            <br>
            <!-- Updated button with onclick event -->
            <a href="javascript:void(0);" class="btn text-uppercase btn-outline-danger btn-lg mb-3" onclick="showJoinMessage()"> JOIN NOW </a>
          </div>
        </div>
      </div>
    </div>

    <?php include('footer.php'); ?>
  </body>
</html>
