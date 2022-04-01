<?php
	
	if(isset($_SESSION['user'])){

?>

	<?php require_once 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<h1> Main Dashboard Page </h1>
		</div>
	</div>
</body>
</html>

<?php

	} else {

		header('location../');
		echo '<a class="btn btn-lg agma" href="AGMA.php"> AGMA 2018 <label class="ins"> <?= $agma ?> </label> </a>';

	}
		
?>