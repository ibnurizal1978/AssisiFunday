<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$shop_id             = Encryption::decode($_POST['id']);
$product_id             = Encryption::decode($_POST['id2']);
$tc                     = input_data(filter_var($_POST['tc'],FILTER_SANITIZE_STRING));
$shop_name         = input_data($_POST['shop_name']);
$product_name  = input_data($_POST['product_name']);
$product_type        = input_data(filter_var($_POST['product_type'],FILTER_SANITIZE_STRING));
$order_index         = input_data(filter_var($_POST['order_index'],FILTER_SANITIZE_STRING));
$accept_special_instruction        = input_data(filter_var($_POST['accept_special_instruction'],FILTER_SANITIZE_STRING));
$price        = input_data(filter_var($_POST['price'],FILTER_SANITIZE_STRING));
$usual_price        = input_data(filter_var($_POST['usual_price'],FILTER_SANITIZE_STRING));

if(isset($_POST['fufilment_delivery'])) { $fufilment_delivery  = input_data(filter_var($_POST['fufilment_delivery'],FILTER_SANITIZE_STRING)); }else{ $fufilment_delivery = ''; }
if(isset($_POST['fufilment_pickup'])) { $fufilment_pickup  = input_data(filter_var($_POST['fufilment_pickup'],FILTER_SANITIZE_STRING)); }else{ $fufilment_pickup = ''; }
if(isset($_POST['fufilment_postage'])) { $fufilment_postage  = input_data(filter_var($_POST['fufilment_postage'],FILTER_SANITIZE_STRING)); }else{ $fufilment_postage = ''; }
if(isset($_POST['display_fufilment_delivery'])) { $display_fufilment_delivery  = input_data(filter_var($_POST['display_fufilment_delivery'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_delivery = ''; }
if(isset($_POST['display_fufilment_pickup'])) { $display_fufilment_pickup  = input_data(filter_var($_POST['display_fufilment_pickup'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_pickup = ''; }
if(isset($_POST['display_fufilment_postage'])) { $display_fufilment_postage  = input_data(filter_var($_POST['display_fufilment_postage'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_postage = ''; }
if(isset($_POST['display_fufilment_dinein'])) { $display_fufilment_dinein  = input_data(filter_var($_POST['display_fufilment_dinein'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_dinein = ''; }
if(isset($_POST['display_fufilment_takeaway'])) { $display_fufilment_takeaway  = input_data(filter_var($_POST['display_fufilment_takeaway'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_takeaway = ''; }
if(isset($_POST['display_fufilment_appointment'])) { $display_fufilment_appointment  = input_data(filter_var($_POST['display_fufilment_appointment'],FILTER_SANITIZE_STRING)); }else{ $display_fufilment_appointment = ''; }

if(isset($_POST['delivery_time'])) { $delivery_time  = input_data(filter_var($_POST['delivery_time'],FILTER_SANITIZE_STRING)); }else{ $delivery_time = ''; }
if(isset($_POST['pickup_time'])) { $pickup_time  = input_data(filter_var($_POST['pickup_time'],FILTER_SANITIZE_STRING)); }else{ $pickup_time = ''; }

$fufilment_type_option        = input_data(filter_var($_POST['fufilment_type_option'],FILTER_SANITIZE_STRING));
$fufilment_cash_option        = input_data(filter_var($_POST['fufilment_cash_option'],FILTER_SANITIZE_STRING));
$delivery_leadtime = input_data(filter_var($_POST['delivery_leadtime'],FILTER_SANITIZE_STRING));
$pickup_leadtime = input_data(filter_var($_POST['pickup_leadtime'],FILTER_SANITIZE_STRING));
$delivery_date = input_data(filter_var($_POST['delivery_date'],FILTER_SANITIZE_STRING));
$pickup_date = input_data(filter_var($_POST['pickup_date'],FILTER_SANITIZE_STRING));
$product_description = addslashes($_POST['product_description']);
$product_tc = addslashes($_POST['product_tc']);
$active_status = input_data(filter_var($_POST['active_status'],FILTER_SANITIZE_STRING));
$similar_products         = input_data(filter_var($_POST['similar_products'],FILTER_SANITIZE_STRING));
$product_image = input_data(filter_var($_POST['product_image'],FILTER_SANITIZE_STRING));
$total_quantity = input_data(filter_var($_POST['total_quantity'],FILTER_SANITIZE_STRING));
$product_keyword         = input_data(filter_var($_POST['product_keyword'],FILTER_SANITIZE_STRING));
$golive = input_data(filter_var($_POST['golive'],FILTER_SANITIZE_STRING));
$pickup_location = input_data(filter_var($_POST['pickup_location'],FILTER_SANITIZE_STRING));

if($shop_name == "" || $product_name == "" || $order_index == "") {
  echo "<script>";
  echo "alert('Please fill name and order index'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if ($total_quantity < $tc) {
    echo "<script>";
    echo "alert('New quantity cannot be lower than current'); window.location.href=history.back()";
    echo "</script>";
  exit();
}

if($golive == '') { $golive_date = '0000-00-00'; }else{ $golive_date = $golive; }

if($price > 0 && ($usual_price=='0.00' || $usual_price == '')) {
  $usual_price = $price;
}

$permitted_chars = '0123456789';
$random = substr(str_shuffle($permitted_chars), 0, 10);
$delivery_date = "[".$delivery_date."]";
$pickup_date = "[".$pickup_date."]";
if(isset($_POST['delivery_time'])) { $del_time = implode(',',@$_POST['delivery_time']); }else{ $del_time =''; }
if(isset($_POST['pickup_time'])) { $pic_time = implode(',',@$_POST['pickup_time']); }else{ $pic_time = ''; }


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
  $photo1 		= 'ds-cover-image'.substr(str_shuffle($permitted_chars), 0, 16).'.'.end($temp);
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
  //echo $value.'<br/>';
  //echo $sql_sp.'<br/><br/>  ';
  mysqli_query($conn, $sql_sp);
}

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

//update into tbl_product
$sql       = "UPDATE tbl_product SET product_name = '".$product_name."', shop_id = '".$shop_id."', product_type = '".$product_type."', shop_name = '".$shop_name."', shop_description = 'Daily Special', order_index = '".$order_index."', accept_special_instruction = '".$accept_special_instruction."', price = '".$price."',  usual_price = '".$usual_price."',  product_description = '".$product_description."',  product_tc = '".$product_tc."', active_status = 1, createdDateTime = now(), modifiedDateTime=now(), product_image = '".@$product_image."', product_similar = '".$similar_products."', product_keyword = '".$product_keyword."', total_quantity = '".$total_quantity."' WHERE product_id = '".$product_id."' LIMIT 1";
//echo $sql;
mysqli_query($conn,$sql);

//update into tbl_shop
$sql2   = "UPDATE tbl_shop SET shop_name = '".$shop_name."', shop_description = 'Daily Special', order_index = '".$order_index."', delivery_time = '".$del_time."',  delivery_date = '".$delivery_date."',  pickup_time = '".$pic_time."',  pickup_date = '".$pickup_date."', delivery_leadtime = '".$delivery_leadtime."',  pickup_leadtime = '".$pickup_leadtime."',  fufilment_type_option = '".$fufilment_type_option."',  fufilment_cash_option = '".$fufilment_cash_option."',  fufilment_delivery = '".$fufilment_delivery."',  fufilment_pickup = '".$fufilment_pickup."',  fufilment_postage = '".$fufilment_postage."',  display_fufilment_delivery = '".$display_fufilment_delivery."',  display_fufilment_pickup = '".$display_fufilment_pickup."',  display_fufilment_postage = '".$display_fufilment_postage."',  display_fufilment_dinein = '".$display_fufilment_dinein."',  display_fufilment_takeaway = '".$display_fufilment_takeaway."',  display_fufilment_appointment = '".$display_fufilment_appointment."', active_status = '".$active_status."', modifiedDateTime=now(), cover_image = '".@$product_image."', golive='".$golive_date."', pickup_location = '".$pickup_location."' WHERE  shop_id = '".$shop_id."' LIMIT 1";
//echo $sql2;

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE DAILY SPECIAL', 'Update daily special with shop_id $shop_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

mysqli_query($conn,$sql2);
echo "<script>";
echo "alert('Success'); window.location=\"daily_special\"";
echo "</script>";
?>
