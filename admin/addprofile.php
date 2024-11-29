<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

$errors = array(); // Initialize errors array

if (isset($_POST['btn_save'])) {
    // Check if the keys exist before accessing them
    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $weight = isset($_POST['weight']) ? $_POST['weight'] : '';

    // Validation checks
    if (empty($id)) {
        $errors[] = "ID is required";
    } elseif (!is_numeric($id)) {
        $errors[] = "ID must be a number";
    }

    if (empty($image)) {
        $errors[] = "Image is required";
    } elseif (!in_array(strtolower(pathinfo($image, PATHINFO_EXTENSION)), array('jpg', 'jpeg', 'png', 'gif'))) {
        $errors[] = "Invalid image format";
    }

    if (empty($name)) {
        $errors[] = "Name is required";
    } elseif (strlen($name) < 3) {
        $errors[] = "Name must have at least 3 characters";
    } elseif (strlen($name) > 50) {
        $errors[] = "Name cannot contain more than 50 characters";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email address";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must have at least 8 characters";
    }

    if (empty($phone_number)) {
        $errors[] = "Phone Number is required";
    } elseif (!is_numeric($phone_number)) {
        $errors[] = "Phone Number must be a number";
    }

    if (empty($gender)) {
        $errors[] = "Gender is required";
    }

    if (empty($weight)) {
        $errors[] = "Weight is required";
    } elseif (!is_numeric($weight)) {
        $errors[] = "Weight must be a number";
    }

    // If no errors, proceed with database insertion
    if (count($errors) == 0) {
        $stmt = $con->prepare("INSERT INTO `registration`(`iD`, `image`, `name`, `email`, `password`, `number`, `gender`, `weight`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $id, $image, $name, $email, $password, $phone_number, $gender, $weight);

        if ($stmt->execute()) {
            @header("location:profile.php"); 
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        mysqli_close($con);
    }
}
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <!-- your content here -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Profile</h4>
                    <p class="card-category">Complete profile</p>
                </div>
                <div class="card-body">
                    <form action="" method="post" name="form" enctype="multipart/form-data">
                        <div class="row">
                            <!-- your content here -->
                        </div>
                    
                        <div class="row">
                            
                            </div>
                            <!-- your content here -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    <?php if (isset($errors) && in_array("Name is required", $errors)) { ?>
                                        <span style="color: red;">Name is required</span>
                                    <?php } elseif (isset($errors) && in_array("Name must have at least 3 characters", $errors)) { ?>
                                        <span style="color: red;">Name must have at least 3 characters</span>
                                    <?php } elseif (isset($errors) && in_array("Name cannot contain more than 50 characters", $errors)) { ?>
                                        <span style="color: red;">Name cannot contain more than 50 characters</span>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-md-12">
                  <!-- <div class="">
                    <label for="">Add Image</label>
                    <input type="file" name="picture" class="btn btn-fill btn-success" id ="picture" >
                    <?php if (isset($errors) && in_array("Picture is required", $errors)) { ?>
                        <span style="color: red;">Picture is required</span>
                    <?php } elseif (isset($errors) && in_array("Invalid picture type. Only JPEG, JPG, PNG, and GIF are allowed.", $errors)) { ?>
                        <span style="color: red;">Invalid picture type. Only JPEG, JPG, PNG, and GIF are allowed.</span>
                    <?php } elseif (isset($errors) && in_array("Picture size is too large. Maximum size is 50MB.", $errors)) { ?>
                        <span style="color: red;">Picture size is too large. Maximum size is 50MB.</span>
                    <?php } ?>
                  </div> -->
                <!-- </div> -->

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" id="email" class="form-control">
                                    <?php if (isset($errors) && in_array("Email is required", $errors)) { ?>
                                        <span style="color: red;">Email is required</span>
                                    <?php } elseif (isset($errors) && in_array("Invalid email address", $errors)) { ?>
                                        <span style="color: red;">Invalid email address</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- your content here -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <?php if (isset($errors) && in_array("Password is required", $errors)) { ?>
                                        <span style="color: red;">Password is required</span>
                                    <?php } elseif (isset($errors) && in_array("Password must have at least 8 characters", $errors)) { ?>
                                        <span style="color: red;">Password must have at least 8 characters</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input type="number" id="phone_number" name="phone_number" class="form-control">
                                    <?php if (isset($errors) && in_array("Phone Number is required", $errors)) { ?>
                                        <span style="color: red;">Phone Number is required</span>
                                    <?php } elseif (isset($errors) && in_array("Phone Number must be a number", $errors)) { ?>
                                        <span style="color: red;">Phone Number must be a number</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- your content here -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <?php if (isset($errors) && in_array("Gender is required", $errors)) { ?>
                                        <span style="color: red;">Gender is required</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Weight</label>
                                    <input type="number" id="weight" name="weight" class="form-control">
                                    <?php if (isset($errors) && in_array("Weight is required", $errors)) { ?>
                                        <span style="color: red;">Weight is required</span>
                                    <?php } elseif (isset($errors) && in_array("Weight must be a number", $errors)) { ?>
                                        <span style="color: red;">Weight must be a number</span>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- your content here -->
                        </div>
                        <!-- your content here -->
                        <button type="submit" name="btn_save" id=" btn_save" class="btn btn-primary pull-right">Update User</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>