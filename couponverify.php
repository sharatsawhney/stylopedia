<?php

session_start();
include("conn.php");
if(isset($_POST['couponcode'])){
	$query = "SELECT * FROM coupons WHERE code = '".$_POST['couponcode']."'";
	$result = mysqli_query($link,$query);
	if($num = mysqli_num_rows($result)== 1){
		$row = mysqli_fetch_array($result);
		echo $row['discount'];
	}
	else{
		echo 0;
	}
}




?>