<?php
date_default_timezone_set('Asia/Manila');
$tz_time = date("F j, Y g:i:s");

$date = date('Y-m-d H:i:s');
$daytoday = date('Y-m-d');
$todaytimestamp = date('Y-m-d H:i');
$filetimestamp = date('YmdHis');

$day = date('l', strtotime($date));
$week = date('W', strtotime($date));
$year = date('Y', strtotime($date));
$month = date("M d, Y",strtotime($date));
$yearweek = $year. "-" ."W".$week;
$empdate = $day.", ".$month;


$connection = new mysqli("localhost","root","","empattendanceci");
if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connection -> connect_error;
  exit();
}

  $query = "SELECT * FROM roles";
  $result = mysqli_query($connection, $query);
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $co = $row['major'];
    }
  }
?>

<script>
    window.onload = function() {
    document.getElementById('co').innerHTML = <?php echo json_encode($coo)?>
}
</script>