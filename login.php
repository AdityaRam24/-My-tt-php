<?php
// Database connection
$servername = "localhost"; // Assuming your MySQL server is running on the localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "MYTT"; // Change this to your MySQL database name
$conn_error = "error occured";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Hash the password (You should use a more secure hashing algorithm like bcrypt)
    
    // Query to check if the username and password match in the database
    $sql = "SELECT * FROM student WHERE Roll_no='$username' AND s_password='$password'";
    
    $result = mysqli_query($conn, $sql);
    $url = 'http://localhost/test/homepage.php'; 
    if(isset($_POST['submit'])) {
    if (mysqli_num_rows($result) == 1) {
        // Login successful
        echo "Login successful!";
        // Redirect to a welcome page or dashboard
        // header("Location: welcome.php");
        header('Location : ' .$url);
        exit();
        
    } else {
        // Login failed
        echo "Invalid username or password!";
    }
    }
}

// Close connection
mysqli_close($conn);
?>


<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
   <h2>Login Form</h2>
   <form method="post" action="login.php">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="Login"  name = "submit">
   </form>
</body>
</html>


