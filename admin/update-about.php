<?php
// upload.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Directory where images will be uploaded
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check file size
    if ($_FILES["upload"]["size"] > 500000) { // Limit file size to 500KB
        echo json_encode(['error' => 'File is too large.']);
        exit;
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        echo json_encode(['error' => 'Only JPG, JPEG, PNG & GIF files are allowed.']);
        exit;
    }

    // Attempt to move the uploaded file to the target directory
    if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
        // Success response with the URL of the uploaded image
        echo json_encode(['url' => $target_file]);
    } else {
        echo json_encode(['error' => 'Error uploading file.']);
    }
}
