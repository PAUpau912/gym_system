<?php
function connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "gym_system";

    $conn = new mysqli($host, $username, $password, $database);
    if($conn->connect_error){
       echo "";
    }else{return $conn;}
}
?>