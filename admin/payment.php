<?php
include "sidenav.php";
include "topheader.php";
?>


<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Add Feedback</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter table-hover" id="">
              <thead class=" text-primary">
                <tr>
                  <th>id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Number</th>
                  <th>Message</th>
                  <th>Rating</th>
                  <th><a href="addfeedback.php" class="btn btn-success">Add New</a></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>bhakti</td>
                  <td>bhakti123@gmail.com</td>
                  <td>1234567890</td>
                  <td>helloo i am bhakti</td>
                  <td>5</td>
               
                  <td>
                    <a class="btn btn-success" href="editfeedback.php?id=1&action=edit">Edit</a>
                    <a class="btn btn-success" href="manageuser.php?id=1&action=delete">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>nirali</td>
                  <td>nirali123@gmail.com</td>
                  <td>1234567890</td>
                  <td>hello i am nirali</td>
                  <td>4</td>
                <td>
                    <a class="btn btn-success" href="editfeedback.php?id=2&action=edit">Edit</a>
                    <a class="btn btn-success" href="manageuser.php?id=2&action=delete">Delete</a>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>siya</td>
                  <td>siya@gmail.com</td>
                  <td>1234567890</td>
                  <td>hello i am siya</td>
                  <td>5</td>
                 <td>
                    <a class="btn btn-success" href="editfeedback.php?id=3&action=edit">Edit</a>
                    <a class="btn btn-success" href="manageuser.php?id=3&action=delete">Delete</a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>





<?php
include "footer.php";
?>