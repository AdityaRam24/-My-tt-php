<?php
$servername = "localhost"; // Assuming your MySQL server is running on the localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "MYTT"; // Change this to your MySQL database name
session_start();
// Create connection

$conn = new mysqli($servername, $username, $password, $database);

$sql = ""; // Default value for $sql

if(isset($_SESSION['INFT'])) {

    $sql = "SELECT  Subject_name FROM dept_contains where D_name = 'INFT'";
} else if(isset($_SESSION['CMPN'])) {
    $sql = "SELECT Subject_name FROM dept_contains where D_name = 'CMPN'";
}
    $result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">Subject_name
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="subjectpagestyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action = 'testslots.php' method = 'post'>
    <div class="container">
        <div class="navbar">
            <div class="nav-img1">
                <img src="VITVL2_1.png" alt="Logo">
            </div>
            <div class="nav-icon">
                <div class="nav-icon1">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="nav-icon2">
                    <i class="fa-regular fa-message"></i>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="nav-tab">
                <ul class="sitePages">Site Pages
                    <li id="myCourses"><a href="myCourses.in">My Courses</a></li>
                    <li id="siteBlogs"><a href="siteBlogs.in">Site Blogs</a></li>
                    <li id="siteBadges"><a href="siteBadges.in">Site Badges</a></li>
                    <li id="Tags"><a href="Tags.in">Tags</a></li>
                    <li id="siteAnn"><a href="siteAnn.in">Site Announcements</a></li>
                </ul>
            </div>
            <div class="subjects">
                <h2 id="MS">Mandatory Subjects:</h2>
                <div class="subject1">
                   <?php
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<div class='subject' onclick='redirect()'>" . $row["subject_name"] . "</div>";
                            }
                        } else {
                            echo "0 results";
                        }

                        // Close connection
                        $conn->close();
                    ?>


                    </div>
                    <h2 id="ALC">ALC Subjects:</h2>
                <div class="subject2">
                    <div class="subject" id = "AT" onclick="redirect()">AT</div>
                    <div class="subject" id = "SEWDL" onclick="redirect()">SEWDL</div>
                </div>
            </div>
        </div>
        <div class="footer">
            <div class="nav-icon3"><i class="fa-regular fa-envelope"></i></div>
            <p id="first" href="contactsitesupport">Contact Site Support</p>
            <p id="second">You are logged in as</p>
            <p id="third" href="StudentName">std Name</p>
        </div>
    </div>
</form>
    <script>
        function redirect() {
            // Redirect to the slot booking page using JavaScript
            window.location.href = 'testslots.php';
        }
    </script>
</body>
</html>



<div class="subject" id = "EM4" onclick="redirect()">EM4</div>
                    <div class="subject" id = "CN" onclick="redirect()">CN</div>
                    <div class="subject" id = "OS" onclick="redirect()">OS</div>
                    <div class="subject" id = "DBMS" onclick="redirect()">DBMS</div>
                    <div class="subject" id = "PEM" onclick="redirect()">PEM</div>