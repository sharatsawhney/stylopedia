<?php

session_start();
include("conn.php");

$query = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
$result = mysqli_query($link,$query);
$row = mysqli_fetch_array($result);
$cart = $row['cart'];
$cartItems = explode(",",$cart);
$numberItems = sizeof($cartItems);
$quantitycartarray = $row['quantitycart'];
$sizecartarray = $row['sizecart'];
$quantitycart = explode(",",$quantitycartarray);
$sizecart = explode(",",$sizecartarray);

if(isset($_POST['cartdelete']) && array_key_exists('cartdelete',$_POST) && array_key_exists("submit",$_POST)){
	$placement = $_POST['cartdelete'];
	
	array_splice($cartItems,$placement,1);
	$joinarray = join(",",$cartItems);
	
	array_splice($sizecart,$placement,1);
	$joinarray1 = join(",",$sizecart);
	
	array_splice($quantitycart,$placement,1);
	$joinarray2 = join(",",$quantitycart);
	
	
	$query2 = "UPDATE users SET cart = '".$joinarray."'WHERE id = '".$_SESSION['id']."'";
	$result2 = mysqli_query($link,$query2);
	$query3 = "UPDATE users SET sizecart = '".$joinarray1."'WHERE id = '".$_SESSION['id']."'";
	$result3 = mysqli_query($link,$query3);
	$query4 = "UPDATE users SET quantitycart = '".$joinarray2."'WHERE id = '".$_SESSION['id']."'";
	$result4 = mysqli_query($link,$query4);
	header('Location: cartcheckout.php');
	
}

