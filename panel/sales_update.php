<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$order_code         = Encryption::decode($_POST['order_code']);
$shop_id            = Encryption::decode($_POST['shop_id']);
$delivery_status    = input_data(filter_var($_POST['delivery_status'],FILTER_SANITIZE_STRING));
$shop_notes         = input_data(filter_var($_POST['shop_notes'],FILTER_SANITIZE_STRING));

if($shop_id == "" || $order_code == "") {
    echo "<script>";
    echo "alert('shop ID and Order Code are empty'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$s       = "UPDATE tbl_order_shop SET delivery_status = '".$delivery_status."', staff_id = '".$_SESSION['staff_id']."', shop_notes = '".$shop_notes."', updated_date_staff_id = now() WHERE order_code = '".$order_code."' AND shop_id = '".$_SESSION['shop_id']."'";
//echo $sql2;
mysqli_query($conn,$s);

$s2      = "UPDATE tbl_order_detail SET shop_notes = '".$shop_notes."' WHERE order_code = '".$order_code."' AND shop_id = '".$_SESSION['shop_id']."'";
mysqli_query($conn,$s2);

echo "<script>";
echo "alert('Success'); window.location=\"sales_transaction\"";
echo "</script>";
?>
