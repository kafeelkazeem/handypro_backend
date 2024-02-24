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
    $rating = $_POST['rating'];
    $email = $_POST['email'];

    $sql1 = "SELECT * FROM prosignup WHERE email = '$email' limit 1";
    $res1 = mysqli_query($dbc, $sql1);

    if($res1){
      if(mysqli_num_rows($res1) > 0){
          $d = mysqli_fetch_assoc($res1);
          if($d['rating'] == 0){
            $rating = $rating;
          }else{
            $rating = round(($d['rating'] + $rating)/2);
          }
      }
    }
    $sql2 = "UPDATE prosignup Set rating = '$rating' WHERE email = '$email'";
    $res2 = mysqli_query($dbc, $sql2);
    if($res2){
        echo $rating;
    }else{
        echo false;
    }
  }
  mysqli_close($dbc);
?>