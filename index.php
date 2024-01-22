<?php
//include auth.php file on all secure pages
include("auth.php");
?>
<html>
<head>
	<title>
		Hostel Food Review
	</title>
	<link rel="icon" href="keclogo.png">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="style.css">
</head> 

<body>
	<h1>Kongu Engineering College</h1>
        <p style="color:red;margin-left:85%;margin-top:-3%;font-size:18px;">Welcome <?php echo $_SESSION['username']; ?>!</p>

	<div class="navbar">
		<a href="#last">Contact</a>
        <a href="logout.php">Logout</a> 
        <a href="reviewfilter.html">Dashboard</a>
		<div class="dropdown Menu List">
			<button class="mybutton">Menu List</button>	
			<div class="dropdown-content">
				<a href="#last">Veg-Menu</a>
				<a href="#">Snacks</a>
			</div>
		</div>
		<a href="review.php">Review</a>
	</div>
	<div class="content">
		<h1>Welcome to Hostel Website</h1>
		<p> Here You can give some Review about the Hostel Food to change it<br>There are 7 hostels I Have Listed Three hostels below<!--Whether it is good or not or to change the food</p>-->
	</div>
	<input type="text"  id="search" placeholder="Search">
	
	<div class="hostel">
		<div class="box" id="#last">
			<a href="review.php"><img src="hostel1.jpg"></a>
			<p>Dheeran Hostel</p>
		</div>
		<div class="box">
			<a href="review.php">
			<img src="valluvar.jpg"></a>
			<p>Valluvar Hostel</p>
		</div>
		<div class="box">
		<a href="review.php">
			<img src="ponnar.jpg"></a>
			<p>Ponnar Hostel</p>
		</div>
		<div class="box">
		<a href="review.php">
			<img src="bharathi.jpg"></a>
			<p>Bharathi Hostel</p>
		</div>
		<div class="box">
		<a href="review.php">
			<img src="ilango.jpg"></a>
			<p>Ilango Hostel</p>
		</div>
		<div class="box">
		<a href="review.php">
			<img src="sankar.jpg"></a>
			<p>Sankar Hostel</p>
		</div>
	</div>

	<iframe style="margin-left:35%;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d32914.2251472261!2d77.56508432088997!3d11.27226838264986!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ba96d7810fe32d5%3A0x85cf49c5b26fb72e!2sKongu%20Engineering%20College!5e0!3m2!1sen!2sin!4v1694959256623!5m2!1sen!2sin"width="450" height="350" id="map" ></iframe><br>

	<div class="about" style="margin-top: 500px;">
		<p id="last">Contact Us<br></p>
		<p style="margin-top: 4px";>📞Phone: +91 123-456-7890<br></p>
		<p style="margin-top: 4px">✉️Email: info@hostelfoodreview.com<br></p>
		<p style="margin-top: 4px">© 2023 Hostel Food Review. All rights reserved.</p>
 	 </div>
</body>
</html> 

