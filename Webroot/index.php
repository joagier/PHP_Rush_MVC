
<!DOCTYPE html>
<html>
<head>
	<title>Inscription</title>
</head>
<body>

	<form method="get" action="<?php
	if(isset($_GET['submit'])){
		header('Location: index.php?url=UsersController/Inscription/' . $_GET['username'] . '/' . $_GET['email'] . '/' . $_GET['password'] . '/' . $_GET['confirmPassword']);
	}
	
	 ?>">
		<input type="text" name="username" id="username" placeholder="Name" >
		<input type="text" name="email" id="email" placeholder="email">
		<input type="password" name="password" id="password" placeholder="password">
		<input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm">
		<input type="submit" name="submit">
	</form>

</body>
</html>

<?php

include_once (dirname(__FILE__) . '/../dispatcher.php');
