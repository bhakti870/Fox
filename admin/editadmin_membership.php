<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

$result = mysqli_query($con, "SELECT `id`, `Name`, `Amount`, `Image`, `Description`, `Time_duration`, `Date` FROM `admin_membership` WHERE id='$id'") or die("query 1 incorrect.......");

list($id, $name, $amount, $img, $description, $time_duration, $date) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];
    $time_duration = $_POST['time_duration'];
    $date = $_POST['date'];

    // Picture upload handling
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Update image only if a new one is uploaded
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
            move_uploaded_file($picture_tmp_name, "images/" . $pic_name);
            
            // Update the record with the new image
            mysqli_query($con, "UPDATE `admin_membership` SET `Image`='$pic_name' WHERE id='$id'") or die("Query 2 is incorrect..........");
        }
    }
}

    // Update other fields
    mysqli_query($con, "UPDATE `admin_membership` SET `Name`='$name', `Amount`='$amount', `Description`='$description', `Time_duration`='$time_duration', `Date`='$date' WHERE id='$id'") or die("Query 2 is incorrect..........");

    header("location: admin_membership.php");
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
                            <h5 class="title">Edit Admin Membership</h5>
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
                                        <label>Amount</label>
                                        <input type="number" id="amount" required name="amount" value="<?php echo $amount; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" cols="80" id="description" required name="description" class="form-control"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Time Duration</label>
                                        <input type="text" id="time_duration" required name="time_duration" value="<?php echo $time_duration; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="">
                                        <label for="">Add Image</label>
                                        <br>
                                        <input type="file" id="picture" name="picture" class="btn btn-fill btn-success"><br>
                                        <br>
                                        <img src='http://localhost/fox/fox/images/<?php echo $img; ?>' style='width:70px; height:70px; border:groove #000'>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" id="date" required name="date" value="<?php echo $date; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update Membership</button>
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
