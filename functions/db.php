<?php

	//echo phpinfo();

	//$sever = "192.168.8.14";
	//$sever = "DESKTOP-MQ5MT02\SQLEXPRESS";
	$sever = "localhost";
	//$connention_info = array("Database"=>"Logistics", "UID"=>"n2a2Users", "PWD"=>"n2a2Users");
	$connention_info = array("Database"=>"Logistics", "UID"=>"cwsol", "PWD"=>"CwSol2022");

	$conn = sqlsrv_connect($sever,$connention_info);

	if($conn){

		//echo 'Connected Successfuly';

	} else {

		//echo 'Errorzki ';
		die(var_dump(sqlsrv_errors(), true));

	}

?>