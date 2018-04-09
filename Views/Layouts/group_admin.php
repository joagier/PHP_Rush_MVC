<?php 
session_start();
include_once (dirname(__FILE__) . '/../../Config/core.php');
$usersController = UsersController::getInstance();
$articlesController = ArticlesController::getInstance(); 

?>

<?php ob_start(); ?>
<h3> Create user</h3>
<button id="createUser">Create user</button>
	<form id="createForm" method="post" action="<?php
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

<h3> Display users</h3>
<?php 

$usersController->viewUsers();
?>


<button id="displayUsers">Display users</button>
<p> Modifié, ban, status</p>

<h3> Edit Articles </h3>
<?php 
$articlesController->viewArticles('creation_date');
?>
<button class="editArticle">Edit article</button>

<h3> Write articles </h3>
<button id="writeArticle">Write article</button>
<form id="writerForm" method="post" action="
<?php
	if(isset($_POST['submit_newArticle'])){
		header('Location: index.php?url=ArticlesController/addArticleController/' . $_POST['title'] . '/' . $_SESSION['id'] . '/' . $_POST['content'] . '/' . $_POST['tag']);
	}
	
?>
">
		<p><label for="title"> Title </label><input type="text" name="title" id="title" required> </p>
		<p><label for="content"> Content </label><textarea name="content" id="content" cols="40" rows="5"></textarea></p>
		<p><label for="tag"> Tag </label> <input type="text" name="tag" id="tag"></p>
		<input type="submit" name="submit_newArticle" id="submit">
</form>

<h3> Edit your profile </h3>
<button id="editProfile">Edit your profile</button>
<form id="userForm" method="post" action="
<?php
	if(isset($_POST['submit_editUser'])){
		header('Location: index.php?url=UsersController/Edit/' . $_POST['username'] . '/' . $_POST['password'] . '/' . $_POST['confirmPassword'] . '/' . $_SESSION['email'] . '/' . $_POST['email'] . '/' . $_SESSION['user_group'] . '/' . $_SESSION['status'] );
	}
	
?>
">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"> </p>
		<p><label for="password"> Password </label> <input type="password" name="password" id="password" required> </p>
		<p><label for="confirmPassword"> Confirm password </label><input type="password" name="confirmPassword" id="confirmPassword" required> </p>
		<input type="submit" name="submit_editUser">
</form>

<h3> Delete your account </h3>
<button id="deleteAccount">Delete account</button>

<?php $admin = ob_get_clean(); ?>

<?php ob_start(); ?>

<h3> Write new article</h3>
<button id="writeArticle2">Write article</button>
<form id="writerForm" method="post" action="
<?php
	if(isset($_POST['submit_newArticle'])){
		header('Location: index.php?url=ArticlesController/addArticleController/' . $_POST['title'] . '/' . $_SESSION['id'] . '/' . $_POST['content'] . '/' . $_POST['tag']);
	}
	
?>
">
		<p><label for="title"> Title </label><input type="text" name="title" id="title" required> </p>
		<p><label for="content"> Content </label><textarea name="content" id="content" cols="40" rows="5"></textarea></p>
		<p><label for="tag"> Tag </label> <input type="text" name="tag" id="tag"></p>
		<input type="submit" name="submit_newArticle" id="submit">
</form>

<h3> Edit your articles</h3>
<?php
$articlesController->viewArticlesAuthor($_SESSION['id']);
?>
<button id="editArticle2">Edit article</button>

<h3> Edit your profile </h3>
<button id="editProfile2">Edit your profile</button>
<form id="userForm" method="post" action="
<?php
	if(isset($_POST['submit_editUser'])){
		header('Location: index.php?url=UsersController/Edit/' . $_POST['username'] . '/' . $_POST['password'] . '/' . $_POST['confirmPassword'] . '/' . $_SESSION['email'] . '/' . $_POST['email'] . '/' . $_SESSION['user_group'] . '/' . $_SESSION['status'] );
	}
	
?>
">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"> </p>
		<p><label for="password"> Password </label> <input type="password" name="password" id="password" required> </p>
		<p><label for="confirmPassword"> Confirm password </label><input type="password" name="confirmPassword" id="confirmPassword" required> </p>
		<input type="submit" name="submit_editUser">
</form>

<h3> Delete your account </h3>
<button id="deleteAccount2">Delete account</button>
<?php $writer = ob_get_clean(); ?>

<?php ob_start(); ?>

<h3>Edit your profile</h3>
<button id="editProfile3">Edit your profile</button>
<form id="userForm" method="post" action="
<?php
	if(isset($_POST['submit_editUser'])){
		header('Location: index.php?url=UsersController/Edit/' . $_POST['username'] . '/' . $_POST['password'] . '/' . $_POST['confirmPassword'] . '/' . $_SESSION['email'] . '/' . $_POST['email'] . '/' . $_SESSION['user_group'] . '/' . $_SESSION['status'] );
	}
	
?>
">
		<p><label for="username"> Name </label><input type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" > </p>
		<p><label for="email"> Email </label><input type="text" name="email" id="email" value="<?php echo $_SESSION['email']; ?>"> </p>
		<p><label for="password"> Password </label> <input type="password" name="password" id="password" required> </p>
		<p><label for="confirmPassword"> Confirm password </label><input type="password" name="confirmPassword" id="confirmPassword" required> </p>
		<input type="submit" name="submit_editUser">
</form>
<h3>Delete your account </h3>
<button id="deleteAccount3">Delete account</button>
<?php $user = ob_get_clean(); ?>

<?php include_once (dirname(__FILE__) . '/admin.php'); ?>