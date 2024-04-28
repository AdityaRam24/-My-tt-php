<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "my tt"; // Corrected database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if(isset($_SESSION['username']))
{$username = $_SESSION['username'];}

if(isset($_SESSION['dept']))
{
    $dept = $_SESSION['dept'];
}
?>





