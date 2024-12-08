<?php
session_start();
include("config.php");
error_reporting(0);

// Pagination and searching variables
$search_query = "";
$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;



// Count total records
$total_records = mysqli_num_rows(mysqli_query($con, "SELECT id FROM trainers WHERE 1" . $search_query));
$total_pages = ceil($total_records / $records_per_page);

// Delete record
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // Fetching the picture to delete
    $result = mysqli_query($con, "SELECT Image FROM trainers WHERE id='$id'") or die("query is incorrect...");
    list($image) = mysqli_fetch_array($result);
    $path = "assets/img/" . $image;

    if (file_exists($path)) {
        unlink($path);
    }

    // Delete query
    mysqli_query($con, "DELETE FROM trainers WHERE id='$id'") or die("query is incorrect...");
}

// Update status
if (isset($_GET['action']) && $_GET['action'] == 'toggle_status') {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'Active' ? 'Inactive' : 'Active';

    // Update the status in the database
    mysqli_query($con, "UPDATE trainers SET status='$status' WHERE id='$id'") or die("Query is incorrect...");
}


// Fetch records for pagination

$result = mysqli_query($con, "SELECT id, Name, Image, Contact, City, Address, Experience, bio, created_at, status FROM trainers WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");


include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
 <br><br>
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
           <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">About Us Page</h4>
                <form action="" method="get" class="form-inline float-right">s
                </form>
            </div>

                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter" id="page1">
                        <div class="container">
                            <div class="row text-center">
                                <div class="col-12  text-white p-2 align-center"><br><br>
                                    <h1>About Page Details</h1>
                                </div>
                            </div>
                             <br>
                            <div class="row">
                                <?php
                                // Start Generation Here
                                $query = "SELECT * FROM about_us";
                                $result = mysqli_query($con, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<p>" . $row['content'] . "</p>";
                                        if (!empty($row['image_path'])) {
                                            echo "<img src='" . $row['image_path'] . "' alt='About Image' style='max-width: 100%; height: auto; margin-top: 10px;'>";
                                        }
                                    }
                                } else {
                                    echo "<p>No content available.</p>";
                                }
                                ?>
                            </div>
                            </div>

                <div class="container">
                    <div class="row text-center">
                        <div class="col-12 text-white p-2 align-center">
                            <h1>Change Content</h1>
                        </div>
                    </div>
                     <br>
                  <div class="row">
                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8" />
                        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                        <title>CKEditor 5 with Image Upload</title>
                        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/decoupled-document/ckeditor.js"></script>
                        <style>
                            #editor-content {
                                width: 100%;
                                height: 200px;
                            }
                        </style>
                    </head>

                    <body>
                        <form action="admin_manage_about.php" method="post" enctype="multipart/form-data">
                            <!-- Toolbar container -->
                            <div id="toolbar-container"></div>

                            <!-- Editor container -->
                            <div id="editor">
                                <?php
                                $query = "SELECT * FROM about_us";
                                $result = mysqli_query($con, $query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo $row['content'];
                                    }
                                } else {
                                    echo "<p>No content available.</p>";
                                }
                                ?>
                            </div>

                            <!-- Hidden textarea to store the HTML content -->
                            <textarea id="editor-content" name="editor_content" style="display:none"></textarea>
                            <br>
                            
                            <!-- Image Upload Input -->
                            <label for="about_image">Upload Image:</label>
                            <input type="file" name="about_image" accept="image/*">
                            <br><br>
                            
                            <input type="submit" value="Update Content" class="btn btn-dark" name="updt_about">
                            <script>
                                DecoupledEditor.create(document.querySelector("#editor"), {
                                    toolbar: [
                                        "heading", "bold", "italic", "link", "bulletedList", "numberedList",
                                        "blockQuote", "fontColor", "fontBackgroundColor",
                                        "undo", "redo"
                                    ],
                                    simpleUpload: {
                                        uploadUrl: 'upload.php',
                                        headers: {
                                            'X-CSRF-TOKEN': 'CSRF-Token',
                                        }
                                    }
                                })
                                .then((editor) => {
                                    const toolbarContainer = document.querySelector("#toolbar-container");
                                    toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                                    document.querySelector("#editor-content").value = editor.getData();

                                    editor.model.document.on("change:data", () => {
                                        document.querySelector("#editor-content").value = editor.getData();
                                    });
                                })
                                .catch((error) => {
                                    console.error(error);
                                });
                            </script>
                        </form>
                    </body>
                    </html>
                </div>
</div>




                          

                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination links -->
        
            <!-- <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page <= 1) echo '#'; else echo "trainer.php?page=" . ($page - 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="trainer.php?page=<?php echo $i; ?><?php if (isset($_GET['search'])) echo "&search=" . $_GET['search']; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page >= $total_pages) echo '#'; else echo "trainer.php?page=" . ($page + 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> -->

        </div>
    </div>
</div>


<?php
    if (isset($_POST['updt_about'])) 
    {
        // Escape the content to prevent SQL injection
        $about_content = mysqli_real_escape_string($con, $_POST['editor_content']);
        
        // Image upload handling
        $image_path = '';
        if (isset($_FILES['about_image']) && $_FILES['about_image']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["about_image"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if the file is an image
            if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                if (move_uploaded_file($_FILES["about_image"]["tmp_name"], $target_file)) {
                    $image_path = $target_file;
                }
            }
        }

        $q1 = "SELECT * FROM about_us";
        $res1 = mysqli_query($con, $q1);
        $count = mysqli_num_rows($res1);

        if ($count == 0) {
            // Insert new content if it doesn't exist
            $q2 = "INSERT INTO about_us (content, image_path) VALUES ('$about_content', '$image_path')";
            if (mysqli_query($con, $q2)) {
                setcookie("success", 'Page Content Updated', time() + 5, "/");
            } else {
                setcookie("error", 'Failed to update page content', time() + 5, "/");
            }
        } else {
            // Prepare the update query
            $q = "UPDATE about_us SET content='$about_content'";
            if ($image_path) {
                $q .= ", image_path='$image_path'";
            }
            $q .= " WHERE id = 1"; // Assuming there's only one row, adjust as necessary
            
            // Execute the update query
            if (mysqli_query($con, $q)) {
                setcookie("success", 'Page Content Updated', time() + 5, "/");
            } else {
                setcookie("error", 'Failed to update page content', time() + 5, "/");
            }
        }
    ?>
    <script>
        window.location.href = "admin_manage_about.php";
    </script>
<?php
}

include "footer.php";
?>  

<style>
        .search-input {
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        width: 300px;
    }

    .search-input::placeholder {
        color: #666;
        font-size: 16px;
    }

    .input-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .input-group .form-control {
        margin-right: 4px;
    }

    .input-group .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .input-group .btn-primary {
        background-color: #337ab7;
        border-color: #337ab7;
        color: #fff;
    }

    .input-group .btn-default {
        background-color: #fff;
        border-color: #ccc;
        color: #666;
    }

</style> 