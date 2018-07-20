<?php  

session_start();
include("conn.php");


	if(array_key_exists('id',$_SESSION) && !array_key_exists('user',$_GET)){
		$query2 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result2 = mysqli_query($link,$query2);
		$row2 = mysqli_fetch_array($result2);
	    header('Location: contact.php?user='.$row2['email']);
	}
	
if(isset($_POST['submit1'])) {
 
    $emailTo ="sharatsawhneyy@gmail.com";
			$emailSubject = "Stylopedia:General Contact";
			$emailMessage = "Form Details below.\n\n";
			$emailMessage .= "Name: ".$_POST['name']."\n";
			$emailMessage .= "Email: ".$_POST['email']."\n";
			$emailMessage .= "Number: ".$_POST['number']."\n";
			$emailMessage .= "Message: ".$_POST['message']."\n";
			$headers = "From: ".$_POST["email"];
			if (mail($emailTo, $emailSubject, $emailMessage, $headers)) {
                
                $message =   '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
                
                
            } else {
                
                $message = '<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</div>';
                
                
            }
}

if(isset($_POST['submit2'])) {
 
    $emailTo ="sharatsawhneyy@gmail.com";
			$emailSubject = "Stylopedia:Careers";
			$emailMessage = "Form Details below.\n\n";
			$emailMessage .= "Name: ".$_POST['name']."\n";
			$emailMessage .= "Email: ".$_POST['email']."\n";
			$emailMessage .= "Number: ".$_POST['number']."\n";
			$emailMessage .= "Last Qualification: ".$_POST['qualification']."\n";
			$emailMessage .= "Message: ".$_POST['message']."\n";
			$headers = "From: ".$_POST["email"];
			if (mail($emailTo, $emailSubject, $emailMessage, $headers)) {
                
                $message =   '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
                
                
            } else {
                
                $message = '<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</div>';
                
                
            }
}

