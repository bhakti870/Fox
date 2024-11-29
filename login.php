<?php
@include 'config.php';
session_start();

if (isset($_POST['submit'])) {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Don't hash it here; use password_verify()

    // Select user based on email
    $select = "SELECT * FROM registration WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Verify password
        if (password_verify($password, $row['password'])) {

            // Set session and redirect to user page
            $_SESSION['name'] = $row['name'];
            header('location:index.php');
            exit(); // Make sure to stop script execution after redirect

        } else {
            $error[] = 'Incorrect password!';
        }
    } else {
        $error[] = 'Email not found!';
    }
}
?>



<!doctype html>
<html lang="en">
<head>
  <style>
    body {
      background: url('bg.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Arial', sans-serif;
      color: white;
    }

    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-box {
      background-color: rgba(0, 0, 0, 0.7);
      padding: 30px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .form-box h4 {
      margin-bottom: 40px;
      font-size: 24px;
    }

    .form-box input[type="email"],
    .form-box input[type="password"] {
      width: 90%;
      padding: 10px;
      margin-bottom: 10px; /* Adjusted margin to control space between fields */
      border: none;
      border-radius: 5px;
      background: #f0f0f0;
      color: #333;
      font-size: 16px;
    }

    .form-box input::placeholder {
      color: #aaa;
    }

    .form-box a.forgot-password {
      display: block;
      margin-top: 1px; /* Reduced margin to keep link close to the field */
      margin-left: 5px; /* Shift the link slightly to the left */
      color: #ddd;
      font-size: 14px;
      font-weight: bold; /* Make the link bold */
      text-align: left; /* Align the link to the left */
    }

    .form-box button[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      color: white;
      font-size: 16px;
      font-weight: bold; /* Make the link bold */

      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-box button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .form-box p.signup {
      margin-top: 20px;
      color: #ddd;
      font-size: 14px;
      font-weight: bold; /* Make the link bold */

    }

    .form-box p.signup a {
      color: #fff;
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 0.875em;
      margin-top: 0.25em;
      text-align: left;
    }
  </style>

  <!-- Include jQuery Validation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
</head>
<body>

  <div class="form-container">
    <div class="form-box">
      <h4>Login Form</h4>
		<form id="contactForm" method="POST" action="login.php">
        <input type="email" id="email" name="email" placeholder="Email" /><br></br>
        <input type="password" id="password" name="password" placeholder="Password" />
        <a href="change_password1.php" class="forgot-password">Forgot Password?</a><br></br>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>

        <button type="submit">Login</button>
        <p class="signup">Don't have an account? <a href="registration.php">Signup Now</a></p>
      </form>
    </div>
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
            required: "Please enter your email or phone number.",
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
