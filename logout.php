<?php
session_start();
require_once 'config.php';
unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION['staffID']);
session_unset();
session_destroy();
session_regenerate_id(true);
if($_GET['s']=='e') {
	header("Location: ".$base_url."index.php?p=e");
}elseif($_GET['s']=='session') {
	header("Location: ".$base_url."index.php?p=s");
}else{
	header("Location: ".$base_url);
}
?>