if(isset($_POST['cartdelete']) && array_key_exists('cartdelete',$_POST) && array_key_exists("wsubmit",$_POST)){
	$placement = $_POST['cartdelete'];
	
	$query5 = "SELECT * FROM users WHERE id = '".$_SESSION['id']."'";
		$result5 = mysqli_query($link,$query5);
		$row5 = mysqli_fetch_array($result5);
		$cartitems = explode(",",$row5['cart']);
		$sizecartitems = explode(",",$row5['sizecart']);
		if($row5['wishlist'] == ""){
			$query6 = "UPDATE users SET wishlist = '".mysqli_real_escape_string($link,$cartitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query6);
		}else{
			$query6 = "UPDATE users SET wishlist = '".$row5['wishlist'].",".mysqli_real_escape_string($link,$cartitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query6);
		}
		
		if($row5['sizewishlist'] == ""){
			$query7 = "UPDATE users SET sizewishlist = '".mysqli_real_escape_string($link,$sizecartitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
			mysqli_query($link,$query7);
		}else{
			$query7 = "UPDATE users SET sizewishlist = '".$row5['sizewishlist'].",".mysqli_real_escape_string($link,$sizecartitems[$placement])."' WHERE id = '".mysqli_real_escape_string($link,$_SESSION['id'])."' LIMIT 1";
		    mysqli_query($link,$query7);
		}
	
	array_splice($cartItems,$placement,1);
	$joinarray = join(",",$cartItems);
	
	array_splice($sizecart,$placement,1);
	$joinarray1 = join(",",$sizecart);
	
	array_splice($quantitycart,$placement,1);
	$joinarray2 = join(",",$quantitycart);
	
	
	$query2 = "UPDATE users SET cart = '".$joinarray."'WHERE id = '".$_SESSION['id']."'";
	$result2 = mysqli_query($link,$query2);
	$query3 = "UPDATE users SET sizecart = '".$joinarray1."'WHERE id = '".$_SESSION['id']."'";
	$result3 = mysqli_query($link,$query3);
	$query4 = "UPDATE users SET quantitycart = '".$joinarray2."'WHERE id = '".$_SESSION['id']."'";
	$result4 = mysqli_query($link,$query4);
	
	
	
	header('Location: cartcheckout.php');
	
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
	
	.table>tbody>tr>td, .table>tfoot>tr>td{
        vertical-align: middle;
    }
	@media screen and (max-width: 600px) {
		table#cart tbody td .form-control{
			width:20%;
			display: inline !important;
		}
		.actions .btn{
			width:36%;
			margin:1.5em 0;
		}
		
		.actions .btn-info{
			float:left;
		}
		.actions .btn-danger{
			float:right;
		}
		
		table#cart thead { display: none; }
		table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
		table#cart tbody tr td:first-child { background: #333; color: #fff; }
		table#cart tbody td:before {
			content: attr(data-th); font-weight: bold;
			display: inline-block; width: 8rem;
		}
		
		
		
		table#cart tfoot td{display:block; }
		table#cart tfoot td .btn{display:block;}
		
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
						<?php  if(!isset($_SESSION['id'])&& !array_key_exists("id",$_SESSION)){ echo '<li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>';}else{ echo '<li><a href="shop.php?logout=1">Logout| '.$answer['fname'].'</a></li>';} ?>
                    </ul>						
                </div>
            </div>
        </nav>
		
    </header>
	
	
   
    <div class="container" style="margin-top:100px">
	    <p class="text-center"><b><a href="cartcheckout.php" style="text-decoration:underline">BAG</a> -------- DELIVERY -------- PAYMENT</b></p><br><br>
		<div class="row"> 
		    <div class="col-sm-9">
				<table id="cart" class="table table-hover table-condensed">
					<thead>
						<tr>
							<th style="width:50%">Product</th>
							<th style="width:10%">Price</th>
							<th style="width:8%">Quantity</th>
							<th style="width:22%" class="text-center">Subtotal</th>
							<th style="width:10%"></th>
						</tr>
					</thead>
				  <?php
					  $i  = 0;
					  while($i < $numberItems):
						  $query1 = "SELECT * FROM items WHERE id = '".$cartItems[$i]."'";
						  $result1 = mysqli_query($link,$query1);
						  $row1 = mysqli_fetch_array($result1);
				  ?>
					<tbody>
						<tr>
							<td data-th="Product">
								<div class="row">
									<div class="col-sm-2 hidden-xs"><img src="images/items/<?php  echo $row1['image1'];  ?>" alt="..." class="img-responsive"/></div>
									<div class="col-sm-10">
										<h4 class="nomargin">Product <?php echo $i+1;  ?></h4>
										<p><?php echo $row1['heading'];      ?></p>
									</div>
								</div>
							</td>
							<td data-th="Price" class="price<?php echo $i; ?>" >Rs.<?php  echo $row1['nprice'];   ?></td>
							<td data-th="Quantity">
								<input type="number" class="form-control text-center quantity<?php echo $i; ?>" value="<?php echo $quantitycart[$i];   ?>">
							</td>
							<td data-th="Subtotal" class="text-center subtotal<?php echo $i;  ?>"></td>
							<td class="actions" data-th="">
							   <form method="post">
								<input type="hidden" name="cartdelete" value="<?php echo $i;  ?>">
								<input type="submit" class="btn btn-info btn-sm towishlist" value="Move To Wishlist" name="wsubmit"><br><br>
								<input type="submit"  class="btn btn-danger delete" value="Remove" name="submit">
							   </form>						
							</td>
						</tr>
					</tbody>
					  <?php
						  $i = $i+1;
						  endwhile;
					  ?>
					<tfoot>
						<tr class="visible-xs">
							<td class="text-center"><strong>Total 1.99</strong></td>
						</tr>
						<tr>
							<td><a href="shop.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
							<td colspan="2" class="hidden-xs"></td>
							
							<td></td>
						</tr>
					</tfoot>
				</table>
			</div>
			
			<div class="col-sm-3" style="margin-top:30px">
			    <a href="address.php" class="btn btn-warning btn-block">Checkout <i class="fa fa-angle-right"></i></a>
				<button type="button" class="btn btn-block btn-block" data-toggle="collapse" data-target="#coupondiv">Apply Coupon Code</button>
				<div id="coupondiv" class="collapse">
				    <input type="text" class="form-control couponcode">
					<button type="button" class="btn btn-primary applycoupon">Apply</button>
				</div>
				<h3>Order Summary</h3><hr>
				<h5><span >Bag Total</span>  <span class="text-center total" style="position:absolute;right:10px"><strong></strong></span> </h5>
				<h5><span >Coupon Discount</span>  <span style="position:absolute;right:10px" class="discount"><b></b></span> </h5>
				<h5><span >Delivery Charges</span>  <span style="position:absolute;right:10px"><b>Free</b></span> </h5><hr>
				<h2><span ><b>Order Total</b></span>  <span class="text-center ordertotal" style="position:absolute;right:10px"><strong></strong></span> </h2>
				
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
	    setInterval(function(){
			  for(var i=0;;i++){
                				 
				var quantity =  $(".quantity" + i).val();
				
				if(typeof(quantity) == "undefined"){
					break;
				}else{
					$.ajax({
						type: 'POST',
						url: 'quantityupdate.php',
						data: {i:i,quantity:quantity},
						success: function(){
							
						}
					});
				}
				
			  }
				
			
		},4000);
		
		setInterval(function(){
			$.ajax({
						type: 'GET',
						url: 'subtotalupdate.php',
						success: function(data){
							var quantarray = data.split(" ");
							var total = 0;
							for(var i=0;;i++){
								var quantarray = data.split(" ");
							    var price = $(".price"+i).html().substr(3);
								var quantity = quantarray[i];
								$(".subtotal"+i).html("Rs."+price*quantity);
							    var add = price*quantity;
								
								total += add;
								$(".total").html("<b>Rs."+total+"</b>");
								var discount = parseFloat($(".discount").html().substr(6));
							
								$(".ordertotal").html("Rs."+ (total-discount));
							
							}
							
							
						}
					});
		},500);
		
		
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
	$(".discount").html("<b>Rs."+0+"</b>");
	$(".applycoupon").click(function(){
		var couponcode = $(".couponcode").val();
	
		$.ajax({
						type: 'POST',
						url: 'couponverify.php',
						data: {couponcode:couponcode},
						success: function(data){
							$(".discount").html("<b>Rs."+data+"</b>");
						}
					});
	});
	
		
	</script>
</body>	
</html>