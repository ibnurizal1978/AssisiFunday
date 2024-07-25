<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$discount_voucher_id         = Encryption::decode($_POST['id']);
$max_qty         = input_data(filter_var($_POST['max_qty'],FILTER_SANITIZE_STRING));

if($max_qty == "") {
    echo "<script>";
    echo "alert('Please fill max quantity'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$sql = "SELECT * FROM tbl_discount_voucher WHERE discount_voucher_id = '".$discount_voucher_id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);

if($max_qty < $row['max_qty']) {
    echo "<script>";
    echo "alert('Quantity cannot be less than current'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$sql2       = "UPDATE tbl_discount_voucher SET max_qty = '".$max_qty."', updated_at = now(), updated_by = '".$_SESSION['staff_id']."' WHERE discount_voucher_id = '".$discount_voucher_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2) or die(mysqli_error($conn));

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE DISCOUNT VOUCHER', 'Update discount voucher with discount_voucher_id $discount_voucher_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"discount_voucher\"";
echo "</script>";
?>
