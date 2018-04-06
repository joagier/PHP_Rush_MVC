<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerLogin.php'); ?>

	<form method="get" action="<?php
	if(isset($_GET['submit'])){
		header('Location: inscription.tpl?url=UsersController/Inscription/' . $_GET['username'] . '/' . $_GET['email'] . '/' . $_GET['password'] . '/' . $_GET['confirmPassword']);
	}
	
	 ?>">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" placeholder="Name" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" placeholder="email"> </p>
		<p><label for="password"> Password </label> <input type="password" name="password" id="password" placeholder="password"> </p>
		<p><label for="confirmPassword"> Confirm password </label><input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm"> </p>
		<input type="submit" name="submit">
	</form>
</body>
</html>