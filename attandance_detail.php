<?php
include('header.php');
include('config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Start session if not already started
}


// Get the logged-in user's ID
$user_id = $_SESSION['id'];

// Default month and year
$month = date('m');
$year = date('Y');

// Check if the form is submitted and get the selected month and year
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $month = $_POST['month'];
    $year = $_POST['year'];
}

// Fetch attendance data for the selected month and year, filtered by user ID
$sql = "SELECT date, status FROM attendance WHERE MONTH(date) = ? AND YEAR(date) = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $month, $year, $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Layout</title>
    <style>
.calendar-container {
            background-color: white;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            max-width: 600px;
            margin: 20px auto;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .calendar-header {
            display: flex;
            color: white;
            align-items: center;
            margin-bottom: 10px;
        }

        .calendar-header img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .calendar-header h2 {
            font-size: 24px;
            color: black;
            margin: 0;
        }

        .divider {
            margin: 10px 0;
            border-bottom: 1px solid #ccc;
        }

        .note {
            color: #d9534f; /* Red color for 'Note:' */
            font-weight: bold;
            margin-bottom: 10px;
        }

        .legend {
            display: flex;
            justify-content: space-around;
            font-size: 14px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend-item span {
            border-left: 2px solid;
            color: white;
            padding-left: 5px;
        }

        .legend-item.suspend span { color: black; }
        .legend-item.holiday span { color: #f0ad4e; } /* Orange color for 'Holiday' */
        .legend-item.absent span { color: #d9534f; } /* Red color for 'Absent' */
        .legend-item.present span { color: #5cb85c; } /* Green color for 'Present' */

        .table-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        table {
            width: 50%;
            border-collapse: collapse;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #333;
        }

        th:first-child {
            background-color: #000;
            color: #fff;
        }

        td:first-child {
            color: #d9534f; /* Red color for dates */
            font-weight: bold;
        }

        td {
            color: #333;
            font-size: 16px;
        }

        .present {
            color: #5cb85c; /* Green color for 'Present' */
        }

        .absent {
            color: #d9534f; /* Red color for 'Absent' */
        }

        .suspend {
            color: #000; /* Black color for 'Suspend' */
        }

        .remaining {
            font-weight: bold;
            color: orange;
        }    </style>
</head>
<body>

<div class="calendar-container">
    <div class="calendar-header">
        <img src="https://cdn-icons-png.flaticon.com/512/61/61112.png" alt="Calendar Icon">
        <h2><?php echo date('F-Y', mktime(0, 0, 0, $month, 1, $year)); ?></h2>
    </div>

    <div class="divider"></div>

    <div class="note">
        Note :
    </div>

    <div class="legend">
        <div class="legend-item suspend">
            <span>S - Suspend</span>
            <span>R - Remaining</span>
        </div>
        <div class="legend-item holiday">
            <span>H - Holiday</span>
        </div>
        <div class="legend-item absent">
            <span>A - Absent</span>
        </div>
        <div class="legend-item present">
            <span>P - Present</span>
        </div>
    </div>
    <br>

    <form method="POST" action="">
        <label for="month">Select Month:</label>
        <select name="month" id="month">
            <?php for ($m = 1; $m <= 12; $m++): ?>
                <option value="<?php echo $m; ?>" <?php echo ($m == $month) ? 'selected' : ''; ?>>
                    <?php echo date('F', mktime(0, 0, 0, $m, 1)); ?>
                </option>
            <?php endfor; ?>
        </select>

        <label for="year">Select Year:</label>
        <select name="year" id="year">
            <?php for ($y = date('Y'); $y >= 2000; $y--): ?>
                <option value="<?php echo $y; ?>" <?php echo ($y == $year) ? 'selected' : ''; ?>>
                    <?php echo $y; ?>
                </option>
            <?php endfor; ?>
        </select>

        <input type="submit" value="Show Attendance">
    </form>
</div>

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Attendance</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are results and display them
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    // Format date to display day and month
                    $date = date('d-M<br>D', strtotime($row['date']));
                    // Set attendance status class
                    $attendanceClass = '';
                    switch($row['status']) {
                        case 'P':
                            $attendanceClass = 'present';
                            break;
                        case 'A':
                            $attendanceClass = 'absent';
                            break;
                        case 'H':
                            $attendanceClass = 'holiday';
                            break;
                        case 'R':
                            $attendanceClass = 'remaining';
                            break;
                        case 'S':
                            $attendanceClass = 'suspend';
                            break;
                        default:
                            $attendanceClass = 'absent'; // Default class
                    }
                    echo "<tr>
                            <td>{$date}</td>
                            <td class='{$attendanceClass}'>{$row['status']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No attendance records found for this month.</td></tr>";
            }
            // Close the database connection
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

</body>
</html>
