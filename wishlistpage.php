<?php

session_start();
include("conn.php");

$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$wishlist = $row['wishlist'];
$wishlistitems = explode(",",$wishlist);
$numitems = sizeof($wishlistitems);
$sizewishlist = $row['sizewishlist'];
$sizeitems = explode(",",$sizewishlist);

if(isset($_POST['wishlistdelete']) && array_key_exists('wishlistdelete',$_POST) && array_key_exists("wsubmit",$_POST)){
	$placement = $_POST['wishlistdelete'];
	
	$query5 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result5 = mysqli_query($link,$query5);
		$row5 = mysqli_fetch_array($result5);
		$wishitems = explode(",",$row5['wishlist']);
		$sizewishitems = explode(",",$row5['sizewishlist']);
		if($row5['cart'] == ""){
			$query6 = "UPDATE users SET cart = '".mysqli_real_escape_string($link,$wishitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query6);
		}else{
			$query6 = "UPDATE users SET cart = '".$row5['cart'].",".mysqli_real_escape_string($link,$wishitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query6);
		}
		
		if($row5['sizecart'] == ""){
			$query7 = "UPDATE users SET sizecart = '".mysqli_real_escape_string($link,$sizewishitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query7);
		}else{
			$query7 = "UPDATE users SET sizecart = '".$row5['sizecart'].",".mysqli_real_escape_string($link,$sizewishitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query7);
		}
		
		if($row5['quantitycart'] == ""){
			$query7 = "UPDATE users SET quantitycart = '1' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query7);
		}else{
			$query7 = "UPDATE users SET quantitycart = '".$row5['quantitycart'].",1' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query7);
		}
	
	array_splice($wishitems,$placement,1);
	$joinarray = join(",",$wishitems);
	
	array_splice($sizewishitems,$placement,1);
	$joinarray1 = join(",",$sizewishitems);
	
	
	
	
	$query2 = "UPDATE users SET wishlist = '".$joinarray."'WHERE id = '".$_SESSION['id']."'";
	$result2 = mysqli_query($link,$query2);
	$query3 = "UPDATE users SET sizewishlist = '".$joinarray1."'WHERE id = '".$_SESSION['id']."'";
	$result3 = mysqli_query($link,$query3);
	
	
	
	
	header('Location: wishlistpage.php');
	
}

if(isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){	
	$ask = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
	$receive = mysqli_query($link,$ask);
	$answer = mysqli_fetch_array($receive);	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stylopedia is a specialized e-commerce site for Muzaffarpur, Bihar and handles Men, Women and Fashion Accessories.">
    <meta name="author" content="Stylopedia">
    <title>About | Stylopedia</title>
	
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
         
    <link rel="shortcut icon" href="images/ico/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    <style>
	.card {
    /* Add shadows to create the "card" effect */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
    transition: 0.3s;
	width:90%;
}

/* On mouse-over, add a deeper shadow */
.card:hover {
    box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

/* Add some padding inside the card container */
.container {
    padding: 2px 16px;
}

@media only screen and (max-width:991px){
	.navbar-nav{
		margin-top:5px;
		margin-right:-26px !important;
	}
	.navbar-nav li{
		margin-right:-5px;
	}
	.compress-nav{
		margin-left:40px;
	}
	.compress-nav li{
		margin-right:-10px !important;
	}
}
@media only screen and (max-width:767px){
.navbar-collapse{
	background-color:lightblue;
	width:99%;
	overflow-x:hidden;
}
}
 #login-modal .modal-content{
	background-color:#e5e5ff !important;
}
#register-modal .modal-content{
	background-color:#e5e5ff !important;
}
	</style>
</head>
<body>

    <header id="header">
       
        <nav class="navbar navbar-inverse navbar-fixed-top " style="height:60px">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/ico/icon.png" alt="logo" height="60px" style="margin-top:-10px"></a>
                </div>
				
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li class="active"><a href="about.php">About Us</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
						
                    </ul>
					<ul class="nav navbar-nav compress-nav">            
                        <li><a href="<?php if( isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "wishlistpage.php";}?>"><i class="fa fa-heart fa-2x tight"></i><span class="wq" style="border-radius:50%;font-size:15px;padding-right:6px;padding-left:6px;background-color:red;position:relative;bottom:15px;right:10px"></span></a></li>
						<li><a href="<?php if( isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "cartcheckout.php";}?>"><i class="fa fa-shopping-cart fa-2x tight"></i><span class="cq" style="border-radius:50%;font-size:15px;padding-right:6px;padding-left:6px;background-color:red;position:relative;bottom:15px;right:10px"></span></a></li>
						<?php  if(!isset($_SESSION['id']) && !array_key_exists("id",$_SESSION)){ echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>';}else{ echo '<li><a href="shop.php?logout=1">Logout| '.$answer['fname'].'</a></li>';} ?>
                    </ul>						
                </div>
            </div>
        </nav>
		
    </header>
	
	<div class="container" style="margin-top:70px">
	    <h1 style="color:grey" class="text-center"><b>WishList</b></h1><hr><br><br>
	    <div class="row">
		  <?php 
		    $i =0;
		    while($i < $numitems):
			    $query1 = "SELECT * FROM items WHERE id = '".$wishlistitems[$i]."'";
				$result1 = mysqli_query($link,$query1);
				$row1 = mysqli_fetch_array($result1);
		  ?>
		    <div class="col-sm-3">
			    <div class="card">
				  <img src="images/items/<?php echo $row1['image1'];  ?>" alt="Avatar" style="width:100%;height:300px">
					<h5 style="padding:10px"><?php echo $row1['heading'];   ?></h5>
                    <h5 class="text-center" style="margin-bottom:10px">Size:<?php echo $sizeitems[$i];   ?></h5>					
					<h3 class="text-center" style="color:#F1696E;margin-top:-10px"><b>Rs.<?php echo $row1['nprice'];   ?></b></h3> 
					<form method="post">
					<input type="hidden" name="wishlistdelete" value="<?php  echo $i;  ?>">
					<input type="submit" class="btn" style="margin-left:25%;margin-bottom:10px" value="Move to Cart" name="wsubmit">
					</form>
				</div>
			</div>
		  <?php
		    $i = $i+1;
		    endwhile;
		  ?>
		</div>
	</div>
	
	<script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
	<script>
	
	$(".loginchangebtn").click(function(){
	    $('#login-modal').modal('hide');
	});
    $(".registerchangebtn").click(function(){
        $('#register-modal').modal('hide');
    });
	 
	setInterval(function(){
		$.get("repeat.php", function(data){
			var repeatdata = data.toString();
			
			var wq = repeatdata.slice(0,repeatdata.indexOf(","));
			var cq = repeatdata.slice(repeatdata.indexOf(",")+1);
			
			
			$(".wq").html(wq);
			$(".cq").html(cq);
			
		});
	},100);
	
	</script>
</body>	
</html>