<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit User</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>

<body>
<?php 
include_once (dirname(__FILE__) . '/headerHome.tpl'); 
include_once (dirname(__FILE__) . '/../../Config/core.php');
?>

<form id="editForm" method="post" action="
<?php
	if(isset($_POST['submit_editUser'])){
		header('Location: index.php?url=UsersController/Edit2/' . $_POST['username'] . '/' . $_SESSION['url6'] . '/' . $_SESSION['url3'] . '/' . $_POST['email'] . '/' . $_POST['user_group'] . '/' . $_POST['status'] . '/');
	}
	
?>
">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" value="<?php echo $_SESSION['url2']; ?>" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" value="<?php echo $_SESSION['url3']; ?>"> </p>
		<p><label for="status"> Status </label> <input type="text" name="status" id="status" value="<?php echo $_SESSION['url5']; ?>"> </p>
		<p><label for="user_group"> User Group </label> <input type="text" name="user_group" id="user_group" value="<?php echo $_SESSION['url4']; ?>"> </p>
		<input type="submit" name="submit_editUser">
</form>
<button id="deleteAccountbis">Delete</button>
<script src="js/admin.js"></script>