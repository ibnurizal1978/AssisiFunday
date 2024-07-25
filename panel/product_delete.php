<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$product_id                    = Encryption::decode($param[1]);
$sql2   = "UPDATE tbl_product SET delete_status = '1'  WHERE  product_id = '".$product_id."' LIMIT 1";
//echo $sql2;

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'DELETE PRODUCT', 'Delete product with product_id $product_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

mysqli_query($conn,$sql2);
echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
