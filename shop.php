<?php
session_start();
include("conn.php");


if(array_key_exists('clicked',$_GET) && array_key_exists("subcategory",$_GET) && $_GET['subcategory'] != "brands" && !array_key_exists("brand",$_GET)){
	$subcategory = $_GET['subcategory'];
	$query = "SELECT * FROM items WHERE subcategory = '".$_GET['subcategory']."' ";
	$result = mysqli_query($link,$query);
}elseif(array_key_exists('clicked',$_GET) && array_key_exists("subcategory",$_GET) && $_GET['subcategory'] == "brands"){
	$subcategory = $_GET['subcategory'];
	$query = "SELECT * FROM brands";
	$result = mysqli_query($link,$query);
}elseif(array_key_exists('clicked',$_GET) && array_key_exists("brand",$_GET)){
	$subcategory = $_GET['brand'];
	$query = "SELECT * FROM items WHERE brand = '".$_GET['brand']."'";
	$result = mysqli_query($link,$query);
}
else{
	$query = "SELECT * FROM items";
	$result = mysqli_query($link,$query);
}




if(array_key_exists('logout',$_GET)){
		session_unset();
		header('Location: shop.php');
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
      .extra-menu{
		display:none;
	  }
	  
       @media only screen and (max-width:767px){

        .sidebar{
                display:none;
        }
        .extra-menu{
            display:block;
        }
      }
      @media only screen and (max-width:991px){
		
	.flex-item{
		width: 35%;
		height: 500px;
		margin: 13px;
		margin-top:-70px;
		margin-left:30px;
	}
	.navbar .nav li{
		     margin-bottom:-5px !important;
	    }
	
}
      .compress-nav li{
	margin-right:-40px;

}
@media only screen and (max-width:1200px){
	.compress-nav li{
	margin-right:0px;

}
}
      .sidebar {
  background: -webkit-linear-gradient(#9999ff, white); /* For Safari 5.1 to 6.0 */
    background: -o-linear-gradient(#9999ff, white); /* For Opera 11.1 to 12.0 */
    background: -moz-linear-gradient(#9999ff, white); /* For Firefox 3.6 to 15 */
    background: linear-gradient(#9999ff, white); /* Standard syntax */
  height:100%;
  position:fixed;
  margin-top:0px;
}
 .category-header{
  font-family:"Times New Roman", Times, serif;
  font-size:32px;
}
 .category-hr {
  margin-top:0px;
  width:70%;
  margin-left:0%;
}

 .category-list{
  list-style-type:none;
  content:outside;
}

 .category-ul {
  background-color:#ff6666;
  font-weight:bold;
  box-shadow: 4px 4px 5px #6666FF;
}
.category-ul li {
  background-color:#e5e5ff;

}

 .subcategory-ul{
  list-style-type:none;
  font-weight:normal;
}
 .subcategory-ul li{
	cursor:default;
}
 .subcategory-ul li:hover{
	color:red;
}
 .span-men:hover{
  cursor:default;
}
 .span-women:hover{
  cursor:default;
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
						<div class="extra-menu">
						<ul class="list-group category-ul" >
						<li class="list-group-item" ><span  class="span-men">Men</span>
				  <ul class="subcategory-ul" id="subcategory-men">
				    <li>Brands</li>
				    <li>Topwear</li>
				    <li>Bottomwear</li>
				  </ul>
				</li>
				<li class="list-group-item" ><span  class="span-women">Women</span>
				  <ul class="subcategory-ul" id="subcategory-women">
				    <li>Brands</li>
				    <li>Indian & Fusion Wear</li>
				    <li>Western Wear</li>
				  </ul>
				</li>  
				<li class="list-group-item" >Accessories</li>
				</ul>
				</div>
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
	
	<div class="container row">
	   
	    <div class="sidebar col-sm-3">
		    <h2 class="category-header">Categories</h2><hr class="category-hr">
			<ul class="list-group category-ul">
				<li class="list-group-item"><span  class="span-men">Men</span>
				  <ul class="subcategory-ul" id="subcategory-men">
				    <li>Brands</li>
				    <li>Topwear</li>
				    <li>Bottomwear</li>
				  </ul>
				</li>
				<li class="list-group-item "><span  class="span-women">Women</span>
				  <ul class="subcategory-ul" id="subcategory-women">
				    <li>Brands</li>
				    <li>Indian & Fusion Wear</li>
				    <li>Western Wear</li>
				  </ul>
				</li>  
				<li class="list-group-item">Accessories</li>
			</ul>
	    </div>
		
		<div class="col-sm-9 col-sm-push-4 list-items" >
		    <p class="text-center category-title"><?php if(isset($subcategory)){echo ucfirst($subcategory);}else{ echo "ALL PRODUCTS";}  ?></p><hr><br><br><br><br>
			<div class="flex-container">
			  <?php
			    if(array_key_exists("subcategory",$_GET) && $_GET['subcategory'] == "brands"){
				while($row = mysqli_fetch_array($result)):
				
			  ?>
			    <div class="flex-item" style="margin-bottom:-150px;" >
				    <a href="<?php echo "shop.php?brand=".$row['brand']."&clicked=1";     ?>"><img src="images/ico/<?php echo $row['image']; ?>" alt="item" width="200px" height="150px" class="img-responsive"></a>
					
					
				</div>
			  <?php
			    endwhile;}elseif(array_key_exists("brand",$_GET)){
              ?>
			  <?php
			    
				while($row = mysqli_fetch_array($result)):
				
			  ?>
			    <div class="flex-item" >
				    <a href="<?php echo "details.php?id=".$row['id'];     ?>"><img src="images/items/<?php echo $row['image1']; ?>" alt="item" width="200px" height="250px" class="img-responsive"></a>
					<h3><?php echo $row['heading'];     ?></h3>
					<h4><span>Rs.<?php echo $row['nprice'];  ?></span><span class="oprice-span">Rs.<?php echo $row['oprice'];  ?></span><span style="color:#FF717B"> ( <?php echo round((($row['oprice']-$row['nprice'])/$row['oprice'])*100);   ?>% OFF )</span></h4>
				</div>
			  <?php
			    endwhile;}else{
              ?>
			  <?php
			    
				while($row = mysqli_fetch_array($result)):
				
			  ?>
			    <div class="flex-item" >
				    <a href="<?php echo "details.php?id=".$row['id'];     ?>"><img src="images/items/<?php echo $row['image1']; ?>" alt="item" width="200px" height="250px" class="img-responsive"></a>
					<h3><?php echo $row['heading'];     ?></h3>
					<h4><span>Rs.<?php echo $row['nprice'];  ?></span><span class="oprice-span">Rs.<?php echo $row['oprice'];  ?></span><span style="color:#FF717B"> ( <?php echo round((($row['oprice']-$row['nprice'])/$row['oprice'])*100);   ?>% OFF )</span></h4>
				</div>
			  <?php
			    endwhile;}
              ?>			  
			</div>
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