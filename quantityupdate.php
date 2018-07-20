<?php

session_start();
include("conn.php");

$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$quantitycart = $row['quantitycart'];
$quantityarray = explode(",",$quantitycart);
$quantityarray[$_POST['i']] = $_POST['quantity'];
$array = join(",",$quantityarray);
$query1 = "UPDATE users SET quantitycart = '".$array."' WHERE id = '".$_SESSION['id']."'";
$result1 = mysqli_query($link,$query1);





?>