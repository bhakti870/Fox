<?php
include('header.php');
include('config.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $messages = $_POST['messages'];
    $rating = $_POST['emoji'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedback (Name, Email, Number, Message, Rating) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $email, $number, $messages, $rating);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>alert('Feedback submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close the statement
    $stmt->close();

    // Close the connection
    $conn->close();
}
?>

<!doctype html>
<html lang="en">
<head>
  <style>
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-box {
    background-color: rgba(255, 255, 255, 0.9); /* Transparent background */
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-box h4 {
      text-align: center;
      color: orange;
      margin-bottom: 20px;
    }

    .rating {
      display: flex;
      justify-content: space-between;
    }

    .rating label {
      margin-right: 10px;
    }

    .emoji-feedback {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .emoji-feedback label {
      cursor: pointer;
    }

    .emoji-feedback input {
      display: none;
    }

    .emoji-feedback img {
      width: 40px;
      height: 40px;
      transition: transform 0.2s;
    }

    .emoji-feedback img:hover {
      transform: scale(1.2);
    }

    .error {
      color: red;
      font-size: 0.875em;
      margin-top: 0.25em;
    }
  </style>

  <!-- Include jQuery Validation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
</head>
<body>

  <div class="container-fluid form-container">
    <div class="col-md-6 footer2 wow bounceInUp" data-wow-delay=".25s" id="contact">
      <div class="form-box">
        <h4>FEEDBACK FORM</h4>
        <form id="contactForm" method="POST" action="">
          <table class="table table-responsive d-table">
            <tr>
              <td><input type="text" class="form-control pl-0" id="name" name="name" placeholder="NAME" /></td>
              <td><input type="email" class="form-control pl-0" id="email" name="email" placeholder="EMAIL" /></td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="2">
                <input 
                  type="number" 
                  class="form-control pl-0" 
                  id="number" 
                  name="number" 
                  placeholder="Number" 
                  pattern="[0-9]{10}" 
                  step="1" 
                  aria-describedby="numberHelp"
                />
              </td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="2"><input type="text" class="form-control pl-0" id="messages" name="messages" placeholder="MESSAGES" /></td>
            </tr>
            <tr>
              <td colspan="2"></td>
            </tr>
                        <tr>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td colspan="2" class="text-center pl-0">
                <label>Feedback:</label>
                <div class="emoji-feedback">
		  <label>
                    <input type="radio" name="emoji" value="1" />
                    <img src="images/icon3.png" alt="Sad" />
                  </label>
 		  <label>
                    <input type="radio" name="emoji" value="2" />
                    <img src="images/icon4.png" alt="Angry" />
                  </label>
                  <label>
                    <input type="radio" name="emoji" value="3" />
                    <img src="images/icon2.png" alt="Neutral" />
                  </label>
                  <label>
                    <input type="radio" name="emoji" value="4" />
                    <img src="images/icon5.png" alt="Love" />
                  </label>
		  <label>
                    <input type="radio" name="emoji" value="5" />
                    <img src="images/icon1.png" alt="Happy" />
                  </label>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center pl-0">
                <button type="submit" class="btn btn-dark">SEND</button>
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/parallax.js"></script>
<script src="js/wow.js"></script>
<script src="js/main.js"></script>
<!-- Include jQuery Validation library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

<script>
  $(document).ready(function() {
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
          minlength: 10,
          maxlength: 10,
          digits: true
        },
        messages: {
          required: true
        },
        rating: {
          required: true
        },
        emoji: {
          required: true
        }
      },
      messages: {
        name: {
          required: "Please enter a valid name with only letters.",
          pattern: "Name should only contain letters."
        },
        email: {
          required: "Please enter a valid email address.",
          email: "Please enter a valid email address."
        },
        number: {
          required: "Please enter a valid number.",
          minlength: "Number must be 10 digits long.",
          maxlength: "Number must be 10 digits long.",
          digits: "Please enter a valid number."
        },
        messages: {
          required: "Messages cannot be empty."
        },
        rating: {
          required: "Please select a rating."
        },
        emoji: {
          required: "Please select an emoji."
        }
      },
      errorPlacement: function(error, element) {
        // Insert error message below the field
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
<?php
include('footer.php');
?>
