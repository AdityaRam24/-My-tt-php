<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "MYTT"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add slot
if (isset($_POST["add"])) {
    $slots = $_POST["slots"];
    $professor = $_POST["professor"];
    $venue = $_POST["venue"];
    $time = $_POST["time"];
    $course_name = $_POST["slot_number"];
    
    $check_query = "SELECT COUNT(*) AS count FROM codinator_adds WHERE slot_id = '$slots' AND t_name = '$professor' AND subject_name = '$course_name'";
    $result = $conn->query($check_query);
    $row = $result->fetch_assoc();
    
    if ($row['count'] > 0) {
        echo '<script>alert("Duplicate slots");</script>';
    } else {
        $insert_query = "INSERT INTO codinator_adds (slot_id, t_name, venue, s_time, subject_name) 
                         VALUES ('$slots', '$professor', '$venue', '$time', '$course_name')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo '<script>alert("New record created successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . $conn->error . '");</script>';
        }
    }
}

// Delete slot
if (isset($_POST["delete"])) {
    $slot_id = $_POST["slot_id"];
    $delete_query = "DELETE FROM codinator_adds WHERE slot_id = '$slot_id'";
    if ($conn->query($delete_query) === TRUE) {
        echo '<script>alert("Record deleted successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }
}

// Update slot
if (isset($_POST["update"])) {
    $slot_id = $_POST["slot_id"];
    // $slots = $_POST["slots"];
    $professor = $_POST["professor"];
    $venue = $_POST["venue"];
    $time = $_POST["time"];
    $course_name = $_POST["slot_number"];

    $update_query = "UPDATE codinator_adds SET t_name='$professor', venue='$venue', s_time='$time', subject_name='$course_name' WHERE slot_id='$slot_id'";
    if ($conn->query($update_query) === TRUE) {
        echo '<script>alert("Record updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $conn->error . '");</script>';
    }
}
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
                <button type="submit" name="add">Add</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="content">
            <h2>Slots List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Update</th> <!-- New column for update button -->
                        <th>Slot ID</th>
                        <th>Professor</th>
                        <th>Venue</th>
                        <th>Time</th>
                        <th>Course Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch slots from database
                    $sql = "SELECT slot_id, t_name, venue, s_time, subject_name FROM codinator_adds";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Update button for each slot
                            echo '<td><button onclick="showUpdateForm(\'' . $row["slot_id"] . '\')">Update</button></td>';
                            // Display other columns
                            echo "<td>" . $row["slot_id"] . "</td>";
                            echo "<td>" . $row["t_name"] . "</td>";
                            echo "<td>" . $row["venue"] . "</td>";
                            echo "<td>" . $row["s_time"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            // Delete button for each slot
                            echo '<td><form action="" method="POST"><input type="hidden" name="slot_id" value="' . $row["slot_id"] . '"><button type="submit" name="delete">Delete</button></form></td>';
                            echo "</tr>";
                            // Update form for each slot (hidden by default)
                            echo '<tr id="updateForm_' . $row["slot_id"] . '" style="display:none;">';
                            echo '<td colspan="6">';
                            echo '<form action="" method="POST">';
                            echo '<input type="hidden" name="slot_id" value="' . $row["slot_id"] . '">';
                            echo 'Professor: <input type="text" name="professor" value="' . $row["t_name"] . '"><br>';
                            echo 'Venue: <input type="text" name="venue" value="' . $row["venue"] . '"><br>';
                            echo 'Time: <input type="text" name="time" value="' . $row["s_time"] . '"><br>';
                            echo 'Course Name: <input type="text" name="slot_number" value="' . $row["subject_name"] . '"><br>';
                            echo '<button type="submit" name="update">Update</button>';
                            echo '</form>';
                            echo '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='6'>No slots found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function showUpdateForm(slot_id) {
            var updateForms = document.querySelectorAll('[id^="updateForm_"]');
            updateForms.forEach(function(form) {
                form.style.display = "none";
            });
            var updateForm = document.getElementById("updateForm_" + slot_id);
            updateForm.style.display = "table-row";
        }
    </script>
</body>
</html>