<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Purchase Voucher Page </title>
</head>
<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> PURCHASE VOUCHER APPROVAL </h4>
				</span>
				<?php
					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vMPVInformation] WHERE Status = 'FLOAT' AND Recommending = 'APPROVED' AND Approval = 'PENDING' ORDER BY RequestDate DESC");

					if(sqlsrv_has_rows($sel_data) > 0){

						while ($val = sqlsrv_fetch_object($sel_data))
						{

							$date = $val->RequestDate;
							$date = $date->format("j-M-Y");
					?>
					<div class="form_info">
						<label> MPV: <strong> <?= $val->MPVNo ?> </strong></label><br>
						<label> Request Type: <strong> <?= $val->RequestType ?> </strong> </label><br>
						<label> Date: <strong> <?= $date ?> </strong> </label><br>
						<label> Requester: <strong> <?= $val->RequestedBy ?> </strong> </label><br>
						<label> Purpose: <strong> <?= $val->Purpose ?> </strong> </label><br><br>
						<form action="Purchase_details.php" method="POST">
							<input type="hidden" value="<?= $val->MPVNo ?>" name="key">
							<input type="hidden" value="Purchase_Voucher.php" name="link">
							<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary v_details">
						</form>
					</div>
					<?php

						}

					} else {

					?>
					<div class="form_info">
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