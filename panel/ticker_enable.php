<?php
session_start();
ini_set('display_errors',0);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";
$tickerID  = Encryption::decode($param[1]);
$sql2   = "UPDATE tbl_news_ticker SET active_status = '1'  WHERE news_ticker_id = '".$tickerID."' LIMIT 1";
//echo $sql2;
mysqli_query($conn,$sql2);

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'ENABLE NEWSTICKER', 'Enable newsticker with news_ticker_id $news_ticker_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */

echo "<script>";
echo "alert('Success'); window.location.href=history.back()";
echo "</script>";
?>
