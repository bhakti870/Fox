<?php
include('config.php'); // Ensure this includes your database connection

// Fetch content from the contact_us table
$query = "SELECT * FROM contact_us";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $content = $row['content'];
    $address = $row['address'];
    $phone = $row['phone'];
    $email = $row['email'];
} else {
    $content = "Content not available.";
    $address = "Not available";
    $phone = "Not available";
    $email = "Not available";
}
?>

<!doctype html>
<html>
<head>
  <style>
    .footer1, .footer3 {
      margin-bottom: 20px; /* Adds space at the bottom of each section */
    }

    @media (min-width: 768px) {
      .footer1 {
        margin-right: 40px; /* Adds space to the right of the first column */
      }
    }

    .contact-container {
      max-width: 400px; /* Set max width for the contact form */
      margin: 0 auto; /* Center the contact form */
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.1); /* Slightly transparent background for the form */
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    h1 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 10px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input, textarea {
      width: 100%;
      padding: 7px;
      border: none;
      border-radius: 4px;
      font-size: 10px;
    }

    input {
      background-color: rgba(255, 255, 255, 0.2); /* Light transparent background */
      color: #fff; /* White text color for input fields */
    }

    textarea {
      background-color: rgba(255, 255, 255, 0.2); /* Light transparent background */
      color: #fff; /* White text color for textarea */
    }

    button {
      background-color: orange; /* Change button color to orange */
      color: #fff; /* White text color for button */
      border: none;
      border-radius: 4px;
      padding: 10px 15px;
      cursor: pointer;
      font-size: 16px;
      width: 100%;
    }

    button:hover {
      background-color: darkorange; /* Darker shade on hover */
    }
  </style>
</head>
<body>
  <footer class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-3 footer1 d-flex wow bounceInLeft" data-wow-delay=".25s" style="margin-right: 30px;">
          <div class="d-flex flex-wrap align-content-center">
            <a href="#"><img src="images/logo.png" alt="logo" /></a>
            <p>
            <?php echo $content; ?>
            </p>
          </div>
        </div>

        <div class="col-md-3 footer3 wow bounceInRight" data-wow-delay=".25s">
          <h5>ADDRESS</h5>
          <p><?php echo $address; ?></p>
          <h5>PHONE</h5>
          <p><?php echo $phone; ?></p>
          <h5>EMAIL</h5>
          <p><?php echo $email; ?></p>
          <div class="social-links"></div>
        </div>

        <div class="col-md-6 contact-container">
          <h1>Contact Us</h1>
          <form id="contactForm" action="submit_contact.php" method="POST">
            <div class="form-group">
              <label for="name">Name:</label>
              <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
              <label for="message">Message:</label>
              <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Send</button>
          </form>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>
