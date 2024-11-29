<?php
  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirmPassword'];

      if ($password !== $confirmPassword) {
          echo "Passwords do not match.";
          exit;
      }

      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

      $servername = "localhost"; // Change if necessary
      $username = "root"; 
      $dbpassword = ""; 
      $dbname = "Fox"; 

      $conn = new mysqli($servername, $username, $dbpassword, $dbname);

      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }

      $sql = "INSERT INTO registration (name, email, password) VALUES (?, ?, ?)";
      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $name, $email, $hashedPassword);

      if ($stmt->execute()) {
    header("Location: login.php");
    exit;
} else {
    echo "Error executing statement: " . $stmt->error;
}


      $stmt->close();
      $conn->close();
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

    .form-box input[type="text"],
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
      cursor: pointer;
      font-weight: bold; /* Make the link bold */
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

  <!-- Include jQuery and jQuery Validation libraries -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
</head>
<body>

  <div class="form-container">
    <div class="form-box">
      <h4>Register Form</h4>
      <form id="contactForm" method="POST" action="registration.php">
        <input type="text" id="name" name="name" placeholder="NAME" /><br><br>
        <input type="email" id="email" name="email" placeholder="EMAIL" /><br><br>
        <input type="password" id="password" name="password" placeholder="PASSWORD" /><br><br>
        <input type="password" id="confirmPassword" name="confirmPassword" placeholder="CONFIRM PASSWORD" /><br><br>
        <button type="submit">Register</button>
        <p class="signup">Already have an account? <a href="login.php">Login Now</a></p>
      </form>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <script>
  $(document).ready(function() {
    // Add custom method for confirming passwords
    $.validator.addMethod("passwordMatch", function(value, element, params) {
      return this.optional(element) || value === $(params).val();
    }, "Passwords do not match");

    // Apply validation rules
    $('#contactForm').validate({
      rules: {
        name: {
          required: true,
          pattern: /^[A-Za-z\s]+$/ 
        },
        email: {
          required: true,
          email: true
        },
        password: {
          required: true,
          minlength: 8
        },
        confirmPassword: {
          required: true,
          minlength: 8,
          passwordMatch: '#password'  
        }
      },
      messages: {
        name: {
          required: "Please enter your name.",
          pattern: "Name should only contain letters."
        },
        email: {
          required: "Please enter your email address.",
          email: "Please enter a valid email address."
        },
        password: {
          required: "Please enter a password.",
          minlength: "Password must be at least 8 characters long."
        },
        confirmPassword: {
          required: "Please confirm your password.",
          minlength: "Password must be at least 8 characters long.",
          passwordMatch: "Passwords do not match." // Custom error message for mismatching passwords
        }
      },
      errorPlacement: function(error, element) {
        error.insertAfter(element);  // Place the error message after the input field
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
