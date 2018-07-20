<?php

session_start();
include("conn.php");

$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$quantitycartarray = $row['quantitycart'];
$quantitycart = explode(",",$quantitycartarray);
for($i=0;$i < sizeof($quantitycart);$i++){
	echo $quantitycart[$i];
	echo " ";
}




?>