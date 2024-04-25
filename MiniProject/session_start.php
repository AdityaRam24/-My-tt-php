<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['username']))
{$username = $_SESSION['username'];}

if(isset($_SESSION['dept']))
{
    $dept = $_SESSION['dept'];
}
if(isset($_SESSION['subject']))
{
    $sub = $_SESSION['subject'];
}
?>