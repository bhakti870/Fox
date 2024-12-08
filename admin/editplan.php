<?php
session_start();
include("config.php");

$id = $_REQUEST['id'];

$result = mysqli_query($con, "SELECT `id`, `Name`, `Weight`, `Goal`, `Skill`, `Duration`, `Days` FROM `admin_plan` WHERE id=$id");

list($id, $Name, $Weight, $Goal, $Skill, $Duration, $Days) = mysqli_fetch_array($result);

if (isset($_POST['edit'])) {
    $Name = $_POST['Name'];
    $Weight = $_POST['Weight'];
    $Goal = $_POST['Goal'];
    $Skill = $_POST['Skill'];
    $Duration = $_POST['Duration'];
    $Days = $_POST['Days'];

    mysqli_query($con, "UPDATE `admin_plan` SET `Name`='$Name', `Weight`='$Weight', `Goal`='$Goal', `Skill`='$Skill', `Duration`='$Duration', `Days`='$Days' WHERE id=$id") or die("Query 2 is incorrect..........");

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
            <form action="editplan.php" name="form" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="card-body">
                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" id="Name" name="Name" class="form-control" value="<?php echo $Name; ?>">
                            <span id="nameError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" id="Weight" name="Weight" class="form-control" value="<?php echo $Weight; ?>">
                            <span id="weightError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Goal</label>
                            <input type="text" id="Goal" name="Goal" class="form-control" value="<?php echo $Goal; ?>">
                            <span id="goalError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Skill</label>
                            <input type="text" id="Skill" name="Skill" class="form-control" value="<?php echo $Skill; ?>">
                            <span id="skillError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Duration</label>
                            <input type="number" id="Duration" name="Duration" class="form-control" value="<?php echo $Duration; ?>">
                            <span id="durationError" style="color: red;"></span>
                        </div>
                    </div>
                    <div class="col-md-12 ">
                        <div class="form-group">
                            <label>Days</label>
                            <input type="number" id="Days" name="Days" class="form-control" value="<?php echo $Days; ?>">
                            <span id="daysError" style="color: red;"></span>
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

<script>
    function validateForm() {
        let isValid = true;

        // Name validation
        let name = document.getElementById('Name').value;
        if (name === "" || name.length < 3 || name.length > 50) {
            document.getElementById('nameError').innerText = "Name must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('nameError').innerText = "";
        }

        // Weight validation
        let weight = document.getElementById('Weight').value;
        if (weight === "" || weight <= 0) {
            document.getElementById('weightError').innerText = "Weight must be a positive number.";
            isValid = false;
        } else {
            document.getElementById('weightError').innerText = "";
        }

        // Goal validation
        let goal = document.getElementById('Goal').value;
        if (goal === "" || goal.length < 3 || goal.length > 100) {
            document.getElementById('goalError').innerText = "Goal must be between 3 and 100 characters.";
            isValid = false;
        } else {
            document.getElementById('goalError').innerText = "";
        }

        // Skill validation
        let skill = document.getElementById('Skill').value;
        if (skill === "" || skill.length < 3 || skill.length > 50) {
            document.getElementById('skillError').innerText = "Skill must be between 3 and 50 characters.";
            isValid = false;
        } else {
            document.getElementById('skillError').innerText = "";
        }

        // Duration validation
        let duration = document.getElementById('Duration').value;
        if (duration === "" || duration <= 0) {
            document.getElementById('durationError').innerText = "Duration must be a positive number.";
            isValid = false;
        } else {
            document.getElementById('durationError').innerText = "";
        }

        // Days validation
        let days = document.getElementById('Days').value;
        if (days === "" || days <= 0) {
            document.getElementById('daysError').innerText = "Days must be a positive number.";
            isValid = false;
        } else {
            document.getElementById('daysError').innerText = "";
        }

        return isValid;
    }
</script>
