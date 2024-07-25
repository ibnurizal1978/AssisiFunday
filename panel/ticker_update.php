<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$news_ticker_id = Encryption::decode($_POST['id']);
$content = input_data(filter_var($_POST['content'],FILTER_SANITIZE_STRING));
$url = input_data(filter_var($_POST['url'],FILTER_SANITIZE_STRING));
$live_date = input_data(filter_var($_POST['live_date'],FILTER_SANITIZE_STRING));
$active_status = input_data(filter_var($_POST['active_status'],FILTER_SANITIZE_STRING));

if($content == "" || $url == "" || $live_date == "") {
    echo "<script>";
    echo "alert('Please fill content, url and event date'); window.location.href=history.back()";
    echo "</script>";
    exit();
}

$sql2 = "UPDATE tbl_news_ticker SET content = '".$content."', url = '".$url."', live_date = '".$live_date."',  active_status = '".$active_status."' WHERE news_ticker_id = '".$news_ticker_id."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPDATE NEWSTICKER', 'Update newsticker with news_ticker_id $news_ticker_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location=\"ticker\"";
echo "</script>";
?>
