<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="style1.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container">
        <div class="navbar">
            <div class="nav-img1">
                <img src="VITVL2_1.png" >
            </div>
            <div class="nav-icon">
                <div class="nav-icon1">
                    <i class="fa-regular fa-bell"></i>
                </div>
                <div class="nav_icon2">
                <i class="fa-regular fa-message"></i>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="nav-tab">
                <ul class="sitePages" style="list-style-type: none;">Site Pages
                    <li id="myCourses"></li> <a href="myCourses.in" style="text-decoration: none;">My Courses></a>
                    <li id="siteBlogs"></li> <a href="siteBlogs.in"style="text-decoration: none;">Site Blogs></a>
                    <li id="siteBadges"></li><a href="siteBadges.in"style="text-decoration: none;">Site Badges></a>
                    <li id="Tags"></li><a href="Tags.in"style="text-decoration: none;">Tags></a>
                    <li id="siteAnn"></li><a href="siteAnn.in"style="text-decoration: none;">Site Announcements></a>
                </ul>
            </div>
            <div class="subjects">
                <h2>Mandatory Subjects: </h2>
                <div class="EM4" onclick="redirect()">EM4</div>
                <div class="CN" onclick="redirect()">CN</div>
                <div class="OS" onclick="redirect()">OS</div>
                <div class="DBMS" onclick="redirect()">DBMS</div>
                <div class="PEM" onclick="redirect()">PEM </div>
                <h2>ALC Subjects: </h2>
                <div class="AT" onclick="redirect()">AT </div>
                <div class="SEWDL" onclick="redirect()">SEWDL </div>
            </div>
        </div>
        <div class="footer">
            <div class="nav-icon3"><i class="fa-regular fa-envelope"></i></div>
            <p id="first" href="contactsitesupport">Contact Site Support</p>
            <p id="second">You are logged in as</p>
            <p id="third" href="StudentName">std Name</p>
        </div>
    </div>

    <script>
        function redirect() {
            // Redirect to the slot booking page using JavaScript
            window.location.href = 'slot.php';
        }
    </script>
</body>
</html>
