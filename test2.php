<?php
$redirect_page = 'http://localhost/test/homepage.php';

if(isset($_POST['redirect'])){
    $redirect = true;
    if ($redirect == true) {
        header('Location: ' . $redirect_page);
        exit(); // Always exit after sending a Location header
    }
}
?>
<form action='test2.php' method='post'>
    <input type='submit' name='redirect' value='redirect me' style="background-color: yellow;">
</form>