<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

// Fetching the existing record for the given id
$result = mysqli_query($con, "SELECT `id`, `name`, `email`, `password`, `number`, `weight`, `gender`, `image`, `classes`, `created_at` FROM `registration` WHERE id='$id'") or die("query is incorrect.......");

list($id, $name, $email, $password, $number, $weight, $gender, $image, $classes, $created_at) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $number = $_POST['number'];
    $weight = $_POST['weight'];
    $gender = $_POST['gender'];
    $classes = $_POST['classes'];
    $created_at = $_POST['created_at'];

   // Picture upload handling
$picture_name = $_FILES['picture']['name'];
$picture_type = $_FILES['picture']['type'];
$picture_tmp_name = $_FILES['picture']['tmp_name'];
$picture_size = $_FILES['picture']['size'];

// Update image only if a new one is uploaded
if ($picture_name) {
    if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
        if ($picture_size <= 50000000) {
            // Save the image with the original name (no time prefix)
            $pic_name = basename($picture_name);
            move_uploaded_file($picture_tmp_name, "assets/img/" . $pic_name);
            
            // Update the image in the database
            mysqli_query($con, "UPDATE `registration` SET `image`='$pic_name' WHERE id='$id'") or die("Query to update image is incorrect.");
        }
    }
}


    // Update other fields
    mysqli_query($con, "UPDATE `registration` SET 
        `name`='$name', 
        `email`='$email', 
        `password`='$password', 
        `number`='$number', 
        `weight`='$weight', 
        `gender`='$gender', 
        `classes`='$classes', 
        `created_at`='$created_at' 
        WHERE id='$id'") or die("Query to update other fields is incorrect.");

    header("location: profile.php"); // Redirect after updating
    mysqli_close($con);
}

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Edit Registration</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" required name="name" value="<?php echo $name; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" required name="email" value="<?php echo $email; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="password" required name="password" value="<?php echo $password; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" id="number" required name="number" value="<?php echo $number; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Weight</label>
                                        <input type="text" id="weight" required name="weight" value="<?php echo $weight; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" id="gender" class="form-control">
                                            <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                                            <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Classes</label>
                                        <input type="text" id="classes"  name="classes" value="<?php echo $classes; ?>" class="form-control">
                                    </div>
                                </div>
                             
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Profile Image</label>
                                        <br>
                                        <input type="file" id="picture" name="picture" class="btn btn-fill btn-success"><br>
                                        <br>
                                        <img src='images/<?php echo $image; ?>' style='width:70px; height:70px; border:groove #000'>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update Registration</button>
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
