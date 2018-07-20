<?php

session_start();
include("conn.php");

if(array_key_exists("subemail",$_POST)){
		$ques = "SELECT id FROM subscribers WHERE subemail = '".$_POST['subemail']."'";
		$ans = mysqli_query($link,$ques);
		if( mysqli_num_rows($ans) != 1){
			$ques1 = "INSERT INTO subscribers (subemail) VALUES ( '".$_POST['subemail']."')";
			$ans1 = mysqli_query($link,$ques1);
			$h = "You have been sucessfully subscribed to Stylopedia!";
			echo $h;
			
		}else{
			$h = "You have already subscribed to stylopedia";
			echo $h;
			
		}
	}


?>