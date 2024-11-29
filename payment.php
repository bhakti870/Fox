<?php include('header.php'); 

if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
  }
 
  
  // Check and sanitize incoming GET parameters
  if (isset($_GET['membership_id'], $_GET['user_id'], $_GET['amount'], $_GET['name'])) {
    $membership_id = ($_GET['membership_id']);
    $user_id = ($_GET['user_id']);
    $amount = ($_GET['amount']);
    $name = ($_GET['name']);
} else {
    echo "Debug Info:<br>";
    echo "Membership ID: " . (isset($_GET['membership_id']) ? $_GET['membership_id'] : "Missing") . "<br>";
    echo "User ID: " . (isset($_GET['user_id']) ? $_GET['user_id'] : "Missing") . "<br>";
    echo "Amount: " . (isset($_GET['amount']) ? $_GET['amount'] : "Missing") . "<br>";
    echo "Name: " . (isset($_GET['name']) ? $_GET['name'] : "Missing") . "<br>";
    exit;
}
$promoDiscount = 0; // Default discount
$promoMessage = ""; // Default message

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['promoCode'])) {
    include('config.php'); // Include your database connection

    $promoCode = $_POST['promoCode'];

    if (!empty($promoCode)) {
        // Query to check the promo code
        $query = "SELECT price, expired_at FROM promocode WHERE name = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $promoCode);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $discount = $row['price'];
            $expiry_date = $row['expired_at'];

            // Check if the promo code is expired
            if (strtotime($expiry_date) >= time()) {
                $promoDiscount = $discount;
                $promoMessage = "Promo code applied successfully!";
            } else {
                $promoMessage = "Promo code has expired.";
            }
        } else {
            $promoMessage = "Promo code does not exist.";
        }

        $stmt->close();
    }
}

$total = $amount - $promoDiscount; // Calculate the updated total
  
?>


