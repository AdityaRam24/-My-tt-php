<?php
include 'session_start.php';
include 'config.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['INFT'])) {
    //$_SESSION['deptname'] = $_POST["INFT"];
    $_SESSION['dept'] ='INFT';
} elseif (isset($_POST["CMPN"])) {
    //$_SESSION['deptname']= $_POST["CMPN"];
    $_SESSION['dept']= "CMPN";
} elseif (isset($_POST["EXTC"])) {
    //$_SESSION['deptname']= $_POST["EXTC"];
    $_SESSION['dept']= "EXTC";
} elseif (isset($_POST["EXCS"])) {
   // $_SESSION['deptname']= $_POST["EXCS"];
    $_SESSION['dept']= "EXCS";
} elseif (isset($_POST["BIOM"])) {
    //$_SESSION['deptname']= $_POST["BIOM"];
    $_SESSION['dept']= "BIOM";
}
try{
$sql= "select f_name , l_name from student where Roll_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $_SESSION['f_name'] = $row['f_name'];
    $_SESSION['l_name'] = $row['l_name'];
   
    } 
catch(Exception $e)
{
    $f_name = 'Jon';
    $l_name = "Doe";
}
}

$subject_mand = [];
$subject_alc = [];


    if (isset($_SESSION['dept']) ) {
        $sql1 = "SELECT Subject_name FROM dept_contains JOIN subject USING(subject_name) WHERE D_name = '".$_SESSION['dept']."' AND subject_type = 'MAND'";
        $sql2 = "SELECT Subject_name FROM dept_contains JOIN subject USING(subject_name) WHERE D_name = '".$_SESSION['dept']."' AND subject_type = 'ALC'";
    } 
    
    else {
        echo "Invalid department name.";
        exit;
    }

    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    while ($row1 = $result1->fetch_assoc()) {
        $subject_mand[] = $row1["Subject_name"];
    }
    while ($row2 = $result2->fetch_assoc()) {
        $subject_alc[] = $row2["Subject_name"];
    }

    $stmt1->close();
    $stmt2->close();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($subject_mand as $subject) {
        if (isset($_POST['subject_mand'])) {
            $_SESSION['subject'] = $_POST['subject_mand'];
        }
    }

    foreach ($subject_alc as $subject1) {
        if (isset($_POST['subject_alc'])) {
            $_SESSION['subject'] = $_POST['subject_alc'];
        }
    }
    }

$conn->close();
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
    <form action="slot.php" method="POST">
        <div class="container">
            <div class="navbar">
                <div class="nav-img1">
                    <img src="VITVL2_1.png" alt="Logo">
                </div>
              
            </div>
            <div class="main">
                <div class="nav-tab">
                <h3>More from Vidyalankar</h3>
                <br><br>
                    <ul class="sitePages" style="list-style-type: none;">
                    <li id="MyTimeTable"><a href="calscript.php" style="text-decoration: none;">My Courses</a></li>
                    <li id="ERP LOGIN "><a href="https://erp.mycollege.edu.in/landingpage.ashx"  style="text-decoration: none;">ERP LOGIN </a></li>
                    <li id="V-Print"><a href="http://vprint.vit.edu.in:9191/user" onclick="loadPage('http://vprint.vit.edu.in:9191/user')" style="text-decoration: none;">V-Print</a></li>
                    <li id="Campus Connet"><a href="https://a.impartus.com/login/#/" onclick="loadPage('https://a.impartus.com/login/#/')" style="text-decoration: none;">Campus Connect</a></li>
                    <li><a href="logout.php" style="text-decoration: none; color: red; display: inline-block; height: 100%; width: 100%; font-size:1rem;font: weight 1000px;">LOG OUT</a></li>    
                    </ul>
                </div>
                <div class="subjects">
                    <h2 id="MS">Mandatory Subjects:</h2>
                    <div class="subject1">
                        <?php foreach ($subject_mand as $subject): ?>
                            <div class="subject-button">
                                <button type="submit" value="<?= $subject ?>" name="subject_mand" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"><?= $subject ?></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <h2 id="ALC">ALC Subjects:</h2>
                    <div class="subject2">
                        <?php foreach ($subject_alc as $subject1): ?>
                            <div class="subject-button">
                                <button type="submit" value="<?= $subject1 ?>" name="subject_alc" style="background-color: transparent; border: 2px solid transparent; outline: none; height: 100px; width: 100px; border-radius: 2rem;"><?= $subject1 ?></button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="footer">
                <div class="nav-icon3">
                    <i class="fa-regular fa-envelope"></i>
                </div>
                <p id="first" href="contactsitesupport">Contact Site Support</p>
                <p id="second">You are logged in as</p>
                <p id="third" href="StudentName"><?php echo $_SESSION['f_name'] .' '.$_SESSION['l_name'] ;?></p>
            </div>
        </div>
    </form>
</body>
</html>