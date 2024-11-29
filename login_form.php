<?php
include 'config.php';
session_start();


if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Check for admin credentials
    if ($email === 'admin7@gmail.com' && $password === 'admin@2717') {
        // Start session for admin user
        $_SESSION['admin_name'] = 'Admin'; // You can set any admin name you want
        header('location:admin'); // Redirect to admin page
        exit();
    }

    // Select user with the provided email
    $select = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    // Check if user exists
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Verify the password (direct comparison)
        if ($password === $row['password']) {
            // Start session for the user
            $_SESSION['user_name'] = $row['name'];

 $_SESSION['name'] = $row['name'];
 $_SESSION['email'] = $row['email'];
 $_SESSION['password'] = $row['password'];
 $_SESSION['number'] = $row['number'];
 $_SESSION['weight'] = $row['weight'];
 $_SESSION['gender'] = $row['gender'];
 $_SESSION['id'] = $row['id'];
//  $_SESSION['image'] = $row['image']; // Store image or default

 // Ensure the session stores the correct image
 if (!empty($row['image'])) {
    $_SESSION['image'] = $row['image']; // Store the image path in session
} else {
    $_SESSION['image'] = 'icon4.png'; // Use a default image if not found
}




            header('location:index.php'); // Redirect to user homepage or dashboard
            exit();
        } else {
            $error[] = 'Incorrect email or password!';
        }
    } else {
        $error[] = 'Incorrect email or password!'; // Avoid disclosing user existence
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <style>
        .form-box a.forgot-password {
            display: block;
            margin-top: 1px; /* Reduced margin to keep link close to the field */
            margin-left: 5px; /* Shift the link slightly to the left */
            color: #ddd;
            font-size: 14px;
            font-weight: bold; /* Make the link bold */
            text-align: left; /* Align the link to the left */
        }
    </style>
    <div class="form-container" style="background-image: url('bg.jpg'); background-size: cover; background-position: center;">
        <form id="contactForm" action="" method="post">
            <h3>Login Now</h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="email" name="email" id="email" required placeholder="Enter your email">
            <input type="password" name="password" id="password" required placeholder="Enter your password">
            <a href="change_password1.php" class="forgot-password">Forgot Password?</a><br></br>
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register now</a></p>
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contactForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email.",
                        email: "Please enter a valid email address."
                    },
                    password: {
                        required: "Please enter your password.",
                        minlength: "Your password must be at least 8 characters long."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('error');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('error');
                }
            });
        });
    </script>
</body>
</html>
