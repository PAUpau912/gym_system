<?php

include_once("connections/connection.php"); 

$con = connection();

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $sql = "DELETE FROM coach WHERE CoachID = '$id'";
    $query_run = mysqli_query($con, $sql);   

    if($query_run){
        echo '<script> alert("Data Deleted"); </script>';
        header('location: coach.php');
    }
    else{
        echo '<script> alert("Data Not Deleted"); </script>';

    }  
    
}