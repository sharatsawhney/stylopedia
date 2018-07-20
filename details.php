<?php
session_start();
include("conn.php");

	$query = "SELECT * FROM items WHERE id = '".$_GET['id']."' ";
	$result = mysqli_query($link,$query);
    $row = mysqli_fetch_array($result);

	
	if(array_key_exists('logout',$_GET)){
		session_unset();
		header('Location: details.php?id='.$_GET['id']);
	}
	elseif(array_key_exists('id',$_SESSION) && !array_key_exists('user',$_GET)){
		$query2 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result2 = mysqli_query($link,$query2);
		$row2 = mysqli_fetch_array($result2);
	    $url = $_SERVER['REQUEST_URI'];
		$getdecide = parse_url($url, PHP_URL_QUERY);
		
		if ($getdecide) {
			$url .= '&user='.$row2['email'];
			header('Location: '.$url);
		} else {
			$url .= '?user='.$row2['email'];
			header('Location: '.$url);
		}
	}
	
	if(isset($_POST['login-hidden']) && array_key_exists("login-hidden",$_POST) && $_POST['login-hidden']=="Login"){
		if($_POST['login-email'] == "" || $_POST['login-password'] == ""){
		    $error = "Please provide complete details";
		}else{
			$query1 = "SELECT * FROM users WHERE email = '".mysqli_real_escape_string($link,$_POST['login-email'])."' AND password = '".mysqli_real_escape_string($link,md5($_POST['login-password']))."'";
			$result1 = mysqli_query($link,$query1);
			if(mysqli_num_rows($result1) ==1){
				$row1 = mysqli_fetch_array($result1);
                $_SESSION['id'] = $row1['id'];
                $url = $_SERVER['REQUEST_URI'];
				$getdecide = parse_url($url, PHP_URL_QUERY);
				
				if ($getdecide) {
					$url .= '&user='.$row1['email'];
					header('Location: '.$url);
				} else {
					$url .= '?user='.$row1['email'];
					header('Location: '.$url);
				}
			}else{
				echo "You are not a registered user!";
			}
		}
	}
	elseif(isset($_POST['register-hidden']) && array_key_exists("register-hidden",$_POST) && $_POST['register-hidden']=="Register"){
		if($_POST['register-email'] == "" || $_POST['register-password'] == "" || $_POST['fname'] == "" || $_POST['lname'] == "" || $_POST['number'] == ""){
		    $error =  "Please provide complete details";
		}else{
			$query1 = "INSERT INTO users (fname,lname,email,number,password) VALUES ('".mysqli_real_escape_string($link,$_POST['fname'])."', '".mysqli_real_escape_string($link,$_POST['lname'])."', '".mysqli_real_escape_string($link,$_POST['register-email'])."', '".mysqli_real_escape_string($link,$_POST['number'])."', '".mysqli_real_escape_string($link,md5($_POST['register-password']))."')";
			$result1 = mysqli_query($link,$query1);
			$_SESSION['id'] = mysqli_insert_id($link);
			$query3 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
			$result3 = mysqli_query($link,$query3);
			$row3 = mysqli_fetch_array($result3);
                $url = $_SERVER['REQUEST_URI'];
				$getdecide = parse_url($url, PHP_URL_QUERY);
				
				if ($getdecide) {
					$url .= '&user='.$row3['email'];
					header('Location: '.$url);
				} else {
					$url .= '?user='.$row3['email'];
					header('Location: '.$url);
				}
		}
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
    <title>Shop | Stylopedia</title>
	
	
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
	.chatter img{
		margin-bottom:10px;
		border:1px solid grey;
	}
    .compress-nav li{
          margin-right:-40px;

      }
      @media only screen and (max-width:1200px){
          .compress-nav li{
          margin-right:0px;

      }
      }  
	  @media only screen and (max-width:991px){
		  .navbar .nav li{
		     margin-bottom:-5px !important;
	    }
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
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="<?php if(isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "shop.php?subcategory=topwear&clicked=1&user=sharatsawhneyy@gmail.com";}else{ echo "shop.php?subcategory=topwear&clicked=1";}   ?>">Men</a></li>
                        <li><a href="<?php if(isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "shop.php?subcategory=indian&clicked=1&user=sharatsawhneyy@gmail.com";}else{ echo "shop.php?subcategory=indian&clicked=1";}   ?>">Women</a></li>
                        <li><a href="#">Fashion Accessories</a></li>
						<li><a href="<?php if(isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "shop.php?subcategory=brands&clicked=1&user=sharatsawhneyy@gmail.com";}else{ echo "shop.php?subcategory=brands&clicked=1";}   ?>">Brands</a></li>
						
                    </ul>
					<ul class="nav navbar-nav compress-nav">            
                        <li><a href="<?php if( isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "wishlistpage.php";}?>"><i class="fa fa-heart fa-2x tight"></i><span class="wq" style="border-radius:50%;font-size:15px;padding-right:6px;padding-left:6px;background-color:red;position:relative;bottom:15px;right:10px"></span></a></li>
						<li><a href="<?php if( isset($_SESSION['id']) && array_key_exists("id",$_SESSION)){ echo "cartcheckout.php";}?>"><i class="fa fa-shopping-cart fa-2x tight"></i><span class="cq" style="border-radius:50%;font-size:15px;padding-right:6px;padding-left:6px;background-color:red;position:relative;bottom:15px;right:10px"></span></a></li>
						<?php  if(!isset($_SESSION['id']) && !array_key_exists("id",$_SESSION)){ echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>';}else{ echo '<li><a href="details.php?id='.$_GET['id'].'&logout=1">Logout| '.$answer['fname'].'</a></li>';} ?>
                    </ul>						
                </div>
            </div>
        </nav>
		
    </header>
	
	<div class="modal fade" id="login-modal">
	  <div class="modal-dialog" >
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="login-title">Login</h4>
		  </div>
		  <div class="modal-body">
			  <form method="post">
				  <div class="form-group">
					<label for="form-email">Email address</label>
					<input type="email" name="login-email" class="form-control" id="form-email" placeholder="Email">
				  </div>
				  <div class="form-group">
					<label for="form-password">Password</label>
					<input type="password"  name="login-password" class="form-control" id="form-password" placeholder="Password">
				  </div>
				  <input type="hidden" name="login-hidden" class="form-control" value="Login">
				  <button type="submit" class="btn btn-default">Login</button>
				  <button type="button" class="btn btn-default loginchangebtn" data-toggle="modal" data-target="#register-modal">Create a New Account</button>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="modal fade" id="register-modal">
	  <div class="modal-dialog" >
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="login-title">Register</h4>
		  </div>
		  <div class="modal-body">
			  <form method="post">
			      <div class="row">
				  <div class="col-sm-6">
			      <div class="form-group">
					<label for="form-fname">First Name</label>
					<input type="text" name="fname" class="form-control" id="form-fname" placeholder="First Name">
				  </div>
				  </div>
				  <div class="col-sm-6">
				  <div class="form-group">
					<label for="form-lname">Last Name</label>
					<input type="text" name="lname" class="form-control" id="form-lname" placeholder="Last Name">
				  </div>
				  </div>
				  </div>
				  <div class="form-group">
					<label for="form-email">Email address</label>
					<input type="email" name="register-email" class="form-control" id="form-email" placeholder="Email">
				  </div>
				  <div class="form-group">
					<label for="form-number">Contact Number</label>
					<input type="text"  name="number" class="form-control" id="form-number" placeholder="Contact Number">
				  </div>
				  <div class="form-group">
					<label for="form-password">Password</label>
					<input type="password"  name="register-password" class="form-control" id="form-password" placeholder="Password">
				  </div>
				  <input type="hidden" name="register-hidden" class="form-control" value="Register">
				  <button type="submit" class="btn btn-default" name="register">Create Account</button>
				  <button type="button" class="btn btn-default registerchangebtn" data-toggle="modal" data-target="#login-modal">Already have an account</button>
			  </form>
		  </div>
		</div>
	  </div>
	</div>
	
	<div class="container" style="margin-top:190px;margin-bottom:20px">
	    
		<h4 style="color:grey;margin-top:-50px;margin-bottom:40px"><?php echo ucfirst($row['category']);  ?>  /  <?php echo ucfirst($row['subcategory']);    ?></h4>
	    <div class="row">
		    <div class="col-sm-1 chatter">
			    <img src="images/items/<?php echo $row['image1'];  ?>" width="50px" height="60px">
				<img src="images/items/<?php echo $row['image2'];  ?>" width="50px" height="60px">
				<img src="images/items/<?php echo $row['image3'];  ?>" width="50px" height="60px">
				<img src="images/items/<?php echo $row['image4'];  ?>" width="50px" height="60px">
				<img src="images/items/<?php echo $row['image5'];  ?>" width="50px" height="60px">
			</div>
			<div class="col-sm-6 cover-photo">
			    <img src="images/items/<?php echo $row['image1'];   ?>" width="500px" height="600px" class="img-responsive">
			</div>
			<div class="col-sm-5">
			    <h2 style="color:black"><b><?php echo $row['heading'];     ?></b></h2>
				<h3><span style="text-decoration:line-through">Rs.<?php echo $row['oprice']; ?></span><span style="color:red"> ( <?php echo round((($row['oprice']-$row['nprice'])/$row['oprice'])*100);   ?>% OFF )</span></h3>
				<h3 style="color:black;margin-top:0px"><b>Rs.<?php echo $row['nprice'];  ?></b></h3><br>
				<select style="padding:6px;background-color:lightgrey" class="sizeselect">
				    <option value="Select Size" disabled selected>Select Size</option>
				    <option value="S">S</option>
				    <option value="M">M</option>
				    <option value="L">L</option>
				    <option value="XL">XL</option>
					<option value="XXL">XXL</option>
				</select>
				<input type="number" name="quantity" min="1" placeholder="Quantity" style="padding:5px;background-color:lightgrey" class="quantityselect" value="1"><br><br>
				<button type="button" class="btn btn-lg cart-btn" style="background: #ccccff;background: -webkit-linear-gradient(#ccccff, #7f7fff);background: -o-linear-gradient(#ccccff, #7f7fff);background: -moz-linear-gradient(#ccccff,#7f7fff);background: linear-gradient(#ccccff, #7f7fff);"><b>ADD TO CART</b></button>
				<button type="button" class="btn btn-lg wishlist-btn" style="background: #ccccff;background: -webkit-linear-gradient(#ccccff, #7f7fff);background: -o-linear-gradient(#ccccff, #7f7fff);background: -moz-linear-gradient(#ccccff,#7f7fff);background: linear-gradient(#ccccff, #7f7fff);"><b>ADD TO WISHLIST</b></button><br><br>
				<button type="button" class="btn btn-lg buy-btn" style="background-color:red"><b>BUY NOW</b></button>
			</div>
		</div>
	</div>
	
	<footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2017 <a target="_blank" href="http://www.stylopedia.co.in">Stylopedia</a>. All Rights Reserved.
                </div>
                <div class="col-sm-6">
                    <ul class="pull-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

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
	 function getUrlVars(){
		var vars = [], hash;
		var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
		for(var i = 0; i < hashes.length; i++)
		{
			hash = hashes[i].split('=');
			vars.push(hash[0]);
			vars[hash[0]] = hash[1];
		}
		return vars;
	}
	$(".cart-btn").click(function(){
		if(!getUrlVars()["user"]){
			alert("Please Login to continue!");
		}else if($(".sizeselect").val() == null){
			alert("Please, Select a size!");
		}else{
			var userEmail = getUrlVars()["user"];
			var productId = getUrlVars()["id"];
			var sizeItem = $(".sizeselect").val();
			var quanItem = $(".quantityselect").val();
			$.ajax({
				type: 'POST',
				url: 'cart.php',
				data: { id : productId, sizeItem: sizeItem, quanItem: quanItem},
				success: function(){
					
				}
			});
			
		}
	});
	
	$(".wishlist-btn").click(function(){
		if(!getUrlVars()["user"]){
			alert("Please Login to continue!");
		}else if($(".sizeselect").val() == null){
			alert("Please, Select a size!");
		}else{
			var userEmail = getUrlVars()["user"];
			var productId = getUrlVars()["id"];
			var sizeItem = $(".sizeselect").val();
			$.ajax({
				type: 'POST',
				url: 'wishlist.php',
				data: { id : productId,sizeItem:sizeItem},
				success: function(){
					
				}
			});
			
		}
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