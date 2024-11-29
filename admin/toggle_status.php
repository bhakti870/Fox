<?php
include("config.php");
$id = $_GET['id'];
$status = $_GET['status'];

// Toggle the status based on the current value
$new_status = ($status == "Active") ? "Inactive" : "Active";

// Update the status in the database
$update_query = "UPDATE trainers SET status='$new_status' WHERE id=$id";

if (mysqli_query($con, $update_query)) {
    setcookie("success", "Status updated successfully", time() + 5, "/");
    header("Location: trainer.php");
    exit;
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>