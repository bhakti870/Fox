<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

// Fetch the current data from the 'classes' table
$result = mysqli_query($con, "SELECT `id`, `Name`, `description`, `img`, `created_at` FROM `classes` WHERE id='$id'") or die("Query 1 incorrect.......");

list($id, $Name, $description, $img, $created_at) = mysqli_fetch_array($result);

if (isset($_POST['btn_save'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Picture upload handling
    $picture_name = $_FILES['picture']['name'];
    $picture_type = $_FILES['picture']['type'];
    $picture_tmp_name = $_FILES['picture']['tmp_name'];
    $picture_size = $_FILES['picture']['size'];

    // Validate Name and Description
    if (empty($name) || empty($description)) {
        $error = "Both Name and Description fields are required.";
    } else {
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
                    mysqli_query($con, "UPDATE `classes` SET `img`='$pic_name' WHERE id='$id'") or die("Query 2 is incorrect..........");
                }
            }
        }

        // Update other fields
        mysqli_query($con, "UPDATE `classes` SET `Name`='$name', `description`='$description' WHERE id='$id'") or die("Query 2 is incorrect..........");

        header("location: classes.php");
        mysqli_close($con);
    }
}

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h5 class="title">Edit Class</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name"  value="<?php echo $Name; ?>" class="form-control">
                                        <span id="nameError" style="color: red;"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea rows="4" cols="80" id="description" name="description"  class="form-control"><?php echo $description; ?></textarea>
                                        <span id="descriptionError" style="color: red;"></span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="">
                                        <label for="picture">Add Image</label>
                                        <br>
                                        <!-- File input -->
                                        <input type="file" id="picture" name="picture" class="btn btn-fill btn-success" accept="image/*" onchange="previewImage(event)">
                                        <br><br>
                                        
                                        <!-- Preview image -->
                                        <img id="imagePreview" src="assets/img/<?php echo $img; ?>" 
                                            style="width:70px; height:70px; border:groove #000" alt="Current Image">
                                        <span id="imageError" style="color: red;"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <?php if (isset($error)) { ?>
                                <div class="alert alert-danger">
                                    <?php echo $error; ?>
                                </div>
                            <?php } ?>

                            <div class="card-footer">
                                <button type="submit" id="btn_save" name="btn_save" class="btn btn-fill btn-primary">Update Class</button>
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

<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview'); // Get the preview image element
        const file = event.target.files[0]; // Get the selected file

        if (file) {
            const reader = new FileReader(); // Initialize FileReader
            reader.onload = function(e) {
                imagePreview.src = e.target.result; // Set the preview image source to the file content
            };
            reader.readAsDataURL(file); // Read the file content
        }
    }

    function validateForm() {
        let isValid = true;

        // Name validation
        let name = document.getElementById('name').value;
        if (name === "" || name.length < 3 || name.length > 50) {
            document.getElementById('nameError').innerText = "Name must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Description validation
        let description = document.getElementById('description').value;
        if (description === "") {
            document.getElementById('descriptionError').innerText = "Description is required.";
            isValid = false;
        } else {
            document.getElementById('descriptionError').innerText = "";
        }

        // Image validation (optional)
        let picture = document.getElementById('picture').files[0];
        if (picture) {
            let fileType = picture.type;
            let fileSize = picture.size;
            if (!["image/jpeg", "image/jpg", "image/png", "image/gif"].includes(fileType)) {
                document.getElementById('imageError').innerText = "Only image files (jpeg, jpg, png, gif) are allowed.";
                isValid = false;
            } else if (fileSize > 50000000) {
                document.getElementById('imageError').innerText = "File size must be less than 50MB.";
                isValid = false;
            } else {
                document.getElementById('imageError').innerText = "";
            }
        }

        return isValid;
    }
</script>
