<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

if(isset($_POST['btn_save'])) {
    // $Name = $_POST['Name'];
    // $Email = $_POST['Email'];
    // $Message = $_POST['Message'];
    $Reply = $_POST['Reply'];
    
    $stmt = $con->prepare("INSERT INTO `replies`(`Reply`) VALUES (?)");
    $stmt->bind_param("s", $Reply);

    $stmt->execute();

    @header("location:classes.php"); 
    mysqli_close($con);
}
?>


      <!-- End Navbar -->
    <!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Reply to Message</h4>
            <p class="card-category">Complete Reply</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
             

                </div>
               <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Reply</label>
                    <textarea name="Reply" id="Reply" class="form-control" required></textarea>
                  </div>
                </div>
              
             

               

</div>

</div>
                </div>
                
              </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" name="Email" id="Email" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Message</label>
                    <textarea name="Message" id="Message" class="form-control" required></textarea>
                  </div>
                </div>
              </div> -->
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Reply</label>
                    <textarea name="Reply" id="Reply" class="form-control" required></textarea>
                  </div>
                </div> -->
              </div>
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Reply</button>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



<?php
include "footer.php";
?>