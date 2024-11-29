<?php
include('header.php');
include('config.php'); // Database connection
if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start session if not already started
}

// Check if ID is set in the URL
if (isset($_GET['Id'])) {
    $id = $_GET['Id'];
    // Fetch membership details from the database
    $query = "SELECT Name, Image, Description, Amount, Time_duration FROM admin_membership WHERE Id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the membership exists
    if ($result->num_rows > 0) {
        $membership = $result->fetch_assoc();
    } else {
        echo "Membership not found.";
        exit;
    }
} else {
    echo "No membership selected.";
    exit;
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if user is logged in
    if (!isset($_SESSION['id'])) {
        // Redirect to login page if user is not logged in
        header("Location: login_form.php");
        exit;
    }

    // If user is logged in, proceed with form submission
    $user_id = $_SESSION['id']; // Assuming user_id is stored in session after login
    $membership_id = $id; // Corrected variable name
    $name = $membership['Name'];
    $amount = $membership['Amount'];

    // Insert the data into user_membership table
    $query = "INSERT INTO user_membership (name, amount, membership_id, user_id) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdii", $name, $amount, $membership_id, $user_id);
    $stmt->execute();

    // Redirect to payment page with membership details
    header("Location: payment.php?membership_id=$membership_id&user_id=$user_id&amount=$amount&name=$name");
    exit;
}
?>



<!doctype html>
<html lang="en">
<head>
    <title>Membership Details</title>
    <style>
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
        font-family: Arial, sans-serif;
      }

      .main-content {
        padding: 60px 20px;
        margin-bottom: 40px;
      }

      .container {
        display: flex;
        gap: 20px;
      }

      .section {
        flex: 1;
        text-align: center;
      }

      .image-box {
        margin-bottom: 20px;
        overflow: hidden;
      }

      .image-box img {
        width: 1100px;
        height: 500px;
        display: block;
        object-fit: cover;
        opacity: 0;
        animation: zoom-in-once 1.5s ease-out forwards;
      }

      .text-box {
        color: white;
        text-align: center;
      }

      .text-box h2 {
        margin-bottom: 20px;
      }

      .text-box p {
        margin-bottom: 20px;
        font-size: 16px;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
      }

      .text-box .btn {
        margin: 5px;
        color: #f0f0f0;
        border: 2px solid white;
        background-color: transparent;
        transition: background-color 0.3s, color 0.3s;
      }

      .text-box .btn:hover {
        background-color: orange;
        color: white;
        border-color: orange;
      }

      .text-box .btn:active {
        background-color: #d35400;
        color: white;
        border-color: #d35400;
      }

      .terms-and-conditions {
        background-color: #f9f9f9;
        padding: 20px;
        margin-top: 40px;
        border-radius: 8px;
        max-width: 800px;
        margin: 20px auto;
        font-size: 14px;
        line-height: 1.8;
      }

      .terms-and-conditions h3 {
        margin-top: 0;
        font-size: 18px;
      }

      .terms-and-conditions p {
        margin-bottom: 15px;
      }

      .terms-and-conditions a {
        color: #007bff;
        text-decoration: none;
      }

      .terms-and-conditions a:hover {
        text-decoration: underline;
      }

      .highlighted-text {
        color: #ff9800;
        font-size: 18px;
        font-weight: bold;
      }
    </style>
</head>
<body>
<div class="main-content">
    <div class="container">
        <div class="section">
            <div class="image-box">
                <img src="images/<?php echo $membership['Image']; ?>" alt="membership">
            </div>
            <div class="text-box">
                <h2><?php echo strtoupper($membership['Name']); ?></h2>
                <p><?php echo nl2br($membership['Description']); ?></p>
                <p><span class="highlighted-text">Amount:</span> $<?php echo $membership['Amount']; ?></p>
                <p><span class="highlighted-text">Time Duration:</span> <?php echo $membership['Time_duration']; ?></p>
                
                <!-- Added Form for Submission -->
                <form method="POST">
                    <button type="submit" class="btn text-uppercase btn-outline-danger btn-lg mb-3">JOIN NOW</button>
                </form>
            </div>
        </div>c
    </div>

    <div class="terms-and-conditions">
        <h3>Terms and Conditions</h3>
        <p><strong>1. Introduction:</strong> Welcome to Fox Pro. By signing up for a membership, you agree to comply with these Terms and Conditions.</p>
        <p><strong>2. Membership Eligibility:</strong> You must be 18 years of age or older.</p>
        <p><strong>3. Membership Fees and Payment:</strong> Fees are non-refundable except as required by law.</p>
        <p><strong>4. Membership Benefits:</strong> Benefits are subject to change.</p>
        <p><strong>5. Cancellation and Termination:</strong> You can cancel your membership by contacting the gym.</p>
        <p><strong>6. Code of Conduct:</strong> Members are expected to behave respectfully.</p>
        <p><strong>7. Privacy Policy:</strong> Your personal information will be handled as per our Privacy Policy.</p>
        <p><strong>8. Limitation of Liability:</strong> Fox Pro is not liable for indirect, incidental, or consequential damages.</p>
        <p><strong>11. Contact Information:</strong> For questions or concerns, please contact us.</p>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
