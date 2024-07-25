<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$staff_id             = Encryption::decode($_POST['id']);
$staffName         = input_data(filter_var($_POST['staffName'],FILTER_SANITIZE_STRING));
$email         = input_data(filter_var($_POST['email'],FILTER_SANITIZE_STRING));
$contact         = input_data(filter_var($_POST['contact'],FILTER_SANITIZE_STRING));
$shop_id         = input_data(filter_var($_POST['shop_id'],FILTER_SANITIZE_STRING));
$roleID  = input_data(filter_var($_POST['roleID'],FILTER_SANITIZE_STRING));
$password  = @$_POST['password'];

if($staffName == "") {
    echo "<script>";
    echo "alert('Please fill name and email'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

//check duplicate
$sql = "SELECT email FROM tbl_staff WHERE email = '".$email."' AND staff_id <> '".$staff_id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
if(mysqli_num_rows($h) > 0) {
  echo "<script>";
  echo "alert('Duplicate email'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if($password <> '') {

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

    $sql2       = "UPDATE tbl_staff SET  staffName = '".$staffName."', contact = '".$contact."', shop_id = '".$shop_id."', roleID = '".$roleID."', password = '".md5($password)."' WHERE staff_id = '".$staff_id."' LIMIT 1";
    mysqli_query($conn,$sql2);

    /* === LOG === */
    $sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE MERCHANT WITH PASSWORD', 'Update merchant with staff_id $staff_id',1,now())";
    mysqli_query($conn, $sql_log);
    /* === LOG === */

    echo "<script>";
    echo "alert('Success'); window.location=\"merchant\"";
    echo "</script>";
}else{
    $sql2       = "UPDATE tbl_staff SET  staffName = '".$staffName."', contact = '".$contact."', shop_id = '".$shop_id."', roleID = '".$roleID."' WHERE staff_id = '".$staff_id."' LIMIT 1";
    //echo $sql2;
    mysqli_query($conn,$sql2);

    /* === LOG === */
    $sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE MERCHANT', 'Update merchant with staff_id $staff_id',1,now())";
    mysqli_query($conn, $sql_log);
    /* === LOG === */

    echo "<script>";
    echo "alert('Success'); window.location=\"merchant\"";
    echo "</script>";
}
?>
