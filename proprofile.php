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
    $Bname = $_POST['Bname'];
    $Bcat = $_POST['Bcat'];
    $email = $_POST['email'];
    $num = $_POST['num'];
    $area = $_POST['area'];
    $address = $_POST['address'];
     
    $sql = "UPDATE prosignup Set business_name = '$Bname', business_category = '$Bcat', email = '$email', phone_number = '$num', local_area = '$area', local_address = '$address' WHERE email = '$email'";
    $res = mysqli_query($dbc, $sql);
    if($res){
        echo true;
    }else{
        echo false;
    }
  }
  mysqli_close($dbc);
?>