<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$id                     = Encryption::decode($param[1]);
$sql = "SELECT active_status FROM tbl_user WHERE user_id = '".$id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);


if($row['active_status']==1) {
    $sql2   = "UPDATE tbl_user SET active_status = 0  WHERE  user_id = '".$id."' LIMIT 1";
}else{
    $sql2   = "UPDATE tbl_user SET active_status = 1  WHERE  user_id = '".$id."' LIMIT 1";
}

mysqli_query($conn,$sql2);
echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
