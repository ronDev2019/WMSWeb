<?php
	
	if(isset($_SESSION['user'])){

?>

	<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-4 main_frame">
				<center>
					<a class="btn btn-lg pv" href="Purchase_Voucher.php"> Purchase Voucher <label class="ins"> <strong> (<?= $pv ?>) </strong> </label> </a>
					<a class="btn btn-lg po" href="Purchase_Order.php"> Purchase Order <label class="ins"> <strong> (<?= $po ?>) </strong> </label> </a>
					<a class="btn btn-lg rr" href="Receiving_Report.php"> Receiving Report <label class="ins"> <strong> (<?= $rr ?>) </strong> </label> </a>
				</center>
			</div>
		</div>
	</div>
</body>
</html>

<?php

	} else {

		header('location../');

	}
		
?>