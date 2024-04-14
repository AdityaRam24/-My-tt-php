<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();
    header("Location: http://localhost/test/homepage.php");
    // Check if the div is clicked (sent as a hidden input)
    if (isset($_POST['INFT'])) {
        echo "INFT CHAL RAHA HAI ";
        } 
        else if(isset($_POST['CMPN'])) {
            echo "CMPN CHAL RAHA HAI";
    }
    else{
        echo "nahi chal raha kuch bhi";
    }
} 
?>