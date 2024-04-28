<?php
session_start(); // Start session if not already started

$servername = "localhost";
$username = "root";
$password = "";
$database = "my tt";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    if ($role == 'student') {
        $sql = "SELECT * FROM student WHERE Roll_no = ? AND s_password = ?";
    } else if ($role == 'Administrator') {
        $sql = "SELECT * FROM admin WHERE A_name = ? AND A_password = ?";
    } else if ($role == 'coordinator') {
        $sql = "SELECT * FROM coordinator WHERE C_name = ? AND C_password = ?";
    } else {
        echo 'Something went wrong';
        exit();
    }
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    
    $stmt->execute();
    
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        // Login successful
        echo "Login successful!";
        // After successful authentication
        $_SESSION['username'] = $username; // Set username in session

        // Redirect to slot.php or any other page
        header("Location: homepage.php");
        exit();
    } else {
        // Login failed
        echo "Invalid username or password!";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
   <h2>Login Form</h2>
   <div>
   <form method="post" action="login.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <label for="role">Role:</label>
      <select id="role" name="role">
         <option value="student">Student</option>
         <option value="Administrator">Administrator</option>
         <option value="coordinator">Coordinator</option> <!-- Corrected role name -->
      </select><br><br>
      
      <input type="submit" value="Login" name="submit">
   </form>
   <div>
</body>
</html>
