<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$product_id         = input_data(filter_var($_POST['product_id'],FILTER_SANITIZE_STRING));
$title         = input_data(filter_var($_POST['title'],FILTER_SANITIZE_STRING));
$location         = input_data(filter_var($_POST['location'],FILTER_SANITIZE_STRING));
$datetime         = input_data(filter_var($_POST['datetime'],FILTER_SANITIZE_STRING));
$voucher_info  = input_data(filter_var($_POST['voucher_info'],FILTER_SANITIZE_STRING));
//$foodpanda  = input_data(filter_var($_POST['foodpanda'],FILTER_SANITIZE_STRING));
$foodpanda = 0;
if($product_id == "" || $title == "" || $location == "" || $datetime == "" || $voucher_info == "") {
    echo "<script>";
    echo "alert('Please fill all columns'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

//check duplicate
$sql = "SELECT product_id, title FROM tbl_evoucher WHERE product_id = '".$product_id."' AND title = '".$title."' LIMIT 1";
$h = mysqli_query($conn, $sql);
if(mysqli_num_rows($h) > 0) {
  echo "<script>";
  echo "alert('Duplicate data'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

/*
check if shop_id = 1, 10, 22 then flag it to self_upload = 1
They answered me. There’ll be 2 merchants for now:
Food Panda
Le Amis
*/

$s_shop = "SELECT shop_id FROM tbl_product WHERE product_id = '".$product_id."' AND shop_id IN (1, 10, 22)";
$h_shop = mysqli_query($conn, $s_shop);
if(mysqli_num_rows($h_shop)>0)
{
  $self_upload = 1;
}else{
  $self_upload = 0;
}

$permitted_chars = '0123456789';
$random = substr(str_shuffle($permitted_chars), 0, 10);
$evoucherID = 'EVCH'.date('ymdhis').$random.strtoupper(uniqid());

$sql2       = "INSERT INTO tbl_evoucher SET product_id = '".$product_id."', title = '".$title."', location = '".$location."', datetime = '".$datetime."', voucher_info = '".$voucher_info."', createdDateTime = now(), foodpanda = '".$foodpanda."', self_upload = '".$self_upload."'";
mysqli_query($conn,$sql2) or die(mysqli_error($conn));
$last_id    = mysqli_insert_id($conn);


/* add evoucher code */
$s3 = "SELECT total_quantity, shop_id FROM tbl_product WHERE product_id = '".$product_id."' AND shop_id NOT IN (1, 10, 22) LIMIT 1";
$h3 = mysqli_query($conn, $s3);
if(mysqli_num_rows($h3)>0)
{
  $r3 = mysqli_fetch_assoc($h3);
  for($i=1;$i<=$r3['total_quantity'];$i++)
  {
    $evoucher_code = $product_id.substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 10);
    $s4 = "INSERT INTO tbl_evoucher_list SET evoucher_code = '".$evoucher_code."', evoucher_id = '".$last_id."', shop_id = '".$r3['shop_id']."', product_id = '".$product_id."', created_at = now(), staff_id = '666'";
    mysqli_query($conn, $s4);
  }
}



/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ADD EVOUCHER', 'Add new evoucher',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"evoucher\"";
echo "</script>";
?>
