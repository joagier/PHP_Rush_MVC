<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerLogin.tpl'); ?>

	<form method="post" action="<?php
	if(isset($_POST['submit_inscription'])){
		header('Location: index.php?url=UsersController/Inscription/' . $_POST['username'] . '/' . $_POST['email'] . '/' . $_POST['password'] . '/' . $_POST['confirmPassword']);
	}
	
	 ?>">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" placeholder="Name" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" placeholder="email"> </p>
		<p><label for="password"> Password </label> <input type="password" name="password" id="password" placeholder="password"> </p>
		<p><label for="confirmPassword"> Confirm password </label><input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm"> </p>
		<input type="submit" name="submit_inscription">
	</form>
</body>
</html>