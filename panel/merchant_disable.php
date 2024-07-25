<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$staff_id                     = Encryption::decode($param[1]);
$sql2   = "UPDATE tbl_staff SET status = '3'  WHERE  staff_id = '".$staff_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'DISABLE MERCHANT', 'Disable merchant with staff_id $staff_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
