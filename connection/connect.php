<?php
date_default_timezone_set('Asia/Manila');
$tz_time = date("F j, Y g:i:s");

$date = date('Y-m-d H:i:s');
$daytoday = date('Y-m-d');
$day = date('l', strtotime($date));
$week = date('W', strtotime($date));
$year = date('Y', strtotime($date));
$month = date("M d, Y",strtotime($date));
$todaytimestamp = date('Y-m-d H:i');

$yearweek = $year. "-" ."W".$week;

$empdate = $day.", ".$month;


$connection = new mysqli("localhost","root","","empattendanceci");
if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $connection -> connect_error;
  exit();
}
?>