<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> OGM's Leave Approval Page </title>
</head>
<?= require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> OGM's LEAVE APPLICATION </h4>
				</span>
				<table border="0" class="table table-hover table-bordered dd">
					<tr class="hh">
						<td> Unique Id </td>
						<td> Date Applied </td>
						<td> Employee </td>
						<td> Department </td>
						<td> ACTION </td>
					</tr>
					<?php

					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT  DISTINCT(LeaveInformationId) AS UniqueId, ApplicationType AS TypeOf, ApplicationDate AS DateApplied, Name, Department FROM [HR.ExtensionDB].Leave.vLineItem WHERE Department = 'Office of General Manager' AND Canceled = 0 AND RecommendingStatus <> 'APPROVED' AND Status = 'ACTIVE' ORDER BY DateApplied");

					if(sqlsrv_has_rows($sel_data) > 0){

						while ($val = sqlsrv_fetch_object($sel_data)){

						$date = $val->DateApplied;
						$date = $date->format("j-M-Y");

					?>

					<tr class="hh2">
						<td> <?= $val->UniqueId ?> </td>
						<td> <?= $date ?> </td>
						<td> <?= $val->Name ?> </td>
						<td> <?= $val->Department ?> </td>
						<td>
							<form action="OGMLeave_Details.php" method="POST">
								<input type="hidden" value="<?= $val->UniqueId ?>" name="key">
								<input type="hidden" value="OGMLeave.php" name="link">
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