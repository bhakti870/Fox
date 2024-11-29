<?php include('header.php'); ?>

<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

  <style>
    body {
      background: url('images/banner2.jpg') no-repeat center center;
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
    background-color: rgba(255, 255, 255, 0.4); /* Transparent background */
      padding: 30px;
      border-radius: 10px;
      width: 390px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    .form-box h4 {
      margin-bottom: 40px;
      font-size: 24px;
      color: orange;
    }

    .form-box input[type="text"],
    .form-box input[type="email"],
    .form-box input[type="password"] {
      width: 100%;
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

  <!-- Include jQuery Validation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
</head>
<body>

  <div class="form-container">
    <div class="form-box">
      <h4>Change Password</h4>
      <form id="contactForm">
	<input type="password"  id="currentpassword" name="currentpassword" placeholder="CURRENT PASSWORD" /><br></br>
        <input type="password" id="password" name="password" placeholder="PASSWORD" /><br></br>
  <input type="password" id="confirmPassword" name="confirmPassword" placeholder="CONFIRM PASSWORD"><br></br>

        <button type="submit">Change Password</button>
  <div id="error-message" style="color: red; display: none;">Passwords do not match</div>

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

    $('#contactForm').validate({
      rules: {
        currentpassword: {
          required: true,
          minlength: 8
        },
        password: {
          required: true,
          minlength: 8
        },
        confirmPassword: {
          required: true,
          minlength: 8,
          passwordMatch: '#password' // Referencing the password field
        }
      },
      messages: {
   currentpassword: {
          required: "Please enter your password.",
          minlength: "Your password must be at least 8 characters long."
        },

               password: {
          required: "Please enter your password.",
          minlength: "Your password must be at least 8 characters long."
        },
        confirmPassword: {
          required: "Please confirm your password.",
          minlength: "Your password must be at least 8 characters long.",
          passwordMatch: "Passwords do not match."
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

  <?php include('footer.php'); ?>
</body>
</html>