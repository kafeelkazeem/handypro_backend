<?php
  header('Access-Control-Allow-Origin: *');
  $arr = null;
  DEFINE('DB_USER', 'root');
  DEFINE('DB_PASSWORD', '');
  DEFINE('DB_HOST', 'localhost');
  DEFINE('DB_NAME', 'handypro');
  $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  if(!$dbc){
    trigger_error('could not connect to mysql: ' . mysqli_connect_error());
  }else{
    // Retrieve POST data
    $email = $_POST['eml'];
    $password = $_POST['pswd'];

    // Sanitize user inputs
    $email = mysqli_real_escape_string($dbc, $email);
    $password = mysqli_real_escape_string($dbc, $password);

    $sql = "SELECT * FROM signup WHERE email = '$email' limit 1";
    $res = mysqli_query($dbc, $sql);

    if($res){
      if(mysqli_num_rows($res) > 0){
          $d = mysqli_fetch_assoc($res);
          if($d['password'] == $password){
            $arr = array('message'=> 'logged in', 'link' => 'true', 'name' => $d['fullName'], 'email' => $d['email'], 'number' => $d['phoneNumber'], 'area' => $d['localArea'], 'address' => $d['address']);
            echo json_encode($arr);
          }else{
            $arr = array('message'=> 'Wrong username or password', 'link' => 'false');
            echo json_encode($arr);
          }
      }
    }
  }
  mysqli_close($dbc);
?>