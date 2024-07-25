<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$shop_outlet_id         = Encryption::decode($_POST['shop_outlet_id']);
$shop_outlet_name       = input_data($_POST['shop_outlet_name']);

if($shop_outlet_name == "") {
  echo "<script>";
  echo "alert('Please fill name'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$s = "SELECT shop_outlet_name FROM tbl_shop_outlet WHERE shop_outlet_name = '".$shop_outlet_name."' AND shop_outlet_id <> '".$shop_outlet_id."' LIMIT 1";
$h = mysqli_query($conn, $s);
if(mysqli_num_rows($h)>0)
{
  echo "<script>";
  echo "alert('Duplicate outlet name'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$sql2   = "UPDATE tbl_shop_outlet SET shop_outlet_name = '".$shop_outlet_name."' WHERE shop_outlet_id = '".$shop_outlet_id."'";
//echo $sql2;
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE SHOP OUTLET', 'Update new shop outlet id: $shop_outlet_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
