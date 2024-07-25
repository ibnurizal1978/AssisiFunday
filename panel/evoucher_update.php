<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$evoucher_id         = Encryption::decode($_POST['id']);
$product_id         = input_data(filter_var($_POST['product_id'],FILTER_SANITIZE_STRING));
$title         = input_data(filter_var($_POST['title'],FILTER_SANITIZE_STRING));
$location         = input_data(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
$datetime         = input_data(filter_var($_POST['datetime'],FILTER_SANITIZE_STRING));
$voucher_info  = input_data($_POST['voucher_info']);
//$foodpanda  = input_data(filter_var($_POST['foodpanda'],FILTER_SANITIZE_STRING));
$foodpanda = 0;
if($product_id == "" || $title == "" || $location == "" || $datetime == "" || $voucher_info == "") {
    echo "<script>";
    echo "alert('Please fill all columns'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

//check duplicate
$sql = "SELECT product_id, title FROM tbl_evoucher WHERE product_id = '".$product_id."' AND title = '".$title."' AND evoucher_id <> '".$evoucher_id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
if(mysqli_num_rows($h) > 0) {
  echo "<script>";
  echo "alert('Duplicate data'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$sql2       = "UPDATE tbl_evoucher SET product_id = '".$product_id."', title = '".$title."', location = '".$location."', datetime = '".$datetime."', voucher_info = '".$voucher_info."', modifiedDateTime = now(), foodpanda = '".$foodpanda."' WHERE evoucher_id = '".$evoucher_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2) or die(mysqli_error($conn));

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE EVOUCHER', 'Update evoucher with evoucher_id $evoucher_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"evoucher\"";
echo "</script>";
?>
