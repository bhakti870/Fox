<?php
session_start();
include("config.php");
$id = $_REQUEST['id'];

$result = mysqli_query($con, "SELECT `id`, `Name`, `Email`, `Number`, `Message`, `Rating` FROM `feedback` WHERE id=$id");

list($id, $Name, $Email, $Number, $Message, $Rating) = mysqli_fetch_array($result);

if (isset($_POST['edit'])) {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Number = $_POST['Number'];
    $Message = $_POST['Message'];
    $Rating = $_POST['Rating'];

    mysqli_query($con, "UPDATE `feedback` SET `Name`='$Name',`Email`='$Email',`Number`='$Number',`Message`='$Message',`Rating`='$Rating' WHERE id=$id") or die("Query 2 is incorrect..........");

    header("location: feedback.php");
    mysqli_close($con);
}

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="title">Edit Feedback</h5>
            </div>
            <form action="editfeedback.php" name="form" method="post" onsubmit="return validateForm()">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="Name" name="Name" class="form-control" value="<?php echo $Name; ?>">
                            <span id="nameError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" id="Email" name="Email" class="form-control" value="<?php echo $Email; ?>">
                            <span id="emailError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Number</label>
                            <input type="number" id="Number" name="Number" class="form-control" value="<?php echo $Number; ?>">
                            <span id="numberError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="Message" id="Message" class="form-control"><?php echo $Message; ?></textarea>
                            <span id="messageError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Rating</label>
                            <input type="number" id="Rating" name="Rating" class="form-control" value="<?php echo $Rating; ?>">
                            <span id="ratingError" style="color: red;"></span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="btn_save" name="edit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        let isValid = true;

        // Name validation
        let name = document.getElementById('Name').value;
        if (name === "" || name.length < 3 || name.length > 50) {
            document.getElementById('nameError').innerText = "Name must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Email validation
        let email = document.getElementById('Email').value;
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (email === "" || !emailPattern.test(email)) {
            document.getElementById('emailError').innerText = "Please enter a valid email address.";
            isValid = false;
        } else {
            document.getElementById('emailError').innerText = "";
        }

        // Number validation
        let number = document.getElementById('Number').value;
        if (number === "" || isNaN(number)) {
            document.getElementById('numberError').innerText = "Please enter a valid number.";
            isValid = false;
        } else {
            document.getElementById('numberError').innerText = "";
        }

        // Message validation
        let message = document.getElementById('Message').value;
        if (message === "") {
            document.getElementById('messageError').innerText = "Message is required.";
            isValid = false;
        } else {
            document.getElementById('messageError').innerText = "";
        }

        // Rating validation
        let rating = document.getElementById('Rating').value;
        if (rating === "" || isNaN(rating) || rating < 1 || rating > 5) {
            document.getElementById('ratingError').innerText = "Rating must be between 1 and 5.";
            isValid = false;
        } else {
            document.getElementById('ratingError').innerText = "";
        }

        return isValid;
    }
</script>

<?php
include "footer.php";
?>
