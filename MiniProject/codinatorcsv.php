<?php
include 'session_start.php';
include 'config.php';

// CSV file upload and processing
if(isset($_POST["upload"])) {
    if(isset($_FILES["file"])) {
        $file = $_FILES["file"]["tmp_name"];
        $handle = fopen($file, "r");
        if ($handle !== FALSE) {
            
            while(($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (count($data) == 5) { // Ensure the row has exactly 5 columns
                    $slots = $data[0];
                    $professor = $data[1];
                    $venue = $data[2];
                    $course_name = $data[3];
                    $course_type = $data[4];
                    // Prepare the insert statement
                    $insert_query = $conn->prepare("INSERT INTO codinator_adds (slot_id, t_name, venue, subject_name) VALUES (?, ?, ?, ?)");
                    $insert_query->bind_param("ssss", $slots, $professor, $venue,$course_name);
                    // Execute the prepared statement
                    $insert_query->execute();

                    try {
                        $insert_query2 = "INSERT INTO subject (subject_name,subject_type) VALUES (?, ?)";
                        $stmt2 = $conn->prepare($insert_query2);
                        $stmt2->bind_param("ss", $course_name,$course_type);
                        $stmt2->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    try {
                        $insert_query4 = "INSERT INTO dept_contains VALUES (?,?)";
                        $stmt4 = $conn->prepare($insert_query4);
                        $stmt4->bind_param("ss", $_SESSION['dept'] , $course_name);
                        $stmt4->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
            
                    try {
                        $insert_query4 = "INSERT INTO teacher (t_name) VALUES (?)";
                        $stmt4 = $conn->prepare($insert_query4);
                        $stmt4->bind_param("s", $professor);
                        $stmt4->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    
                    try {
                        $insert_query1 = "INSERT INTO is_alloted_to (t_name,S_id) VALUES (?, ?)";
                        $stmt1 = $conn->prepare($insert_query1);
                        $stmt1->bind_param("ss", $professor, $slots);
                        $stmt1->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    
                    try {
                        $insert_query3 = "INSERT INTO sub_has_slots (S_id, subject_name) VALUES (?, ?)";
                        $stmt2 = $conn->prepare($insert_query3);
                        $stmt2->bind_param("ss", $slots, $course_name);
                        $stmt2->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    
                    try {
                        $insert_query4 = "INSERT INTO taught_by (t_name, subject_name) VALUES (?, ?)";
                        $stmt3 = $conn->prepare($insert_query4);
                        $stmt3->bind_param("ss", $professor, $course_name);
                        $stmt3->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    
                    try {
                        $insert_query5 = "INSERT INTO is_from (D_name, t_name) VALUES (?, ?)";
                        $stmt5 = $conn->prepare($insert_query5);
                        $stmt5->bind_param("ss", $_SESSION['dept'], $professor);
                        $stmt5->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                    try {
                        $insert_query5 = "INSERT INTO final_slots (t_name,S_id,sub_name,venue) VALUES (?, ?,?,?)";
                        $stmt5 = $conn->prepare($insert_query5);
                        $stmt5->bind_param("ssss", $professor,$slots,$course_name,$venue);
                        $stmt5->execute();
                    } catch (Exception $e) {
                        echo '<script>alert('.$e.');</script>';
                    }
                $insert_query = "INSERT INTO codinator_adds (slot_id, t_name, venue, subject_name) 
                                 VALUES ('$slots', '$professor', '$venue', '$course_name')";
                
                try{
                $conn->query($insert_query); 
                    echo '<script>alert("New record created successfully");</script>';
                } catch(Exception $e) {
                    echo '<script>alert("Error: duplicate Slots");</script>';
                }
            }
                else{
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

if (isset($_POST["delete"])) {
    // Decode JSON data
    $info = json_decode($_POST["delete"], true);
    
    // Check if slot_id, t_name, and subject_name are set
    if (isset($info[0]) && isset($info[1]) && isset($info[2]) && isset($info[3])) {
        try{
        // Prepare and execute DELETE query for codinator_adds table
        $delete_query = "DELETE FROM codinator_adds WHERE slot_id = ? AND t_name = ? AND subject_name = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param("sss", $info[0], $info[1], $info[2]); // Assuming slot_id is an integer
        
        $stmt->execute();
        } catch (Exception $e)
        {
            echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
            // Log error for debugging
            error_log("Error deleting record from sub_has_slots: " . $stmt_update->error);
        }
        
       try{
        $delete_sub = "DELETE FROM sub_has_slots WHERE subject_name = ? AND S_id = ?";
        $stmt_update = $conn->prepare($delete_sub);
        $stmt_update->bind_param("ss", $info[2], $info[0]);
        $stmt_update->execute();
            //echo '<script>alert("subject updated successfully");</script>';
        }
         catch(Exception $e) {
            echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
            // Log error for debugging
            error_log("Error deleting record from sub_has_slots: " . $stmt_update->error);
        }
        // Close statement
        $stmt_update->close();
        try{
        $delete_sub = "DELETE FROM is_alloted_to WHERE t_name = ? AND S_id = ?";
        $stmt_update = $conn->prepare($delete_sub);
        $stmt_update->bind_param("ss", $info[1], $info[2]);
        $stmt_update->execute();
            //echo '<script>alert("subject updated successfully");</script>';
        } catch(Exception $e) {
            echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
            error_log("Error deleting record from is_alloted_to: " . $stmt_update->error);
        }
        // Close statement
        $stmt_update->close();
        
        try {
            // Prepare and execute DELETE query for final_slots table
            $insert_query5 = "DELETE FROM final_slots WHERE t_name = ? AND S_id = ? AND sub_name = ? AND venue = ?";
            $stmt5 = $conn->prepare($insert_query5);
            $stmt5->bind_param("ssss", $info[1], $info[0], $info[2], $info[3]);
            $stmt5->execute();
        } catch (Exception $e) {
            echo '<script>alert(' . $e->getMessage() . ');</script>';
            // Log error for debugging
            error_log("Error deleting record from final_slots: " . $e->getMessage());
        }
        // Close statement
        $stmt5->close();
        echo '<script>alert("Record deleted successfully");</script>';
    } else {
        echo '<script>alert("Error: Invalid data");</script>';
    }
}



// Update slot
if (isset($_POST["update"])) {
    $info = json_decode($_POST["update"], true);
    $slots = $_POST["slot_id"];
    $professor = $_POST["professor"];
    $venue = $_POST["venue"];
    $course_name = $_POST["slot_number"];
    $course_type = $_POST['course_type'];

    $update_query = "UPDATE codinator_adds SET t_name=?, venue=?, subject_name=? WHERE slot_id=?";
    $stmt_update = $conn->prepare($update_query);
    $stmt_update->bind_param("ssss", $professor, $venue, $course_name, $slots);
    
    if ($stmt_update->execute()) {
        echo '<script>alert("Record updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
    }

    $update_teach = "UPDATE teacher SET t_name=? WHERE t_name=?";
    $stmt_update = $conn->prepare($update_teach);
    $stmt_update->bind_param("ss", $professor , $info[1]);
    
    if ($stmt_update->execute()) {
        //echo '<script>alert("teacher updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
    }

    $update_sub = "UPDATE subject SET subject_name=? WHERE subject_name=?";
    $stmt_update = $conn->prepare($update_sub);
    $stmt_update->bind_param("ss", $course_name , $info[2]);
    
    if ($stmt_update->execute()) {
        //echo '<script>alert("subject updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
    }

    $update_sub = "UPDATE sub_has_slots SET S_id = ? WHERE subject_name = ? and S_id = ?";
    $stmt_update = $conn->prepare($update_sub);
    $stmt_update->bind_param("sss", $slots , $course_name , $info[0]);
    
    if ($stmt_update->execute()) {
        //echo '<script>alert("subject updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
    }
    
    $update_sub = "UPDATE is_alloted_to SET S_id = ? WHERE t_name = ? and S_id = ?";
    $stmt_update = $conn->prepare($update_sub);
    $stmt_update->bind_param("sss", $slots , $info[1] , $info[0]);
    
    if ($stmt_update->execute()) {
        //echo '<script>alert("subject updated successfully");</script>';
    } else {
        echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
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
                    $sql = "SELECT slot_id, t_name, venue, subject_name FROM codinator_adds order by slot_id";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            $info_arr = array(NULL,NULL,NULL,NULL);
                            $info_arr = array($row["slot_id"], $row["t_name"], $row["subject_name"],$row["venue"]);
                            echo "<tr>";
                            // Update button for each slot
                            echo '<td><button onclick="showUpdateForm(\'' . htmlspecialchars(json_encode($info_arr)) .'\')">Update</button></td>';
                            // Display other columns
                            echo "<td>" . $row["slot_id"] . "</td>";
                            echo "<td>" . $row["t_name"] . "</td>";
                            echo "<td>" . $row["venue"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            // Delete button for each slot
                            echo '<td><form action="" method="POST"><input type="hidden" name="delete" ><button type="submit" name="delete" value="' . htmlspecialchars(json_encode($info_arr)) .'">Delete</button></form></td>';
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