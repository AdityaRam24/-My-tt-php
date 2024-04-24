<?php
include 'config.php';
$error_message = ""; // Initialize error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $sql = "SELECT * FROM Admin WHERE A_name='$username' AND A_password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Redirect to codinator.php if login successful
        header("Location: codinator.php");
        exit; // Ensure that script stops executing after redirection
    } else {
        $error_message = "Invalid username or password."; // Set error message
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if ($error_message) : ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="input-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>