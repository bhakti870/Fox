<?php
session_start();
include("config.php");
$id=$_REQUEST['id'];

$result=mysqli_query($con,"SELECT `ID`, `Name`, `Email`, `Message`FROM `contacts` WHERE ID=$id");

list($id,$Name,$Email,$Message,$Address)=mysqli_fetch_array($result);

if(isset($_POST['edit'])) 
{


$Name=$_POST['Name'];

$Email=$_POST['Email'];
$Message=$_POST['Message'];
$Address=$_POST['Address'];


mysqli_query($con,"UPDATE `contacts` SET `Name`='$Name',`Email`='$Email',`Message`='$Message' WHERE ID=$id")or die("Query 2 is incorrect..........");

header("location: contactlist.php");
mysqli_close($con);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        <!-- <div class="col-md-5 mx-auto"> -->
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit Contact</h5>
              </div>
              <form action="editcontact.php" name="form" method="post" enctype="multipart/form-data">
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
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email"  id="Email" name="Email" class="form-control" value="<?php echo $Email; ?>">
                      </div>
                    </div>
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label >Message</label>
                        <textarea name="Message" id="Message" class="form-control" ><?php echo $Message; ?></textarea>
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
      </div>
      <?php
include "footer.php";
?>