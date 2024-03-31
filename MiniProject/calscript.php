<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Timetable</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
  }

  .timetable {
    margin: 20px auto;
    max-width: 800px;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }

  .timetable .time {
    flex: 0 0 auto;
    width: 100px;
    text-align: center;
    background-color: #f8f8f8;
    border-right: 1px solid #e0e0e0;
    padding: 15px 10px;
    font-weight: bold;
  }

  .timetable .day {
    display: flex;
    border-bottom: 1px solid #e0e0e0;
  }

  .timetable .day .slot {
    flex: 1;
    border-right: 1px solid #e0e0e0;
    padding: 15px 10px;
  }

  .timetable .day .slot:last-child {
    border-right: none;
  }

  .timetable .day:nth-child(odd) {
    background-color: #f9f9f9;
  }

  .timetable .day:nth-child(even) {
    background-color: #fafafa;
  }

  @media (max-width: 600px) {
    .timetable .time {
      width: 80px;
    }

    .timetable .slot {
      padding: 10px 5px;
    }
  }
</style>
</head>
<body>

<div id="timetable" class="timetable"></div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var timetable = document.getElementById('timetable');

  var times = ['8:00 -9:00', '9:00-10:00', '10:00-11:00', '11:15-12:15', '12:15-1:15', '1:45-2:45', '2:45-3:45', '3:45-4:45', '4:45-5:45', '5:45-6:45'];
  var daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];

  var html = '';

  // Header row with days of the week
  html += '<div class="day">';
  html += '<div class="time"></div>';
  for (var i = 0; i < daysOfWeek.length; i++) {
    html += '<div class="slot">' + daysOfWeek[i] + '</div>';
  }
  html += '</div>';

  // Generating timetable slots
  for (var j = 0; j < times.length; j++) {
    html += '<div class="day">';
    html += '<div class="time">' + times[j] + '</div>';
    for (var k = 0; k < daysOfWeek.length; k++) {
      html += '<div class="slot"></div>'; // Empty slot
    }
    html += '</div>';
  }

  timetable.innerHTML = html;
});
</script>

</body>
</html>
