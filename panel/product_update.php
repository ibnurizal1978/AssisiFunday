<?php

session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$product_id             = Encryption::decode($_POST['id']);
$tc                     = input_data(filter_var($_POST['tc'],FILTER_SANITIZE_STRING));
$product_name           = input_data($_POST['product_name']);
$product_type           = input_data(filter_var($_POST['product_type'],FILTER_SANITIZE_STRING));
$shop_id                = input_data(filter_var($_POST['shop_id'],FILTER_SANITIZE_STRING));
$order_index            = input_data(filter_var($_POST['order_index'],FILTER_SANITIZE_STRING));
$accept_special_instruction  = input_data(filter_var($_POST['accept_special_instruction'],FILTER_SANITIZE_STRING));
$mandatory_pickup_location   = input_data(filter_var($_POST['mandatory_pickup_location'],FILTER_SANITIZE_STRING));
$price                  = input_data(filter_var($_POST['price'],FILTER_SANITIZE_STRING));
$usual_price            = input_data(filter_var($_POST['usual_price'],FILTER_SANITIZE_STRING));
$total_quantity         = input_data(filter_var($_POST['total_quantity'],FILTER_SANITIZE_STRING));
$highlight_status       = input_data(filter_var($_POST['highlight_status'],FILTER_SANITIZE_STRING));
$sell_for_good          = input_data(filter_var($_POST['sell_for_good'],FILTER_SANITIZE_STRING));
$product_keyword        = input_data(filter_var($_POST['product_keyword'],FILTER_SANITIZE_STRING));
$product_description    = addslashes($_POST['product_description']);
$product_description    = str_replace('&lt;img', '', $product_description);
$product_description    = str_replace('<img', '', $product_description);
$product_description    = str_replace('<script', '', $product_description);
$product_description    = str_replace('alert(', '', $product_description);
$product_tc             = addslashes($_POST['product_tc']);
$similar_products       = input_data(filter_var($_POST['similar_products'],FILTER_SANITIZE_STRING));
$active_status          = input_data(filter_var($_POST['active_status'],FILTER_SANITIZE_STRING));
$product_image          = input_data(filter_var($_POST['product_image'],FILTER_SANITIZE_STRING));

if($product_name == "" || $order_index == "" || $price == "") {
  echo "<script>";
  echo "alert('Please fill name, order index, price and usual price'); window.location.href=history.back()";
  echo "</script>";
exit();
}

if($price > 0 && ($usual_price=='0.00' || $usual_price == '')) {
  $usual_price = $price;
}

if ($total_quantity < $tc) {
    echo "<script>";
    echo "alert('New quantity cannot be lower than current'); window.location.href=history.back()";
    echo "</script>";
  exit();
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

if($_FILES["fCover"]["name"]) { $product_image = $photo1; }else{ $product_image = $product_image; }

//get for similar products
mysqli_query($conn, "DELETE FROM tbl_product_similar WHERE original_product_id = '".$product_id."'");
$array = explode(',', ltrim($similar_products));
foreach($array as $value){
  $sql_product   = "SELECT product_id FROM tbl_product WHERE product_name = '".ltrim($value)."' LIMIT 1";
  $h_product     = mysqli_query($conn, $sql_product);
$row_product   = mysqli_fetch_assoc($h_product);
  $sql_sp = "INSERT INTO tbl_product_similar(original_product_id, similar_product_id) VALUES ('".$product_id."','".$row_product['product_id']."')";
  mysqli_query($conn, $sql_sp);
}

//view shop_name and description
$sql_shop   = "SELECT shop_name, shop_description FROM tbl_shop WHERE shop_id = '".$shop_id."' LIMIT 1";
$h_shop     = mysqli_query($conn, $sql_shop);
$row_shop   = mysqli_fetch_assoc($h_shop);
$shop_name = mysqli_real_escape_string($conn, $row_shop['shop_name']);
$shop_description = mysqli_real_escape_string($conn, $row_shop['shop_description']);
$sql2       = "UPDATE tbl_product SET  product_name = '".$product_name."', product_type = '".$product_type."', highlight_status = '".$highlight_status."', shop_id = '".$shop_id."', shop_name = '".$shop_name."', shop_description = '".$shop_description."', order_index = '".$order_index."', accept_special_instruction = '".$accept_special_instruction."', mandatory_pickup_location = '".$mandatory_pickup_location."', price = '".$price."',  usual_price = '".$usual_price."', total_quantity = '".$total_quantity."', product_keyword = '".$product_keyword."', product_description = '".$product_description."',  product_tc = '".$product_tc."', active_status = '".$active_status."',  modifiedDateTime=now(), product_image = '".@$product_image."', product_similar = '".$similar_products."', sell_for_good = '".$sell_for_good."' WHERE product_id = '".$product_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2);

//update tbl_order_detail
$s = "UPDATE tbl_order_detail SET product_name = '".$product_name."', price = '".$price."', sub_total = qty * '".$price."' WHERE product_id = '".$product_id."'";
mysqli_query($conn, $s);

/* add evoucher code */
$s3 = "SELECT evoucher_id FROM tbl_evoucher WHERE product_id = '".$product_id."' AND self_upload = 0 LIMIT 1";
$h3 = mysqli_query($conn, $s3);
if(mysqli_num_rows($h3)>0)
{
  $r3 = mysqli_fetch_assoc($h3);
  $new_qty = $total_quantity - $tc;
  for($i=1;$i<=$new_qty;$i++)
  {
    $evoucher_code = $product_id.substr(str_shuffle("ABCDEFGHJKLMNPQRSTUVWXYZ23456789"), 0, 10);
    $s4 = "INSERT INTO tbl_evoucher_list SET evoucher_code = '".$evoucher_code."', evoucher_id = '".$r3['evoucher_id']."', shop_id = '".$shop_id."', product_id = '".$product_id."', created_at = now(), staff_id = '666'";
    mysqli_query($conn, $s4);
  }
}


/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE PRODUCT', 'Update product with product_id $product_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"product\"";
echo "</script>";
?>
