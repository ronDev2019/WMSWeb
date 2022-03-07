<?php

	if(isset($_POST['submit'])){

		require_once 'db.php';

		function sec($data){
			$data = htmlspecialchars($data);
			$data = trim($data);
			$data = stripcslashes($data);
			return $data;
		}

		$username = sec($_POST['user']);
		$password = sec($_POST['pass']);
		//$name = sec($_POST['name']);

		$sele = sqlsrv_query($conn, "SELECT *, Firstname + ' ' + Lastname AS Name FROM [OnlineT].[vUserInformation] WHERE Username = '{$username}' AND Password = '{$password}' AND Active = 1");

		if(sqlsrv_has_rows($sele) > 0){

			while($val = sqlsrv_fetch_object($sele)){

				session_start();

				$_SESSION['Active'] = true;
				$_SESSION['user'] = $val->Username;
				$_SESSION['type'] = 1;
				$_SESSION['name'] = $val->Name;
				$_SESSION['employeeId'] = $val->EmployeeId;
				$_SESSION['employeeDepartment'] = $val->Department;
				$res = array(
						"name" => $val->Firstname,
						"lastname" => $val->Lastname,
						"user" => $val->Username,
						"stat" => 200,
					);

				echo json_encode($res);
				exit;

			}

		} else {

			$res = array("stat" => 404);

			echo json_encode($res);
			exit;

		}


	} else {

		header('location:../');

	}

?>