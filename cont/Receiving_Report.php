<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Receiving Report Page </title>
</head>
<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> RECEIVING REPORT </h4>
				</span>
				<?php

				require_once '../functions/db.php';

				$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vRRInformation] WHERE PostingStatus = 'POSTED' AND CheckedStatus = 'APPROVED' AND NotedStatus <> 'APPROVED' ORDER BY RRNo DESC");

				if(sqlsrv_has_rows($sel_data) > 0){

					while ($val = sqlsrv_fetch_object($sel_data)){

					$date = $val->DateDelivered;
					$date = $date->format("j-M-Y");

				?>
					<div class="form_info">
						<label> RR No.: <strong> <?= $val->RRNo ?> </strong></label><br>
						<label> PO No.: <strong> <?= $val->PONo ?> </strong> </label><br>
						<label> INV No.: <strong> <?= $InvoiceNo ?> </strong> </label><br>
						<label> DR No.: <strong> <?= $val->DRNo ?> </strong> </label><br>
						<label> Date: <strong> <?= $date ?> </strong> </label><br><br>
						<label> Supplier: <strong> <?= $val->SupplierName ?> </strong> </label><br><br>
						<form action="RRDetails.php" method="POST">
							<input type="hidden" value="<?= $val->RRNo ?>" name="key">
							<input type="hidden" value="Receiving_Report.php" name="link">
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
			</div>
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