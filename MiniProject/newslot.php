<?php
session_start(); // Start session if not already started

// Check if student ID is set in the session
if (!isset($_SESSION['username'])) {
    die("Student ID is not set in session, handle accordingly");
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if S_id is set in the POST data
    if(isset($_POST['S_id'])){
        $S_id = $_POST['S_id']; // Get the Slot ID
    } else {
        die("Slot ID is not set."); // Display error message if S_id is not set
    }

    // Check if a subject is selected
    if(isset($_POST['subject_mand'])){
        // Assign the selected subject to $sub
        $sub = trim($_POST['subject_mand']);
    } elseif(isset($_POST['subject_alc'])){
        // Assign the selected subject to $sub
        $sub = trim($_POST['subject_alc']);
    } else {
        die("No subject selected."); // Display error message if no subject is selected
    }

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

    // Fetch slots data based on the subject parameter sent via POST request
    $slots = array();
    $slot_times = array();
    $t_name = array();  
    $venue = array();  
    
    $sql = "SELECT final_slots.S_id, slots.s_time, final_slots.t_name, final_slots.venue 
            FROM final_slots 
            JOIN slots ON final_slots.S_id = slots.S_id
            WHERE final_slots.sub_name = ?";
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

    $conn->close();
} else {
    die("No form submission detected."); // Display error message if no form submission is detected
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Slot Booking</title>
  <link rel="stylesheet" href="slot.css">
  <script>
    function disableButton(button) {
      button.innerHTML = "Enrolled";
      button.disabled = true;
    }
  </script>
</head>
<body>
    <h1>Book your slots:</h1>
    <br><br>
    <hr>
    <div class="slots-container">
    <?php
    // Display slots
    if (isset($slots)) {
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
            echo '<form action="slot.php" method="post">';
            echo '<input type="hidden" name="S_id" value="' . $slots[$j - 1] . '">'; // Hidden field to store the slot ID
            echo '<button type="submit" class="enroll-btn" name="enroll" onclick="disableButton(this)">Enroll</button>';
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo "<p>No subject selected</p>";
    }
    ?>
    </div>
</body>
</html>






