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
    while ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['username'];
        echo $row['username'].'<br>';
    }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="homepagestyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <form action="subjectpage.php" method="post">

        <div class="container">
            <div class="navbar">
                <div class="nav-img1">
                    <img src="VITVL2_1.png" >
                </div>
                <div class="nav-icon">
                    <div class="nav-icon1">
                        <i class="far fa-bell"></i>
                    </div>
                    <div class="nav_icon2">
                        <i class="far fa-message"></i>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="nav-tab">
                    <h3>Site Pages</h3>
                    <ul class="sitePages" style="list-style-type: none;">
                        <li id="myCourses"><a href="myCourses.in" style="text-decoration: none;">My Courses</a></li>
                        <li id="siteBlogs"><a href="siteBlogs.in" style="text-decoration: none;">Site Blogs</a></li>
                        <li id="siteBadges"><a href="siteBadges.in" style="text-decoration: none;">Site Badges</a></li>
                        <li id="Tags"><a href="Tags.in" style="text-decoration: none;">Tags</a></li>
                        <li id="siteAnn"><a href="siteAnn.in" style="text-decoration: none;">Site Announcements</a></li>
                    </ul>
                </div>
                <div class="branch">
                    <div class="INFT" id="INFT"><input type="submit" name="INFT" value="INFT" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"></div>
                    <div class="CMPN" id="CMPN"><input type="submit" name="CMPN" value="CMPN" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"></div>
                    <div class="EXCS" id="EXCS"><input type="submit" name="EXCS" value="EXCS" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"></div>
                    <div class="EXTC" id="EXTC"><input type="submit" name="EXTC" value="EXTC" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"></div>
                    <div class="BIOM" id="BIOM"><input type="submit" name="BIOM" value="BIOM" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"></div>
                </div>
            </div>
            <div class="footer">
                <div class="nav-icon3"><i class="far fa-envelope"></i></div>
                <a id="first" href="contactsitesupport">Contact Site Support</a>
                <p id="second">You are logged in as</p>
                <a id="third" href="StudentName">std Name</a>
            </div>
        </div>
    </form>
</body>
</html>