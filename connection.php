<?php

    $con = mysqli_connect('localhost','root');
    if(!$con){
        echo 'not connected';
    }

    $db= mysqli_select_db($con,'wp_project');
    if(!$db){
        echo 'database not connected';
    }
?>