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
   // Retrieve POST data
   $email = $_POST['eml'];
   $password = $_POST['pswd'];

   // Sanitize user inputs
   $email = mysqli_real_escape_string($dbc, $email);
   $password = mysqli_real_escape_string($dbc, $password);

   $sql = "SELECT * FROM prosignup WHERE email = '$email' limit 1";
   $res = mysqli_query($dbc, $sql);

   if($res){
     if(mysqli_num_rows($res) > 0){
         $d = mysqli_fetch_assoc($res);
         if($d['pass'] == $password){
           $arr = array('message'=> 'logged in', 'link' => 'true', 'Bname' => $d['business_name'], 'Bcat' => $d['business_category'], 'eml'=> $d['email'], 'num' => $d['phone_number'], 'area' => $d['local_area'], 'address' => $d['local_address'], 'pass' => $d['pass'], 'des' => $d['description'], 'rating' => $d['rating']);
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