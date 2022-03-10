<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> AGMA Page </title>
</head>
<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> AGMA Pre-Registration </h4>
				</span>
					<?php

					require_once '../functions/db.php';

					$sel_data = sqlsrv_query($conn, "SELECT District, SUM(NoOfRegistered) AS NoOfRegistered, (SELECT SUM(NoOfRegistered) FROM [Temp].[vAGMARegistration] WHERE LEN(District) > 0) AS Total, (SELECT SUM(NoOfRegistered) AS Total
                               FROM Temp.AGMARegistration
                               WHERE (RegistrationDate > '2018-10-07 00:00:00.000') AND LEN(District) > 0) AS GrandTotal FROM [Temp].[vAGMARegistration] WHERE LEN(District) > 0 Group by District ORDER BY SUM(NoOfRegistered) DESC");

					if(sqlsrv_has_rows($sel_data) > 0){

						//$val2 = sqlsrv_fetch_object($sel_data);	
						

						while ($val = sqlsrv_fetch_object($sel_data))
						{

					?>
					<div class="form_info_agma form_info">
						<label> District Source: <strong> <?= $val->District ?> </strong></label><br>
						<label> Registered: <strong> <?= number_format($val->NoOfRegistered) ?> </strong> </label><br>
						<label> Participation (%): <strong> <?= number_format(($val->NoOfRegistered / $val->GrandTotal) * 100,2) ?> % </strong> </label><br>
						<form action="AGMADetails.php" method="POST">
							<input type="hidden" value="<?= $val->District ?>" name="key">
							<input type="hidden" value="AGMA.php" name="link">
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