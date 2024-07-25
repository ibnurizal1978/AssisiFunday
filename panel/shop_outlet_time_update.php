<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$shop_outlet_id         = Encryption::decode($_POST['shop_outlet_id']);
if(isset($_POST['pickup_time'])) { $pickup_time  = input_data(filter_var($_POST['pickup_time'],FILTER_SANITIZE_STRING)); }else{ $pickup_time = ''; }
$pickup_date = input_data(filter_var($_POST['pickup_date'],FILTER_SANITIZE_STRING));
$pickup_date = "[".$pickup_date."]";

if($_POST['pickup_time'] == "" || $_POST['pickup_date'] == "") {
  echo "<script>";
  echo "alert('Please choose time AND date'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if(isset($_POST['pickup_time'])) { $pic_time = implode(',',@$_POST['pickup_time']); }else{ $pic_time = ''; }

$s = "UPDATE tbl_shop_outlet SET pickup_date = '".$pickup_date."', pickup_time = '".$pic_time."', updated_at = now() WHERE  shop_outlet_id = '".$shop_outlet_id."'";
/*$s = "SELECT * FROM tbl_shop_outlet_time WHERE shop_outlet_id = '".$shop_outlet_id."'";
$h = mysqli_query($conn, $s);
if(mysqli_num_rows($h)==0)
{
  $s2   = "INSERT INTO tbl_shop_outlet_time SET shop_outlet_id = '".$shop_outlet_id."', pickup_date = '".$pickup_date."', pickup_time = '".$pic_time."', created_at = now()";
}else{
  $s2   = "UPDATE tbl_shop_outlet_time SET pickup_time = '".$pic_time."', pickup_date = '".$pickup_date."' WHERE shop_outlet_id = '".$shop_outlet_id."'";
}*/
//echo $s2;
mysqli_query($conn,$s);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE SHOP PICKUP TIME', 'Update shop pickup time outlet id: $shop_outlet_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */
echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
