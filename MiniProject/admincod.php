<?php
include 'session_start.php';
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["add"])) {
        $slots = $_POST["slots"];
        $professor = $_POST["professor"];
        $venue = $_POST["venue"];
        $course_name = $_POST["slot_number"];
        
        $_SESSION['slots'] = $_POST["slots"];
        $_SESSION['professor'] = $_POST["professor"];
        $_SESSION['venue'] = $_POST["venue"];
        $_SESSION['slot_number'] = $_POST["slot_number"];

        // Check for duplicate slots
        $check_query = "SELECT COUNT(*) AS count FROM codinator_adds WHERE slot_id = ? AND t_name = ? AND subject_name = ?";
        $stmt_check = $conn->prepare($check_query);
        $stmt_check->bind_param("sss", $slots, $professor, $course_name);
        $stmt_check->execute();
        $result = $stmt_check->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            echo '<script>alert("Duplicate slots");</script>';
        } else {
            // Insert new slot
            $insert_query = "INSERT INTO codinator_adds (slot_id, t_name, venue, subject_name) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("ssss", $slots, $professor, $venue, $course_name);
            
            if ($stmt_insert->execute()) {
                echo '<script>alert("New record created successfully");</script>';
            } else {
                echo '<script>alert("Error: ' . $stmt_insert->error . '");</script>';
            }

            // Insert into other related tables
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
                $insert_query2 = "INSERT INTO sub_has_slots (S_id, subject_name) VALUES (?, ?)";
                $stmt2 = $conn->prepare($insert_query2);
                $stmt2->bind_param("ss", $slots, $course_name);
                $stmt2->execute();
            } catch (Exception $e) {
                echo '<script>alert('.$e.');</script>';
            }

            try {
                $insert_query3 = "INSERT INTO taught_by (t_name, subject_name) VALUES (?, ?)";
                $stmt3 = $conn->prepare($insert_query3);
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
        }
    }

    // Delete slot
    if (isset($_POST["delete"])) {
        $info_arr = json_decode($_POST['delete'][0], true);

        $delete_query = "DELETE FROM codinator_adds WHERE slot_id = ?";
        $stmt_delete = $conn->prepare($delete_query);
        $stmt_delete->bind_param("s", $info_arr[0]);
        
        if ($stmt_delete->execute()) {
            echo '<script>alert("Record deleted successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt_delete->error . '");</script>';
        }

        try {
            $delete_query1 = "DELETE FROM is_from WHERE D_name = ? and t_name = ?";
            $stmt_delete1 = $conn->prepare($delete_query1);
            $stmt_delete1->bind_param("ss", $_SESSION['dept'], $info_arr[1]);
            $stmt_delete1->execute();
        } catch (Exception $e) {
            echo '<script>alert('.$e.');</script>';
        }

        try {
            $delete_query2 = "DELETE FROM taught_by WHERE  t_name = ? and subject_name = ?";
            $stmt_delete2 = $conn->prepare($delete_query2);
            $stmt_delete2->bind_param("ss", $info_arr[1], $info_arr[2]);
            $stmt_delete2->execute();
        } catch (Exception $e) {
            echo '<script>alert('.$e.');</script>';
        }

        try {
            $delete_query3 = "DELETE FROM sub_has_slots WHERE  S_id = ? and subject_name = ?";
            $stmt_delete3 = $conn->prepare($delete_query3);
            $stmt_delete3->bind_param("ss", $info_arr[0], $info_arr[2]);
            $stmt_delete3->execute();
        } catch (Exception $e) {
            echo '<script>alert('.$e.');</script>';
        }

        try {
            $delete_query4 = "DELETE FROM is_alloted_to WHERE  t_name = ? and S_id = ?";
            $stmt_delete4 = $conn->prepare($delete_query4);
            $stmt_delete4->bind_param("ss", $info_arr[1], $info_arr[0]);
            $stmt_delete4->execute();
        } catch (Exception $e) {
            echo '<script>alert('.$e.');</script>';
        }

        try {
            $delete_query5 = "DELETE FROM teacher WHERE  t_name = ?";
            $stmt_delete5 = $conn->prepare($delete_query5);
            $stmt_delete5->bind_param("s", $info_arr[1]);
            $stmt_delete5->execute();
        } catch (Exception $e) {
            echo '<script>alert('.$e.');</script>';
        }
    }

    // Update slot
    if (isset($_POST["update"])) {
        $slots = $_POST["slot_id"];
        $professor = $_POST["professor"];
        $venue = $_POST["venue"];
        $course_name = $_POST["slot_number"];

        $update_query = "UPDATE codinator_adds SET t_name=?, venue=?, subject_name=? WHERE slot_id=?";
        $stmt_update = $conn->prepare($update_query);
        $stmt_update->bind_param("sssi", $professor, $venue, $course_name, $slots);
        
        if ($stmt_update->execute()) {
            echo '<script>alert("Record updated successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . $stmt_update->error . '");</script>';
        }
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
                    <label for="slot_number">Course Name:</label>
                    <input type="text" id="slot_number" name="slot_number" placeholder="Ex-EM4" required>
                </div>
                <div class="input-group">
                    <label for="Course_Type">Course Type:</label>
                    <input type="text" id="Course_Type" name="Course_Type" placeholder="MAND/ALC" required>
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
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            // Update button for each slot
                            echo '<td><button onclick="showUpdateForm(\'' . $row["slot_id"] . '\')">Update</button></td>';
                            // Display other columns
                            echo "<td>" . $row["slot_id"] . "</td>";
                            echo "<td>" . $row["t_name"] . "</td>";
                            echo "<td>" . $row["venue"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            $info_arr = array($row["slot_id"], $row["t_name"], $row["subject_name"]);
                            // Delete button for each slot
                            echo '<td><form action="" method="POST"><input type="hidden" name="delete[]" value="' .  htmlspecialchars(json_encode($info_arr)) . '"><button type="submit" name="delete">Delete</button></form></td>';
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
