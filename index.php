<?php
session_start();
include("conn.php");

	$query = "SELECT * FROM items WHERE deal= '1'";
	$result = mysqli_query($link,$query);
	
	if(array_key_exists('logout',$_GET)){
		session_unset();
		header('Location: index.php');
	}
	elseif(array_key_exists('id',$_SESSION) && !array_key_exists('user',$_GET)){
		$query2 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result2 = mysqli_query($link,$query2);
		$row2 = mysqli_fetch_array($result2);
	    header('Location: index.php?user='.$row2['email']);
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
                header('Location: index.php?user='.$row1['email']);				
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
                header('Location: index.php?user='.$row3['email']);				
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
    <meta name="author" content="Stylopedia-Fashion for Men and Women with Fashion Accessories">
    <title>Home | Stylopedia:Fashion Products for Men and Women</title>
	
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
	<link href="css/animations.css" rel="stylesheet">
	<link href="css/animations-ie-fix.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
         
    <link rel="shortcut icon" href="images/ico/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
	<style>
	.carousel-inner {
			height:250px !important;
			margin-top:60px;
		}
	.carousel-content h1{
			margin-top:-200px !important;
		}
	.carousel-content h2{
			margin-top:0px !important;
		}	
			
	@media only screen and (max-width:991px){
	    
		.carousel-inner {
			height:250px !important;
		}
		.carousel-content h1{
			margin-top:-230px !important;
		}
		.carousel-content h2{
			margin-top:0px !important;
		}
		.carousel-indicators{
			margin-top:-500px !important;
		}
		.navbar .nav li{
		     margin-bottom:-5px !important;
	    }
		.footer-list{
			margin-bottom:-30px !important;
		}
	    #footer .col-sm-3{
			margin-bottom:60px !important;
		}
		.shopwomen{
	        bottom:100px !important;
	        left:10px !important;
        }
        .shopmen{
	        bottom:100px !important;
	        right:10px !important;
        }
		.accessoriesdiv img{
			height:300px !important;
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
	
	
}
      .compress-nav li{
	margin-right:-40px;

}
@media only screen and (max-width:1200px){
	.compress-nav li{
	margin-right:0px;

}
}
.shopwomen{
	bottom:200px;
	left:20px;
}
.shopmen{
	bottom:200px;
	right:90px;
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

<body class="homepage">
    <div class="loader-div loader-div-virtual">
	    <div class="loader">
		  <div class="dot dot-1"></div>
		  <div class="dot dot-2"></div>
		  <div class="dot dot-3"></div>
		</div>

		<svg xmlns="http://www.w3.org/2000/svg" version="1.1">
		  <defs>
			<filter id="goo">
			  <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
			  <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 21 -7"/>
			</filter>
		  </defs>
		</svg>
	</div>
    
    <header id="header">
       
        <nav class="navbar navbar-inverse navbar-fixed-top special-navbar" style="height:60px" >
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
						<?php  if(!isset($_SESSION['id']) && !array_key_exists("id",$_SESSION)){ echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>';}else{ echo '<li><a href="index.php?logout=1">Logout| '.$answer['fname'].'</a></li>';} ?>
						
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

    <section id="main-slider" class="no-margin">
        <div class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#main-slider" data-slide-to="0" class="active"></li>
                <li data-target="#main-slider" data-slide-to="1"></li>
                <li data-target="#main-slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">

                <div class="item item1 active" style="background-image: url(images/slider/b1.jpg);background-attachment:fixed;">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 slider-headings">Trending and quality-oriented Men's Apparels</h1>
                                    <h2 class="animation animated-item-2">Get all range of men's wearings from topwear to bottomwear with quality and service par excellence.</h2>
                                    
                                </div>
                            </div>

                           

                        </div>
                    </div>
                </div>

                <div class="item" style="background-image: url(images/slider/b2.jpg);background-attachment:fixed">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 slider-headings">Beautiful and Crispy Designs for Women</h1>
                                    <h2 class="animation animated-item-2">Get the ultimate fresh designs so that you wear the attention of everyone.</h2>
                                    
                                </div>
                            </div>

                            

                        </div>
                    </div>
                </div><!--/.item-->

                <div class="item" style="background-image: url(images/slider/b3.jpg);background-attachment:fixed">
                    <div class="container">
                        <div class="row slide-margin">
                            <div class="col-sm-6">
                                <div class="carousel-content">
                                    <h1 class="animation animated-item-1 slider-headings">An all inclusive gallery of Fashion Accessories</h1>
                                    <h2 class="animation animated-item-2">Grow your charm by the best chosen accessories of the Fashion Industry.</h2>
                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="prev hidden-xs" href="#main-slider" data-slide="prev">
            <i class="fa fa-chevron-left"></i>
        </a>
        <a class="next hidden-xs" href="#main-slider" data-slide="next">
            <i class="fa fa-chevron-right"></i>
        </a>
    </section>

    <section id="feature" >
        <div class="container">
           <div class="center wow fadeInDown">
                <h2 class="feature-header">Featured Categories</h2>
                <p class="lead feature-subheader">Stylopedia offers you a complete range of Fashion products diversified from <br>Men and Women to Fashion Accessories.</p>
            </div>

            <div class="row">
                <div class="features">
                    <div class="col-sm-8 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <img src="images/categories/combined.jpg" height="350px" width="700px" class="img-responsive"><a href="shop.php?subcategory=indian&clicked=1" class="btn btn-primary btn-lg shopwomen" style="position:absolute">Shop Women</a><a href="shop.php?subcategory=topwear&clicked=1" class="btn btn-primary btn-lg shopmen" style="position:absolute">Shop Men</a>
                        </div>
                    </div>
                    
					
					
					<div class="col-sm-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="feature-wrap">
                            <a href="#" class="accessoriesdiv"><img src="images/categories/accessories.jpg" height="460px" width="700px"><span class="img-overlay">FASHION ACCESSORIES</span></a>
                        </div>
                    </div>
     
                </div>
            </div>   
        </div>
    </section>

    
    <section id="services" class="service-item">
	   <div class="container">
            <div class="center wow fadeInDown">
                <h2>Our Store</h2>
                <p class="lead">The Biggest store you'll ever see in FASHION industry.</p>
				<a href="shop.php" class="btn btn-primary btn-lg">Go to Store</a>
            </div>

            <div class="row">

                <div class="col-sm-12">
                    <div class="media services-wrap wow fadeInDown">
                        <div class="pull-left">
                            <img class="img-responsive" src="images/services/services1.png">
                        </div>
                        <div class="media-body">
                            <h3 class="media-heading">Our Specialities</h3>
                            <p>Stylopedia serves all range of prodocts for all types of people. Have a look at our store to get the feel of brands and designs.</p>
                        </div>
                    </div>
                </div>                                                   
            </div>
        </div>
    </section>

    <section id="middle">
        <div class="container text-center">
            <h2 class="deal-header"><b>DEALS OF THE DAY</b></h2><hr class="style1"><br><br><br>
			<div class="flex-container">
			  <?php
			    
				while($row = mysqli_fetch_array($result)):
				
			  ?>
			    <div class="flex-item slideanim" >
				    <a href="<?php echo "details.php?id=".$row['id'];     ?>"><img src="images/items/<?php echo $row['image1']; ?>" alt="item" width="200px" height="250px"  style="margin:0 auto" class="img-responsive"></a>
					<h3><?php echo $row['heading'];     ?></h3>
					<h4><span>Rs.<?php echo $row['nprice'];  ?></span><span class="oprice-span">Rs.<?php echo $row['oprice'];  ?></span><span style="color:#FF717B"> ( <?php echo round((($row['oprice']-$row['nprice'])/$row['oprice'])*100);   ?>% OFF )</span></h4>
				</div>
			  <?php
			    endwhile;
              ?>			  
			</div>
        </div>
    </section>

    

    

    <section id="conatcat-info">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="media contact-info wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                        <div class="pull-left">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="media-body">
                            <h2>Have a question or need a customer support?</h2>
                            <p>We at stylopedia are very cautious of your satisfaction and troubles. To help you out in any case, we are always ready.Ping us anytime at +91-9852023769</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/.container-->    
    </section><!--/#conatcat-info-->

    

   <!-- <footer id="footer" class="midnight-blue">
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
	
	<footer id="footer" class="midnight-blue">
	    <div class="container">
		    <div class="row">
			    <h1 style="font-family: 'Montserrat', sans-serif;color:yellow;font-size:35px;position:relative;left:20px">Stylopedia</h1><br>
			</div>
		    <div class="row">
			    <div class="col-sm-3">
					<h4>CUSTOMER SERVICE</h4>
					<ul class="footer-list">
					    <li><a href="contact.php">Contact Us</a></li><br>
						<li><a href="#">FAQ</a></li><br>
						<li><a href="#">Track Order</a></li><br>
						<li><a href="#">Return Order</a></li><br>
						<li><a href="#">Cancel Order</a></li><br>
					</ul><br><br>
					<ul class="footer-list2">
					    <li><a href="#"><img src="images/ico/return.png">15 Days return policy</a></li>
						<li><a href="#"><img src="images/ico/cash.png">Cash on delivery</a></li>
						<li><a href="#"><img src="images/ico/shop.png">Free Shipping</a></li>
					</ul>
					
				</div>
				
				<div class="col-sm-3">
					<h4>COMPANY</h4>
					<ul class="footer-list">
					    <li><a href="about.php">About Us</a></li><br>
						<li><a href="contact.php">Careers</a></li><br>
						<li><a href="#">Affiliate Program</a></li><br>
						<li><a href="#">Terms & Conditions</a></li><br>
						<li><a href="#">Privacy Policy</a></li><br>
					</ul>
					
				</div>
				
				<div class="col-sm-3">
					<h4>CONNECT WITH US</h4>
					<ul class="footer-list">
					    <li><a href="https://www.facebook.com/stylopediastore/"><img src="images/ico/facebook.png" width="30px"></a></li>
						<li><a href="https://www.instagram.com/stylopediastore/"><img src="images/ico/instagram.jpg" width="30px"></a></li><br>
						
					</ul><br><br><br><br>
					<h4>100% SECURE PAYMENT</h4>
					<ul class="footer-list">
					    <li><img src="images/ico/mobikwik.jpg" width="30px"></li>
						<li><img src="images/ico/paytm.png" width="50px"></li>
						<li><img src="images/ico/freecharge.png" width="50px"></li>
					</ul>
					
				</div>
				
				<div class="col-sm-3">
					<h4>KEEP UP TO DATE</h4>
					<div class="input-group">
					  <input type="email" class="form-control email-footer subemail" placeholder="Enter Email Id" >
					  <button type="button" class="ssubmit" style="background-color:#FDD835;border:2px solid #FDD835;position:absolute;right:-75px;top:6px;">SUBSCRIBE</button>
					  <h3 class="sub-reply"></h3>
					</div>
					
				</div>
			</div>
		</div>
	</footer>
	
	

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/css3-animate-it.js"></script>
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
	
	$('.ssubmit').click(function(){
		var subemail = $(".subemail").val();
		$.ajax({
			url: 'subscribe.php',
			type:'POST',
			data:
			{
				subemail: subemail,
			},
			success: function(data)
			{
				$(".sub-reply").html(data);
				
			}               
		});
    });
    </script>
</body>
</html>