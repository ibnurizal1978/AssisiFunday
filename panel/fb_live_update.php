<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$url         = input_data(filter_var($_POST['url'],FILTER_SANITIZE_STRING));
$is_live     = input_data(filter_var($_POST['is_live'],FILTER_SANITIZE_STRING));
if($url == "") {
    echo "<script>";
    echo "alert('Please fill URL'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$sql2       = "UPDATE tbl_fb_live SET url = '".$url."', is_live = '".$is_live."', updated_at = now() LIMIT 1";
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE FB LIVE', 'Update FB Live',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */
echo "<script>";
echo "alert('Success'); window.location=\"fb_live\"";
echo "</script>";
?>
