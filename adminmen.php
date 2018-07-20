<?php
    include("conn.php");
	if(isset($_POST['submit1'])){
		
	}
	


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Stylopedia is a specialized e-commerce site for Muzaffarpur, Bihar and handles Men, Women and Fashion Accessories.">
    <meta name="author" content="Stylopedia">
    <title>Adminmen | Stylopedia</title>
	
	
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Bitter' rel="stylesheet">    
	
    <link rel="shortcut icon" href="images/ico/icon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
<style>
.sidecontrol{
	height:100%;
	position:fixed;
	background-color:whitesmoke;
	width:25%;
	top:0px;
	left:0px;
	margin-top:60px;
}
.maincontrol{
	border:1px solid grey;
	padding:30px;
	margin-top:80px;
	margin-left:30%;
}
#removeitemdiv{
	display:none;
}
#allitemdiv{
	display:none;
}
.sidecontrolul li {
	cursor:default;
}
.sidecontrolul li:hover{
	background-color:lightblue;
}

</style>
</head>
<body>
    
	<div style="background-color:#6666FF;height:60px;width:100%;margin-top:0px;" class="text-center navbar-fixed-top"><h1 style="padding-top:5px;font-family:arial"><b>ADMINMEN</b></h1></div>
	<div class="sidecontrol">
	    <div class="well text-center"><b>Men</b></div>
		<ul class="list-group sidecontrolul">
		  <li class="list-group-item" id="additemli">Add Item</li>
		  <li class="list-group-item" id="removeitemli">Remove Item</li>
		  <li class="list-group-item" id="allitemli">Display All Items</li>
		  <li class="list-group-item">Update Item</li>
		  
		</ul>
	</div>
	
	
	<div class="container maincontrol col-sm-8" id="additemdiv">
	    <h2 style="color:#6666FF;border-bottom:5px solid black;width:90px">Add Item</h2>
		<form method="post">
		  <div class="form-group">
			<label>Heading</label>
			<input type="text" class="form-control" id="heading" placeholder="Heading" name="heading" required>
		  </div>
		  <div class="form-group">
			<label>Category</label>
			<select class="form-control" name="category">
			  <option>men</option>
			  
			</select>
		  </div>
		  <div class="form-group">
			<label>Subcategory</label>
			<select class="form-control" name="subcategory">
			  <option >topwear</option>
			  <option >bottomwear</option>
			  
			</select>
		  </div>
		  <div class="form-group">
			<label>Old Price</label>
			<input type="number" class="form-control" id="oprice" placeholder="Old Price" name="oprice" min="0" required>
		  </div>
		  <div class="form-group">
			<label>New Price</label>
			<input type="number" class="form-control" id="nprice" placeholder="New Price" name="nprice" min="0" required>
		  </div>
		  <div class="checkbox">
			  <label>
				<input type="checkbox" name="deal" class="checkbox">
				Make it Deal of the day!
			  </label>
		  </div><hr>
		  <b>Note: Put all images with .jpg or .png</b><br><br><hr>
		  <div class="form-group">
			<label>Image1(Primary Image)</label>
			<input type="text" class="form-control" id="image1" placeholder="Image1" name="image1" required>
		  </div>
		  <div class="form-group">
			<label>Image2</label>
			<input type="text" class="form-control" id="image2" placeholder="Image2" name="image2">
		  </div>
		  <div class="form-group">
			<label>Image3</label>
			<input type="text" class="form-control" id="image3" placeholder="Image3" name="image3">
		  </div>
		  <div class="form-group">
			<label>Image4</label>
			<input type="text" class="form-control" id="image4" placeholder="Image4" name="image4">
		  </div>
		  <div class="form-group">
			<label>Image5</label>
			<input type="text" class="form-control" id="image5" placeholder="Image5" name="image5">
		  </div>
		  <div class="form-group">
			<label>Brand</label>
			<select class="form-control" name="brand">
			  <option>Peter England</option>
			  <option>Arrow</option>
			  <option>Levis</option>
			  <option>Wrangler</option>
			  <option>Lee</option>
			  <option>Louis Philippe</option>
			  <option>Classic Polo</option>
			  <option>U.S. Polo</option>
			  <option>United Colors of Benetton</option>
			  <option>HRX</option>
			  <option>Spykar</option>
			  <option>Mufti</option>
			</select>
		  </div>
		  
		  
		  <button type="submit" class="btn btn-default" name="submit1">Add</button>
		</form>
	</div>
	
	<div class="container maincontrol col-sm-8" id="removeitemdiv">
	    <h2 style="color:#6666FF;border-bottom:5px solid black;width:130px">Remove Item</h2>
		<form method="post">
		    <div class="form-group">
				<label>Select ProductId</label>
				<input type="number" class="form-control" id="removeproductid" placeholder="Product ID" name="removeproductid" min="1">
			</div>
			<button type="submit" class="btn btn-default" name="submit2">Remove</button>
		</form>
    </div>
	
	<div class="container maincontrol col-sm-8" id="allitemdiv">
	    <h2 style="color:#6666FF;border-bottom:5px solid black;width:90px">All Items</h2>
		<div class="row">
		    <div class="col-sm-4">
			    
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
	
	    
		
	    $("#additemli").click(function(){
			$("#removeitemdiv").hide();
			$("#allitemdiv").hide();
			$("#additemdiv").show();
		});
	
	    $("#removeitemli").click(function(){
			$("#additemdiv").hide();
			$("#allitemdiv").hide();
			$("#removeitemdiv").show();
		});
		
		$("#allitemli").click(function(){
			$("#additemdiv").hide();
			$("#removeitemdiv").hide();
			$("#allitemdiv").show();
		});
		$('input[name=deal]').click(function(){
			if (this.checked) {
			  $(this).val('1');
			} else {
			  $(this).val('0');
			}
			
		});
		
		
	
	</script>
</body>
</html>