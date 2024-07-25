<?php
include '../assets/plugins/phpqrcode/qrlib.php';
$ecc = 'H';
$pixel_size = 5;
$frame_size = 2;

$code1 ='RSSILOAM77754735835';

$file_name1 = $code1;

$file_image1 = "../file/".$file_name1.".png";
QRcode::png($code1, $file_image1, $ecc, $pixel_size, $frame_size); 

?>