<?php
session_start(); // Start the session
include('header.php');
include('config.php'); // Assuming you have a file to handle database connection

// Fetch the class ID from the URL
$classId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch yoga class data from the database
$query = "SELECT Name, img, description FROM classes WHERE Id = $classId";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Check if any class was found
$classData = mysqli_fetch_assoc($result);

// Handle class joining
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_SESSION['id'])) { // Check if the user is logged in
      $user_id = $_SESSION['id']; // Get the logged-in user's ID
      $className = $classData['Name']; // Get the class name

      // Update the user's record in the registration table with the selected class
      $updateQuery = "UPDATE registration SET classes = '$className' WHERE id = '$user_id'";
      
      if (mysqli_query($conn, $updateQuery)) {
        header("Location: classes.php"); // Redirect after updating

          echo "<script>alert('Congratulations!!!!! Class successfully joined!');</script>";



          exit();
      } else {
          error_log("Error updating class: " . mysqli_error($conn));
      }
  } else {
      echo "Please login to join this class.";
  }
}

?>

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
            flex-direction: column; /* Stack sections vertically */
            align-items: center; /* Center align */
        }

        .section {
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
</head>
<body>
<div class="main-content">
    <div class="container">
        <!-- Check if class data is available -->
        <?php if ($classData): ?>
            <div class="section">
                <div class="image-box">
                    <img src="images/<?php echo htmlspecialchars($classData['img']); ?>" alt="Yoga Classes">
                </div>
                <div class="text-box">
                    <h2><?php echo htmlspecialchars($classData['Name']); ?></h2>
                    <p>
                        <?php echo htmlspecialchars($classData['description']); ?>
                    </p>
                    <br>
                    <!-- Form for joining the class -->
                        <form method="POST">
                            <button type="submit" class="btn text-uppercase btn-outline-danger btn-lg mb-3">JOIN NOW</button>
                        </form>
                    
                </div>
            </div>
        <?php else: ?>
            <div class="section">Class not found.</div>
        <?php endif; ?>
    </div>
</div>

<?php include('footer.php'); ?>
</body>
</html>
