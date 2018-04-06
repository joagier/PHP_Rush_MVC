<?php session_start() ?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin page</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
</head>

<body>
<?php 
include_once (dirname(__FILE__) . '/headerHome.tpl'); 
include_once (dirname(__FILE__) . '/../../Config/core.php');
?>


<?php
if ($_SESSION['user_group'] == 'admin') {
 	echo $admin;
 }elseif ($_SESSION['user_group'] == 'writer') {
 	echo $writer;
 }elseif ($_SESSION['user_group'] == 'user') {
 	echo $user;
 }
?>
<script src="js/admin.js">

</script>

</body>

</html>