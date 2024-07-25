<?php
session_start();
ini_set('display_errors', 1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";
//require_once "access.php";

$vcs_code         = input_data(filter_var($_POST['vcs_code'],FILTER_SANITIZE_STRING));

$s = "SELECT evoucher_code, used_status, shop_id from tbl_evoucher_list WHERE evoucher_code = '".$vcs_code."' LIMIT 1";
$h = mysqli_query($conn, $s);
if(mysqli_num_rows($h) == 0)
{
    header('location:vcs_failed?1');
    exit();
}

$r = mysqli_fetch_assoc($h);

if($r['shop_id']<>$_SESSION['shop_id']) {
    header('location:vcs_failed?2');
    exit();
}

if($r['used_status']==1)
{
    header('location:vcs_failed?3');
    exit();
}else{
    $sup = "UPDATE tbl_evoucher_list SET used_status = 1, used_date = now() WHERE evoucher_code = '".$vcs_code."' LIMIT 1";
    mysqli_query($conn, $sup);
    header('location:vcs_success');
}
?>
