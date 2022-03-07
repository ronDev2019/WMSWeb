<?php

	session_start();

	if(isset($_SESSION['user']) && isset($_SESSION['type'])){

		if($_SESSION['type'] == 1){

			require_once 'admin-page.php';

		} else {

			require_once 'normal-page.php';

		}	

	} else {

		header('location:../');

	}

?>