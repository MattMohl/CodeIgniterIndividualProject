<DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="../assets/style.css">
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>
	</head>

<html>
<body>

	<header>
		<h1><a href="landing.html">CardBoard</a></h1>
	</header>

	<div class="sign-in-box">
		<h2>Sign In</h2>
		<form method="post" action="/CardBoard/index.php/main/sign_in">
			<label for="user" name="Username">Username</label>
			<input type="text" name="user">
			<label for="pass" name="Password">Password</label>
			<input type="password" name="pass">
			<input type="submit" name="signin" value="Sign In">
		</form>
	</div>

	<div class="register-box">
		<h2>Register</h2>
		<form method="post" action="/CardBoard/index.php/main/register">
			<label for="usern" naem="Usern">Username</label>
			<input type="text" name="usern">
			<label for="email" name="Email">Email</label>
			<input type="email" name="email">
			<label for="pass1" name="Password">Password</label>
			<input type="password" name="password">
			<label for="pass2" name="Pass2">Confirm Password</label>
			<input type="password" name="pass2">
			<input type="submit" name="register" value="Register">
		</form>
	</div>

	<div style="clear:both;"></div>

</html>
</body>