<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Job Order Page </title>
</head>
<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> JOB ORDER INFORMATION </h4>
				</span>
				<?php

				require_once '../functions/db.php';

				$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vJobOrderInformation] WHERE Status = 'PENDING' AND ApprovalStatus = 'PENDING' AND RecommendingStatus = 'APPROVED' ORDER BY JobOrderID DESC");

				if(sqlsrv_has_rows($sel_data) > 0){

					while ($val = sqlsrv_fetch_object($sel_data)){

					$date = $val->DateCreated;
					$date = $date->format("j-M-Y");

				?>
					<div class="form_info_bythree form_info">
						<label> JO No.: <strong> <?= $val->JobOrderID ?> </strong></label><br>
						<label> Date: <strong> <?= $date ?> </strong> </label><br>
						<label> Job Title: <strong> <?= $val->JobTitle ?> </strong> </label><br>
						<label> Supplier: <strong> <?= $val->SupplierName ?> </strong> </label><br>
						<label> Amount: <strong> <?= number_format($val->MaterialAmount) ?> </strong> </label><br><br>
						<form action="JODetails.php" method="POST">
							<input type="hidden" value="<?= $val->JobOrderID ?>" name="key">
							<input type="hidden" value="Job_Order.php" name="link">
							<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary v_details">
						</form>
					</div>
				<?php

					}

				} else {

				?>
				<div class="form_info text-center">
					<h2> No For Approvals </h2>
				</div>
				<?php

				}

				?>
			</section>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<a href="../" class="btn btn-md btn-warning bk"> Back </a>
			</div>
		</div><br>
	</div>
</body>
</html>

<?php

		} else {

			header('location:../');			

		}

	} else {

		header('location:../');

	}

?>