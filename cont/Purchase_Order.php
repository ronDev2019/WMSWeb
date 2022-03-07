<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Purchase Order Page </title>
</head>
<?= require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> PURCHASE ORDER INFORMATION </h4>
				</span>
				<table border="0" class="table table-hover table-bordered dd">
					<tr class="hh">
						<td> PO No. </td>
						<td> DATE </td>
						<td> SUPLLIER </td>
						<td> STATUS </td>
						<td> ACTION </td>
					</tr>
					<?php

					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vPOInformation] WHERE Status = 'FLOAT' AND Approval = 'PENDING' AND AuditStatus = 'APPROVED' ORDER BY PONo DESC");

					if(sqlsrv_has_rows($sel_data) > 0){

						while ($val = sqlsrv_fetch_object($sel_data)){

						$date = $val->PODate;
						$date = $date->format("j-M-Y");

					?>

					<tr class="hh2">
						<td> <?= $val->PONo ?> </td>
						<td> <?= $date ?> </td>
						<td> <?= $val->SupplierName ?> </td>
						<td> <?= $val->Status ?> </td>
						<td>
							<form action="PODetails.php" method="POST">
								<input type="hidden" value="<?= $val->PONo ?>" name="key">
								<input type="hidden" value="Purchase_Order.php" name="link">
								<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary hh">
							</form>
						</td>
					</tr>

					<?php

						}

					} else {

					?>

					<tr>
						<td colspan="5"> No data </td>
					</tr>

					<?php

					}

					?>
				</table>
			</section>
		</div>
		<div class="row">
			<center class="col-lg-12">
				<a href="../" class="btn btn-md btn-warning bk"> Back </a>
			</center>
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