<?php

    session_start();
    if(isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){
		include("conn.php");
		$query4 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result4 = mysqli_query($link,$query4);
		$row4 = mysqli_fetch_array($result4);
		$wq = sizeof(explode(",",$row4['wishlist']));
		$cq = sizeof(explode(",",$row4['cart']));
		if($row4['wishlist'] == ""){echo 0;}else{echo $wq;}
		echo ",";
		if($row4['cart'] == ""){echo 0;}else{echo $cq;}
	}else{
		$wq = 0;
		$cq = 0;
		echo $wq;
		echo ",";
		echo $cq;
	}





?>