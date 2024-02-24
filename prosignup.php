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
    $password = $_POST['password'];
    $des = '..';
    $rating = 0;

    $sql = "INSERT INTO prosignup(business_name, business_category, email, phone_number, local_area, local_address, pass, description, rating) VALUES('$Bname', '$Bcat', '$email', '$num', '$area', '$address', '$password', '$des', '$rating')";
    $res = mysqli_query($dbc, $sql);
    if($res){
        echo true;
    }else{
        echo false;
    }
  }
  mysqli_close($dbc);
?>