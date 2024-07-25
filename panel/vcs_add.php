<?php 
session_start();
ini_set('display_errors', 1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$vcs_code         = input_data(filter_var($_POST['vcs_code'],FILTER_SANITIZE_STRING));

if($vcs_code == "") {
    echo "<script>";
    echo "alert('Please fill voucher code'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

//check duplicate
$sql = "SELECT shopID FROM tbl_evoucher a INNER JOIN tbl_evoucher_detail b USING (evoucher_id) INNER JOIN tbl_product c ON a.productID = c.productID WHERE evoucher_code  = '".$vcs_code."' LIMIT 1";
$h = mysqli_query($conn, $sql);
if(mysqli_num_rows($h) == 0) {
  echo "<script>";
  echo "alert('Data'); window.location.href='http://35.186.149.64:8081/assisifunday/panel/vcs'";
  //echo "alert('Invalid Merchant'); window.location.href='http://localhost/trinax/asisi/apps/assisi2021/panel/vcs'";
  echo "</script>";
  exit(); 
}

$sql2       = "UPDATE tbl_evoucher_detail SET staffName = '".$staffName."', email = '".$email."', userName = '".$staffName."', contact = '".$contact."', companyID = '".$companyID."', roleID = '".$roleID."', password = '".md5($password)."', status = 1, createdDateTime = now(), staffID = '".$staffID."'";
//echo $sql2;
mysqli_query($conn,$sql2) or die(mysqli_error($conn));
echo "<script>";
echo "alert('Success'); window.location=\"vcs\"";
echo "</script>";
?>