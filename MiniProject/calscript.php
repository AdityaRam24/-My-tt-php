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
    gap :15px;
    border-bottom: 1px solid #e0e0e0;
  }

  .timetable .day .slot {
    flex: 1;
    border-right: 1px solid #e0e0e0;
    padding: 15px 10px;
    text-align: center;
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

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my tt";  // corrected database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$Roll_no = $_SESSION['username'];
$slots = array();
$subject_name = array();
$t_name = array();

$sql = "SELECT S_id, subject_name, t_name FROM student_selects_slots WHERE Roll_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $Roll_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $slots[] = $row['S_id'];
    $subject_name[] = $row['subject_name'];
    $t_name[] = $row['t_name'];
  }
}


$sep_slots = array();
$sep_tname = array();
$sep_sname = array();
$j = 0;
foreach($slots as $s)
{ 
   
    $length = strlen($s);
    for($i = 0 ; $i < $length ; $i += 3)
    {
      $sep_slots[]  = substr($s , $i, 3);
      $sep_tname[] = $t_name[$j];
      $sep_sname[] = $subject_name[$j]; 
    }
    $j++;
}

$All_slots = array();
$sql2 = "SELECT * FROM slots order by CAST(SUBSTRING(S_id FROM 2) AS UNSIGNED)";
$stmt = $conn->prepare($sql2);
$stmt->execute();
$result1 = $stmt->get_result();

if ($result1->num_rows > 0) {
  while ($row = $result1->fetch_assoc()) {
    $All_slots[] = $row['S_id'];
  }
}

$temp_slots = array();
$temp_tname = array();
$temp_sname = array();

foreach($All_slots as $slot)
{
    $index = array_search($slot, $sep_slots);
    if($index !== false)
    {
        $temp_slots[] = $sep_slots[$index];
        $temp_tname[] = $sep_tname[$index];
        $temp_sname[] = $sep_sname[$index];
    }
    else
    {
        $temp_slots[] = '';
        $temp_tname[] = '';
        $temp_sname[] = '';
    }
}
?>

<div class="timetable" id="timetable"></div>

<script>
  var times = ['8:00 - 9:00', '9:00 - 10:00', '10:00 - 11:00', '11:15 - 12:15', '12:15 - 1:15', '1:45 - 2:45', '2:45 - 3:45', '3:45 - 4:45', '4:45 - 5:45', '5:45 - 6:45'];
  var daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
  let slots = <?php echo json_encode($temp_slots); ?>;
  let t_name = <?php echo json_encode($temp_tname); ?>;
  let subject_name = <?php echo json_encode($temp_sname); ?>;

  var timetable = document.getElementById('timetable');
  let html = '';

  // Header row with days of the week
  html += '<div class="day">';
  html += '<div class="time"></div>';
  daysOfWeek.forEach(function(day) {
    html += '<div class="time">' + day + '</div>';
  });
  html += '</div>';

  // Generating timetable slots
  times.forEach(function(time) {
    html += '<div class="day">';
    html += '<div class="time">' + time + '</div>';

    daysOfWeek.forEach(function(day, index) {
      var slot_id = slots[index * times.length + times.indexOf(time)];
      var teacher_name = t_name[index * times.length + times.indexOf(time)];
      var subject = subject_name[index * times.length + times.indexOf(time)];
      html += '<div class="slot" id="' + slot_id + '">' + slot_id + ' - ' + teacher_name + ' - ' + subject + '</div>';
    });

    html += '</div>';
  });

  timetable.innerHTML = html;
</script>

</body>
</html>
