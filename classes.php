<?php
session_start(); // Start the session
include('header.php');
include('config.php'); // Ensure this file connects to the database

// Fetch membership data from the database
$query = "SELECT Id, Name, img FROM classes WHERE status = 'active'";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Handle class joining
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['id'])) { // Check if the user is logged in
        $user_id = $_SESSION['id']; // Get the logged-in user's ID
        $className = isset($_POST['className']) ? $_POST['className'] : ''; // Get the class name

        // Update the user's record in the registration table with the selected class
        $updateQuery = "UPDATE registration SET classes = '$className' WHERE id = '$user_id'";

        if (mysqli_query($conn, $updateQuery)) {
            // Redirect after updating
            echo "<script>alert('Congratulations!!!!! Class successfully joined!');</script>";
            exit();
        } else {
            error_log("Error updating class: " . mysqli_error($conn));
        }
    } else {
        // Redirect to the login page if not logged in
        echo "<script>alert('Please login to join this class.'); window.location.href = 'login_form.php';</script>";
        exit();
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
            flex-wrap: wrap; /* Allow sections to wrap to next line if necessary */
        }

        .section {
            flex: 1; /* Allow each section to take available space */
            text-align: center;
        }

        .image-box {
            margin-bottom: 20px; /* Space between the image and text */
        }

        .image-box img {
            max-width: 100%;
            height: auto;
            width: 100%; /* Ensure both images have the same width */
            height: 300px; /* Fixed height for both images */
            object-fit: cover; /* Ensures the image covers the entire area */
            opacity: 0;
            animation: zoom-in-once 1.5s ease-out forwards; /* One-time zoom-in effect */
        }

        .text-box {
            color: white; /* Set text color to white */
            text-align: center; /* Center text and buttons */
        }

        .text-box h2 {
            margin-bottom: 20px; /* Space between the text and buttons */
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
        <?php
        if ($result->num_rows > 0) {
            // Output data for each class
            while ($row = $result->fetch_assoc()) {
                echo '<div class="section">';
                echo '  <div class="image-box">';
                echo '    <img src="images/' . htmlspecialchars($row['img']) . '" alt="Class image">';
                echo '  </div>';
                echo '  <div class="text-box">';
                echo '    <h2>' . htmlspecialchars($row['Name']) . '</h2>';
                echo '    <a href="yoga.php?id=' . htmlspecialchars($row['Id']) . '" class="btn text-uppercase btn-outline-danger btn-lg mr-3 mb-3"> Learn More</a>';
                
                // Form for joining the class
                echo '    <form method="POST">';
                echo '      <input type="hidden" name="className" value="' . htmlspecialchars($row['Name']) . '">';
                echo '      <button type="submit" class="btn text-uppercase btn-outline-danger btn-lg mb-3"> JOIN NOW </button>';
                echo '    </form>';
                
                echo '  </div>';
                echo '</div>';
            }
        } else {
            echo '<div class="section">No classes found.</div>';
        }
        ?>
    </div>
</div>

<?php
include('footer.php');
?>
</body>
</html>
