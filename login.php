<?php

session_start();
require 'connection/connect.php';

if (isset($_POST['submit'])) {

    $username = $_POST['email'];
    $password = $_POST['password'];
    $access="";
    $empid="";

    $count=0;

    echo $username;
    echo $password;

    $query = "SELECT * FROM user WHERE email = '".$username."' AND password = '".$password."' AND status = 1 AND has_account = 1 ";
    $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
           
                $count++;

                $access = $row['role'];
                $empid = $row['employee_id'];

            }
        }

        if($count == 0){
            
            header("location: index.php?usermsg=Sorry! Wrong email or password.");
            
        }else{

            
            $_SESSION['access'] = $access;
            $_SESSION['emp_id'] = $empid;

            
            if ($_SESSION['access'] == "Admin") {

                header("location: admin/dashboard/dashboard.php");
            
            }else if ($_SESSION['access'] == "Employee") {

                header("location: employee/dashboard/dashboard.php");
            
            }


        }

        echo "testing";

}



