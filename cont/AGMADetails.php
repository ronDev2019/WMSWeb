 <?php
	
	session_start();

	if(isset($_POST['View_details'])){

		require_once '../functions/db.php';

		$link = $_POST['link'];

		$key = $_POST['key'];

		$AGMAInformation = sqlsrv_query($conn, "SELECT SUM(NoOfRegistered) AS Total FROM [Temp].[vAGMARegistration] WHERE District = '{$key}'");

		if(sqlsrv_has_rows($AGMAInformation) > 0)
		{


			$val = sqlsrv_fetch_object($AGMAInformation);

			$total = number_format($val->Total,0);

			$LineItemList = sqlsrv_query($conn, "SELECT District, RegistrationDate, SUM(NoOfRegistered) AS NoOfRegistered FROM [Temp].[vAGMARegistration] WHERE District = '{$key}' Group By District, RegistrationDate ORDER BY RegistrationDate DESC");
?>

<head>
		<title> Pre-Registration Summary </title>
	</head>
	<?php require_once 'header.php'; ?>
	<body>
	<div class="container">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> AGMA Pre-Registration Summary </h4>
				</span><hr>

				<table border="1" class="table table-borderd table-hover d_body">
					<thead>
						<tr class="hh">
							<td> DISTRICT SOURCE </td>
							<td class="text-center"> DATE REGISTERED </td>
							<td class="text-center"> REGISTERED </td>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($lineItem = sqlsrv_fetch_object($LineItemList))
							{
								$date = $lineItem->RegistrationDate;
								$date = $date->format("j-M-Y");
								?>
								<tr class="hh2">
									<td> <?= $lineItem->District ?> </td>
									<td class="text-center"> <?= $date ?> </td>
									<td class="text-center"> <?= number_format($lineItem->NoOfRegistered,0) ?> </td>
								</tr>
							<?php
							}
							?>
						<tr tr class="hh3">
							<td colspan="2">TOTAL</td>
							<td class="text-center"><?= $total ?></td>
						</tr>
					</tbody>
				</table>
			</section>
		</div>
		<div class="row">
			<center class="col-lg-12">
				<a href="<?= $link ?>" class="btn btn-md btn-warning bk"> Back </a>
			</center>
		</div>
	</div>
	</body>
	</html>

<?php

		}


	} else {

		header('location:../');

	}

?>