<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<script type="text/javascript">
		function validateForm(){
			if(document.login.name.value==="")
			{		alert("Enter your name")
					document.login.name.focus()
					return false;
				}
			else if(document.login.password.value==="")
			{
				alert("Enter your Password")
				document.login.password.focus()
				return false;
			}
			return true;
			}
	</script>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body style="background-color:powderblue;">
<h1>Login to see your home page</h1>



<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_POST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE username='$username'
and password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysqli_error($con));
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: index.php");
	    exit();
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
	}
    }else{
?>



<div class="form">
<form method="post"  name="login" id="form" onsubmit="return validateForm()" >
	<div class="container">
		<img src="usr.jpg" alt="User Image" height="70" width="70">
		<div class="card">
			<a class="Username">User Name:</a><br>
			<input type="text" placeholder="Enter your User Name" id="name"  name="username"><br>
			<a class="Password">Password:</a><br>
			<input type="password" placeholder="Enter your Password" id="password" name="password"><br>
			<a href="#" class="forgot">Forgot Passworrd?</a>
			<a href="registration.php" class="signup" id="signup">Sign Up?</a><br>
			<input type="submit" value="Login" id="button1">
		</div>
	</div>
</form>
<div>
<?php } ?>
</body>
</html>