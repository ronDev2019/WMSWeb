<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Purchase Voucher Page </title>
</head>
<?= require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> PURCHASE VOUCHER APPROVAL </h4>
				</span>
				<table border="0" class="table table-hover table-bordered dd">
					<tr class="hh">
						<td> MPV </td>
						<td> Request Type </td>
						<td> Date </td>
						<td> Requester </td>
						<td> Purpose </td>
						<td> Action </td>
					</tr>
<?php

					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vMPVInformation] WHERE Status = 'FLOAT' AND Recommending = 'APPROVED' AND Approval = 'PENDING' ORDER BY RequestDate DESC");

					if(sqlsrv_has_rows($sel_data) > 0){

						while ($val = sqlsrv_fetch_object($sel_data))
						{

							$date = $val->RequestDate;
							$date = $date->format("j-M-Y");


							?>

								<tr class="mm">
									<td> <?= $val->MPVNo ?> </td>
									<td> <?= $val->RequestType ?> </td>
									<td> <?= $date ?> </td>
									<td> <?= $val->RequestedBy ?> </td>
									<td> <p class="ppose"> <?= $val->Purpose ?> </p> </td>
									<td>
										<form action="Purchase_details.php" method="POST">
											<input type="hidden" value="<?= $val->MPVNo ?>" name="key">
											<input type="hidden" value="Purchase_Voucher.php" name="link">
											<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary">
										</form>
									</td>
								</tr>

							<?php

						}

					} else {

					?>

					<tr>
						<td colspan="6"> No data </td>
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