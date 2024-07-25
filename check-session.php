<?php
//if(!isset($_SESSION['staffID'])) {
if(!isset($_SESSION['staffID']) || !isset($_COOKIE["PHPSESSID"]) || strlen(session_id()) < 1)
{
	header("Location: ../logout.php?s=session");
	echo 'Your session is done.';
	die();
	//header("Location: ../logout.php?s=session");
	//if(!isset($_SESSION['staffID']) || !isset($_COOKIE["PHPSESSID"]) || strlen(session_id()) < 1) {
}
?>
