<?php
session_start();
include("config.php");
$id = $_REQUEST['id'];

$result = mysqli_query($con, "SELECT `ID`, `Name`, `Email`, `Message`, `Image` FROM `contacts` WHERE ID=$id");
list($id, $Name, $Email, $Message, $Image) = mysqli_fetch_array($result);

// Handling form submission
if (isset($_POST['edit'])) {
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Message = $_POST['Message'];
    $errors = array();

    // Name validation
    if (empty($Name)) {
        $errors[] = "Name is required";
    } elseif (strlen($Name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($Name) > 20) {
        $errors[] = "Name cannot contain more than 20 characters";
    }

    // Email validation
    if (empty($Email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    // Message validation
    if (empty($Message)) {
        $errors[] = "Message is required";
    }

    // Image upload validation (if image is selected)
    if (isset($_FILES['Image']) && $_FILES['Image']['error'] == 0) {
        $imageName = $_FILES['Image']['name'];
        $imageTmpName = $_FILES['Image']['tmp_name'];
        $imageSize = $_FILES['Image']['size'];
        $imageType = $_FILES['Image']['type'];

        // Validate image type and size
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($imageType, $allowedTypes)) {
            $errors[] = "Invalid image type. Only JPG, JPEG, and PNG are allowed.";
        }
        if ($imageSize > 2000000) { // 2MB limit
            $errors[] = "Image size should not exceed 2MB.";
        }

        // If no error, upload image
        if (count($errors) == 0) {
            $newImageName = time() . "_" . $imageName;
            move_uploaded_file($imageTmpName, "uploads/" . $newImageName);
        }
    } else {
        // If no new image is selected, use the existing image
        $newImageName = $Image; 
    }

    // If no errors, proceed with the update
    if (count($errors) == 0) {
        $query = "UPDATE `contacts` SET `Name`='$Name', `Email`='$Email', `Message`='$Message', `Image`='$newImageName' WHERE ID=$id";
        mysqli_query($con, $query) or die("Query 2 is incorrect..........");

        header("location: contactlist.php");
        mysqli_close($con);
    }
}

include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="float-right">
            <a href="contactlist.php" class="btn btn-primary">Back</a>
            <br><br><br>
        </div>
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="title">Edit Contact</h5>
            </div>
            <form action="editcontact.php" name="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="Name" name="Name" class="form-control" value="<?php echo $Name; ?>">
                            <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                                <span style="color: red;">Name is required</span>
                            <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                                <span style="color: red;">Name must have at least 3 characters</span>
                            <?php } elseif (isset($errors) && in_array("Name cannot contain more than 20 characters", $errors)) { ?>
                                <span style="color: red;">Name cannot contain more than 20 characters</span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" id="Email" name="Email" class="form-control" value="<?php echo $Email; ?>">
                            <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                                <span style="color: red;">Email is required</span>
                            <?php } elseif (isset($errors) && in_array("Invalid email address", $errors)) { ?>
                                <span style="color: red;">Invalid email address</span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Message</label>
                            <textarea name="Message" id="Message" class="form-control"><?php echo $Message; ?></textarea>
                            <?php if (isset($errors) && in_array("Message is required", $errors)) { ?>
                                <span style="color: red;">Message is required</span>
                            <?php } ?>
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

<?php
include "footer.php";
?>  
