<?php
ob_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "MYTT";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    // Prepare and bind SQL statement
    if($role == 'student' || $role == 'Administrator' || $role == 'coordinator') {
        $sql = "SELECT * FROM $role WHERE Roll_no = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            // Login successful
            echo "Login successful!";
            
            // Redirect to homepage
            $redirect_page = 'http://localhost/test/homepage.php';
            header('Location: ' . $redirect_page);
            exit();
        } else {
            // Login failed
            echo "Invalid username or password!";
        }
    } else {
        // Invalid role
        echo 'Invalid role!';
    }
}

// Close connection
$conn->close();
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="adminlogin.css">
</head>
<body>
   <h2>Login Form</h2>
   <form method="post" action="login.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <label for="role">Role:</label>
      <select id="role" name="role">
         <option value="student">Student</option>
         <option value="admin">Administrator</option>
         <option value="coordinator">Coordinator</option>
      </select><br><br>
      
      <input type="submit" value="Login" name="submit">
   </form>
</body>
</html>
