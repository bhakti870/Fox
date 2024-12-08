<?php
session_start();
include("config.php");

if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // This is the delete query
    $stmt = $con->prepare("DELETE FROM `workout` WHERE id=?");
    
    $stmt->bind_param("i", $id);

    if($stmt->execute()) {
        echo "<script>alert('Record deleted successfully');</script>";
        header("Location: user_plan.php");
        exit;
    } else {
        echo "<script>alert('Error deleting record: " . $stmt->error . "');</script>";
    }
}

include "sidenav.php";
include "topheader.php";
?>


<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">
    <div class="col-md-14">
      <div class="float-right">
                <a href="adduser_plan.php" class="btn btn-success">Add +</a>
                <a href="user_membership.php" class="btn btn-primary">Back</a>
                <br><br><br>
            </div>
      <div class="card ">
        <div class="card-header card-header-primary">
          <h2 class="card-title">Workout List</h2>
          <div class="float-right">
            <form action="" method="get" class="form-inline">
              <div class="form-group">
                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control search-input" placeholder="Search...">
                <button type="submit" class="btn btn-primary">Search</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter table-hover" id="">
              <thead class=" text-primary">
                <tr>
                  <th>id</th>
                  <th>Exercise</th>
                  <th>Equipment</th>
                  <th>Reps</th>
                
                </tr>
              </thead>

              <tbody>
    <?php 

        $search_query = "";
        if (isset($_GET['search'])) {
            $search_query = " AND (Name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
        }

        $total_records = mysqli_num_rows(mysqli_query($con, "SELECT `id` FROM `workout` WHERE 1" . $search_query));
        $records_per_page = 5;
        $total_pages = ceil($total_records / $records_per_page);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $records_per_page;

        $result=mysqli_query($con,"SELECT `id`, `Exercise`, `Equipment`, `Reps` FROM `workout` WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

        while(list($id,$Excercise,$Equipment,$Reps)=
        mysqli_fetch_array($result))
        {

        echo 
        "<tr><td>$id</td>
        <td>$Excercise</td>
        <td>$Equipment</td>
        <td>$Reps</td>
        
       
       ";

        echo"<td>
        <a class=' btn btn-success' href='edituser_plan.php?id=$id&action=edit'>Edit</a>
        <a class=' btn btn-danger' href='user_plan.php?id=$id&action=delete'>Delete</a>
        </td></tr>";
        }
        mysqli_close($con);
        ?>
</tbody>

            </table>
                 <!-- Pagination links -->
                 <div class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<a href='user_plan.php?page=$i" . (isset($_GET['search']) ? "&search=" . $_GET['search'] : "") . "'>$i</a> ";
                            } ?>
                        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
  .pagination 
  {
      margin: 20px 0;
      text-align: center;
    }

    .pagination a {
        color: #337ab7;
        text-decoration: none;
        border: 1px solid #ddd;
        padding: 5px 10px;
        border-radius: 5px;
        margin: 0 5px;
    }

    .pagination a:hover {
        background-color: #337ab7;
        color: #fff;
    }

    .search-input {
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
      width: 300px;
    }

    .search-input::placeholder {
      color: #666;
      font-size: 16px;
    }

    .add-new-user-btn {
      position: absolute;
      top: 100px;
      right: 50px;
  }

</style>

<?php
include "footer.php";
?>