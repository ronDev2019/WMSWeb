<?php

	session_start();

	if(isset($_SESSION['Active'])){

		if(isset($_SESSION['user'])){

?>

<head>
	<title> AGMA Page </title>
</head>
<?= require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> AGMA Pre-Registration </h4>
				</span>
				<table border="0" class="table table-hover table-bordered dd">
					<tr class="hh">
						<td> DISTRICT SOURCE</td>
						<td class="text-center"> REGISTERED </td>
						<td class="text-center"> PARTICIPATION(%) </td>
						<td class="text-center"> ACTION </td>
					</tr>
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

							<tr class="hh2">
								<td> <?= $val->District ?> </td>
								<td class="text-center" class="number_format"> <?= $val->NoOfRegistered ?> </td>
								<td class="text-center" class="number_format"> <?= number_format(($val->NoOfRegistered / $val->GrandTotal) * 100,2) ?> % </td>
								<td class="text-center">
									<form action="AGMADetails.php" method="POST">
										<input type="hidden" value="<?= $val->District ?>" name="key">
										<input type="hidden" value="AGMA.php" name="link">
										<input type="submit" name="View_details" value="View Details" class="btn btn-md btn-primary hh">
									</form>
								</td>
							</tr>
							<?php
							$total = number_format($val->Total);
							?>
							<?php

						}
						?>
						<tr tr class="hh3">
							<td class="text-celter">TOTAL</td>
							<td class="text-center"><?= $total ?></td>
							<td class="text-center">100.00 %</td>
							<td class="text-center"></td>
						</tr>

						<?php
					}
					else
					{

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