 <?php
	
	session_start();

	if(isset($_POST['View_details'])){

		require_once '../functions/db.php';

		$link = $_POST['link'];

		$key = $_POST['key'];

		$leaveInformation = sqlsrv_query($conn, "SELECT * FROM [HR.ExtensionDB].Leave.vInformation WHERE LeaveId = '{$key}'");

		if(sqlsrv_has_rows($leaveInformation) > 0)
		{


			$val = sqlsrv_fetch_object($leaveInformation);

			$date = $val->ApplicationDate;
			$date = $date->format("n/j/Y g:i:s A");

			$LineItemList = sqlsrv_query($conn, "SELECT * FROM [HR.ExtensionDB].Leave.vLineItem WHERE LeaveInformationId = '{$key}'");

			$data_values = array(
				"LeaveId"=>$val->LeaveId,
				"Name"=>$val->Name,
				"Department"=>$val->Department,
				"Position"=>$val->Position,
				"Date"=>$date,
			);

?>

<head>
		<title> Manager's Leave Details </title>
	</head>
	<?php require_once 'header.php'; ?>
	<body>
	<div class="container">
		<div class="row">
			<section class="main_frame">
				<span class="well well-md">
					<h4> MANAGER'S LEAVE INFORMATION </h4>
				</span><hr>
				<fieldset>
					<table border="0" class="h_det">
						<tr>
							<td class="text-right">
								<section>
									<label>UNIQUE ID :</label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['LeaveId'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> DATE : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Date'] ?>">
								</section>
							</td>

						</tr>
							<td class="text-right">
								<section>
									<label> NAME : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Name'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> DEPARTMENT : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Department'] ?>">
								</section>
							</td>
							<td class="text-right">
								<section>
									<label> POSITION : </label>
								</section>
							</td>
							<td>
								<section>
									<input type="text" disabled value="<?= $data_values['Position'] ?>">
								</section>
							</td>
						<tr>
							
						</tr>
					</table>
				</fieldset>
				<hr>
				<table border="1" class="table table-borderd table-hover d_body">
					<thead>
						<tr class="hh">
							<td> LEAVE DATE </td>
							<td> LEAVE TYPE </td>
							<td class="text-center"> AM/PM </td>
							<td> REASON </td>
						</tr>
					</thead>
					<tbody>
						<?php
							while ($lineItem = sqlsrv_fetch_object($LineItemList))
							{
								$date2 = $lineItem->LeaveDate;
								$date2 = $date2->format("j-M-Y");
								?>
								<tr class="hh2">
									<td> <?= $date2 ?> </td>
									<td> <?= $lineItem->LeaveType ?> </td>
									<td class="text-center"> <?= $lineItem->Meridiem ?> </td>
									<td> <?= $lineItem->Reason ?> </td>
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
								<input type="submit" class="btn btn-sm btn-primary" value="Approved" name="mngrLeaveApproval">
							</td>
							<td>
								<input type="submit" class="btn btn-sm btn-danger" value="Rejected" name="mngrLeaveReject">
							</td>
							<td class="text-right">
								<label> Remarks : </label>
							</td>
							<td>
								<input type="text" class="form-control" name="remarks">
								<input type="hidden" name="key" value="<?= $data_values['LeaveId'] ?>">
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