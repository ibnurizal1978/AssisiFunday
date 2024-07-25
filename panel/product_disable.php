<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$product_id                     = Encryption::decode($param[1]);
$sql = "SELECT active_status FROM tbl_product WHERE product_id = '".$product_id."' LIMIT 1";
$h = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($h);

if($row['active_status']==1) {
    $sql2   = "UPDATE tbl_product SET active_status = '2'  WHERE  product_id = '".$product_id."' LIMIT 1";
    /* === LOG === */
    $sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'DISABLE PRODUCT', 'Disable product with product_id $product_id',1,now())";
    mysqli_query($conn, $sql_log);
    /* === LOG === */
}else{
    $sql2   = "UPDATE tbl_product SET active_status = '1'  WHERE  product_id = '".$product_id."' LIMIT 1";
    /* === LOG === */
    $sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ENABLE PRODUCT', 'Enable product with product_id $product_id',1,now())";
    mysqli_query($conn, $sql_log);
    /* === LOG === */
}
//echo $sql2;
mysqli_query($conn,$sql2);
echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
