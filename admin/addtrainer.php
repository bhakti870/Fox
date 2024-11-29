<?php
session_start();
include("config.php");

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    // Picture uploading
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Validation
    $errors = array();

    // Name validation
    if (empty($name)) {
        $errors[] = "Name is required";
    }

    // Contact validation
    if (empty($contact)) {
        $errors[] = "Contact is required";
    } elseif (!is_numeric($contact)) {
        $errors[] = "Contact must be a number";
    }

    // City validation
    if (empty($city)) {
        $errors[] = "City is required";
    }

    // Address validation
    if (empty($address)) {
        $errors[] = "Address is required";
    }

    // Experience validation
    if (empty($experience)) {
        $errors[] = "Experience is required";
    }

    // Bio validation
    if (empty($bio)) {
        $errors[] = "Bio is required";
    }

    // Picture validation
    if (empty($picture_name)) {
        $errors[] = "Image is required";
    } elseif (!in_array($picture_type, ["image/jpeg", "image/jpg", "image/png", "image/gif"])) {
        $errors[] = "Invalid file type. Only JPG, PNG, GIF are allowed.";
    } elseif ($picture_size > 50000000) {
        $errors[] = "File size should be less than 50MB.";
    }

    if (count($errors) == 0) {
        $pic_name = time() . "_" . $picture_name;
        move_uploaded_file($picture_tmp_name, "http://localhost/fox/fox/images/" . $pic_name);
        
        // Insert into trainers
        $query = "INSERT INTO `trainers` (`Name`, `Image`, `Contact`, `City`, `Address`, `Experience`, `bio`, `created_at`) VALUES ('$name', '$pic_name', '$contact', '$city', '$address', '$experience', '$bio', NOW())";
        mysqli_query($con, $query);
        
        header("location: trainer.php");
        mysqli_close($con);
    }
}

include "sidenav.php";
include "topheader.php";
?>

<!-- Form -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Add Trainer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                        <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                                            <span style="color: red;">Name is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Contact</label>
                                        <input type="text" id="contact" name="contact" class="form-control">
                                        <?php if (isset($errors) && in_array("Contact is required", $errors)) { ?>
                                            <span style="color: red;">Contact is required</span>
                                        <?php } elseif (isset($errors) && in_array("Contact must be a number", $errors)) { ?>
                                            <span style="color: red;">Contact must be a number</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" id="city" name="city" class="form-control">
                                        <?php if (isset($errors) && in_array("City is required", $errors)) { ?>
                                            <span style="color: red;">City is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address" name="address" class="form-control">
                                        <?php if (isset($errors) && in_array("Address is required", $errors)) { ?>
                                            <span style="color: red;">Address is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" id="experience" name="experience" class="form-control">
                                        <?php if (isset($errors) && in_array("Experience is required", $errors)) { ?>
                                            <span style="color: red;">Experience is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea rows="4" cols="80" id="bio" name="bio" class="form-control"></textarea>
                                        <?php if (isset($errors) && in_array("Bio is required", $errors)) { ?>
                                            <span style="color: red;">Bio is required</span>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label><br>
                                        <input type="file" name="picture" class="btn btn-fill btn-success" id="picture">
                                        <?php if (isset($errors) && in_array("Image is required", $errors)) { ?>
                                            <br><span style="color: red;">Image is required</span>
                                        <?php } elseif (isset($errors) && in_array("Invalid file type. Only JPG, PNG, GIF are allowed.", $errors)) { ?>
                                            <span style="color: red;">Invalid file type. Only JPG, PNG, GIF are allowed.</span>
                                        <?php } elseif (isset($errors) && in_array("File size should be less than 50MB.", $errors)) { ?>
                                            <span style="color: red;">File size should be less than 50MB.</span>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Add Trainer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include "footer.php";
?>
