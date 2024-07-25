<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
include_once '../config.php';

$s = "SELECT user_id FROM tbl_user WHERE active_status = 1";
$h = mysqli_query($conn, $s);
while($r = mysqli_fetch_assoc($h)) {

    $s2 = "INSERT INTO tbl_lucky_draw SET user_id = '".$r['user_id']."', via = 'Activation', created_at = now()";

}
?>
