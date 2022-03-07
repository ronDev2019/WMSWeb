<?php

session_start();

if (!isset($_SESSION['Active'])) {

?>

	<!DOCTYPE html>
	<html>

	<head>
		<title> WMS Login </title>
		<?php require_once 'css/css.php'; ?>
		<?php require_once 'functions/db.php'; ?>
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="icon" type="image/ico" href="images/n2a2logo.png">
	</head>

	<body>
		<div class="form col-lg-4 col-lg-offset-4 col-md-10 col-md-offset-1 col-sm-12 col-xs-12">
			<p> WMS Login </p>
			<input type="text" class="form-control" id="username" placeholder="Username"><br>
			<input type="password" class="form-control" id="password" placeholder="Password"><br><br><br>
			<a href="forgotpassword.php"> Forgot Password </a>
			<button type="submit" class="btn btn-sm btn-primary login"> Sign In </button>
			<!--<input type="submit" class="btn btn-md btn-primary login" value="Login">-->
		</div>
	</body>

	</html>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.sticky.js"></script>
	<script src="js/main.js"></script>
	<script>
		$('.login').click(function(e) {

			e.preventDefault();

			var user = $('#username').val();
			var pass = $('#password').val();
			var sub = $('.login').val();

			if (user == "" || pass == "") {

				alert("Please enter User Information to continue.");

			} else {

				$.ajax({
					url: "functions/login.php",
					method: "POST",
					dataType: "json",
					data: {
						user: user,
						pass: pass,
						submit: sub
					},
					success: function(response) {

						if (response.stat == 200) {

							alert("Welcome " + response.name + " " + response.lastname);

							location.href = "cont";

						} else {

							alert("User information not found. Please re-enter username and password.");

						}

					},
					error: function(response, status, xhr) {
						console.log("Error Occured, sorry for inconvinience "+status + ' ' + xhr);
					}
				});

			}

		});
	</script>

<?php

} else {

	header('location:cont');
}

?>