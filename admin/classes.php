<?php
session_start();
include("config.php");
error_reporting(0);

// Pagination and searching variables
$search_query = "";
$records_per_page = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Searching
if (isset($_GET['search'])) {
    $search_query = " AND (Name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
}

// Count total records
$total_records = mysqli_num_rows(mysqli_query($con, "SELECT id FROM classes WHERE 1" . $search_query));
$total_pages = ceil($total_records / $records_per_page);

// Delete record
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = $_GET['id'];

    // Fetching the image to delete
    $result = mysqli_query($con, "SELECT img FROM classes WHERE id='$id'") or die("Query is incorrect...");
    list($image) = mysqli_fetch_array($result);
    $path = "images/" . $image;

    if (file_exists($path)) {
        unlink($path);
    }

    // Delete query
    mysqli_query($con, "DELETE FROM classes WHERE id='$id'") or die("Query is incorrect...");
}

// Update status
if (isset($_GET['action']) && $_GET['action'] == 'toggle_status') {
    $id = $_GET['id'];
    $status = $_GET['status'] == 'Active' ? 'Inactive' : 'Active';

    // Update the status in the database
    mysqli_query($con, "UPDATE classes SET status='$status' WHERE id='$id'") or die("Query is incorrect...");
}

// Fetch records for pagination
$result = mysqli_query($con, "SELECT id, Name, description, img, created_at, status FROM classes WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="float-right">
                <a href="addclasses.php" class="btn btn-success">Add +</a>
                <a href="classes.php" class="btn btn-primary">Back</a>
                <br><br><br>
            </div>
            <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Classes List</h4>
                <form action="" method="get" class="form-inline float-right">
                    <div class="input-group">
                        <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control search-input" placeholder="Search...">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <?php if (isset($_GET['search'])) { ?>
                            <a href="classes.php" class="btn btn-default">Clear Search</a>
                        <?php } ?>
                    </div>
                </form>
            </div>

                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter" id="page1">
                            <thead class="text-primary">
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Created At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                while (list($id, $name, $description, $img, $created_at, $status) = mysqli_fetch_array($result)) {
                                    echo "<tr>
                                            <td>$id</td>
                                            <td>$name</td>
                                            <td>$description</td>
                                            <td><img src='http://localhost/fox/fox/images/$img' style='width:50px; height:50px; border:groove #000'></td>
                                            <td>" . ($created_at ? $created_at : 'No Date') . "</td>
                                            <td>$status</td>
                                            <td>";

                                    // Add the toggle button for status (Active/Inactive)
                                    if ($status == "Active") {
                                        echo "<a class='btn btn-danger' href='classes.php?id=$id&status=$status&action=toggle_status'>Disable</a>";
                                    } else {
                                        echo "<a class='btn btn-success' href='classes.php?id=$id&status=$status&action=toggle_status'>Enable</a>";
                                    }

                                    // Add the Edit and Delete buttons
                                    echo "<a class='btn btn-success' href='editclasses.php?id=$id&action=edit'>Edit</a>
                                          <a class='btn btn-danger' href='classes.php?id=$id&action=delete'>Delete</a>";

                                    echo "</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination links -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page <= 1) echo '#'; else echo "classes.php?page=" . ($page - 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <li class="page-item <?php if ($page == $i) echo 'active'; ?>"><a class="page-link" href="classes.php?page=<?php echo $i; ?><?php if (isset($_GET['search'])) echo "&search=" . $_GET['search']; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="<?php if ($page >= $total_pages) echo '#'; else echo "classes.php?page=" . ($page + 1) . (isset($_GET['search']) ? "&search=" . $_GET['search'] : ''); ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav>

        </div>
    </div>
</div>

<?php
include "footer.php";
?>  

<style>
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

    .input-group {
        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .input-group .form-control {
        margin-right: 4px;
    }

    .input-group .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
    }

    .input-group .btn-primary {
        background-color: #337ab7;
        border-color: #337ab7;
        color: #fff;
    }

    .input-group .btn-default {
        background-color: #fff;
        border-color: #ccc;
        color: #666;
    }
</style>