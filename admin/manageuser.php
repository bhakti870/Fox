<?php
session_start();
include("config.php");

// Deleting record if action is delete
if (isset($_GET['action']) && $_GET['action'] != "" && $_GET['action'] == 'delete') {
    $id = intval($_GET['id']); // Sanitize the input to ensure it's an integer
    mysqli_query($con, "DELETE FROM `attendance` WHERE id='$id'") or die("query is incorrect...");
}

// Fetch user_id of the selected record and all records for that user_id if action is show
$show_user_id = null;
$records = [];
if (isset($_GET['action']) && $_GET['action'] == 'show' && isset($_GET['id'])) {
    $show_id = intval($_GET['id']); // Get the selected record ID
    // Fetch the user_id of the selected record
    $user_query = mysqli_query($con, "SELECT `user_id` FROM `attendance` WHERE `id`='$show_id'");
    if ($user_row = mysqli_fetch_assoc($user_query)) {
        $show_user_id = $user_row['user_id'];
        // Fetch all records for that user_id
        $result = mysqli_query($con, "SELECT `id`, `name`, `date`, `check_in_time`, `check_out_time`, `status` FROM `attendance` WHERE `user_id`='$show_user_id'");
        while ($row = mysqli_fetch_assoc($result)) {
            $records[] = $row;
        }
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
                <a href="addattendance.php" class="btn btn-success">Add +</a>
                <a href="manageuser.php" class="btn btn-primary">Back</a><br><br><br>
            </div>

            <div class="card">
                <div class="card-header card-header-primary">
                    <h2 class="card-title">Users</h2>
                    <div class="float-right">
                        <form action="" method="get" class="form-inline">
                            <div class="form-group">
                                <input type="text" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>" class="form-control search-input" placeholder="Search...">
                                <br><br>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive ps">
                        <table class="table tablesorter table-hover" id="">
                            <thead class="text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Check_in_Time</th>
                                    <th>Check_Out_Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $search_query = "";
                                if (isset($_GET['search'])) {
                                    $search_query = " AND (name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%' OR email LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
                                }

                                $total_records = mysqli_num_rows(mysqli_query($con, "SELECT `id` FROM `attendance` WHERE 1" . $search_query));
                                $records_per_page = 5;
                                $total_pages = ceil($total_records / $records_per_page);

                                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                $offset = ($page - 1) * $records_per_page;

                                $result = mysqli_query($con, "SELECT `id`, `name`, `date`, `check_in_time`, `check_out_time`, `status` FROM `attendance` WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

                                while (list($id, $name, $date, $check_in_time, $check_out_time, $status) = mysqli_fetch_array($result)) {
                                    echo "<tr>
                                            <td>$id</td>
                                            <td>$name</td>
                                            <td>$date</td>
                                            <td>$check_in_time</td>
                                            <td>$check_out_time</td>
                                            <td>$status</td>";
                                    echo "<td>
                                            <a class='btn btn-primary' href='manageuser.php?id=$id&action=show'>Show</a> 
                                            <a class='btn btn-success' href='edituser.php?id=$id&action=edit'>Edit</a> 
                                            <a class='btn btn-danger' href='manageuser.php?id=$id&action=delete' onclick='return confirm(\"Are you sure you want to delete this attendance record?\");'>Delete</a>
                                          </td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>

                        <!-- Pagination links -->
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<a href='manageuser.php?page=$i" . (isset($_GET['search']) ? "&search=" . urlencode($_GET['search']) : "") . "'>$i</a> ";
                            } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- Show Records Section -->
        <?php if ($show_user_id): ?>
        <div class="card mt-4">
            <div class="card-header card-header-info">
                <h3 class="card-title">Attendance Records for User ID: <?php echo $show_user_id; ?></h3>
            </div>
            <div class="card-body">
                <table class="table tablesorter table-hover">
                    <thead class="text-primary">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Check_in_Time</th>
                            <th>Check_Out_Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['name']; ?></td>
                            <td><?php echo $record['date']; ?></td>
                            <td><?php echo $record['check_in_time']; ?></td>
                            <td><?php echo $record['check_out_time']; ?></td>
                            <td><?php echo $record['status']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
    .pagination {
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
