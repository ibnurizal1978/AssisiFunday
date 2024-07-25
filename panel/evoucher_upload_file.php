<?php
session_start();
ini_set('display_errors',1);  error_reporting(E_ALL);
require_once "../config.php";
require_once "../check-session.php";

$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

//if($imageFileType != "csv" && $imageFileType != "png" && $imageFileType != "gif" && $imageFileType != "jpeg") {
if(empty($_FILES['files']['name']))
{
  echo "<script>";
  echo "alert('Please upload file!'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if(!in_array($_FILES['files']['type'], $csvMimes)){
  echo "<script>";
  echo "alert('File type must csv'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$evoucher_id = $_POST['evoucher_id'];
$base = "../file/";
$filename = $_FILES['files']['name'];
if (@is_uploaded_file($_FILES["files"]["tmp_name"])) {
copy($_FILES["files"]["tmp_name"], "$base" . "$filename");
}
$filenameb= $base . $filename;
if (file_exists($filenameb)){
   $handle = fopen("$filenameb", "r") or die("no file");
   while (($data = fgetcsv($handle, 50000, "," )) !== FALSE ){

      $evoucher_code = str_replace(',', '', $data[0]);
      $evoucher_code = str_replace(';', '', $data[0]);
      //$s = "SELECT evoucher_code FROM tbl_evoucher_list WHERE evoucher_code = '".$evoucher_code."'";
      //$h = mysqli_query($conn, $s);
      //if(mysqli_num_rows($h)==0)
      //{
        $s2="INSERT INTO tbl_evoucher_list (evoucher_id, evoucher_code, shop_id, product_id, created_at,staff_id) VALUES ('".$_POST['evoucher_id']."', '".$evoucher_code."', '".$_POST['shop_id']."','".$_POST['product_id']."',now(),'".$_SESSION['staff_id']."')";
        if(mysqli_query($conn, $s2))
        {
          echo $data[0].' -> <font color="green">success</font><br/>';
        }else{
          echo $data[0].' -> <font color="#ff0000">failed</font><br/>';
        }
    //  }
    }
}

/* === LOG === */
$sql_log = "INSERT INTO tbl_log(user_id, action, notes, cms, created_at) VALUES ('".$_SESSION['staff_id']."', 'UPLOAD VOUCHER LIST', 'Upload evoucher list for evoucher_id: $evoucher_id',1,now())";
mysqli_query($conn, $sql_log);
/* === LOG === */
echo '<br/><br/><a href=evoucher_list?'.Encryption::encode($evoucher_id).'><b>back to list</b></a>';
echo "<script>";
//echo "alert('Success'); window.location.href=history.back()";
//echo "alert('Success'); window.location=\"evoucher_list?".Encryption::encode($evoucher_id).""\"";
echo "</script>";
 ?>
