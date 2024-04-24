<?php
include 'session_start.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["add"])) {
        $username = $_POST["username"];
        $slots = $_POST["slots"];
        $professor = $_POST["professor"];
        $course_name = $_POST["slot_number"];

        try{
        $insert_query = "INSERT INTO student_selects_slots (Roll_no, S_id, subject_name, t_name) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param('ssss', $username, $slots, $course_name, $professor);
        $stmt->execute();
        }
        catch(Exception $e)
        {
            echo "<script> alert('Duplicate entry')</script>";
        }
    } elseif (isset($_POST["delete"])) {
        $info = json_decode($_POST["delete"], true);

        // Delete data using prepared statement
        $delete_query = "DELETE FROM student_selects_slots WHERE Roll_no = ? AND S_id = ? AND subject_name = ? AND t_name = ?";
        $stmt = $conn->prepare($delete_query);
        $stmt->bind_param('ssss', $info[0] ,$info[1] , $info[2] , $info[3] );
        $stmt->execute();
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
            <h2>Add Your Student </h2>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">UserName:</label>
                    <input type="text" id="username" name="username" placeholder="Ex- 22104B0060" required>
                </div>
                <div class="input-group">
                    <label for="slots">Slots:</label>
                    <input type="text" id="slots" name="slots" placeholder="Ex-S1+S2" required>
                </div>
                <div class="input-group">
                    <label for="slot_number">Course Name:</label>
                    <input type="text" id="slot_number" name="slot_number" placeholder="Ex-EM4" required>
                </div>
                <div class="input-group">
                    <label for="professor">Professor:</label>
                    <input type="text" id="professor" name="professor" placeholder="Ex- RB|RSR" required>
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
                        
                        <th>UserName &nbsp &nbsp</th>
                        <th>SlotId &nbsp &nbsp</th>
                        <th>Course Name &nbsp &nbsp</th>
                        <th>Professor &nbsp &nbsp</th>
                        <th>Action &nbsp &nbsp</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Fetch slots from database
                    $sql = "SELECT Roll_no, S_id, subject_name, t_name FROM student_selects_slots where S_id = ? and subject_name = ? and t_name = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $slots,$course_name,$professor);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $info_arr = array(NULL,NULL,NULL,NULL);
                            $info_arr = array($row["Roll_no"], $row["S_id"], $row["subject_name"],$row["t_name"]);
                            echo "<tr>";
                            // Display other columns
                            echo "<td>" . $row["Roll_no"] . "</td>";
                            echo "<td>" . $row["S_id"] . "</td>";
                            echo "<td>" . $row["subject_name"] . "</td>";
                            echo "<td>" . $row["t_name"] . "</td>";
                            
                            // Delete button for each slot
                            echo '<td><form action="" method="POST"><button type="submit" name="delete" value="' .  htmlspecialchars(json_encode($info_arr)) . '">Delete</button></form></td>';
                            echo "</tr>";
                            // // Update form for each slot (hidden by default)
                            // echo '<tr id="updateForm_' .htmlspecialchars(json_encode($info_arr)).'" style="display:none;">';
                            echo '<td colspan="5">';
                            // echo '<form action="admincod.php" method="POST">';
                            // echo 'Slot_id:<input type="text" name="username" value="' . $row["Roll_no"] . '"><br><br>';
                            // echo 'Professor: <input type="text" name="S_id" value="' . $row["S_id"] . '"><br><br>';
                            // echo 'Venue: <input type="text" name="subject_name" value="' . $row["subject_name"] . '"><br><br>';
                            // echo 'Course Name: <input type="text" name="t_name" value="' . $row["t_name"] . '"><br><br>';
                            // echo '</form>';
                            // echo '</td>';
                            // echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>No slots found</td></tr>";
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
