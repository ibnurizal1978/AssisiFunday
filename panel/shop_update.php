<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$shop_id                     = Encryption::decode($_POST['id']);
$shop_name         = input_data($_POST['shop_name']);
@$category_id        = $_POST['category_id'];
$order_index         = input_data(filter_var($_POST['order_index'],FILTER_SANITIZE_STRING));
$website_link  = input_data(filter_var($_POST['website_link'],FILTER_SANITIZE_STRING));
$facebook_link        = input_data(filter_var($_POST['facebook_link'],FILTER_SANITIZE_STRING));

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
$shop_description = addslashes($_POST['shop_description']);
$shop_location = addslashes($_POST['shop_location']);
@$pickup_location = input_data(filter_var($_POST['pickup_location'],FILTER_SANITIZE_STRING));
$active_status = input_data(filter_var($_POST['active_status'],FILTER_SANITIZE_STRING));
$cover_image = input_data(filter_var($_POST['cover_image'],FILTER_SANITIZE_STRING));
$shop_icon = input_data(filter_var($_POST['shop_icon'],FILTER_SANITIZE_STRING));
$shop_image = input_data(filter_var($_POST['shop_image'],FILTER_SANITIZE_STRING));
$is_halal = input_data(filter_var($_POST['is_halal'],FILTER_SANITIZE_STRING));
$is_highlight = input_data(filter_var($_POST['is_highlight'],FILTER_SANITIZE_STRING));
$is_eco_merchant = input_data(filter_var($_POST['is_eco_merchant'],FILTER_SANITIZE_STRING));
$is_priority = input_data(filter_var($_POST['is_priority'],FILTER_SANITIZE_STRING));
@$fb_live_url = input_data(filter_var($_POST['fb_live_url'],FILTER_SANITIZE_STRING));

if($shop_name == "" || $order_index == "") {
  echo "<script>";
  echo "alert('Please fill name and order index'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$permitted_chars = '0123456789';
$random = substr(str_shuffle($permitted_chars), 0, 10);
$delivery_date = "[".$delivery_date."]";
$pickup_date = "[".$pickup_date."]";
@$cat_id   =implode(',',$category_id);

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
  $photo1 		= 'cover-image'.substr(str_shuffle($permitted_chars), 0, 16).'.'.end($temp);
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
  $cover_image = '".@$photo1."';
}

/* this is for photo2 */
if($_FILES["icon"]["name"]) {
  $permitted_chars 	= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $temp 				= explode(".", $_FILES["icon"]["name"]);
  $name 				= $_FILES['icon']['name'];
  $target_dir 		= $image_path.'icon/';
  $photo2 		= 'shop-icon'.substr(str_shuffle($permitted_chars), 0, 16).'.'.end($temp);
  $target_file 		= $target_dir.$photo2;
  $imageFileType 		= strtolower($temp[1]);
  $extensions_arr 	= array("jpg","jpeg","png","gif");

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
    echo "<script>";
    echo "alert('File type must JPG or GIF'); window.location.href=history.back()";
    echo "</script>";
    exit();
  }
  move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file);
  $source_image = $target_file;
  $image_destination = $target_dir.$photo2;
  $shop_icon = '".@$photo2."';
}

/* this is for photo3 */
if($_FILES["icon2"]["name"]) {
  $permitted_chars 	= '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $temp 				= explode(".", $_FILES["icon2"]["name"]);
  $name 				= $_FILES['icon2']['name'];
  $target_dir 		= $image_path.'image/';
  $photo3 		= 'shop-image'.substr(str_shuffle($permitted_chars), 0, 16).'.'.end($temp);
  $target_file 		= $target_dir.$photo3;
  $imageFileType 		= strtolower($temp[1]);
  $extensions_arr 	= array("jpg","jpeg","png","gif");

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
    echo "<script>";
    echo "alert('File type must JPG or GIF'); window.location.href=history.back()";
    echo "</script>";
    exit();
  }
  move_uploaded_file($_FILES["icon2"]["tmp_name"], $target_file);
  $source_image = $target_file;
  $image_destination = $target_dir.$photo3;
}

if($_FILES["fCover"]["name"]) { $cover_image = $photo1; }else{ $cover_image = $cover_image; }
if($_FILES["icon"]["name"]) { $shop_icon = $photo2; }else{ $shop_icon = $shop_icon; }
if($_FILES["icon2"]["name"]) { $shop_image = $photo3; }else{ $shop_image = $shop_image; }

$sql2   = "UPDATE tbl_shop SET fb_live_url = '".$fb_live_url."', is_highlight = '".$is_highlight."', is_priority = '".$is_priority."', is_halal = '".$is_halal."',  is_eco_merchant = '".$is_eco_merchant."', shop_name = '".$shop_name."', shop_description = '".$shop_description."',category_id = '".$cat_id."', order_index = '".$order_index."', website_link = '".$website_link."', facebook_link = '".$facebook_link."', delivery_time = '".@$del_time."',  delivery_date = '".$delivery_date."',  pickup_time = '".@$pic_time."',  pickup_date = '".$pickup_date."',  location = '".$shop_location."',  delivery_leadtime = '".$delivery_leadtime."',  pickup_leadtime = '".$pickup_leadtime."',  fufilment_type_option = '".$fufilment_type_option."',  fufilment_cash_option = '".$fufilment_cash_option."',  fufilment_delivery = '".$fufilment_delivery."',  fufilment_pickup = '".$fufilment_pickup."',  fufilment_postage = '".$fufilment_postage."',  display_fufilment_delivery = '".$display_fufilment_delivery."',  display_fufilment_pickup = '".$display_fufilment_pickup."',  display_fufilment_postage = '".$display_fufilment_postage."',  display_fufilment_dinein = '".$display_fufilment_dinein."',  display_fufilment_takeaway = '".$display_fufilment_takeaway."',  display_fufilment_appointment = '".$display_fufilment_appointment."',  active_status = '".$active_status."',  pickup_location = '".$pickup_location."', modifiedDateTime=now(), cover_image = '".@$cover_image."', shop_icon = '".@$shop_icon."', shop_image = '".@$shop_image."'  WHERE  shop_id = '".$shop_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2);

//update tbl_order_shop
$s = "UPDATE tbl_order_shop SET shop_name = '".$shop_name."' WHERE shop_id = '".$shop_id."'";
mysqli_query($conn, $s);

$s2 = "UPDATE tbl_product SET shop_name = '".$shop_name."', shop_description = '".$shop_description."' WHERE shop_id = '".$shop_id."'";
mysqli_query($conn, $s2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE SHOP', 'Update shop with shop_id $shop_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"shop\"";
echo "</script>";
?>
