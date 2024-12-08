<?php
session_start();
include("config.php");

// Get the ID from the request
$id = $_REQUEST['id'];

// Fetch the user data from the database
$result = mysqli_query($con, "SELECT `id`, `name`, `email`, `password`, `number`, `weight`, `gender`, `image`, `classes`, `created_at` FROM `registration` WHERE id=$id");
list($id, $name, $email, $password, $number, $weight, $gender, $image, $classes, $created_at) = mysqli_fetch_array($result);

// Define the default image if no image exists
$defaultImage = "uploads/default.jpg"; // Replace with the path to your default image
$currentImage = $image ? "uploads/$image" : $defaultImage;

// Update user data on form submission
if (isset($_POST['edit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $weight = $_POST['weight'];
    $gender = $_POST['gender'];
    $classes = $_POST['classes'];

    // Handle image upload
    if ($_FILES['image']['name'] != "") {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
    } else {
        // If no new image is uploaded, keep the old one
        $image = $currentImage === $defaultImage ? "" : $image;
    }

    // Update the database
    mysqli_query($con, "UPDATE `registration` SET 
        `name`='$name', 
        `email`='$email', 
        `password`='$password', 
        `number`='$number', 
        `weight`='$weight', 
        `gender`='$gender', 
        `image`='$image', 
        `classes`='$classes' 
        WHERE id=$id") or die("Query failed.");

    header("location: profile.php");
    mysqli_close($con);
}

include "sidenav.php";
include "topheader.php";
?>

<!-- Edit Profile Form -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="title">Edit Profile</h5>
            </div>
            <form action="editprofile.php?id=<?php echo $id; ?>" name="form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span id="nameError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span id="emailError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control" value="<?php echo $password; ?>">
                            <span id="passwordError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Number</label>
                            <input type="number" id="number" name="number" class="form-control" value="<?php echo $number; ?>">
                            <span id="numberError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="text" id="weight" name="weight" class="form-control" value="<?php echo $weight; ?>">
                            <span id="weightError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Gender</label>
                            <select id="gender" name="gender" class="form-control">
                                <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                            <span id="genderError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" id="image" name="image" class="form-control" onchange="previewImage(event)">
                            <img id="imagePreview" src="<?php echo $currentImage; ?>" alt="Profile Image" style="margin-top: 10px; max-height: 150px;">
                            <span id="imageError" style="color: red;"></span>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Classes</label>
                            <input type="text" id="classes" name="classes" class="form-control" value="<?php echo $classes; ?>">
                            <span id="classesError" style="color: red;"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" name="edit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    function validateForm() {
        let isValid = true;

        // Name validation
        let name = document.getElementById('name').value;
        if (name === "" || name.length < 3 || name.length > 50) {
            document.getElementById('nameError').innerText = "Name must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Email validation
        let email = document.getElementById('email').value;
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (email === "" || !emailPattern.test(email)) {
            document.getElementById('emailError').innerText = "Enter a valid email address.";
            isValid = false;
        } else {
            document.getElementById('emailError').innerText = "";
        }

        // Password validation
        let password = document.getElementById('password').value;
        if (password.length < 6) {
            document.getElementById('passwordError').innerText = "Password must be at least 6 characters long.";
            isValid = false;
        } else {
            document.getElementById('passwordError').innerText = "";
        }

        // Number validation
        let number = document.getElementById('number').value;
        if (number.length < 10 || number.length > 15) {
            document.getElementById('numberError').innerText = "Enter a valid phone number (10-15 digits).";
            isValid = false;
        } else {
            document.getElementById('numberError').innerText = "";
        }

        // Weight validation
        let weight = document.getElementById('weight').value;
        if (isNaN(weight) || weight <= 0) {
            document.getElementById('weightError').innerText = "Enter a valid weight.";
            isValid = false;
        } else {
            document.getElementById('weightError').innerText = "";
        }

        // Gender validation
        let gender = document.getElementById('gender').value;
        if (gender === "") {
            document.getElementById('genderError').innerText = "Select a gender.";
            isValid = false;
        } else {
            document.getElementById('genderError').innerText = "";
        }

        // Classes validation
        let classes = document.getElementById('classes').value;
        if (classes === "") {
            document.getElementById('classesError').innerText = "Enter classes.";
            isValid = false;
        } else {
            document.getElementById('classesError').innerText = "";
        }

        return isValid;
    }
</script>
