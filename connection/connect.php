<?php
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');

$connection = new mysqli("localhost","root","","empattendanceci");
if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connection -> connect_error;
  exit();
}
?>