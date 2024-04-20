<?php
include 'session_start.php';
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
    
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Student login
        $sql= "SELECT Roll_no, s_password FROM student WHERE Roll_no = ? AND s_password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        // Admin login
        $sql1 = "SELECT A_name, A_password FROM admin WHERE A_name = ? AND A_password = ?";
        $stmt1 = $conn->prepare($sql1);
        $stmt1->bind_param("ss", $username, $password);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        // Coordinator login
        $sql2 = "SELECT C_name, C_password FROM coordinator WHERE C_name = ? AND C_password = ?";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("ss", $username, $password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result->num_rows == 1) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION['student_username'] = $row['Roll_no']; // Using 'Roll_no' for student
            }
            include 'homepage.php';
        }
        elseif($result1->num_rows == 1) {
            while ($row = $result1->fetch_assoc()) {
                $_SESSION['admin_username'] = $row['A_name']; // Using 'A_name' for admin
            }
            include 'homepage.php';
        }
        elseif($result2->num_rows == 1) {
            while ($row = $result2->fetch_assoc()) {
                $_SESSION['coordinator_username'] = $row['C_name']; // Using 'C_name' for coordinator
            }
            include 'codinator.php';
        } else {
            echo "Invalid username or password!";
            include 'allog.php';
        }
    }
}
?>
