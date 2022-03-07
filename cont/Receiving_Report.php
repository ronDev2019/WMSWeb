<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Receiving Report Page </title>
</head>
<?= require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> RECEIVING REPORT </h4>
				</span>
				<table border="0" class="table table-hover table-bordered dd">
					<tr class="hh">
						<td> RR No. </td>
						<td> PO No. </td>
						<td> INV No. </td>
						<td> DR No. </td>
						<td> DATE </td>
						<td> SUPLLIER </td>
						<td> ACTION </td>
					</tr>
					<?php

					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vRRInformation] WHERE PostingStatus = 'POSTED' AND CheckedStatus = 'APPROVED' AND NotedStatus <> 'APPROVED' ORDER BY RRNo DESC");

					if(sqlsrv_has_rows($sel_data) > 0){

						while ($val = sqlsrv_fetch_object($sel_data)){

						$date = $val->DateDelivered;
						$date = $date->format("j-M-Y");

					?>

					<tr class="hh2">
						<td> <?= $val->RRNo ?> </td>
						<td> <?= $val->PONo ?> </td>
						<td> <?= $val->InvoiceNo ?> </td>
						<td> <?= $val->DRNo ?> </td>
						<td> <?= $date ?> </td>
						<td> <?= $val->SupplierName ?> </td>
						<td>
							<form action="RRDetails.php" method="POST">
								<input type="hidden" value="<?= $val->RRNo ?>" name="key">
								<input type="hidden" value="Receiving_Report.php" name="link">
								<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary hh">
							</form>
						</td>
					</tr>

					<?php

						}

					} else {

					?>

					<tr>
						<td colspan="7"> No data </td>
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