<?php session_start();
include_once (dirname(__FILE__) . '/../../Config/core.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>

<?php include_once (dirname(__FILE__) . '/headerHome.tpl');
$articlesController = ArticlesController::getInstance();
$articlesController->viewAllArticles();
?>
<form>
<a href="?url=UsersController/viewAdmin"><button type="button" name="admin" id="admin">Admin</button></a>
<a href="?url=UsersController/logout"><button type="button" name="logout" id="logout">Logout</button></a>
<a href="?url=UsersController/deleteUser"><button type="button" name="delete" id="delete">Delete account</button></a>
</form>

</body>
</html>