if(isset($_POST['submit3'])) {
 
    $emailTo ="sharatsawhneyy@gmail.com";
			$emailSubject = "Stylopedia:Partner";
			$emailMessage = "Form Details below.\n\n";
			$emailMessage .= "Name: ".$_POST['name']."\n";
			$emailMessage .= "Email: ".$_POST['email']."\n";
			$emailMessage .= "Number: ".$_POST['number']."\n";
			$emailMessage .= "Company: ".$_POST['company']."\n";
			$emailMessage .= "Pickup Address : ".$_POST['address']."\n";
			$headers = "From: ".$_POST["email"];
			if (mail($emailTo, $emailSubject, $emailMessage, $headers)) {
                
                $message =   '<div class="alert alert-success" role="alert">Your message was sent, we\'ll get back to you ASAP!</div>';
                
                
            } else {
                
                $message = '<div class="alert alert-danger" role="alert"><p><strong>Your message couldn\'t be sent - please try again later</div>';
                
                
            }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stylopedia is a specialized e-commerce site for Muzaffarpur, Bihar and handles Men, Women and Fashion Accessories.">
    <meta name="author" content="Stylopedia">
    <title>Contact | Stylopedia</title>
	
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="gotham.css">
	
         
    <link rel="shortcut icon" href="images/ico/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	<script  src="http://jqueryjs.googlecode.com/files/jquery-1.3.2.min.js"></script>
	
<style>

body, div, h1,h2, form, fieldset, input, textarea, footer,p {
	margin: 0; padding: 0; border: 0; outline: none;
}


@font-face {
	font-family: 'YanoneKaffeesatzRegular';
	src: url('yanonekaffeesatz-regular-webfont.eot');
	src: url('yanonekaffeesatz-regular-webfont.eot?#iefix') format('embedded-opentype'),
	url('yanonekaffeesatz-regular-webfont.woff') format('woff'),
	url('yanonekaffeesatz-regular-webfont.ttf') format('truetype'),
	url('yanonekaffeesatz-regular-webfont.svg#YanoneKaffeesatzRegular') format('svg');
	font-weight: normal;
	font-style: normal;
}

body { color: #7c7873; font-family: 'YanoneKaffeesatzRegular';}
p {text-shadow:0 1px 0 #fff; font-size:24px;}
#wrap {width:530px; margin:20px auto 0; height:1000px;}
h1 {margin-bottom:20px; text-align:center;font-size:48px; text-shadow:0 1px 0 #ede8d9; }


	#form_wrap { overflow:hidden; height:446px; position:relative; top:0px;
		-webkit-transition: all 1s ease-in-out .3s;
		-moz-transition: all 1s ease-in-out .3s;
		-o-transition: all 1s ease-in-out .3s;
		transition: all 1s ease-in-out .3s;}
	
	#form_wrap:before {content:"";
		position:absolute;
		bottom:128px;left:0px;
		background:url('images/before.png');
		width:530px;height: 316px;}
	
	#form_wrap:after {content:"";position:absolute;
		bottom:0px;left:0;
		background:url('images/after.png');
		width:530px;height: 260px; }

	#form_wrap.hide:after, #form_wrap.hide:before {display:none; }
	#form_wrap:hover {height:1050px;top:-200px;}
	


	form {background:#f7f2ec url('images/letter_bg.png'); 
		position:relative;top:200px;overflow:hidden;
		height:200px;width:400px;margin:0px auto;padding:20px; 
		border: 1px solid #fff;
		border-radius: 3px; 
		-moz-border-radius: 3px; -webkit-border-radius: 3px;
		box-shadow: 0px 0px 3px #9d9d9d, inset 0px 0px 27px #fff;
		-moz-box-shadow: 0px 0px 3px #9d9d9d, inset 0px 0px 14px #fff;
		-webkit-box-shadow: 0px 0px 3px #9d9d9d, inset 0px 0px 27px #fff;
		-webkit-transition: all 1s ease-in-out .3s;
		-moz-transition: all 1s ease-in-out .3s;
		-o-transition: all 1s ease-in-out .3s;
		transition: all 1s ease-in-out .3s;}


		#form_wrap:hover form {height:530px;}

		label {
			margin: 11px 20px 0 0; 
			font-size: 16px; color: #b3aba1;
			text-transform: uppercase; 
			text-shadow: 0px 1px 0px #fff;
		}

		input[type=text], textarea {
			font: 14px normal normal uppercase helvetica, arial, serif;
			color: #7c7873;background:none;
			width: 380px; height: 36px; padding: 0px 10px; margin: 0 0 10px 0;
			border:1px solid #f8f5f1;
			-moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px;
			-moz-box-shadow: inset 0px 0px 1px #726959;
			-webkit-box-shadow:  inset 0px 0px 1px #b3a895; 
			box-shadow:  inset 0px 0px 1px #b3a895;
		}	

		textarea { height: 80px; padding-top:14px;}

		textarea:focus, input[type=text]:focus {background:rgba(255,255,255,.35);}

		#form_wrap input[type=submit] {
			position:relative;font-family: 'YanoneKaffeesatzRegular'; 
			font-size:24px; color: #7c7873;text-shadow:0 1px 0 #fff;
			width:100%; text-align:center;opacity:0;
			background:none;
			cursor: pointer;
			-moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px; 
			-webkit-transition: opacity .6s ease-in-out 0s;
			-moz-transition: opacity .6s ease-in-out 0s;
			-o-transition: opacity .6s ease-in-out 0s;
			transition: opacity .6s ease-in-out 0s;
		}

		#form_wrap:hover input[type=submit] {z-index:1;opacity:1;
			-webkit-transition: opacity .5s ease-in-out 1.3s;
			-moz-transition: opacity .5s ease-in-out 1.3s;
			-o-transition: opacity .5s ease-in-out 1.3s;
			transition: opacity .5s ease-in-out 1.3s;}

			#form_wrap:hover input:hover[type=submit] {color:#435c70;}
			
		.jumbo{
			background: url('images/contact.jpg') no-repeat center center fixed;
			background-size:cover;
			height:500px;
			width:100%;
			margin-top:60px;
			font-family: 'Gotham A', 'Gotham B';
		}
		.box{
			border:1px solid grey;
			box-shadow: 10px 10px 5px #888888;
			background-color:lightblue;
			margin-right:95px;
			height:300px;
			
		}
		.box h1{
			font-family: arial;
		}
		.box button{
			font-family: arial;
		}
		#wrap h1{
			color:brown;
		}
		.modal-content{
		    background-color:lightblue;
		}
		.contact-div{
			margin-top:30px;
			
		}
        @media only screen and (max-width:1200px){
			.contact-div{
				width:23%;
			}
			.contact-main{
				margin: auto;
			}
		}
        @media only screen and (max-width:991px){
			.contact-div{
				width:60%;
				margin-left:20%;
			}
			.contact-main{
				margin: auto;
			}
		}	
        @media only screen and (max-width:600px){
			.modal-content{
				width:100%;
			}
			#wrap h1{
				width:80%;
			}
			#form_wrap:before {content:"";
				position:absolute;
				bottom:128px;left:0px;
				background:url('images/before.png');
				display:none;
				width:90%;height: 316px;
			}
	
			#form_wrap:after {content:"";position:absolute;
				bottom:0px;left:0;
				background:url('images/after.png');
				display:none;
				width:90%;height: 260px;
			}
			#form_wrap { overflow:hidden; height:446px; position:relative; top:0px;
				-webkit-transition: all 1s ease-in-out .3s;
				-moz-transition: all 1s ease-in-out .3s;
				-o-transition: all 1s ease-in-out .3s;
				transition: all 1s ease-in-out .3s;
			}
		}	
        @media only screen and (max-width:500px){
			#form_wrap { overflow:hidden; height:446px; position:absolute; top:0px;
				-webkit-transition: all 1s ease-in-out .3s;
				-moz-transition: all 1s ease-in-out .3s;
				-o-transition: all 1s ease-in-out .3s;
				transition: all 1s ease-in-out .3s;
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
						
                    </ul>						
                </div>
            </div>
        </nav>
		
    </header>
	
	
	
	
	
	        <div id="send1" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div id="wrap">
							<h1>Send a message</h1>
							<div id='form_wrap'>
								<form method="post">
									
									<label for="email">Your Message : </label>
									<textarea  name="message" value="Your Message" id="message" ></textarea>
										
									<label for="name">Name: </label>
									<input type="text" name="name" value="" id="name" />
									<label for="email">Email: </label>
									<input type="text" name="email" value="" id="email" />
									<label for="number">Mobile Number: </label>
									<input type="text" name="number" value="" id="number" />
									<input type="submit" name ="submit1" value="Send The Message" />
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
	  	    
			<div id="send2" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div id="wrap">
							<h1>Send a request</h1>
							<div id='form_wrap'>
								<form method="post">
									
									<label for="email">Your Message : </label>
									<textarea  name="message" value="Your Message" id="message" ></textarea>
									
									<label for="name">Name: </label>
									<input type="text" name="name" value="" id="name" />
									<label for="email">Email: </label>
									<input type="text" name="email" value="" id="email" />
									<label for="number">Mobile Number: </label>
									<input type="text" name="number" value="" id="number" />
									<label for="qualification">Last Qualification </label>
									<input type="text" name="qualification" value="" id="qualification" />
									<input type="submit" name ="submit2" value="Send The Request" />
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>				
			
			<div id="send3" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div id="wrap">
							<h1>Open Your Free Shop</h1>
							<div id='form_wrap'>
								<form method="post">
	
									<label for="name">Name: </label>
									<input type="text" name="name" value="" id="name" />
									<label for="company">Company: </label>
									<input type="text" name="company" value="" id="company" />
									<label for="email">Email: </label>
									<input type="text" name="email" value="" id="email" />
									<label for="number">Mobile Number: </label>
									<input type="text" name="number" value="" id="number" />
									<label for="address">Pickup Address: </label>
									<input type="text" name="address" value="" id="address" />
									<input type="submit" name ="submit3" value="Send the Message" />
								</form>
							</div>
						</div>
					</div>
				</div>
            </div>
		
	<div class="jumbo text-center">
	    <br><br><br>
		<h3><?php if(isset($message)){ echo $message;}   ?></h3>
		<h5 style="color:white">CONTACT US</h5><br>
		<h2 style="color:white;font-size:40px;font-family:Gotham A Gotham B">FEEL FREE TO <br>CONTACT US</h2>
		<h3 style="color:white;font-family:Gotham A Gotham B;font-size:20px">Please select the option that suits you the best.</h3>
		
	</div>
	
	<div class="container contact-main" style="margin-top:100px;margin-bottom:40px;">
		<div class="row">
			<div class="col-sm-3 box text-center contact-div">
				<h1>General Contact</h1>
				<h2><b>9852023769</b></h2>
				<h2>Call us b/w 9:30 am and 6:30 pm,<br>Monday to Saturday</h2>
				<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#send1">Send Message</button>
			</div>
			<div class="col-sm-3 box text-center contact-div">
				<h1>Careers</h1>
				<h2>Join our ambitious team</h2>
				<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#send2">Drop Us A Line</button>
			</div>
			<div class="col-sm-3 box text-center contact-div">
				<h1>Partner With Us</h1>
				<h2>Start your business with Stylopedia<br>& reach customers across Muzaffarpur</h2>
				<button type="button" class="btn btn-primary " data-toggle="modal" data-target="#send3">Open My Free Shop</button>
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