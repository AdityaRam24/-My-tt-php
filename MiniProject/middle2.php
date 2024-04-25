<?php
include 'session_start.php';
include 'config.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    if(isset($_POST['Enroll'])){
        include 'subjectpage.php';
    }
    elseif(isset($_POST['Unenroll'])){
        include 'slot.php';
    }
}
?>