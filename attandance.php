<?php
include('header.php'); 
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}
if (isset($_POST['logout'])) {
    session_destroy(); // Destroy the session
    header("Location: login_form.php"); // Redirect to login page
    exit();
}

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Include your database connection here
    include('config.php');

   
    
    // Get the user ID from session
    if (isset($_SESSION['id'])) {
    // Get the current user's ID from session or other source
    $userId = $_SESSION['id']; // Adjust according to your session variable for user ID

    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $weight = $_POST['weight'];
    $gender = $_POST['gender'];

    // Handle file upload
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageFolder = "images/profile_pictures/";

    // Check if a new image is uploaded
    if (!empty($imageName)) {
        // Move the uploaded image to the target directory
        move_uploaded_file($imageTmpName, $imageFolder . $imageName);
        // Update the image name in the database
        $sql = "UPDATE registration SET image='$imageName' WHERE id='$userId'";
        mysqli_query($conn, $sql);
    }

    // Update the user's details in the database
    $sql = "UPDATE registration SET name='$name', email='$email', password='$password', number='$number', weight='$weight', gender='$gender' WHERE id='$userId'";
    
    if (mysqli_query($conn, $sql)) {
        // Update session variables
        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['number'] = $number;
        $_SESSION['weight'] = $weight;
        $_SESSION['gender'] = $gender;

        // Redirect or show a success message
        echo "<script>alert('Profile updated successfully!');</script>";
        header("Location: attandance.php");

    } else {
        echo "<script>alert('Error updating profile: " . mysqli_error($conn) . "');</script>";
    }

    // Close the database connection
    mysqli_close($conn);
}
}
?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparent Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
    
    <style>

body {
    background-color: #000; /* Black background */
    color: #fff; /* Ensure text is white for better readability */
}

        .card-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; 
            justify-content: center;
        }
        .card {
            flex: 1 1 300px; /* Grow and shrink, with a base width of 300px */
            max-width: 500px; /* Maximum width */
            height: 100px; /* Fixed height */
            border: 1px solid #ddd; /* Border for the card */
            border-radius: 8px; /* Rounded corners for the card */
            box-shadow: 0 2px 4px rgba(255, 255, 255, 0.1); /* Shadow effect for visibility */
            background-color: #222; /* Slightly lighter background for cards */
            display: flex;
            flex-direction: column; /* Stack children vertically */
            justify-content: center; /* Center content vertically */
            padding: 15px; /* Padding inside the card */
            box-sizing: border-box; /* Include padding in width/height */
        }

.icon-percentage {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 60px; /* Width of the circle */
    height: 60px; /* Height of the circle */
    border-radius: 50%; /* Make it circular */
    background-color: orange; /* Background color for the circle */
    color: #fff; /* Text color inside the circle */
    font-size: 1.25em; /* Adjust font size as needed */
    text-align: center;
}

        .grey-bg {
            background: url('images/banner2.jpg') no-repeat center center;
            background-size: cover; /* Ensure the image covers the section */
            padding: 20px; /* Adjust padding if necessary */
        }
        .profile-form-container {
            background-color: rgba(255, 255, 255, 0.4); /* Transparent background */
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-width: 900px;
            width: 100%;
            margin: auto; /* Center the form */
        }
        .profile-form-container h1 {
            text-align: center;
            color: orange; 
        }
        .profile-form-container label {
            color: #fff; /* Label text color set to white */
            margin-top: 10px;
            display: block;
        }
        .profile-form-container input, 
        .profile-form-container textarea,
        .profile-form-container select { /* Include select for gender */
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: none;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.7);
            color: #000; /* Input text color */
        }
        .profile-form-container .error {
            color: red;
            font-size: 0.875em;
            margin-top: 0.25em;
            text-align: left;
        }
        .profile-pic-container {
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
    flex-direction: column;
    margin-bottom: 20px; /* Add space below the profile picture */
}
        .profile-pic {
            width: 170px; /* Set the size of the profile picture */
            height: 150px; /* Set the size of the profile picture */
            border-radius: 50%; /* Make the image circular */
            border: 2px solid #00bfae; /* Border color */
            object-fit: cover; /* Ensure the image covers the area */
        }

        .upload-icon {
    display: flex;
    align-items: center;
}

.upload-icon i {
    transition: transform 0.2s;
    margin-top: -5px; 
}

