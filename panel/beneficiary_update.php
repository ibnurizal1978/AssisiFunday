<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$id             = Encryption::decode($_POST['id']);
$amount         = input_data(filter_var($_POST['amount'],FILTER_SANITIZE_STRING));
$active_status  = input_data(filter_var($_POST['active_status'],FILTER_SANITIZE_STRING));

if($amount<>'' && $amount < 1) {
    echo "<script>";
    echo "alert('Amount cannot be zero'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$permitted_chars = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';
$random = substr(str_shuffle($permitted_chars), 0, 5);
$tranId = 'BENEF'.$id.date('ymdhis').$random.strtoupper(uniqid());

$s = "INSERT INTO tbl_ledger SET ledger_type = 'CREDIT', description = 'BENEFICIARY', totalAmount = $amount, credit = $amount,
currency = 'SGD', user_id = $id, trx_status = 'Approved', tranId = '".$tranId."', responseCode = '00', responseMsg = 'SUCCESS', created_at = now(), staff_id = '".$_SESSION['staff_id']."'";
mysqli_query($conn, $s);
//echo $s;

$s2  = "UPDATE tbl_user SET active_status = '".$active_status."' WHERE  user_id = '".$id."' LIMIT 1";
mysqli_query($conn,$s2);

echo "<script>";
echo "alert('Success'); window.location=\"beneficiary\"";
echo "</script>";
?>
