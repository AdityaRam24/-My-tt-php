<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "my tt"; // Corrected database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    
    $password = $_POST['password'];
    
    $sql_student = "SELECT * FROM student WHERE Roll_no = ? AND s_password = ?";
    $stmt_student = $conn->prepare($sql_student);
    $stmt_student->bind_param("ss", $username, $password);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();
    
    $sql_admin = "SELECT * FROM admin WHERE A_name = ? AND A_password = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param("ss", $username, $password);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    
    $sql_coordinator = "SELECT * FROM coordinator WHERE C_name = ? AND C_password = ?";
    $stmt_coordinator = $conn->prepare($sql_coordinator);
    $stmt_coordinator->bind_param("ss", $username, $password);
    $stmt_coordinator->execute();
    $result_coordinator = $stmt_coordinator->get_result();
    
    if ($result_student->num_rows == 1) {
        $_SESSION['username'] = $username;
        var_dump($_SESSION);
        exit();
    } elseif ($result_admin->num_rows == 1) {
        $_SESSION['username'] = $username;
        var_dump($_SESSION);
        exit();
    } elseif ($result_coordinator->num_rows == 1) {
        $_SESSION['username'] = $username;
        var_dump($_SESSION);
        exit();
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="allog.css">
</head>
<body>
   <h2>Login Form</h2>
   <div>
   <form method="post" action="homepage.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <input type="submit" value="Login" name="submit">
   </form>
   <div>
</body>
</html>