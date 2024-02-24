<?php
header('Access-Control-Allow-Origin: *');

DEFINE('DB_USER', 'root');
DEFINE('DB_PASSWORD', '');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'handypro');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$dbc) {
    trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
} else {
    $cat = $_POST['cat'];
    $area = $_POST['area'];

    $cat = mysqli_real_escape_string($dbc, $cat);
    $area = mysqli_real_escape_string($dbc, $area);

    $sql = "SELECT * FROM prosignup WHERE business_category = '$cat' AND local_area = '$area'";
    $res = mysqli_query($dbc, $sql);
    $rows = array();
    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo 'Not Found';
    }
}

mysqli_close($dbc);
?>