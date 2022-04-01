<?php
	
	session_start();

	if(isset($_POST['View_details'])){

		require_once '../functions/db.php';

		$link = $_POST['link'];

		$key = $_POST['key'];

		$mpvInformation = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vMPVInformation] WHERE MPVNo = '{$key}'");

		if(sqlsrv_has_rows($mpvInformation) > 0)
		{


			$val = sqlsrv_fetch_object($mpvInformation);

			$date = $val->RequestDate;
			$date = $date->format("n/j/Y g:i:s A");

			$LineItemList = sqlsrv_query($conn, "SELECT * FROM [OnlineT].[vMPVLineItem] WHERE MPVNo = '{$key}'");

			$data_values = array(
				"MPVNo"=>$val->MPVNo,
				"Type"=>$val->RequestType,
				"Date"=>$date,
				"RequestedBy"=>$val->RequestedBy,
				"Purpose"=>$val->Purpose,
				"Department"=>$val->Department,
				"Budget"=>$val->Budget,
				"BudgetRemarks"=>$val->BudgetRemarks,
			);

?>

	<head>
		<title> MPV Details </title>
	</head>
	<?php require_once 'header.php'; ?>
	<body>
	<div class="container">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> Purchase Voucher Information </h4>
				</span><hr>
				<fieldset>
					<table border="0" class="h_det">
						<tr>
							<td>
								<section>
									<label>MPV:</label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['MPVNo'] ?>">
								</section>
							</td>
							<td>
								<section>
									<label> Type: </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Type'] ?>">
								</section>
							</td>
							<td>
								<section>
									<label> Requester: </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['RequestedBy'] ?>">
								</section>
							</td>
							<td>
								<section>
									<label> Department: </label>
								</section>
							</td>
							<td>
								<section>
									<input type="textarea" class="depts" disabled value="<?= $data_values['Department'] ?>">
								</section>
							</td>

						</tr>
						<tr>
							<td>
								<section>
									<label> Date: </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Date'] ?>">
								</section>
							</td>
							<td colspan="1">
								<section>
									<label> Purpose: </label>
								</section>
							</td>
							<td colspan="5">
								<section>
									<input type="text" disabled value="<?= $data_values['Purpose'] ?>">
								</section>
							</td>

						</tr>
						<tr>
							<td>
								<section>
									<label> Budget: </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Budget'] ?>">
								</section>
							</td>
							<td colspan="1">
								<section>
									<label> Remarks: </label>
								</section>
							</td>
							<td colspan="5">
								<section>
									<input type="text" disabled value="<?= $data_values['BudgetRemarks'] ?>">
								</section>
							</td>

						</tr>
					</table>
				</fieldset>
				<hr>
				<table border="1" class="table table-borderd table-hover d_body">
					<thead>
						<tr class="hh">
							<td> CODE </td>
							<td> PARTICULAR </td>
							<td> SPECIFICATION </td>
							<td> UOM </td>
							<td> QTY </td>
							<td> BUDGET </td>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($lineItem = sqlsrv_fetch_object($LineItemList))
							{
								?>
								<tr class="hh2">
									<td> <?= $lineItem->ProductCode ?> </td>
									<td> <?= $lineItem->Product ?> </td>
									<td> <?= $lineItem->Specification ?> </td>
									<td> <?= $lineItem->Measurement ?> </td>
									<td> <?= $lineItem->Quantity ?> </td>
									<td><section><input type="checkbox" value="<?= $lineItem->ItemBudget ?>" disabled="disabled"></section></td>
								</tr>
							<?php
							}
							?>
						
					</tbody>
				</table>
				<form action="../functions/manipulate.php" method="POST">
					<table class="foot" border="0">
						<tr>
							<td>
								<input type="submit" class="btn btn-sm btn-primary" value="Approved" name="mpvrApproval">
							</td>
							<td>
								<input type="submit" class="btn btn-sm btn-danger" value="Rejected" name="mpvrReject">
							</td>
							<td class="text-right">
								<label> Remarks : </label>
							</td>
							<td>
								<input type="text" class="form-control" name="remarks">
								<input type="hidden" name="key" value="<?= $data_values['MPVNo'] ?>">
							</td>
						</tr>
					</table>
				</form>
			</section>
		</div>
		<div class="row">
			<div class="col-md-12">
				<a href="<?= $link ?>" class="btn btn-md btn-warning bk"> Back </a>
			</div>
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