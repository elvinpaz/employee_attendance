<?php

session_start();
require 'connection/connect.php';

if (isset($_POST['submit'])) {

    $username = $_POST['email'];
    $password = $_POST['password'];
    $access="";

    $count=0;

    echo $username;
    echo $password;

    $query = "SELECT * FROM user WHERE email = '".$username."' AND password = '".$password."' AND status = 1 AND has_account = 1 ";
    $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
           
                $count++;

                $access = $row['role'];

            }
        }

        if($count == 0){
            
            header("location: index.php?usermsg=Sorry! Wrong email or password.");
            
        }else{

            
            $_SESSION['access'] = $access;

            
            if ($_SESSION['access'] == "Admin") {

                header("location: admin/dashboard/dashboard.php");
            
            }


        }

        echo "testing";

}



