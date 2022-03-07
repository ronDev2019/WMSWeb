<?php
	
	session_start();

	if(isset($_POST['View_details'])){

		require_once '../functions/db.php';

		$link = $_POST['link'];

		$key = $_POST['key'];

		$joInformation = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vJobOrderInformation] WHERE JobOrderID = '{$key}'");

		if(sqlsrv_has_rows($joInformation) > 0)
		{


			$val = sqlsrv_fetch_object($joInformation);
			$jobOrderID = $val->JobOrderID;
			$date = $val->DateCreated;
			$date = $date->format("n/j/Y g:i:s A");
			$jobTitle = $val->JobTitle;
			$equipment = $val->Equipment;
			$supplierName = $val->SupplierName;
			$joDetails = $val->MaterialDetails;
			$amount = number_format($val->MaterialAmount,2);
			$status = $val->Status;
			$unit = $val->Unit;
			$mileage = $val->Mileage;

?>

<head>
		<title> JO Details </title>
	</head>
	<?= require_once 'header.php'; ?>
	<body>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> JOB ORDER INFORMATION </h4>
				</span>
				<fieldset>
					<table border="0" class="h_det">
						<tr>
							<td>
								<section>
									<label>J.O. :</label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $jobOrderID ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> J.O. Date : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $date ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> Job Title : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $jobTitle ?>">
								</section>
							</td>

						</tr>
						<tr>
							<td>
								<section>
									<label> Equipment : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $equipment ?>">
								</section>
							</td>

						</tr>

						<tr>
							<td>
								<section>
									<label> Supplier : </label>
								</section>
							</td>
							<td colspan="5">
								<section>
									<input type="text" disabled value="<?= $supplierName ?>">
								</section>
							</td>
						</tr>

						<tr>
							<td>
								<section>
									<label> Amount : </label>
								</section>
							</td>
							
							<td>
								<section>
									<input type="text" disabled value="<?= $amount ?>">
								</section>
							</td>

							<td class="text-right">
								<section>
									<label> Unit : </label>
								</section>
							</td>
							
							<td>
								<section>
									<input type="text" disabled value="<?= $unit ?>">
								</section>
							</td>

							<td class="text-right">
								<section>
									<label> Status : </label>
								</section>
							</td>
							
							<td>
								<section>
									<input type="text" disabled value="<?= $status ?>">
								</section>
							</td>

						</tr>

						<tr>
							<td>
								<section>
									<label> J.O. Details : </label>
								</section>
							</td>
							
							<td colspan="5">
								<section>

									<textarea rows="10" colspan="5">
										<?= $joDetails ?>
									</textarea>

									
								</section>
							</td>

						</tr>
					</table>
				</fieldset>

				<form action="../functions/manipulate.php" method="POST">
					<table class="foot" border="0">
						
						<tr>
							<td>
								<input type="submit" class="btn btn-sm btn-primary" value="Approved" name="joApproval">
							</td>
							<td>
								<input type="submit" class="btn btn-sm btn-danger" value="Rejected" name="joReject">
							</td>
							<td class="text-right">
								<label> Remarks : </label>
							</td>
							<td>
								<input type="text" class="form-control" name="remarks">
								<input type="hidden" name="key" value="<?= $jobOrderID ?>">
							</td>
						</tr>
					</table>
				</form>
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