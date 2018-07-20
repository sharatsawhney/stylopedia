<?php

    session_start();
    if(array_key_exists('id',$_POST)){
		include("conn.php");
		$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
		if($row['wishlist'] == ""){
			$query1 = "UPDATE users SET wishlist = '".mysqli_real_escape_string($link,$_POST['id'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query1);
		}else{
			$query1 = "UPDATE users SET wishlist = '".$row['wishlist'].",".mysqli_real_escape_string($link,$_POST['id'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query1);
		}
		
		if($row['sizewishlist'] == ""){
			$query1 = "UPDATE users SET sizewishlist = '".mysqli_real_escape_string($link,$_POST['sizeItem'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query1);
		}else{
			$query1 = "UPDATE users SET sizewishlist = '".$row['sizewishlist'].",".mysqli_real_escape_string($link,$_POST['sizeItem'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query1);
		}
	}





?>