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
$sql = "SELECT S_id, t_name, s_time FROM slots JOIN is_alloted_to USING(s_id)";
$result = $conn->query($sql);

$slots = array();
$slot_times = array();
$t_name = array();    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $slots[] = $row['S_id'];
        $slot_times[] = $row['s_time'];
        $t_name[] = $row['t_name'];
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
                <div id="slotList">
                    <?php
                    // Display slots fetched from the database as buttons
                    $i = 0;
                    $j = 0;
                    while ($i < count($slots)) {
                        for ($j = $i + 1; $j < count($slots); $j++) {
                            if ($t_name[$i] == $t_name[$j]) {
                                $t1 = $slots[$i];
                                $t2 = $t1 . '+' . $slots[$j];
                                $t = $t_name[$j]; // Check if $slots[$j] exists
                                $st1 = $slot_times[$j];
                                $st2 = $slot_times[$i] . '+' . $st1;
                                echo '<button>' . $t2 . '&nbsp &nbsp &nbsp' . $st2 . '&nbsp &nbsp &nbsp' .  $t_name[$i] . '</button>' . '<br>';
                            }  
                            
                        }
                        $i++;
                        //if ($t_name[$i] == $t) 
                        //{
                          //  continue;
                        //}
                    }
                    ?>
                </div>
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
