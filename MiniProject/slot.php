<?php
session_start(); // Start session if not already started

// Check if student ID is set in the session

// Your PHP code to establish database connection and fetch slots data
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my tt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username']; // Access student ID from session
} else {
    die("Student ID is not set in session, handle accordingly");
}
// Close statement
$deptname = $_SESSION['deptname'];
$sqlsubsArr = "SELECT Subject_name FROM dept_contains WHERE D_name = ?";
$stmt = $conn->prepare($sqlsubsArr);
$stmt->bind_param("s", $deptname);
$stmt->execute();
$result1 = $stmt->get_result();

// Alert message variable
$alertMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['subject_mand'])){
        // Assign the selected subject to $sub
        $sub = trim($_POST['subject_mand']);
    }
    if(isset($_POST['subject_alc'])){
        // Assign the selected subject to $sub
        $sub = trim($_POST['subject_alc']);
    }
    
    // Check if the slot for the selected subject or same day and time slot is already enrolled
    $sqlCheckEnrollment = "SELECT COUNT(*) AS total FROM final_slots JOIN slots USING(S_id) WHERE sub_name = ? AND (S_id = ? OR (s_time = ? AND venue = ?))";
    $stmtCheckEnrollment = $conn->prepare($sqlCheckEnrollment);
    $stmtCheckEnrollment->bind_param("siss", $sub, $_POST['S_id'], $_POST['slot_times'], $_POST['venue']);
    $stmtCheckEnrollment->execute();
    $resultCheckEnrollment = $stmtCheckEnrollment->get_result();
    $rowCheckEnrollment = $resultCheckEnrollment->fetch_assoc();
    $totalEnrolled = $rowCheckEnrollment['total'];
    
    if ($totalEnrolled > 0) {
        // Slot for the selected subject or same day and time slot is already enrolled
        $alertMessage = "You are already enrolled for a slot of this subject or a slot with the same day and time.";
    } else {
        // Proceed with enrollment
        $S_id = $_POST['S_id']; // Get the slot ID to enroll
        
        // Your enrollment logic here...
        // For example, you might insert the enrollment into a database table
        $sqlEnroll = "INSERT INTO student_selects_slots (Roll_no, S_id) VALUES (?, ?)";
        $stmtEnroll = $conn->prepare($sqlEnroll);
        $stmtEnroll->bind_param("ss", $username, $S_id); // Bind student ID to the enrollment
        if ($stmtEnroll->execute()) {
            $alertMessage = "Enrollment successful.";
        } else {
            $alertMessage = "Enrollment failed: " . $stmtEnroll->error;
        }
    }
}

// Fetch slots data based on the subject parameter sent via GET request
$slots = array();
$slot_times = array();
$t_name = array();  
$venue = array();  
if (isset($sub)) {
    $sql = "SELECT S_id, s_time, t_name, venue FROM final_slots JOIN slots USING(S_id) WHERE sub_name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $sub);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $slots[] = $row['S_id'];
            $slot_times[] = $row['s_time'];
            $t_name[] = $row['t_name'];
            $venue[] = $row['venue'];
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slot Booking</title>
  <link rel="stylesheet" href="slot.css">
</head>
<body>
    <form action="slot.php" method="post">
    <h1>Book your slots:</h1>
    <br><br>
    <hr>
    <div class="slots-container">
    <?php
    if (isset($sub)) {
        $j = 0; // Initialize $j
        while ($j < count($t_name)) {
            // Get teacher and venue for the current slot
            $current_teacher = $t_name[$j];
            $current_venue = $venue[$j];
            
            // Initialize variables for slots, slot times, and venues
            $s = "";
            $st = "";
            $v = "";
            
            // Loop until the teacher and venue remain the same
            while ($j < count($t_name) && $t_name[$j] == $current_teacher && $venue[$j] == $current_venue) {
                // Concatenate slots, slot times, and venues
                $s .= '&nbsp;' . $slots[$j] . '&nbsp;';
                $st .= '&nbsp;' . $slot_times[$j] . '&nbsp;';
                $v = $current_venue;
                $j++;
            }
            
            // Print the combined slots for the current teacher and venue
            echo '<div class="slot">';
            echo '<label for="slot">' . $s . ' - ' . $st . ' - ' . $current_teacher . ' - ' . $v . '</label>';
            echo '<input type="hidden" name="S_id" value="' . $slots[$j - 1] . '">'; // Hidden field to store the slot ID
            echo '<button type="submit" class="enroll-btn" name="enroll">Enroll</button>'; // Changed button type to submit
            echo '<button class="unenroll-btn" name="unenroll">Unenroll</button>';
            echo '</div>';
        }
    } else {
        echo "<p>No subject selected</p>";
    }
    ?>
    </div>
    </form>
 
</body>
</html>
