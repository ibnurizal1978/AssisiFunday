<?php
session_write_close();
session_start();
//session_start(['cookie_secure' => true,'cookie_httponly' => true]);
ini_set('display_errors',1);  error_reporting(E_ALL);
include "../config.php";
//session_regenerate_id(true);
$txt_username	=	input_data($_POST['txt_username']);
$txt_password	= md5($_POST['txt_password']);
//$txt_password	=	input_data(md5($_POST['txt_password']));

if($txt_username=='' || $txt_password=='') {
  echo "<script>";
  echo "alert('Please fill all column'); window.location.href=history.back()";
  echo "</script>";
}

//generate balikannya
$replacements = array('1' => '2',
                      '2' => '3',
                      '3' => '4',
                      '4' => '5',
                      '5' => '6',
                      'a' => 'b',
                      'b' => 'c',
                      'c' => 'd',
                     );
//$txt_new_password = strtr($txt_password,$replacements);
$sql              = "SELECT staff_id, staffID, email, userName, staffName, roleID, status, companyID, shop_id FROM tbl_staff WHERE email = '".$txt_username."' AND password = '".$txt_password."' AND status = 1 LIMIT 1";
$h                = mysqli_query($conn ,$sql);
if(mysqli_num_rows($h)==0) {
  echo "<script>";
  echo "alert('Wrong login information'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$row              = mysqli_fetch_assoc($h);
if($row['email']<>$txt_username) {
  echo "<script>";
  echo "alert('Wrong login information'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

if($row['status']<>1) {
  //echo "<script>";
  echo "alert('Your user has been deactivated'); window.location.href=history.back()";
  echo "</script>";
  exit();
}

$staffID        = $row['staffID'];
$staff_id       = $row['staff_id'];
$email      = $row['email'];
$roleID       = $row['roleID'];
$userName       = $row['userName'];
$staffName      = $row['staffName'];
$companyID      = $row['companyID'];
$shop_id        = $row['shop_id'];
$sql            = "update tbl_staff SET lastLoginDateTime = now() where staff_id='".$staff_id."' limit 1";
$h2             = mysqli_query($conn,$sql);

$serverTimezoneOffset       = (date("O") / 100 * 60 * 60);
$clientTimezoneOffset       = $_POST["timezoneoffset"];
$serverTime                 = time();
$serverClientTimeDifference = $clientTimezoneOffset-$serverTimezoneOffset;
$clientTime                 = $serverTime+$serverClientTimeDifference;
$_SESSION['selisih']        = ($serverClientTimeDifference/(60*60));
$_SESSION['staffID']			  = $staffID;
$_SESSION['email']          = $email;
$_SESSION['userName']			  = $userName;
$_SESSION['staffName']			= $staffName;
$_SESSION['roleID']			    = $roleID;
$_SESSION['companyID']			= $companyID;
$_SESSION['shop_id']			  = $shop_id;
$_SESSION['staff_id']			  = $staff_id;

//mysqli_free_result($h);
//mysqli_free_result($h2);

//echo $_SESSION['staffID'].' - '.$_SESSION['userName'];
//exit();
//tampilkan menu berdasarkan level
/*
$sql_nav_header = "SELECT nav_header_id,nav_header_icon,nav_header_name FROM tbl_nav_user a INNER JOIN tbl_nav_menu b using (nav_menu_id) INNER JOIN tbl_nav_header USING (nav_header_id) WHERE user_id = '".$user_id."' GROUP BY nav_header_id ORDER by nav_menu_name";
$h_nav_header = mysqli_query($conn,$sql_nav_header);
echo $sql_nav_header;
while($row_menu_header = mysqli_fetch_assoc($h_nav_header)) {
	$_SESSION['nav_header'][]= array('header_id' => $row_menu_header['nav_header_id'],'header_icon' => $row_menu_header['nav_header_icon'],'header_name' => $row_menu_header['nav_header_name']);

	$sql_menu 	= "SELECT nav_header_id,nav_menu_name, nav_menu_url FROM tbl_nav_user a INNER JOIN tbl_nav_menu b using (nav_menu_id) WHERE user_id = '".$user_id."' AND nav_header_id = '".$row_menu_header['nav_header_id']."' ORDER by nav_menu_name";
	echo $sql_menu.'<br/>';
	$h_menu 	= mysqli_query($conn,$sql_menu);
	while($row_menu = mysqli_fetch_assoc($h_menu)) {
		$_SESSION['nav_items'][]= array('url' => $row_menu['nav_menu_url'], 'name' => $row_menu['nav_menu_name'],'nav_header_id' => $row_menu['nav_header_id']);
	}
}*/
//header('location:'.$base_url.'panel/jink');
if($roleID == 1) {
  header('location:'.$base_url.'panel/');
}else{
  header('location:'.$base_url.'panel/dashboard');
}
?>

<!-- Page JS Code -->
<script>
    jQuery(function () {
        // Init page helpers (Slick Slider plugin)
        Codebase.helpers('slick');
    });
</script>
