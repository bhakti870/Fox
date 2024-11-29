<?php
session_start();
include("config.php");
$id=$_REQUEST['id'];

$result=mysqli_query($con,"SELECT `id`, `Name`, `Weight`, `Goal`, `Skill`, `Duration`, `Days` FROM `admin_plan` WHERE id=$id");

list($id,$Name,$Weight,$Goal,$Skill,$Duration,$Days)=mysqli_fetch_array($result);

if(isset($_POST['edit'])) 
{
  $Name=$_POST['Name'];
  $Weight=$_POST['Weight'];
  $Goal=$_POST['Goal'];
  $Skill=$_POST['Skill'];
  $Duration=$_POST['Duration'];
  $Days=$_POST['Days'];

  mysqli_query($con,"UPDATE `admin_plan` SET `Name`='$Name',`Weight`='$Weight',`Goal`='$Goal',`Skill`='$Skill',`Duration`='$Duration',`Days`='$Days' WHERE id=$id")or die("Query 2 is incorrect..........");

  header("location: plan.php");
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
              <h5 class="title">Edit Admin Plan</h5>
            </div>
            <form action="editplan.php" name="form" method="post" enctype="multipart/form-data">
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
                  <label>Weight</label>
                  <input type="number" id="Weight" name="Weight" class="form-control" value="<?php echo $Weight; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Goal</label>
                  <input type="text" id="Goal" name="Goal" class="form-control" value="<?php echo $Goal; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Skill</label>
                  <input type="text" id="Skill" name="Skill" class="form-control" value="<?php echo $Skill; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Duration</label>
                  <input type="number" id="Duration" name="Duration" class="form-control" value="<?php echo $Duration; ?>">
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group">
                  <label>Days</label>
                  <input type="number" id="Days" name="Days" class="form-control" value="<?php echo $Days; ?>">
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