.upload-icon:hover i {
    transform: scale(1.1); /* Slightly enlarge on hover */
}
.logout-btn {
    margin-left: 20px; /* Adjust this value for desired spacing */
}


    </style>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgElement = document.getElementById('profile-pic-preview');
                imgElement.src = e.target.result; // Set the src to the selected image
            };
            if (file) {
                reader.readAsDataURL(file); // Convert the file to a Data URL
            }
        }

        $(document).ready(function() {
            $("#profile-form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: "required",
                    number: {
                        required: true,
                        digits: true
                    },
                    weight: {
                        required: true,
                        digits: true
                    },
                    gender: "required"
                },
                messages: {
                    name: "Please enter your name",
                    email: "Please enter a valid email address",
                    password: "Please provide a password",
                    number: "Please enter a valid number",
                    weight: "Please enter a valid weight",
                    gender: "Please select a gender"
                },
                submitHandler: function(form) {
                    form.submit(); // Submit the form if valid
                }
            });
        });
    </script>
</head>
<body>
    <div class="grey-bg container-fluid main-content">
        <section id="minimal-statistics" class="section-spacing">
            <div class="card-container">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="media-body text-left">
                                    <h3 class="success">Attendance</h3>
                                </div>
                                <div class="align-self-center">
                                    <a href="attandance_detail.php" style="text-decoration: none;">
                                        <div class="icon-percentage">
                                            <div class="percentage"><img src="images/profile.png"/></div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<br>
    </br>
    <div class="profile-form-container"> <!-- Encapsulated the form -->
    <form id="profile-form" method="post" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
        <h1>Profile</h1>
        <br>
        <div class="profile-pic-container d-flex align-items-center">
            <img src="<?php echo "images/profile_pictures/" . $_SESSION['image']; ?>" alt="Profile Picture" class="rounded-circle" style="width: 150px; height: 150px;">
            <label for="image" class="upload-icon" style="cursor: pointer; margin-left: -5px ;"> <!-- Added margin-left for space -->
                <i class="fas fa-plus-circle" style="font-size: 34px; color: #007bff;"></i> <!-- Font Awesome icon -->
            </label>
            <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" style="display: none;"> <!-- Hidden file input -->
        </div>


                    <div class="error"></div>

                    <div class="grid-row">
                        <div class="grid-item">
                            <label for="name">Name:</label>
                            <input type="text" id="name" name="name" placeholder="NAME" style="font-size: 17px" value="<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>">
                            <div class="error"></div>
                            </div>
<div class="grid-item">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="EMAIL" style="font-size: 17px" 
           value="<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>" readonly>
    <div class="error"></div>
</div>

                        <div class="grid-item">
                            <label for="password">Password:</label>
                            <input type="text" id="password" name="password" placeholder="PASSWORD" style="font-size: 17px" value="<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>" onclick="redirectToConfirmPassword()">
                            <div class="error"></div>
                        </div>
                        <div class="grid-item">
                            <label for="number">Number:</label>
                            <input type="number" id="number" name="number" placeholder="NUMBER" style="font-size: 17px;" value="<?php echo isset($_SESSION['number']) ? $_SESSION['number'] : ''; ?>">
                            <div class="error"></div>
                        </div>
                        <div class="grid-item">
                            <label for="weight">Weight:</label>
                            <input type="number" id="weight" name="weight" placeholder="WEIGHT" 
       style="font-size: 17px;" 
       value="<?php echo isset($_SESSION['weight']) ? $_SESSION['weight'] : ''; ?>">
                            <div class="error"></div>
                        </div>
                        <div class="grid-item">
                            <label for="gender">Gender:</label>
                            <select id="gender" name="gender">
                                <option value="" disabled selected>Select Gender</option>
                                <option value="male" <?php echo (isset($_SESSION['gender']) && $_SESSION['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                <option value="female" <?php echo (isset($_SESSION['gender']) && $_SESSION['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <div class="error"></div>
                        </div>
                    </div>
                    <br>
    </br>
    
                    <button type="submit" style="background-color: orange; color: white; width: 120px;" class="btn">Update Profile</button>
<button type="submit" name="logout" style="background-color: orange; color: white; width: 120px;" class="btn logout-btn">Logout</button>


                </form>
            </div>
        </section>
    </div>

    <script>
function redirectToConfirmPassword() {
    window.location.href = 'change_password2.php'; // Replace with your confirmation page URL
}
</script>

    <?php include('footer.php'); ?>
</body>
</html>
