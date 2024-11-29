<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

$result = mysqli_query($con, "SELECT `id`, `Name`, `Image`, `Contact`, `City`, `Address`, `Experience`, `bio`, `created_at` FROM `trainers` WHERE id='$id'") or die("query 1 incorrect.......");

list($id, $name, $img, $contact, $city, $address, $experience, $bio, $created_at) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $experience = $_POST['experience'];
    $bio = $_POST['bio'];

    // Picture upload handling
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Update image only if a new one is uploaded
    if ($picture_name) {
        if ($picture_type == "image/jpeg" || $picture_type == "image/jpg" || $picture_type == "image/png" || $picture_type == "image/gif") {
            if ($picture_size <= 50000000) {
                // Extracting the base name and extension
                $file_extension = pathinfo($picture_name, PATHINFO_EXTENSION);
                $base_name = pathinfo($picture_name, PATHINFO_FILENAME);
                
                // Create new filename using only the base name and extension
                $pic_name = $base_name . '.' . $file_extension;
                
                // Move uploaded file to the desired location
                move_uploaded_file($picture_tmp_name, "assets/img/" . $pic_name);
                
                // Update the record with the new image
                mysqli_query($con, "UPDATE `trainers` SET `Image`='$pic_name' WHERE id='$id'") or die("Query 2 is incorrect..........");
            }
        }
    }
    

    // Update other fields
    mysqli_query($con, "UPDATE `trainers` SET `Name`='$name', `Contact`='$contact', `City`='$city', `Address`='$address', `Experience`='$experience', `bio`='$bio' WHERE id='$id'") or die("Query 2 is incorrect..........");

    header("location: trainer.php");
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
                            <h5 class="title">Edit Trainer</h5>
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
                                        <label>Contact</label>
                                        <input type="text" id="contact" required name="contact" value="<?php echo $contact; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>City</label>
                                        <input type="text" id="city" required name="city" value="<?php echo $city; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" id="address" required name="address" value="<?php echo $address; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Experience</label>
                                        <input type="text" id="experience" required name="experience" value="<?php echo $experience; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Bio</label>
                                        <textarea rows="4" cols="80" id="bio" required name="bio" class="form-control"><?php echo $bio; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label>
                                        <br>
                                        <input type="file" id="picture" name="picture" class="btn btn-fill btn-success"><br>
                                        <br>
                                        <img src='assets/img/<?php echo $img; ?>' style='width:70px; height:70px; border:groove #000'>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update Trainer</button>
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
