<?php

include_once("connections/connection.php"); 

$con = connection();

if(isset($_POST['delete']))
{
    $id = $_POST['id'];
    $sql = "DELETE FROM member WHERE MemberID = '$id'";
    $query_run = mysqli_query($con, $sql);   

    if($query_run){
        echo '<script> alert("Data Deleted"); </script>';
        header('location: member.php');
    }
    else{
        echo '<script> alert("Data Not Deleted"); </script>';

    }  
    
}
?>