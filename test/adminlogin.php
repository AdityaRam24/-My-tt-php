<?php
$servername = "localhost"; // Assuming your MySQL server is running on the localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "MYTT"; // Change this to your MySQL database name

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
    if($role == 'student')
    {
        $sql = "SELECT * FROM student;";
    }
    else if($role == 'Administrator')
    {
        $sql = "SELECT * FROM admin;";

    }
    else if($role == 'coordinator')
    {
        $sql = "SELECT * FROM coordinator;";

    }
    // Prepare and bind SQL statement
    else 
    {
        echo 'something went wrong';
    }

    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $role);
    
    // Execute the statement
    $stmt->execute();
    
    // Get result
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        // Login successful
        echo "Login successful!";
        // Redirect to a welcome page or dashboard
        // header("Location: welcome.php");
        $redirect_page = 'http://localhost/test/homepage.php';

        if(isset($_POST['Login'])){
            $redirect = true;
            if ($redirect == true) {
                header('Location : http://localhost/test/homepage.php');
                exit(); // Always exit after sending a Location header
            }
}
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
         <option value="Administrator">Administrator</option>
         <option value="coordinator"> coordinator </option>
      </select><br><br>
      
      <input type="submit" value="Login"  name="submit">
   </form>
</body>
</html>
