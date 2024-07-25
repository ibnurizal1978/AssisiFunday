<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$product_name         = input_data($_POST['product_name']);
$product_type         = input_data(filter_var($_POST['product_type'],FILTER_SANITIZE_STRING));
$shop_id              = input_data(filter_var($_POST['shop_id'],FILTER_SANITIZE_STRING));
$order_index          = input_data(filter_var($_POST['order_index'],FILTER_SANITIZE_STRING));
$highlight_status     = input_data(filter_var($_POST['highlight_status'],FILTER_SANITIZE_STRING));
$sell_for_good        = input_data(filter_var($_POST['sell_for_good'],FILTER_SANITIZE_STRING));
if(isset($_POST['accept_special_instruction']))
{
  $accept_special_instruction  = input_data(filter_var($_POST['accept_special_instruction'],FILTER_SANITIZE_STRING));
}else{
  $accept_special_instruction = '';
}

if(isset($_POST['mandatory_pickup_location']))
{
  $mandatory_pickup_location  = input_data(filter_var($_POST['mandatory_pickup_location'],FILTER_SANITIZE_STRING));
}else{
  $mandatory_pickup_location = '';
}

$price        = input_data(filter_var($_POST['price'],FILTER_SANITIZE_STRING));
$usual_price        = input_data(filter_var($_POST['usual_price'],FILTER_SANITIZE_STRING));
$total_quantity        = input_data(filter_var($_POST['total_quantity'],FILTER_SANITIZE_STRING));
$product_keyword        = input_data(filter_var($_POST['product_keyword'],FILTER_SANITIZE_STRING));
$product_description        = addslashes($_POST['product_description']);
$product_tc        = addslashes($_POST['product_tc']);
$similar_products         = input_data(filter_var($_POST['similar_products'],FILTER_SANITIZE_STRING));

if($product_name == "" || $order_index == "" || $price == "") {
    echo "<script>";
    echo "alert('Please fill name, order index, price and usual price'); window.location.href=history.back()";
    echo "</script>";
  exit();
}

if($price > 0 && ($usual_price=='0.00' || $usual_price == '')) {
  $usual_price = $price;
}

if ($_FILES['fCover']['size'] > 1000000) {
    echo "<script>";
    echo "alert('File size must not more than 1MB'); window.location.href=history.back()";
    echo "</script>";
  exit();
}

/* this is for photo1 */
if($_FILES["fCover"]["name"]) {
  $permitted_chars 	= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $temp 				= explode(".", $_FILES["fCover"]["name"]);
  $name 				= $_FILES['fCover']['name'];
  $target_dir 		= $image_path.'cover/';
  $photo1 		= 'product-image'.substr(str_shuffle($permitted_chars), 0, 16).'.'.end($temp);
  $target_file 		= $target_dir.$photo1;
  $imageFileType 		= strtolower($temp[1]);
  $extensions_arr 	= array("jpg","jpeg","png","gif");

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
    echo "<script>";
    echo "alert('File type must JPG or GIF'); window.location.href=history.back()";
    echo "</script>";
    exit();
  }
  move_uploaded_file($_FILES["fCover"]["tmp_name"], $target_file);
  $source_image = $target_file;
  $image_destination = $target_dir.$photo1;
}
$permitted_chars = '0123456789';
$random = substr(str_shuffle($permitted_chars), 0, 10);
$productID = date('ymdhis').$random.strtoupper(uniqid());

//get for similar products
if($similar_products <> '') {
  $array = explode(',', ltrim($similar_products));
  foreach($array as $value){
    $sql_product   = "SELECT product_id FROM tbl_product WHERE product_name = '".ltrim($value)."' LIMIT 1";
    $h_product     = mysqli_query($conn, $sql_product);
  $row_product   = mysqli_fetch_assoc($h_product);
    $sql_sp = "INSERT INTO tbl_product_similar(original_product_id, similar_product_id) VALUES ('".@$product_id."','".$row_product['product_id']."')";
    mysqli_query($conn, $sql_sp);
  }
}


//view shop_name and description
$sql_shop   = "SELECT shop_name, shop_description FROM tbl_shop WHERE shop_id = '".$shop_id."' LIMIT 1";
$h_shop     = mysqli_query($conn, $sql_shop);
$row_shop   = mysqli_fetch_assoc($h_shop);
$shop_name = mysqli_real_escape_string($conn, $row_shop['shop_name']);
$shop_description = mysqli_real_escape_string($conn, $row_shop['shop_description']);
$sql2       = "INSERT INTO tbl_product SET productID = '".$productID."', product_name = '".$product_name."', shop_id = '".$shop_id."', highlight_status = '".$highlight_status."', product_type = '".$product_type."', shop_name = '".$shop_name."', shop_description = '".$shop_description."', order_index = '".$order_index."', accept_special_instruction = '".$accept_special_instruction."', mandatory_pickup_location = '".$mandatory_pickup_location."', price = '".$price."',  usual_price = '".$usual_price."',  total_quantity = '".$total_quantity."', product_keyword = '".$product_keyword."',  product_description = '".$product_description."',  product_tc = '".$product_tc."', active_status = 1, createdDateTime = now(), modifiedDateTime=now(), product_image = '".@$photo1."', product_similar = '".$similar_products."', sell_for_good = '".$sell_for_good."'";
mysqli_query($conn,$sql2) or die(mysqli_error($conn));

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ADD PRODUCT', 'Add new product',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"product\"";
echo "</script>";
?>
