<?php
// Establish database connection
$servername = "localhost"; // Assuming your MySQL server is running on the localhost
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "MYTT"; 
$conn_error = "error occured";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch slots from database
$sql = "SELECT * FROM slots"; // Change 'slot_name' to your actual column name
$result = $conn->query($sql);

$slots = array();
$slot_times = array();    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $slots[] = $row['S_id'];
        $slot_times[] = $row['s_time'];
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="slot.css">
</head>
<body>
    
    <div class="container">
        <header>
            <h1>Vidyalankar Institute of Technology</h1>
            <p>Hello, <span id="username"></span> please select your slots </p>
        </header>
        <main>
            <section class="slots">
                <h2>Prof with slot number timing venue with day </h2>
                <ul id="slotList">
                    <?php
                    // Display slots fetched from the database
                    for ($i = 0; $i < count($slots); $i++) {
                        echo "<li>" . $slots[$i] .' &nbsp' . ' &nbsp' . ' &nbsp' . ' &nbsp' . $slot_times[$i] . "</li>";
                    }
                    ?>
                </ul>
            </section>
        </main>
        <footer>
            <p>&copy; 2024 Your Website. All rights reserved.</p>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var username = localStorage.getItem('username');
            var usernameElement = document.getElementById('username');
            if (username) {
                usernameElement.textContent = username;
            } else {
                usernameElement.textContent = 'Guest';
            }
        });
    </script>
</body>
</html>
