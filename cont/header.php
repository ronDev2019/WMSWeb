<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<link rel="stylesheet" href="../fonts/icomoon/style.css">

	<link rel="stylesheet" href="../css/owl.carousel.min.css">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="../css/bootstrap.min.css">

	<!-- Style -->
	<link rel="stylesheet" href="../css/style.css">

	<title> Admin Page </title>
	<?php require_once '../js/js.php'; ?>
	<?php require_once '../functions/count.php'; ?>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<link rel="icon" type="image/ico" href="../images/n2a2logo.png">
</head>

<body>


	<div class="site-mobile-menu">
		<div class="site-mobile-menu-header">
			<div class="site-mobile-menu-close mt-3">
				<span class="icon-close2 js-menu-toggle"></span>
			</div>
		</div>
		<div class="site-mobile-menu-body"></div>
	</div>

	<header class="site-navbar" role="banner">

		<div class="container">
			<div class="row align-items-center">

				<div class="col-11 col-xl-2">
					<h1 class="mb-0 site-logo"><a href="" class="text-white mb-0"><img src="../images/n2a2logo.png" alt="Logo"></a></h1>
				</div>
				<div class="col-12 col-md-10 d-none d-xl-block">
					<nav class="site-navigation position-relative text-right" role="navigation">

						<ul class="site-menu js-clone-nav mr-auto d-none d-lg-block">
							<li class="active" id="dashboard"><a href="../cont/"><span>Dashboard</span></a></li>
							<li id="menu"><a href="../cont/menu.php"><span>Menu</span></a></li>
							<li id="pending"><a href="about.html"><span>Pending</span></a></li>
							<li id="approve"><a href="blog.html"><span>Approve</span></a></li>
							<li id="contact"><a href="contact.html"><span>Contact</span></a></li>
							<li class="has-children">
								<a href="contact.html"><img class="profile" src="../images/n2a2logo.png" alt="Logo"><span> <?= $_SESSION['name'] ?> </span></a>
								<ul class="dropdown arrow-top">
									<li><a href="#">View Profile</a></li>
									<li><a href="#">Settings</a></li>
									<li><a href="logout.php">Sign out</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>


				<div class="d-inline-block d-xl-none ml-md-0 mr-auto py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>

			</div>

		</div>
		</div>

	</header>