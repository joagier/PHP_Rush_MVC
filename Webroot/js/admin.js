
$(document).ready(function(){

	$(".edit").click(function(){

	})

	$(".SHOW").hide();
	$(".editArticle").click(function(){
		$(".SHOW").toggle();
	})


	$("#createForm").hide();
	$("#createUser").click(function(){
		$("#createForm").toggle();
	})

	$("#allUsers").hide();
	$("#displayUsers").click(function(){
		$("#allUsers").toggle();
	})

	$("#userForm").hide();
	$("#editProfile3").click(function(){
		$("#userForm").toggle();
	});
	$("#editProfile2").click(function(){
		$("#userForm").toggle();
	});
	$("#editProfile").click(function(){
		$("#userForm").toggle();
	});

	$("#writerForm").hide();
	$("#articles").hide();
	$("#writeArticle2").click(function(){
		$("#writerForm").toggle();
	});
	$("#writeArticle").click(function(){
		$("#writerForm").toggle();
	});

	$("#editArticle2").click(function(){
		$("#articles").toggle();
	})

	$("#deleteAccount3").click(function(){
		var r = confirm("You are about to delete your account ?");

		if (r == true) {
			$("#deleteAccount3").after("<a href='index.php?url=UsersController/delete/'><button>Confirm deletion</button></a>");
			$("#deleteAccount3").hide();
		}
	});

	$("#deleteAccount2").click(function(){
		var r = confirm("You are about to delete your account ?");

		if (r == true) {
			$("#deleteAccount2").after("<a href='index.php?url=UsersController/delete/'><button>Confirm deletion</button></a>");
			$("#deleteAccount2").hide();
		}
	});
	$("#deleteAccount").click(function(){
		var r = confirm("You are about to delete your account ?");

		if (r == true) {
			$("#deleteAccount").after("<a href='index.php?url=UsersController/delete/'><button>Confirm deletion</button></a>");
			$("#deleteAccount").hide();
		}
	});

		$("#deleteAccountbis").click(function(){
		var r = confirm("You are about to delete your account ?");

		if (r == true) {
			$("#deleteAccountbis").after("<a href='index.php?url=UsersController/deletebis/'><button>Confirm deletion</button></a>");
			$("#deleteAccountbis").hide();
		}
	});
});