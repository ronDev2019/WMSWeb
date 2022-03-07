 <?php
	
	session_start();

	if(isset($_POST['View_details'])){

		require_once '../functions/db.php';

		$link = $_POST['link'];

		$key = $_POST['key'];

		$poInformation = sqlsrv_query($conn, "SELECT *, (SELECT SUM(Total) FROM [OnlineT].[vPOLineItem] WHERE PONo = '{$key}') AS Total FROM [OnlineT].[vPOInformation] WHERE PONo = '{$key}'");

		if(sqlsrv_has_rows($poInformation) > 0)
		{


			$val = sqlsrv_fetch_object($poInformation);

			$date = $val->PODate;
			$date = $date->format("n/j/Y g:i:s A");
			$total = number_format($val->Total,2);

			$LineItemList = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vPOLineItem] WHERE PONo = '{$key}'");

			$data_values = array(
				"PONo"=>$val->PONo,
				"Date"=>$date,
				"Status"=>$val->Status,
				"Supplier"=>$val->SupplierName,
				"Remarks"=>$val->Remarks,
			);

?>

<head>
		<title> PO Details </title>
	</head>
	<?= require_once 'header.php'; ?>
	<body>
	<div class="container-fluid">
		<div class="row">
			<section class="dtpanel">
				<span class="well well-md">
					<h4> PURCHASE ORDER INFORMATION </h4>
				</span>
				<fieldset>
					<table border="0" class="h_det">
						<tr>
							<td>
								<section>
									<label>P.O. :</label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['PONo'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> P.O. Date : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Date'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> Status : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Status'] ?>">
								</section>
							</td>

						</tr>
						<tr>
							<td>
								<section>
									<label> Supplier : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Supplier'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> Remarks : </label>
								</section>
							</td>
							<td colspan="3">
								<section>
									<input type="text" disabled value="<?= $data_values['Remarks'] ?>">
								</section>
							</td>

						</tr>
					</table>
				</fieldset>

				<table border="1" class="table table-borderd table-hover d_body">
					<thead>
						<tr class="hh">
							<td> PARTICULAR </td>
							<td> UOM </td>
							<td class="text-right"> QTY </td>
							<td class="text-right"> PRICE </td>
							<td class="text-right"> SUB-TOTAL </td>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($lineItem = sqlsrv_fetch_object($LineItemList))
							{
								?>

								<tr class="hh2">
									<td> <?= $lineItem->Product ?> </td>
									<td> <?= $lineItem->Measurement ?> </td>
									<td class="text-right"> <?= number_format($lineItem->Quantity,1) ?> </td>
									<td class="text-right"> <?= number_format($lineItem->UnitPrice,2) ?> </td>
									<td class="text-right"> <?= number_format($lineItem->Total,2) ?> </td>
								</tr>
							<?php
							}
							?>
						<tr tr class="hh3">
							<td></td>
							<td></td>
							<td></td>
							<td class="text-right">TOTAL</td>
							<td class="text-right"><?= $total ?></td>
						</tr>
					</tbody>
				</table>
				<form action="../functions/manipulate.php" method="POST">
					<table class="foot" border="0">
						
						<tr>
							<td>
								<input type="submit" class="btn btn-sm btn-primary" value="Approved" name="poApproval">
							</td>
							<td>
								<input type="submit" class="btn btn-sm btn-danger" value="Rejected" name="poReject">
							</td>
							<td class="text-right">
								<label> Remarks : </label>
							</td>
							<td>
								<input type="text" class="form-control" name="remarks">
								<input type="hidden" name="key" value="<?= $data_values['PONo'] ?>">
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