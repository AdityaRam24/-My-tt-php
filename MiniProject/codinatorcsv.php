<?php
// Database connection
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$database = "my tt"; 

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// CSV file upload and processing
if(isset($_POST["upload"])) {
    if(isset($_FILES["file"])) {
        $file = $_FILES["file"]["tmp_name"];
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {
            
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) == 4) { // Ensure the row has exactly 5 columns
                    $slots = $data[0];
                    $professor = $data[1];
                    $venue = $data[2];
                    $course_name = $data[3];
                    // Prepare the insert statement
                    $insert_query = $conn->prepare("INSERT INTO codinator_adds (slot_id, t_name, venue, subject_name) VALUES (?, ?, ?, ?)");
                    $insert_query->bind_param("ssss", $slots, $professor, $venue,$course_name);
                    // Execute the prepared statement
                    $insert_query->execute();
                } else {
                    echo '<script>alert("Invalid row in CSV file: ' . implode(',', $data) . '");</script>';
                }
            }
            fclose($handle);
            echo '<script>alert("CSV file uploaded and data inserted successfully");</script>';
        } else {
            echo '<script>alert("Error opening CSV file");</script>';
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
    $professor = $_POST["professor"];
    $venue = $_POST["venue"];
    $course_name = $_POST["slot_number"];

    $update_query = "UPDATE codinator_adds SET t_name='$professor', venue='$venue', subject_name='$course_name' WHERE slot_id='$slot_id'";
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
    <link rel="stylesheet" href="codinator1.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="VITVL2_1.png" alt="Logo">
        </div>
        <div class="content">
            <h2>Upload CSV File</h2>
            <!-- New form for CSV file upload -->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="file" name="file" required>
                <button type="submit" name="upload">Upload</button>
            </form>
            <!-- End of new form -->
        </div>
    </div>

    <div class="container">
        <div class="content">
            <h2>Slots List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Update</th>
                        <th>Slot ID</th>
                        <th>Professor</th>
                        <th>Venue</th>
                        <th>Course Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch slots from database
                    $sql = "SELECT slot_id, t_name, venue, subject_name FROM codinator_adds";
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