<?php

  header('Access-Control-Allow-Origin: *');

  DEFINE('DB_USER', 'root');
  DEFINE('DB_PASSWORD', '');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_NAME', 'handypro');
  $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if(!$dbc){
    trigger_error('could not connect to mysql: ' . mysqli_connect_error());
  }else{
    $des = $_POST['des'];
    $email = $_POST['email'];
     
    $sql = "UPDATE prosignup Set description = '$des' WHERE email = '$email'";
    $res = mysqli_query($dbc, $sql);
    if($res){
        echo true;
    }else{
        echo false;
    }
  }
  mysqli_close($dbc);
?>