<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

// Fetch the current record based on the ID
$result = mysqli_query($con, "SELECT `id`, `Name`, `Amount`, `Date` FROM `user_membership` WHERE id=$id");

list($id, $Name, $Amount, $Date) = mysqli_fetch_array($result);

// Check if the form has been submitted
if (isset($_POST['edit'])) {
    // Get the updated values from the form
    $Name = $_POST['Name'];
    $Amount = $_POST['Amount'];
    $Date = $_POST['Date'];

    // Update the record in the database
    mysqli_query($con, "UPDATE `user_membership` SET `Name`='$Name', `Amount`='$Amount', `Date`='$Date' WHERE id=$id") or die("Query 2 is incorrect..........");

    // Redirect to the membership page after updating
    header("location: user_membership.php");
    mysqli_close($con);
}

// Include side navigation and top header
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header card-header-primary">
                <h5 class="title">Edit User Membership</h5>
            </div>
            <form action="edituser_membership.php?id=<?php echo $id; ?>" name="form" method="post" enctype="multipart/form-data">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="Name" name="Name" class="form-control" value="<?php echo $Name; ?>">
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="number" id="Amount" name="Amount" class="form-control" value="<?php echo $Amount; ?>">
                        </div>
                    </div>
                   
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" id="Date" name="Date" class="form-control" value="<?php echo $Date; ?>">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" id="btn_save" name="edit" class="btn btn-fill btn-primary">Update</button>
                </div>
            </form>    
        </div>
    </div>
</div>

<?php
include "footer.php";
?>