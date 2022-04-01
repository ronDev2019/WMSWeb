<?php
	
	session_start();

	if(isset($_SESSION['user'])){

?>

	<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 main_frame">
				<div class="row">
					<div class="card pvr">
						<h3 class="card-title"> MPV Recommending </h3>
						<h2 class="card-text"> <?= $pvr ?> </h2>
						<a href="MPV_Recommending.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card pv">
						<h3 class="card-title"> Purchase Voucher </h3>
						<h2 class="card-text"> <?= $pv ?> </h2>
						<a href="Purchase_Voucher.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card po">
						<h3 class="card-title"> Purchase Order </h3>
						<h2 class="card-text"> <?= $po ?> </h2>
						<a href="Purchase_Order.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card po">
						<h3 class="card-title"> Job Order </h3>
						<h2 class="card-text"> <?= $jo ?> </h2>
						<a href="Job_Order.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card jo">
						<h3 class="card-title"> Receiving Report </h3>
						<h2 class="card-text"> <?= $rr ?> </h2>
						<a href="Receiving_Report.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card rr">
						<h3 class="card-title"> Manager's Leave </h3>
						<h2 class="card-text"> <?= $mngrleave ?> </h2>
						<a href="ManagersLeave.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card mngrleave">
						<h3 class="card-title"> OGM's Leave </h3>
						<h2 class="card-text"> <?= $ogmleave ?> </h2>
						<a href="OGMLeave.php" class="btn btn=md btn-danger"> View Details </a>
					</div>
					<div class="card ogmleave">
						<h3 class="card-title"> AGMA PRE-REG </h3>
						<h2 class="card-text"> <?= $agma ?> </h2>
						<a href="AGMA.php" class="btn btn=md btn-danger"> View Details </a>
					</div>


					<!--<a class="btn btn-lg pvr" href="MPV_Recommending.php"> MPV Recommending <br> <label class="ins"> <?= $pvr ?> </label> </a>
					<a class="btn btn-lg pv" href="Purchase_Voucher.php"> Purchase Voucher <br> <label class="ins"> <?= $pv ?> </label> </a>
					<a class="btn btn-lg po" href="Purchase_Order.php"> Purchase Order <br> <label class="ins"> <?= $po ?> </label> </a>
					<a class="btn btn-lg jo" href="Job_Order.php"> Job Order <br> <label class="ins"> <?= $jo ?> </label> </a>
					<a class="btn btn-lg rr" href="Receiving_Report.php"> Receiving Report <br> <label class="ins"> <?= $rr ?> </label> </a>
					<a class="btn btn-lg mngrleave" href="ManagersLeave.php"> Manager's Leave <br> <label class="ins"> <?= $mngrleave ?> </label> </a>
					<a class="btn btn-lg ogmleave" href="OGMLeave.php"> OGM's LEave <br> <label class="ins"> <?= $ogmleave ?> </label> </a>
					<a class="btn btn-lg ogmleave" href="AGMA.php"> AGMA PRE-REG <br> <label class="ins"> <?= $agma ?> </label> </a>-->
				</div>
			</div>
		</div>
	</div>
</body>
</html>
<script>
	$('#dashboard').removeClass("active");
	$('#menu').addClass("active");
</script>

<?php

	} else {

		header('location../');
		echo '<a class="btn btn-lg agma" href="AGMA.php"> AGMA 2018 <label class="ins"> <?= $agma ?> </label> </a>';

	}
		
?>