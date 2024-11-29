<?php
require 'vendor/autoload.php';
session_start();

use Razorpay\Api\Api;

// Include any necessary authentication or session management
include_once("header.php");

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Fetch total amount or fallback to session value
    $total = $_POST['amount'] ?? $_SESSION['amount'] ?? 0;
    $user_id = $_POST['user_id'] ?? $_SESSION['user_id'] ?? '';  // Ensure user ID is set
    $membership_id = $_POST['membership_id'] ?? $_SESSION['membership_id'] ?? '';  // Ensure membership ID is set

    // Debugging information to check which value is not set or is incorrect
    if ($total <= 0) {
        echo "Total amount is not valid. Received: " . htmlspecialchars($total);
        exit;
    }
    if (empty($user_id)) {
        echo "User ID is missing. Received: " . htmlspecialchars($user_id);
        exit;
    }
    if (empty($membership_id)) {
        echo "Membership ID is missing. Received: " . htmlspecialchars($membership_id);
        exit;
    }

    // Proceed with Razorpay API initialization and order creation...
    
    // Initialize Razorpay API
    $api_key = 'rzp_test_yCgrsfXSuM7SxL';
    $api_secret = 'eaxt0pkgow03xe2s2ufGFmBK';
    $api = new Api($api_key, $api_secret);

    try {
        // Create a Razorpay order
        $order = $api->order->create([
            'receipt' => 'order_rcptid_' . time(),
            'amount' => $total * 100, // Amount in paise
            'currency' => 'INR'
        ]);
        $_SESSION['order_id'] = $order->id;

    } catch (Exception $e) {
        echo "Error creating Razorpay order: " . $e->getMessage();
        exit;
    }
?>
<br>
</br>
    <div class="container">
        <div class="row text-center">
            <div class="col-12 bg-white text-black p-2">
                <h1>Paying to Fox Fitness</h1>
            </div>
        </div>
        <br>
</br>
        <div class="row justify-content-center">
            <div class="col-6">
                <form action="payment.php" method="POST">
                    <div class="form-group">
                        <label for="total" style="color: white; font-weight: bold;"><b>Net Payable Amount</b></label>
                        <input type="text" class="form-control" value="<?php echo htmlspecialchars($total); ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="order_id" style="color: white; font-weight: bold;"><b>Payment ID</b></label>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['order_id']; ?>" disabled>
                    </div>
                    <br>
                    <button id="rzp-button" class="btn btn-dark">Pay Now</button>
                </form>
            </div>
        </div>

        <!-- Razorpay checkout script -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            var options = {
                "key": "<?php echo $api_key; ?>",  // API key
                "amount": "<?php echo $total * 100; ?>",  // Amount in paisse
                "currency": "INR",
                "name": "Fox Fitness",
                "description": "Membership Payment",
                "image": "https://i.postimg.cc/X7SnKqg5/images.jpg",
                "order_id": "<?php echo $_SESSION['order_id']; ?>", // Razorpay Order ID
                "prefill": {
                    "name": "Nirali Akbari",
                    "email": "nakbari365@rku.ac.in",
                    "contact": "8849274162"
                },
                "theme": {
                    "color": "#ffffff"
                },
                "handler": function(response) {
                    $.post("payment_razorpay_checkout.php", {
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        user_id: "<?php echo $user_id; ?>",
                        membership_id: "<?php echo $membership_id; ?>",
                        amount: "<?php echo $total; ?>"
                    }, function(data) {
                        if (data === "success") {
                            // Redirect to user order page
                            window.location.href = "payment.php"; // or wherever you want to redirect after payment success
                        } else {
                            alert("Payment verification failed. Please contact support.");
                        }
                    });
                }
            };

            var rzp = new Razorpay(options);
            document.getElementById('rzp-button').onclick = function(e) {
                rzp.open();
                e.preventDefault();
            };
        </script>
    </div>
<?php
}
?>
