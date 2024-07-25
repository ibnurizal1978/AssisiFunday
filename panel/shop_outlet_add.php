<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$shop_id         = Encryption::decode($_POST['shop_id']);
$shop_outlet_name       = input_data($_POST['shop_outlet_name']);

if($shop_outlet_name == "") {
  echo "<script>";
  echo "alert('Please fill name'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$s = "SELECT shop_outlet_name FROM tbl_shop_outlet WHERE shop_outlet_name = '".$shop_outlet_name."'";
$h = mysqli_query($conn, $s);
if(mysqli_num_rows($h)>0)
{
  echo "<script>";
  echo "alert('Duplicate outlet name'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$sql2   = "INSERT INTO tbl_shop_outlet SET shop_id = '".$shop_id."', shop_outlet_name = '".$shop_outlet_name."', created_at = now()";
//echo $sql2;
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ADD SHOP OUTLET', 'Add new shop outlet name: $shop_outlet_name',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
