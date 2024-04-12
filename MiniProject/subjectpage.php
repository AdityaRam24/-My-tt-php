<?php
    session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "my tt"; // Corrected the database name
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Initialize variables
    $subject_mand = [];
    $subject_alc = [];
?>
<a href="slot.php"></a>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['INFT'])) {
            $sql1 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'INFT' AND subject_type = 'MAND'";
            $sql2 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'INFT' AND subject_type = 'ALC'";
            $deptname = "INFT";
            $_SESSION['deptname']='INFT';
        } elseif (isset($_POST["CMPN"])) {
            $sql1 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'CMPN' AND subject_type = 'MAND'";
            $sql2 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'CMPN' AND subject_type = 'ALC'";
            $deptname = "CMPN";
            $_SESSION['deptname']='CMPN';
        } elseif (isset($_POST["EXTC"])) {
            $sql1 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'EXTC' AND subject_type = 'MAND'";
            $sql2 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'EXTC' AND subject_type = 'ALC'";
            $deptname = "EXTC";
            $_SESSION['deptname']='EXTC';
        } elseif (isset($_POST["EXCS"])) {
            $sql1 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'EXCS' AND subject_type = 'MAND'";
            $sql2 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'EXCS' AND subject_type = 'ALC'";
            $deptname = "EXCS";
            $_SESSION['deptname']='EXCS';
        } elseif (isset($_POST["BIOM"])) {
            $sql1 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'BIOM' AND subject_type = 'MAND'";
            $sql2 = "SELECT Subject_name FROM dept_contains join subject using(subject_name) WHERE D_name = 'BIOM' AND subject_type = 'ALC'";
            $deptname = "BIOM";
            $_SESSION['deptname']='BIOM';
        } else {
            // Handle case where no POST data is received
            echo "No POST data received";
            exit; // Exit the script
        }
        $stmt1 = $conn->prepare($sql1);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        $stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        // Fetch results
        while ($row1 = $result1->fetch_assoc()) {
            $subject_mand[] = $row1["Subject_name"];
        }

        while ($row2 = $result2->fetch_assoc()) {
            $subject_alc[] = $row2["Subject_name"];
        }

        // Close statements
        $stmt1->close();
        $stmt2->close();
    } else {
        echo "No POST data received";
        exit; // Exit the script
    }
   
    // Close connection
    $conn->close();
        // Prepare and execute SQL queries
       
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subjects</title>
    <link rel="stylesheet" href="subjectpagestyle.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        if(window.history.replaceState){
            window.history.replaceState(null,null,window.location.href)
        }
    </script>
</head>
<body>
    <form action = "slot.php" method = "POST">
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

        </div>
        <div class="main">
            <div class="nav-tab">
            <ul class="sitePages">
                <li id="myCourses"><a href="myCourses.php">My Courses</a></li>
                <li id="siteBlogs"><a href="siteBlogs.php">Site Blogs</a></li>
                <li id="siteBadges"><a href="siteBadges.php">Site Badges</a></li>
                <li id="Tags"><a href="Tags.php">Tags</a></li>
                <li id="siteAnn"><a href="siteAnn.php">Site Announcements</a></li>
            </ul>

            </div>
            <div class="subjects">
                <h2 id="MS">Mandatory Subjects:</h2>
                <div class="subject1">
                    <?php
                        foreach ($subject_mand as $subject) {
                            echo '<div class="MAND" id="MAND"><button type ="submit" value="'.$subject.'" name="subject_mand" style="background-color: transparent;border: 2px solid transparent; outline: none;  height: 100px; width: 100px; border-radius: 2rem;">'.$subject.'</button></div>';
                            
                        }
                    ?>
                </div>
                <h2 id="ALC">ALC Subjects:</h2>
                <div class="subject2">
                    <?php
                        foreach ($subject_alc as $subject1) {
                            echo '<div class="ALC" id="ALC"><button type ="submit" value="'.$subject1.'" name="subject_alc" style="background-color: transparent;border: 2px solid transparent; outline: none;  height: 100px; width: 100px; border-radius: 2rem;">'.$subject1.'</button></div>';
                        }

                    ?>
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
</body>
</html>
