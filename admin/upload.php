<?php
if (isset($_FILES['upload']['name'])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is an image
    if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
            $url = $target_file;
            echo json_encode([
                "url" => $url
            ]);
        } else {
            echo json_encode([
                "error" => [
                    "message" => "Failed to upload image."
                ]
            ]);
        }
    } else {
        echo json_encode([
            "error" => [
                "message" => "Invalid file format. Only JPG, JPEG, PNG, and GIF are allowed."
            ]
        ]);
    }
}
?>
