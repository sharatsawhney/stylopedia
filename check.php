<?php

    session_start();
    if(array_key_exists('id',$_POST)){
		include("conn.php");
		$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result = mysqli_query($link,$query);
		$row = mysqli_fetch_array($result);
		if($row['cart'] == ""){
			$query1 = "UPDATE users SET cart = '".mysqli_real_escape_string($link,$_POST['id'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query1);
		}else{
			$query1 = "UPDATE users SET cart = '".$row['cart'].",".mysqli_real_escape_string($link,$_POST['id'])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query1);
		}
	}





?>