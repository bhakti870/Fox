<?php
session_start();
include("config.php");
include "sidenav.php";
include "topheader.php";

?>


      <!-- End Navbar -->
    <!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <!-- your content here -->
    <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Add Feedback</h4>
            <p class="card-category">Complete Feedbacl profile</p>
          </div>
          <div class="card-body">
            <form action="" method="post" name="form" enctype="multipart/form-data">
              <div class="row">
                
             

                </div>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Name</label>
                    <input type="name" name="name" id="name" class="form-control" required>
                  </div>
                </div>
              
              </div>
               <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Number</label>
                    <input type="number" id="number" name="number" class="form-control" required>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Message</label>
                    <input type="message" name="message" id="message" class="form-control" required>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Rating</label>
                    <input type="rating" id="rating" name="rating" class="form-control" required>
                  </div>
                </div>
              </div>

              

             
            
                  </div>
                </div>
                
              </div>
              
              <button type="submit" name="btn_save" id="btn_save" class="btn btn-primary pull-right">Update feedback</button>
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