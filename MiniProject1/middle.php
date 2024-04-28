<?php
include 'session_start.php';
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql= "select Roll_no as username , s_password as pass from student where Roll_no = ? and s_password = ? union select A_name as username , A_password as pass from admin where A_name = ? and A_password = ? union select C_name as username , C_password as pass from coordinator where C_name = ? and C_password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $username, $password, $username, $password, $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result -> num_rows == 1) {
        while ($row = $result->fetch_assoc()) {
            $_SESSION['username'] = $row['username'];
        }
        include 'homepage.php';
    } else {
        echo "Invalid username or password!";
        include 'allog.php';
    }
    
    }
}

?>