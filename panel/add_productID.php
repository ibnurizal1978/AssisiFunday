<?php 
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once '../config.php';
$sql   = "SELECT productID, product_name FROM tbl_product WHERE productID = ''";
echo $sql;
$h = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($h)) {

    $permitted_chars = '0123456789';
    $random = substr(str_shuffle($permitted_chars), 0, 20);
    $productID = date('ymdhis').$random.strtoupper(uniqid());

    $sql_id = "UPDATE tbl_product SET productID = '".$productID."' WHERE product_name = '".$row['product_name']."'";
    echo $sql_id.'<br/>';
    mysqli_query($conn, $sql_id);
    //echo $row['productID'].' --> '.$row['product_name'].'<br/>';
}
?>