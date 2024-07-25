<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$staffName         = input_data(filter_var($_POST['staffName'],FILTER_SANITIZE_STRING));
$email         = input_data(filter_var($_POST['email'],FILTER_SANITIZE_STRING));
$contact         = input_data(filter_var($_POST['contact'],FILTER_SANITIZE_STRING));
$shop_id         = input_data(filter_var($_POST['shop_id'],FILTER_SANITIZE_STRING));
$roleID  = input_data(filter_var($_POST['roleID'],FILTER_SANITIZE_STRING));
$password  = @$_POST['password'];

if($staffName == "" || $email == "" || $password == "") {
    echo "<script>";
    echo "alert('Please fill name, email and password'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

if(strlen($password)<8) {
    echo "<script>";
    echo "alert('Password must minimum 8 alphanumeric, 1 uppercase and 1 special character'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$containsLetter  = preg_match('/[a-zA-Z]/',    $password);
$containsDigit   = preg_match('/\d/',          $password);
$containsSpecial = preg_match('/[^a-zA-Z\d]/', $password);

$containsAll = $containsLetter && $containsDigit && $containsSpecial;
if(!$containsAll){
    echo "<script>";
    echo "alert('Password must minimum have 1 uppercase and 1 special character'); window.location.href=history.back()";
    echo "</script>";
    exit();
}
//check duplicate
$sql = "SELECT email FROM tbl_staff WHERE email = '".$email."' LIMIT 1";
$h = mysqli_query($conn, $sql);
if(mysqli_num_rows($h) > 0) {
  echo "<script>";
  echo "alert('Duplicate email'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$permitted_chars = '0123456789';
$random = substr(str_shuffle($permitted_chars), 0, 10);
$staffID = 'STF'.date('ymdhis').$random.strtoupper(uniqid());

$sql2       = "INSERT INTO tbl_staff SET staffName = '".$staffName."', email = '".$email."', userName = '".$staffName."', contact = '".$contact."', shop_id = '".$shop_id."', roleID = '".$roleID."', password = '".md5($password)."', status = 1, createdDateTime = now(), staffID = '".$staffID."'";
//echo $sql2;
mysqli_query($conn,$sql2) or die(mysqli_error($conn));

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ADD MERCHANT', 'Add new merchant',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */


echo "<script>";
echo "alert('Success'); window.location=\"merchant\"";
echo "</script>";
?>