<!doctype html>
<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Work+Sans:wght@800&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            padding: 15px;
            background-image: url('images/banner2.jpg'); /* Replace with the path to your image */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        /* Scoped CSS for the page content */
        #page-content .container {
            margin: 20px auto;
            max-width: 1200px;
            background-color: rgba(255, 255, 255, 0.4); /* Transparent background */
            padding: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        #page-content .form-control,
        #page-content .form-control2,
        #page-content .form-control3 {
            border-bottom: 2px solid #ccc;
            background-color: rgba(255, 255, 255, 0.4); /* Transparent background */
        }

        #page-content .form-control:focus,
        #page-content .form-control2:focus,
        #page-content .form-control3:focus {
            background-color: transparent;
            border-bottom: 2px solid #ccc;
        }

        .text-muted {
            font-size: 20px;
        }

        .textmuted {
            color: white;
            font-size: 13px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .btn.btn-primary {
            width: 100%;
            height: 55px;
            border-radius: 0;
            padding: 13px 0;
            background-color: black;
            border: none;
            font-weight: 600;
        }

        .btn.btn-primary:hover .fas {
            transform: translateX(10px);
            transition: transform 0.5s ease;
        }

        .fw-900 {
            font-weight: 900;
        }

        ::placeholder {
            font-size: 12px;
        }

        .ps-30 {
            padding-left: 30px;
        }

        .h4 {
            font-family: 'Work Sans', sans-serif !important;
            font-weight: 800 !important;
        }

        .textmuted,
        h5,
        .text-muted {
            font-family: 'Poppins', sans-serif;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }


    </style>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">

    <!-- jQuery Validation Plugin -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js"></script>
</head>
<body>
<div id="page-content">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-7 pb-5 pe-lg-5">
                    <div class="row">
                        <div class="col-12 p-5">
                            <img src="images/gym2.jpg" alt="" style="width: 115%; height: 100%;">
                        </div>
                        <div class="row m-0 bg-light">
                            <div class="col-md-4 col-6 ps-30 pe-0 my-4">
                                <p class="text-muted">Membership</p>
                                <h5 class="h5"><?php echo ($name); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 p-0 ps-lg-4">
                    <div class="row m-0">
                        <div class="col-12 px-4">
                            <div class="d-flex align-items-end mt-4 mb-2">
                                <p class="h4 m-0"><span class="pe-1">MAKE</span><span class="pe-1">PAYMENT</span></p>
                            </div>
                            <br>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="textmuted">Subtotal</p>
                                <p class="fs-14 fw-bold"><?php echo ($amount); ?></p>
                            </div>
                            <form method="POST">
                                <div class="d-flex justify-content-between mb-2">
                                    <input type="text" name="promoCode" id="promoCode" class="form-control me-2" placeholder="Enter promo code">
                                    <button type="submit" class="btn btn-primary">Enter</button>
                                </div>
                            </form>
                            <p class="textmuted mt-2"><?php echo $promoMessage; ?></p>
                            <div class="d-flex justify-content-between mb-2">
                                <p class="textmuted">Promo code</p>
                                <p class="fs-14 fw-bold"><?php echo number_format($promoDiscount, 2); ?></p>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <p class="textmuted fw-bold">Total</p>
                                <div class="d-flex align-text-top">
                                    <span class="fs-14 fw-bold"><?php echo number_format($total, 2); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0">
                            <div class="row bg-light m-0">
                                <div class="col-12 px-4 my-4">
                                    <p class="fw-bold">Payment detail</p>
                                </div>
                                <div class="col-12 px-4">
                                    <form id="paymentForm" action="payment_razorpay_action.php" method="POST">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" />
                                        <input type="hidden" name="membership_id" value="<?php echo $membership_id; ?>" />
                                        <input type="hidden" name="amount" value="<?php echo $total; ?>" />
                                        <button type="submit" class="btn btn-primary" id="purchaseBtn">PAY NOW<span class="fas fa-arrow-right ps-2"></span></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    $('#purchaseBtn').on('click', function(e) {
    if ($('#paymentForm').valid()) {
        $('#paymentForm').submit(); // Submit the form if validation passes
    }

    let memberCount = 1;

    // Get the input field element
    const memberCountInput = document.getElementById("memberCountInput");

    // Event listener to handle changes in the input
    memberCountInput.addEventListener("input", () => {
        const newCount = parseInt(memberCountInput.value);
        if (!isNaN(newCount) && newCount >= 1) {
            memberCount = newCount; // Update the member count if valid
        } else {
            memberCountInput.value = memberCount; // Restore value if input is invalid
        }
});
</script>
    <!-- Modal -->
    <!-- <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">Payment Successful</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your payment has been successfully processed.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#paymentForm').validate({
                rules: {
                    cardNumber: {
                        required: true,
                        creditcard: true
                    },
                    cardholderName: {
                        required: true,
                        minlength: 2
                    },
                    cvc: {
                        required: true,
                        digits: true,
                        minlength: 3,
                        maxlength: 3
                    }
                },
                messages: {
                    cardNumber: {
                        required: "Please enter your card number.",
                        creditcard: "Please enter a valid card number."
                    },
                    cardholderName: {
                        required: "Please enter the cardholder's name.",
                        minlength: "The cardholder's name must be at least 2 characters long."
                    },
                    cvc: {
                        required: "Please enter the CVC.",
                        digits: "Please enter a valid CVC.",
                        minlength: "The CVC must be 3 digits long.",
                        maxlength: "The CVC must be 3 digits long."
                    }
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element); // Insert error message directly after the element
                },
                highlight: function(element) {
                    $(element).addClass('error');
                },
                unhighlight: function(element) {
                    $(element).removeClass('error');
                }
            });

            $('#purchaseBtn').on('click', function() {
                if ($('#paymentForm').valid()) {
                    var paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
                    paymentModal.show();
                }
            });
        });
    </script>
</body>
</html>

<?php include('footer.php'); ?>
