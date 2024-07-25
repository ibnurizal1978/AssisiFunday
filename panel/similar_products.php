<?php 
require_once "../config.php";

	$sql = "SELECT shop_name, product_name FROM tbl_product WHERE product_name LIKE '%".$_GET['query']."%' ORDER BY shop_name LIMIT 10"; 
	$result = mysqli_query($conn, $sql);

	$json = [];
	while($row = mysqli_fetch_assoc($result)){
	     //$json[] = $row['shop_name'].' - '.$row['product_name'];
		 $json[] = $row['product_name'];
	}


	echo json_encode($json);
?>