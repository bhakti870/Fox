<?php
include('header.php');
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Include jQuery Validation CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">

  <style>
    .form-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-box {
    background-color: rgba(255, 255, 255, 0.5); /* Transparent background */
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .form-box h4 {
      text-align: center;
      color: orange;
      margin-bottom: 20px;
    }

    /* Custom error message styling */
    .error {
      color: red;
      font-size: 12px;
      margin-top: 5px;
    }
  </style>
</head>
<body>

  <div class="container-fluid form-container">
    <div class="col-md-6 footer2 wow bounceInUp" data-wow-delay=".25s" id="contact">
      <div class="form-box">
        <h4>CONTACT US</h4>
         <form id="contactForm">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="name" name="name" placeholder="NAME">
                        <label for="name" class="error"></label>
                    </div>
		
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control" id="email" name="email" placeholder="EMAIL">
                        <label for="email" class="error"></label>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" id="address" name="address" placeholder="ADDRESS">
                    <label for="address" class="error"></label>
                </div>
                <div class="form-group">
                    <textarea class="form-control" id="messages" name="messages" placeholder="MESSAGES" rows="4"></textarea>
                    <label for="messages" class="error"></label>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-dark">SEND</button>
                </div>
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
        address: {
          required: true
        },
        messages: {
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
        address: {
          required: "Address is required."
        },
        messages: {
          required: "Messages cannot be empty."
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
<?php
include('footer.php');
?>
