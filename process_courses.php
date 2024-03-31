<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle the submitted courses
    if (isset($_POST["courses"]) && !empty($_POST["courses"])) {
        $selected_courses = $_POST["courses"];
        // Process the selected courses, e.g., store in the database, perform any necessary operations
        echo "<h2>Selected Courses:</h2>";
        echo "<ul>";
        foreach ($selected_courses as $course) {
            echo "<li>$course</li>";
        }
        echo "</ul>";
    } else {
        echo "Please select at least one course.";
    }
} else {
    echo "Invalid request.";
}
?>
