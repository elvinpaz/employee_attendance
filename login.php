<?php

session_start();
require 'connection/connect.php';

if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name="";
    $access="";
    $status="";

    $count=0;

    $query = "SELECT * FROM teacher WHERE teacher_email = '".$username."' AND teacher_password = '".$password."' AND status = 'Activate' ";
    $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
           
                $count++;

                $name = $row['teacher_name'];
                $status = $row['status'];
                $access = $row['access'];

            }
        }

        if($count == 0){
            
            header("location: index.php?usermsg=Sorry! Wrong LRN or password.");
            
        }else{

            $_SESSION['name'] = $name;
            $_SESSION['access'] = $access;
            $_SESSION['status'] = $status;

            

            if ($_SESSION['access'] == "student") {

                header("location: dashboard.php");
            
            }



        }

}



