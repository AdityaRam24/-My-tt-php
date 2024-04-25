<?php
include 'session_start.php';
include 'config.php';
try {
// Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username']; // Access student ID from session
    } else {
        throw new Exception("Student ID is not set in session, handle accordingly");
    }

    $deptname = $_SESSION['dept'];
    $sqlsubsArr = "SELECT Subject_name FROM dept_contains WHERE D_name = ?";
    $stmt = $conn->prepare($sqlsubsArr);
    $stmt->bind_param("s", $deptname);
    $stmt->execute();
    $result1 = $stmt->get_result();

    // Alert message variable
    $alertMessage = "";

    $sub = null; // Initialize $sub

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['subject_mand'])) {
            // Assign the selected subject to $sub
            $sub = trim($_POST['subject_mand']);
            $_SESSION['subject'] = $sub;
            
        } elseif (isset($_POST['subject_alc'])) {
            // Assign the selected subject to $sub
            $sub = trim($_POST['subject_alc']);
            $_SESSION['subject'] = $sub;
        }

    }
    if(isset($_SESSION['subject'])){
        $sub = $_SESSION['subject'];
    }
    // Fetch slots data based on the subject parameter sent via GET request
    $slots = array();
    $slot_times = array();
    $t_name = array();
    $venue = array();

    if ($sub != null) {
        $sql = "SELECT S_id, s_time, t_name, venue FROM final_slots JOIN slots USING(S_id) WHERE sub_name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $sub);
        $stmt->execute();
        $result = $stmt->get_result();
        $subject = $sub;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $slots[] = $row['S_id'];
                $slot_times[] = $row['s_time'];
                $t_name[] = $row['t_name'];
                $venue[] = $row['venue'];
            }
        }
    }  
    $i = 0;
    if (isset($_POST['Enroll'])) {
        $info_json = $_POST['Enroll'];
        $info = json_decode($info_json, true); // Decode JSON string to array

        if ($info[0] != null) { // Check for null value before proceeding
            // Check if the first 3 characters of S_id in the database match the first 3 characters of info[0]
            $checkDuplicate = "SELECT S_id , Roll_no FROM student_selects_slots WHERE S_id = ? and Roll_no = ?";
            $stmtCheck = $conn->prepare($checkDuplicate);
            $stmtCheck->bind_param("ss", $info[0] , $username);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();

            if ($resultCheck->num_rows > 0) {
                $alertMessage = "The slot is already booked.";
                echo '<script>alert("' . $alertMessage . '");</script>';
                echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                exit(); // Stop further execution
            }
            $checkcount = "SELECT COUNT(*) AS count 
            FROM student_selects_slots 
            WHERE 
                (subject_name = ? AND t_name = ? AND S_id = ? AND subject_name LIKE '%Lab') 
                OR 
                (subject_name = ? AND t_name = ? AND S_id = ?)";
            
            $stmtCheck = $conn->prepare($checkcount);
            $stmtCheck->bind_param("ssssss", $info[2] , $info[1] , $info[0] ,  $info[2] , $info[1] , $info[0]);
            $stmtCheck->execute();
            $resultCheck = $stmtCheck->get_result();
            $row = $resultCheck->fetch_assoc();
            $numcount = $row['count'];

            if ($numcount < 2 && strpos($sub, 'Lab') === false) {

            $sqlEnroll = "INSERT INTO student_selects_slots (Roll_no, S_id, subject_name, t_name) VALUES (?, ?, ?, ?)";
            $stmtEnroll = $conn->prepare($sqlEnroll);
            $stmtEnroll->bind_param("ssss", $username, $info[0], $info[2], $info[1]);

            try {
                if ($stmtEnroll->execute()) {
                    $alertMessage = "Enrollment successful.";
                    echo '<script>alert("' . $alertMessage . '");</script>';
                    $subject = $_SESSION['subject'] ;
                    echo $subject;
                    $deptname = $_SESSION['dept'];
                    echo $deptname;
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                } else {
                    $alertMessage = "Invalid slot selected.";
                    echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { // Check for duplicate entry error code
                    $alertMessage = "You are already enrolled for this subject.";
                    echo '<script>alert("' . $alertMessage . '");</script>';
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                } else {
                    throw $e; // Re-throw exception if it's not the duplicate entry error
                }
            }

        } 
        else 
         {
            $alertMessage = "slots full";
            echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
            echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
        }

         if($numcount < 2  && preg_match('/Lab/', $numcount)){
            $sqlEnroll = "INSERT INTO student_selects_slots (Roll_no, S_id, subject_name, t_name) VALUES (?, ?, ?, ?)";
            $stmtEnroll = $conn->prepare($sqlEnroll);
            $stmtEnroll->bind_param("ssss", $username, $info[0], $info[2], $info[1]);

            try {
                if ($stmtEnroll->execute()) {
                    $alertMessage = "Enrollment successful.";
                    echo '<script>alert("' . $alertMessage . '");</script>';
                    $subject = $_SESSION['subject'] ;
                    echo $subject;
                    $deptname = $_SESSION['dept'];
                    echo $deptname;
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                } else {
                    $alertMessage = "Invalid slot selected.";
                    echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { // Check for duplicate entry error code
                    $alertMessage = "You are already enrolled for this subject.";
                    echo '<script>alert("' . $alertMessage . '");</script>';
                    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
                } else {
                    throw $e; // Re-throw exception if it's not the duplicate entry error
                }
            }

        } 
        else 
         {
            $alertMessage = "slots full";
            echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
            echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
        }
        
       
    }
    else {
        // Handle the case where S_id is null
        $alertMessage = "Invalid slot selected.";
        echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
        echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php
    }   
}

         if(isset($_POST['Unenroll'])){
        $info_json = $_POST['Unenroll'];
        $info = json_decode($info_json, true); // Decode JSON string to array
        $sqlCheckEnrollment = "SELECT * FROM student_selects_slots WHERE Roll_no = ? AND S_id = ? AND subject_name = ? AND t_name = ?";
        $stmtCheckEnrollment = $conn->prepare($sqlCheckEnrollment);
        $stmtCheckEnrollment->bind_param("ssss", $username, $info[0], $info[2], $info[1]);
        $stmtCheckEnrollment->execute();
        $resultCheckEnrollment = $stmtCheckEnrollment->get_result();
    
        if ($resultCheckEnrollment->num_rows > 0) {
            // If enrolled, proceed with unenrollment
            $sqlUnenroll = "DELETE FROM student_selects_slots WHERE Roll_no = ? AND S_id = ? AND subject_name = ? AND t_name = ?";
            $stmtUnenroll = $conn->prepare($sqlUnenroll);
            $stmtUnenroll->bind_param("ssss", $username, $info[0], $info[2], $info[1]);
    
            try {
                if ($stmtUnenroll->execute()) {
                    $alertMessage = "Unenrolled successfully.";
                    echo '<script>alert("' . $alertMessage . '");</script>';
                    $subject = $_SESSION['subject'] ;
                    echo $subject;
                    $deptname = $_SESSION['DEPT'];
                    echo $deptname;
                    echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
                } else {
                    $alertMessage = "Failed to unenroll from the slot.";
                    echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
                    echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
                }
            } catch (Exception $e) {
                $alertMessage = "An error occurred while unenrolling.";
                echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
                echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
            }
        } else {
            // If not enrolled, display alert
            $alertMessage = "You are not enrolled in this slot.";
            echo '<script>alert("' . $alertMessage . '");</script>'; // Display alert message
            echo '<script>window.location.href = "slot.php";</script>'; // Redirect to subjectpage.php
        }
    }
    
    
    $conn->close();

} catch (Exception $e) {
    echo '<script>alert("Error: ' . $e->getMessage() . '");</script>';
    echo '<script>window.location.href = "subjectpage.php";</script>'; // Redirect to subjectpage.php

}
?>

<!-- Your HTML code remains the same -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slot Booking</title>
    <link rel="stylesheet" href="slot.css">
</head>
<body>
    <form action = 'slot.php' method="post">
        <h1>Book your slots:</h1>
        <br><br>
        <hr>
        <div class="slots-container">
            <?php
            if (isset($sub)) {
                $u_tname = array();
                $u_venue = array();
                $info_array = array(3);

                // Get unique teachers after filtering out null values
                foreach ($t_name as $value) {
                    if (!in_array($value, $u_tname)) {
                        $u_tname[] = $value;
                    }
                }

                foreach ($venue as $val) {
                    if (!in_array($val, $u_venue)) {
                        $u_venue[] = $val;
                    }
                }

                $num_venues = count($u_venue);
                $teacher_index = 0;

                for ($i = 0; $i < $num_venues; $i++) {
                    $current_venue = $u_venue[$i];
                    $s = "";
                    $st = "";
                    $current_teacher = $u_tname[$teacher_index];

                    for ($j = 0; $j < count($slots); $j++) {
                        if ($t_name[$j] == $current_teacher && $venue[$j] == $current_venue) {
                            $s .= '' . $slots[$j];
                            $st .= '  ' . $slot_times[$j];
                        }
                    }

                    $info_array[0] = $s;
                    $info_array[1] = $current_teacher;
                    $info_array[2] = $sub;

                    echo '<div class="slot">';
                    echo '<label for="slot">' . $s . ' &nbsp - &nbsp ' . $st . ' &nbsp - &nbsp ' . $current_teacher . ' &nbsp - &nbsp ' . $current_venue . '</label>';
                    echo '&nbsp &nbsp <button type="submit" class="enroll-btn" name="Enroll" value="' . htmlspecialchars(json_encode($info_array)) . '">Enroll</button>';
                    echo '&nbsp &nbsp <button class="unenroll-btn" name="Unenroll" value="' . htmlspecialchars(json_encode($info_array)) . '">Unenroll</button>';
                    echo '</div>';

                    $teacher_index++;

                    if ($teacher_index == count($u_tname)) {
                        $teacher_index = count($u_tname) - 1;
                    }
                }

                // echo '<button name="' . $deptname . '" value="' . $deptname . '"><a href="subjectpage.php"></a></button>';
            }
            ?>
        </div>
    </form>
</body>
</html>