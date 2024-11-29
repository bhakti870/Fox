<?php
include('config.php');
include "sidenav.php";
?>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
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
        <div class="col-12 bg-dark text-white p-2 align-center">
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

<?php
if (isset($_POST['updt_about'])) {
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
?>
