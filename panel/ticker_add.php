<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";

$content     = input_data(filter_var($_POST['content'],FILTER_SANITIZE_STRING));
$url         = input_data(filter_var($_POST['url'],FILTER_SANITIZE_STRING));
$live_date   = input_data(filter_var($_POST['live_date'],FILTER_SANITIZE_STRING));

if($content == "" || $url == "" || $live_date == "") {
    echo "<script>";
    echo "alert('Please fill up content, url and event date'); window.location.href=history.back()";
    echo "</script>";
    exit();
}


$sql2 = "INSERT INTO tbl_news_ticker SET content = '".$content."', url = '".$url."', live_date = '".$live_date."' , active_status = 1, created_at = now()";

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ADD NEWSTICKER', 'Add newsticker',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

mysqli_query($conn,$sql2) or die(mysqli_error($conn));
echo "<script>";
echo "alert('Success'); window.location=\"ticker\"";
echo "</script>";
?>
