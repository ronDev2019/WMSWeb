<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> Manager's Leave Approval Page </title>
</head>
<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> MANAGER'S LEAVE APPLICATION </h4>
				</span>
				<?php

				require_once '../functions/db.php';

				$sel_data = sqlsrv_query($conn, "SELECT  DISTINCT(LeaveInformationId) AS UniqueId, ApplicationType AS TypeOf, ApplicationDate AS DateApplied, Name, Department FROM [HR.ExtensionDB].Leave.vLineItem WHERE CertifiedStatus = 'APPROVED' AND Status = 'ACTIVE' AND Canceled = 0 AND (Position LIKE '%Manager%') AND ApprovalStatus <> 'APPROVED' AND Status = 'ACTIVE' ORDER BY DateApplied");

				if(sqlsrv_has_rows($sel_data) > 0){

					while ($val = sqlsrv_fetch_object($sel_data)){

					$date = $val->DateApplied;
					$date = $date->format("j-M-Y");

				?>
					<div class="form_info_bythree form_info">
						<label> Unique ID: <strong> <?= $val->UniqueId ?> </strong></label><br>
						<label> Date Applied: <strong> <?= $date ?> </strong> </label><br>
						<label> Manager: <strong> <?= $val->Name ?> </strong> </label><br>
						<label> Department: <strong> <?= $val->Department ?> </strong> </label><br>
						<form action="ManagersLeave_Details.php" method="POST">
							<input type="hidden" value="<?= $val->UniqueId ?>" name="key">
							<input type="hidden" value="ManagersLeave.php" name="link">
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