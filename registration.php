<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css" />
<script type="text/javascript" >
		function checkForm(){
			if(document.form.name.value==="")
			{		alert("Enter your name")
					document.form.name.focus()
					return false;
				}
			else if(document.form.email.value==="")
			{
				alert("Enter your Email")
				document.form.email.focus()
				return false;
			}
			else if(document.form.password.value==="")
			{
				alert("Enter your Password")
				document.form.password.focus()
				return false;
			}
			return true;
			}
	</script>
</head>
<body background="signup.jpg">
<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$trn_date = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date)
VALUES ('$username', '".md5($password)."', '$email', '$trn_date')";
        $result = mysqli_query($con,$query);
        if($result){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>


<a href="index.php" class="back">⬅️Home</a>
<div class="form">
<form method="post"  name="form" action="" onsubmit="return checkForm()">
	<div class="container1">
		<img src="usr.jpg" alt="User Image" height="70" width="70">
		<div class="card1">
			<a class="Username">User Name:</a><br>
			<input type="text" placeholder="User Name" id="name" name="username"><br>
			<a class="Username">Email ID:</a><br>
			<input type="email" placeholder="Email" id="email" name="email"><br>
			<a class="Username">Password:</a><br>
			<input type="password" placeholder="Passworrd" min="5" max="10" id="password" name="password"><br>
			<input type="submit" value="submit" name="submit" id="button2">
		</div>
	</div>
</form>
</div>


<?php } ?>
</body>	
</html>