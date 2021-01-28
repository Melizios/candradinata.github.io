<?php
  //config your database
  $host = "localhost";
  $user = "root";
  $password = "";
  $db = "db_1301160038";
  $conn = mysqli_connect($host, $user, $passwor, $db);
  
  if ($conn->connect_error){
    die("Disconnect. ".$conn->connect_error);
  } 
?>