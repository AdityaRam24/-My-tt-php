<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my tt"; 


$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
    
    // Close statement
  
    // $sqlsubsArr = "SELECT Subject_name FROM dept_contains where d_name = ".$_SESSION['deptname'];
    $subsArr = array();
    echo $_SESSION['deptname'];
// Fetch slots data based on the subject parameter sent via GET request
?>
