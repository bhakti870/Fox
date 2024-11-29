<?php
session_start();
include("config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the ID of the plan
    $planId = $_POST['id'];

    // Check if exercises are selected
    if (isset($_POST['exercises'])) {
        $selectedExerciseIds = $_POST['exercises']; // Array of selected exercise IDs

        // Fetch the corresponding exercise names using the IDs
        $exerciseNames = [];
        foreach ($selectedExerciseIds as $exerciseId) {
            $query = $con->prepare("SELECT exercise FROM workout WHERE id = ?");
            $query->bind_param("i", $exerciseId);
            $query->execute();
            $result = $query->get_result();
            if ($row = $result->fetch_assoc()) {
                $exerciseNames[] = $row['exercise']; // Add the exercise name to the array
            }
            $query->close();
        }

        // Convert the array of names to a comma-separated string
        $exerciseNamesString = implode(", ", $exerciseNames);

        // Insert each selected exercise ID into the admin_plan_exercise table
        foreach ($selectedExerciseIds as $exerciseId) {
            $insertQuery = $con->prepare("INSERT INTO admin_plan_exercise (admin_plan_id, workout_id) VALUES (?, ?)");
            $insertQuery->bind_param("ii", $planId, $exerciseId);
            if (!$insertQuery->execute()) {
                echo "<script>alert('Error adding exercise: " . $con->error . "');</script>";
            }
            $insertQuery->close();
        }

        // Update the Exercise column in admin_plan table with the selected exercise IDs
        $exerciseIdsString = implode(", ", $selectedExerciseIds); // Convert to a comma-separated string
        $updateQuery = $con->prepare("UPDATE admin_plan SET Exercise = CONCAT(IFNULL(Exercise, ''), IF(Exercise IS NOT NULL, ', ', ''), ?) WHERE id = ?");
        $updateQuery->bind_param("si", $exerciseIdsString, $planId); // Use bind_param for parameters
        if (!$updateQuery->execute()) {
            echo "<script>alert('Error updating plan exercises: " . $con->error . "');</script>";
        }
        $updateQuery->close();

        echo "<script>alert('Exercises added successfully!');</script>";
        echo "<script>window.location.href='plan.php';</script>";
        exit;

    } else {
        echo "<script>alert('No exercises selected.');</script>";
    }
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // Delete the plan from admin_plan table
    $deleteQuery = $con->prepare("DELETE FROM admin_plan WHERE id = ?");
    $deleteQuery->bind_param("i", $deleteId);
    if ($deleteQuery->execute()) {
        echo "<script>alert('Plan deleted successfully!');</script>";
    } else {
        echo "<script>alert('Error deleting plan: " . $con->error . "');</script>";
    }
    $deleteQuery->close();
}

// Fetch exercises from the workout table
$exerciseOptions = "";
$exerciseQuery = "SELECT id, exercise FROM workout"; // Get the ID along with the exercise name
$exerciseResult = $con->query($exerciseQuery);

include "sidenav.php";
include "topheader.php";
?>

<!-- End Navbar -->
<div class="content">
    <div class="container-fluid">
        <div class="col-md-14">
            <div class="float-right">
                <a href="addplan.php" class="btn btn-success">Add +</a>
                <a href="admin_membership.php" class="btn btn-primary">Back</a>
                <br><br><br>
            </div>
            <div class="card">
                <div class="card-header card-header-primary">
                    <h2 class="card-title">Admin Plan</h2>
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
                        <table class="table tablesorter table-hover">
                            <thead class="text-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Weight</th>
                                    <th>Goal</th>
                                    <th>Skill</th>
                                    <th>Duration</th>
                                    <th>Days</th>
                                    <th>Exercise</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Fetch records from database
                                $search_query = "";
                                if (isset($_GET['search'])) {
                                    $search_query = " AND (Name LIKE '%" . mysqli_real_escape_string($con, $_GET['search']) . "%')";
                                }

                                $total_records = mysqli_num_rows(mysqli_query($con, "SELECT id FROM admin_plan WHERE 1" . $search_query));
                                $records_per_page = 5;
                                $total_pages = ceil($total_records / $records_per_page);

                                $page = isset($_GET['page']) ? $_GET['page'] : 1;
                                $offset = ($page - 1) * $records_per_page;

                                $result = mysqli_query($con, "SELECT ID, Name, Weight, Goal, Skill, Duration, Days, Exercise FROM admin_plan WHERE 1" . $search_query . " LIMIT $offset, $records_per_page");

                                while(list($id, $Name, $Weight, $Goal, $Skill, $Duration, $Days, $Exercise) = mysqli_fetch_array($result)) {
                                    // Convert exercise IDs to names
                                    $exerciseNames = [];
                                    $exerciseIds = !empty($Exercise) ? explode(", ", $Exercise) : [];
                                    
                                    foreach ($exerciseIds as $exerciseId) {
                                        $exerciseNameQuery = $con->prepare("SELECT exercise FROM workout WHERE id = ?");
                                        $exerciseNameQuery->bind_param("i", $exerciseId);
                                        $exerciseNameQuery->execute();
                                        $exerciseNameResult = $exerciseNameQuery->get_result();
                                        
                                        if ($exerciseNameResult->num_rows > 0) {
                                            $exerciseRow = $exerciseNameResult->fetch_assoc();
                                            $exerciseNames[] = $exerciseRow['exercise'];
                                        }
                                    }
                                    
                                    // Join the exercise names into a comma-separated string
                                    $exerciseNamesString = implode(", ", $exerciseNames);
                                    
                                    echo "<tr>
                                        <td>$id</td>
                                        <td>$Name</td>
                                        <td>$Weight</td>
                                        <td>$Goal</td>
                                        <td>$Skill</td>
                                        <td>$Duration</td>
                                        <td>$Days</td>
                                        <td>$exerciseNamesString</td> <!-- Display Exercise Names -->
                                        <td>
                                            <a class='btn btn-success' href='editplan.php?id=$id&action=edit'>Edit</a>
                                            <a class='btn btn-danger' href='plan.php?id=$id&action=delete'>Delete</a>
                                            <a class='btn btn-success' href='#' onclick='showDropdown($id)'>Add Exercise</a>
                                            <form id='exerciseForm_$id' method='post' style='display: none;' class='exercise-form'>
                                                <input type='hidden' name='id' value='$id'>";

                                    // Fetch exercise options as checkboxes
                                    $exerciseResult = $con->query("SELECT id, exercise FROM workout");
                                    if ($exerciseResult->num_rows > 0) {
                                        while ($row = $exerciseResult->fetch_assoc()) {
                                            echo "<div class='checkbox'>
                                                    <label>
                                                        <input type='checkbox' name='exercises[]' value='" . $row['id'] . "'> " . $row['exercise'] . "
                                                    </label>
                                                </div>";
                                        }
                                    }
                                
                                    echo "<button type='submit' class='btn btn-primary'>Add</button>
                                            </form>
                                        </td>
                                    </tr>";
                                }
                                
                                mysqli_close($con);
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        <div class="pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++) {
                                echo "<a href='plan.php?page=$i" . (isset($_GET['search']) ? "&search=" . $_GET['search'] : "") . "'>$i</a> ";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showDropdown(id) {
    var form = document.getElementById('exerciseForm_' + id);
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script>

<?php include "footer.php"; ?>
