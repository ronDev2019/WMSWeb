<?php

	require_once 'db.php';

	$department = $_SESSION['employeeDepartment'];

	if(isset($_SESSION['Active'])){

		$sel_pvr = sqlsrv_query($conn, "SELECT COUNT(*) AS total_pvr FROM [OnlineT].[vMPVInformation] WHERE Status = 'FLOAT' AND Budget = 'APPROVED' AND Recommending = 'PENDING' AND Department = '{$department}'");

		if($sel_pvr){

			$val = sqlsrv_fetch_object($sel_pvr);

			if($val->total_pvr > 0){

				$pvr = $val->total_pvr;

			} else {

				$pvr = "0";

			}

		} else {

			echo 'Fetching record count exception.';

		}
		// End of Purchase Voucher Recommending



		$sel_pv = sqlsrv_query($conn, "SELECT COUNT(*) AS total FROM [OnlineT].[vMPVInformation] WHERE Status = 'FLOAT' AND Recommending = 'APPROVED' AND Approval = 'PENDING'");

		if($sel_pv){

			$val = sqlsrv_fetch_object($sel_pv);

			if($val->total > 0){

				$pv = $val->total;

			} else {

				$pv = 0;

			}

		} else {

			echo 'Fetching record count exception.';

		}
		// End of Purchase Voucher




		$sel_po = sqlsrv_query($conn, "SELECT COUNT(*) AS total_po FROM [OnlineT].[vPOInformation] WHERE Status = 'FLOAT' AND Approval = 'PENDING' AND AuditStatus = 'APPROVED'");

		if($sel_po){

			$val_po = sqlsrv_fetch_object($sel_po);

			if($val_po->total_po > 0){

				$po = $val_po->total_po;

			} else {

				$po = 0;

			}

		} else {

			echo 'Fetching record count exception.';

		}
		// End of Purchase Order

		$sel_jo = sqlsrv_query($conn, "SELECT COUNT(JobOrderID) AS total_jo FROM [JO].[JobOrderInformation] WHERE Status = 'PENDING' AND ApprovalStatus = 'PENDING' AND RecommendingStatus = 'APPROVED'");

		if($sel_jo){

			$val_jo = sqlsrv_fetch_object($sel_jo);

			if($val_jo->total_jo > 0){

				$jo = $val_jo->total_jo;

			} else {

				$jo = 0;

			}

		} else {

			echo 'Fetching record count exception.';

		}
		// End of Job Order



		$sel_rr = sqlsrv_query($conn, "SELECT COUNT(*) AS total_rr FROM [OnlineT].[vRRInformation] WHERE PostingStatus = 'POSTED' AND CheckedStatus = 'APPROVED' AND NotedStatus <> 'APPROVED'");

		if($sel_rr){

			$val_rr = sqlsrv_fetch_object($sel_rr);

			if($val_rr->total_rr > 0){

				$rr = $val_rr->total_rr;

			} else {

				$rr = "0";

			}

		} else {

			echo 'Fetching record count exception.';

		}
		//End of Receiving Report



		$sel_agma = sqlsrv_query($conn, "SELECT SUM(NoOfRegistered) AS total_registered FROM [Temp].[vAGMARegistration] WHERE LEN(District) > 0 SELECT SUM(NoOfRegistered) AS total_registered FROM [Temp].[vAGMARegistration] WHERE LEN(District) > 0");

		if($sel_agma){

			$val_agma = sqlsrv_fetch_object($sel_agma);

			if($val_agma->total_registered > 0){

				$agma = number_format($val_agma->total_registered,0);

			} else {

				$agma = "0";

			}

		} else {

			echo 'Fetching record count exception.';

		}
		//End of AGMA


		$sel_mngrleave = sqlsrv_query($conn, "SELECT  COUNT(DISTINCT(LeaveInformationId)) AS total_mngrleave FROM [HR.ExtensionDB].Leave.vLineItem WHERE CertifiedStatus = 'APPROVED' AND Canceled = 0 AND (Position LIKE '%Manager%' OR Position = 'Internal Auditor') AND ApprovalStatus <> 'APPROVED' AND Status = 'ACTIVE'");


		if($sel_mngrleave){

			$val_mngrleave = sqlsrv_fetch_object($sel_mngrleave);

			if($val_mngrleave->total_mngrleave > 0){

				$mngrleave = number_format($val_mngrleave->total_mngrleave,0);

			} else {

				$mngrleave = "0";

			}

		} else {

			//echo 'Fetching record count exception.';

		}
		//End of Manager's Leave

		$sel_ogmleave = sqlsrv_query($conn, "SELECT  COUNT(DISTINCT(LeaveInformationId)) AS total_ogmleave FROM [HR.ExtensionDB].Leave.vLineItem WHERE Department = 'Office of General Manager' AND Canceled = 0 AND RecommendingStatus <> 'APPROVED' AND Status = 'ACTIVE'");


		if($sel_ogmleave){

			$val_ogmleave = sqlsrv_fetch_object($sel_ogmleave);

			if($val_ogmleave->total_ogmleave > 0){

				$ogmleave = number_format($val_ogmleave->total_ogmleave,0);

			} else {

				$ogmleave = "0";

			}

		} else {

			//echo 'Fetching record count exception.';

		}
		//End of OGM's Leave


	}

?>