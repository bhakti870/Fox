<?php

@include 'config.php';

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    
    // Handle image upload
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_images/' . $image;
    
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    if (empty($name) || empty($email) || empty($number) || empty($weight) || empty($gender) || empty($pass) || empty($cpass) || empty($image)) {
        $error[] = 'All fields are required!';
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error[] = 'Please enter a valid email address!';
        } else {
            $select = "SELECT * FROM registration WHERE email = '$email'";
            $result = mysqli_query($conn, $select);

            if (mysqli_num_rows($result) > 0) {
                $error[] = 'User already exists!';
            } else {
                if ($pass !== $cpass) {
                    $error[] = 'Passwords do not match!';
                } else {
                    // Move the uploaded image to the folder
                    move_uploaded_file($image_tmp_name, $image_folder);
                    
                    $insert = "INSERT INTO registration (name, email, number, weight, gender, image, password) VALUES('$name','$email','$number','$weight','$gender','$image','$pass')";
                    mysqli_query($conn, $insert);
                    session_start();
                    header('location:login_form.php');
                    exit;
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="style.css">
   <style>
       .error-msg {
           color: red;
           display: block;
           margin-top: 5px;
       }

       .error {
           border-color: red;
       }

       .form-container {
           padding: 20px;
           border-radius: 10px;
           background: rgba(255, 255, 255, 0.8);
       }

       input, select {
           width: 100%;
           padding: 10px;
           margin: 10px 0;
           border: 1px solid #ccc;
           border-radius: 5px;
       }
   </style>
</head>
<body>
   
<div class="form-container" style="background-image: url('bg.jpg'); background-size: cover; background-position: center;">

   <form id="contactForm" action="" method="post" enctype="multipart/form-data">
      <h3>Register Now</h3>
      <?php
      if (isset($error)) {
         foreach ($error as $error) {
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="text" name="name" id="name" placeholder="NAME" required>
      <input type="email" name="email" id="email" placeholder="EMAIL" required>
      <input type="number" name="number" id="number" placeholder="PHONE NUMBER" required>
      <input type="text" name="weight" id="weight" placeholder="WEIGHT (in kg)" required>
      <select name="gender" id="gender" required>
          <option value="">Select Gender</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
          <option value="Other">Other</option>
      </select>
      <input type="password" name="password" id="password" placeholder="PASSWORD" required>
      <input type="password" name="cpassword" id="cpassword" placeholder="CONFIRM PASSWORD" required>
      <input type="file" name="image" id="image" accept="image/*">

     
      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
<script>
  $(document).ready(function() {
    $.validator.addMethod("passwordMatch", function(value, element) {
      return value === $('#password').val();
    }, "Passwords do not match");

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
        number: {
          required: true,
          digits: true,
          minlength: 10
        },
        weight: {
          required: true,
          number: true
        },
        gender: {
          required: true
        },
       /* image: {
          required: true,
          accept: "image/*"
        },*/
        password: {
          required: true,
          minlength: 8
        },
        cpassword: {
          required: true,
          equalTo: '#password' 
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
        number: {
          required: "Please enter your phone number.",
          digits: "Please enter a valid phone number.",
          minlength: "Phone number must be at least 10 digits long."
        },
        weight: {
          required: "Please enter your weight.",
          number: "Please enter a valid weight."
        },
        gender: {
          required: "Please select your gender."
        },
       /* image: {
          required: "Please upload your image.",
          accept: "Only image files are allowed."
        },*/
        password: {
          required: "Please enter a password.",
          minlength: "Password must be at least 8 characters long."
        },
        cpassword: {
          required: "Please confirm your password.",
          equalTo: "Passwords do not match."
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
