<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Timetable</title>
  <link rel="stylesheet" href="cal.css">
</head>
<body>
  <div id="timetable" class="timetable">
    <h2>This is Your personalized Time Table </h2>
    <?php
     
    // Define the times and days of the week arrays
    $times = ['8:00 -9:00', '9:00-10:00', '10:00-11:00', '11:15-12:15', '12:15-1:15', '1:45-2:45', '2:45-3:45', '3:45-4:45', '4:45-5:45', '5:45-6:45'];
    $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

    // Generate the timetable HTML content
    echo '<div class="day">';
    echo '<div class="time"></div>';
    foreach ($daysOfWeek as $day) {
      echo '<div class="slot">' . $day . '</div>';
    }
    echo '</div>';

    foreach ($times as $time) {
      echo '<div class="day">';
      echo '<div class="time">' . $time . '</div>';
      foreach ($daysOfWeek as $day) {
        echo '<div class="slot"></div>';
      }
      echo '</div>';
    }
    ?>
  </div>
</body>
</html>
