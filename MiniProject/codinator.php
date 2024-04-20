<?php
include 'session_start.php';
include 'config.php';
if($_SERVER['REQUEST_METHOD'] == 'post'){
if (isset($_POST["submit"])) {
    
    $slots = $_POST["slots"];
    $professor = $_POST["professor"];
    $venue = $_POST["venue"];
    $time = $_POST["time"];
    $course_name = $_POST["slot_number"];
    
    // Check for duplicate entries
    $check_query = "SELECT COUNT(*) AS count FROM codinator_adds WHERE slot_id = '$slots' AND t_name = '$professor' AND subject_name = '$course_name'";
    $result = $conn->query($check_query);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        echo '<script>alert("Duplicate slots");</script>';
    } else {
        // Insert into the database
        $insert_query = "INSERT INTO codinator_adds (slot_id, t_name, venue, s_time, subject_name) 
                         VALUES ('$slots', '$professor', '$venue', '$time', '$course_name')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo '<script>alert("New record created successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '");</script>';
        }
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
    <title>VIT | Vidyalankar Institute Of Technology </title>
    <link rel="stylesheet" href="codinator.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="VITVL2_1.png" alt="Logo">
        </div>
        <div class="content">
            <h2>Add Your Slots </h2>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="slots">Slots:</label>
                    <input type="text" id="slots" name="slots" placeholder="Ex-S1+S2" required>
                </div>
                <div class="input-group">
                    <label for="professor">Professor:</label>
                    <input type="text" id="professor" name="professor" placeholder="Ex- RB|RSR" required>
                </div>
                <div class="input-group">
                    <label for="venue">Venue:</label>
                    <input type="text" id="venue" name="venue" placeholder="Ex- E101" required>
                </div>
                <div class="input-group">
                    <label for="time">Time:</label>
                    <input type="text" id="time" name="time" placeholder="Ex-1:45-2:45" required>
                </div>
                <div class="input-group">
                    <label for="slot_number">Course Name:</label>
                    <input type="text" id="slot_number" name="slot_number" placeholder="Ex-EM4" required>
                </div>
                <button type="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>