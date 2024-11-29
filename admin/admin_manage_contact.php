<?php
include('config.php');
include "sidenav.php";
?>

<div class="container">
    <div class="row text-center">
        <div class="col-12 bg-dark text-white p-2 align-center">
            <h1>Contact Page Details</h1>
        </div>
    </div>
    <br>
    <div class="row">
        <?php
        // Start Generation Here
        $query = "SELECT * FROM contact_us";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<p>" . $row['content'] . "</p>"; 
                echo "<br>"; 
                echo "<p><strong>Phone:</strong> " . $row['phone'] . "</p>";
                echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
                echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
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
            <form action="admin_manage_contact.php" method="post" enctype="multipart/form-data">
                <!-- Toolbar container -->
                <div id="toolbar-container"></div>

                <!-- Editor container -->
                <div id="editor">
                    <?php
                    $query = "SELECT * FROM contact_us";
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

                <!-- New fields for phone, address, and email -->
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo isset($row['phone']) ? $row['phone'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo isset($row['address']) ? $row['address'] : ''; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo isset($row['email']) ? $row['email'] : ''; ?>" required>
                </div>

                <input type="submit" value="Update Content" class="btn btn-dark" name="updt_contact">
                <script>
                    DecoupledEditor.create(document.querySelector("#editor"), {
                        toolbar: [
                            "heading", "bold", "italic", "link", "bulletedList", "numberedList",
                            "blockQuote", "fontColor", "fontBackgroundColor",
                            "undo", "redo"
                        ]
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
if (isset($_POST['updt_contact'])) {
    // Escape the content to prevent SQL injection
    $contact_content = mysqli_real_escape_string($con, $_POST['editor_content']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $q1 = "SELECT * FROM contact_us";
    $res1 = mysqli_query($con, $q1);
    $count = mysqli_num_rows($res1);

    if ($count == 0) {
        // Insert new content if it doesn't exist
        $q2 = "INSERT INTO contact_us (content, phone, address, email) VALUES ('$contact_content', '$phone', '$address', '$email')";
        if (mysqli_query($con, $q2)) {
            setcookie("success", 'Page Content Updated', time() + 5, "/");
        } else {
            setcookie("error", 'Failed to update page content', time() + 5, "/");
        }
    } else {
        // Prepare the update query
        $q = "UPDATE contact_us SET content='$contact_content', phone='$phone', address='$address', email='$email' WHERE id = 1"; // Adjust as necessary
        
        // Execute the update query
        if (mysqli_query($con, $q)) {
            setcookie("success", 'Page Content Updated', time() + 5, "/");
        } else {
            setcookie("error", 'Failed to update page content', time() + 5, "/");
        }
    }
?>
    <script>
        window.location.href = "admin_manage_contact.php";
    </script>
<?php
}
?>