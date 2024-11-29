<?php
session_start();
include("config.php");
$id=$_REQUEST['id'];

$result=mysqli_query($con,"SELECT `id`, `Name`, `Email`, `Number`, `Message`, `Rating` FROM `feedback` WHERE id=$id");

list($id,$Name,$Email,$Number,$Message,$Rating)=mysqli_fetch_array($result);

if(isset($_POST['edit'])) 
{
  $Name=$_POST['Name'];
  $Email=$_POST['Email'];
  $Number=$_POST['Number'];
  $Message=$_POST['Message'];
  $Rating=$_POST['Rating'];

  mysqli_query($con,"UPDATE `feedback` SET `Name`='$Name',`Email`='$Email',`Number`='$Number',`Message`='$Message',`Rating`='$Rating' WHERE id=$id")or die("Query 2 is incorrect..........");

  header("location: feedback.php");
  mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="card">
            <div class="card-header card-header-primary">
              <h5 class="title">Edit Feedback</h5>
            </div>
            <form action="editfeedback.php" name="form" method="post">
            <div class="card-body">
              <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" id="Name" name="Name"  class="form-control" value="<?php echo $Name; ?>" >
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" id="Email" name="Email" class="form-control" value="<?php echo $Email; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Number</label>
                  <input type="number" id="Number" name="Number" class="form-control" value="<?php echo $Number; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Message</label>
                  <textarea name="Message" id="Message" class="form-control" ><?php echo $Message; ?></textarea>
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Rating</label>
                  <input type="number" id="Rating" name="Rating" class="form-control" value="<?php echo $Rating; ?>">
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