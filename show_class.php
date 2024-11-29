<?php
include('header.php');
include('config.php'); // Ensure this file connects to your database

if (session_status() == PHP_SESSION_NONE) {
  session_start(); // Start session if not already started
}
$user_id = $_SESSION['id']; // Replace with your actual session variable

// Query to fetch data from the user_membership table
$query = "SELECT * FROM registration WHERE id = '$user_id'";
$result = mysqli_query($conn, $query);
$userData = mysqli_fetch_assoc($result);
?>
<!doctype html>
<html lang="en">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
 <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparent Form</title>
    <link rel="stylesheet" href="styles.css">
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>

  <style>
    .card-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px; /* Space between cards */
    }

    .card {
      flex: 1 1 300px; /* Grow and shrink, with a base width of 300px */
      max-width: 500px; /* Maximum width */
      height: 100px; /* Fixed height */
      border: 1px solid #ddd; /* Border for the card */
      border-radius: 8px; /* Rounded corners for the card */
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Shadow effect */
      background-color: #fff; /* Background color */
      display: flex;
      margin-left: 700px;
      flex-direction: column; /* Stack children vertically */
      justify-content: center; /* Center content vertically */
      padding: 15px; /* Padding inside the card */
      box-sizing: border-box; /* Include padding in width/height */
    }

    .percentage-icon {
      position: relative;
      width: 70px; /* Adjust size as needed */
      height: 70px; /* Adjust size as needed */
      margin-bottom: 15px; /* Space below the icon */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .circle {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      background-color: #e0e0e0; /* Background color of the circle */
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      border: 5px solid #00bfae; /* Border color for the circle */
    }

    .percentage {
      font-size: 14px; /* Font size for the percentage */
      color: #00bfae; /* Font color for the percentage */
    }

    .media-body {
      text-align: center; /* Center text and span */
    }

    .media-body h3 {
      margin-bottom: 5px; /* Space between the title and the span */
    }

    .media-body span {
      display: block; /* Ensure the span takes full width */
    }

    .icon-percentage {
      font-size: 2rem; /* Adjust size as needed */
      color: #00bfae; /* Adjust color as needed */
      border-radius: 50%;
      border: 5px solid #00bfae; /* Border color for the circle */
      width: 60px; /* Adjust size as needed */
      height: 60px; /* Adjust size as needed */
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto; /* Center icon horizontally */
    }

    
   
    /* Background image style */
    .grey-bg {
      background: url('images/banner2.jpg') no-repeat center center;
      background-size: cover; /* Ensure the image covers the section */
      padding: 20px; /* Adjust padding if necessary */
    }



.form-container {
    background-color: rgba(255, 255, 255, 0.4); /* Transparent background */
    border-radius: 10px;
    padding: 40px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    max-width: 900px;
    width: 100%;
}

.form-container h1 {
    text-align: center;
    color: orange; 
}

label {
    color: #fff; /* Label text color set to white */
    margin-top: 10px;
    display: block;
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border: none;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.7);
    color: #000; /* Input text color */
}

button {
    width: 100%;
    padding: 10px;
    margin-top: 15px;
    background-color: #000; /* Button background color */
    color: #fff; /* Button text color */
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #333;
}

.grid-row {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two columns of equal width */
    gap: 50px; /* Space between fields */
    margin-bottom: 15px;
}

.grid-item input[type="email"]
{
	color: white;
    display: flex;
    flex-direction: column;
}

input {
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.plan-container {
    margin-left: 900px; /* Adjust the value as needed */
}

.profile-container {
    margin-left: 450px; /* Adjust the value as needed */
}
    .error {
      color: red;
      font-size: 0.875em;
      margin-top: 0.25em;
      text-align: left;
    }



  </style>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap-extended.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/fonts/simple-line-icons/style.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/colors.min.css">
  <link rel="stylesheet" type="text/css" href="https://pixinvent.com/stack-responsive-bootstrap-4-admin-template/app-assets/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">

</head>
<body>
  <div class="grey-bg container-fluid main-content">
    <section id="minimal-statistics" class="section-spacing">
      <div class="row">
        <div class="col-12 mt-3 mb-1">
          <p></p>
        </div>
      </div>

  
		


<div class="form-container profile-container">
    <form id="transparent-form">
        <h1>Plan</h1>
        <br></br>
        <div class="grid-row">
            <div class="grid-item">
                <input type="text" id="name" name="name" placeholder="GOAL"  value="<?php echo $userData['Goal']; ?>">
            </div>
            <div class="grid-item">
                <input type="text" id="skill" name="skill" placeholder="SKILL LEVEL" value="<?php echo $userData['Skill']; ?>">
            </div>
            <div class="grid-item">
                <input type="text" id="duration" name="duration" placeholder="DURATION" value="<?php echo $userData['Duration']; ?>">
            </div>
            <div class="grid-item">
                <input type="days" id="days" name="days" placeholder="DAYS" value="<?php echo $userData['Days']; ?>">
            </div>
            <br></br>
            <div class="grid-item">
        <button type="button"><a href="personal_plan.php">Add New Plan</a></button>
            </div>
        </div>
    </form>
</div>



               
           </section>
  </div>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

   <script>
        $(document).ready(function () {
            $("#profile-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    number: {
                        required: true,
                        number: true,
                        minlength: 10
                    },
                    weight: {
                        required: true,
                        number: true,
                        min: 1
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must consist of at least 3 characters"
                    },
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },
                    number: {
                        required: "Please enter your number",
                        number: "Please enter a valid number",
                        minlength: "Your number must be at least 10 digits long"
                    },
                    weight: {
                        required: "Please enter your weight",
                        number: "Please enter a valid weight",
                        min: "Weight must be greater than 0"
                    }
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.next('.error'));
                }
            });
 $("#transparent-form1").on("submit", function (event) {
            event.preventDefault(); // Prevent the form from submitting
            alert("Your class has been removed successfully!");
	});
        });
    </script>






  <?php include('footer.php'); ?>
</body>
</html>

<!-- "Get ready to dance your way to fitness with our energetic Zumba classes! Combining fun, easy-to-follow dance moves with vibrant Latin rhythms, Zumba is a full-body workout that feels more like a party than exercise." -->

<!-- Discover the art of yoga with our comprehensive classes designed to enhance your flexibility, strength, and overall well-being. Whether you are a beginner or an advanced practitioner, our sessions are tailored to meet your needs. Join us to experience the tranquility and benefits of yoga in a supportive and welcoming environment. -->