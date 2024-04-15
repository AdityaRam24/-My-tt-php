<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers Page</title>
    <link rel="stylesheet" href="prof.css">
</head>
<body>
    <div class="container">
        <h2>Select a Professor:</h2>
        <div class="main">
            <div class="professors">
                <?php
                // Database connection
                $servername = "localhost"; // Assuming your MySQL server is running on the localhost
                $username = "root"; // Change this to your MySQL username
                $password = ""; // Change this to your MySQL password
                $database = "mytt"; // Change this to your MySQL database name
                $conn = mysqli_connect($servername, $username, $password, $database);

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Fetch teacher data from the database
                $sql = "SELECT * FROM teachers"; // Assuming you have a table named 'teachers'
                $result = mysqli_query($conn, $sql);

                // Check if there are any teachers
                if (mysqli_num_rows($result) > 0) {
                    // Output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='professor'>";
                        echo "<div class='prof-img'>";
                        echo "<img src='" . $row['image_url'] . "' alt='" . $row['name'] . "'>";
                        echo "</div>";
                        echo "<div class='prof-details'>";
                        echo "<h3>" . $row['name'] . "</h3>";
                        echo "<p>Department: " . $row['department'] . "</p>";
                        echo "<p>Email: " . $row['email'] . "</p>";
                        // Add more details as needed
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No teachers found.";
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</body>
</html>
