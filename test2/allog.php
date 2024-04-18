<?php
//include 'config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Form</title>
   <link rel="stylesheet" type="text/css" href="allog.css">
</head>
<body>
<form method="post" action="middle.php">
   <h2>Login Form</h2>
   <div>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <input type="submit" value="Login" name="submit">
   </form>
   <div>
</body>
</html>