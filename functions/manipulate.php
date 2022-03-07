<?php

	require_once 'db.php';
	session_start();

	$key = $_POST['key'];
	$remarks = $_POST['remarks'];
	$approvedBy = $_SESSION['employeeId'];

	if(!empty($remarks))
	{
		$remarks = $remarks;
	}
	else
	{
		$remarks = "";
	}
if(isset($_POST['mpvrApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET RecommendingStatus = 'APPROVED', RecommendingStatusId = '{$approvedBy}', RecommendingStatusDate = GetDate() WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Approved Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['mpvrReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET RecommendingStatus = 'REJECTED', RecommendingStatusId = '{$approvedBy}', RecommendingStatusDate = GetDate() WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Rejected Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Exception occured updating ';
		}

	}
	elseif(isset($_POST['mpvrPending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET RecommendingStatus = 'PENDING', RecommendingStatusId = '{$approvedBy}', RecommendingStatusDate = GetDate() WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Set to PENDING Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['approved']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET ApprovedStatus = 'APPROVED', ApprovedById = '{$approvedBy}', ApprovedStatusDate = GetDate(), ApprovalRemarks = '{$remarks}' WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Approved Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['reject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET ApprovedStatus = 'REJECTED', ApprovedById = '{$approvedBy}', ApprovedStatusDate = GetDate(), ApprovalRemarks = '{$remarks}' WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Rejected Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Exception occured updating ';
		}

	}
	elseif(isset($_POST['pending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [MPV].[Information] SET ApprovedStatus = 'PENDING', ApprovedById = '{$approvedBy}', ApprovedStatusDate = GetDate(), ApprovalRemarks = '{$remarks}' WHERE MPVId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Set to PENDING Successfully"); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['poApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [PO].[Information] SET ApprovalStatus = 'APPROVED', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE PONo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Purchase Order Approval has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['poReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [PO].[Information] SET ApprovalStatus = 'REJECTED', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE PONo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Purchase Order Rejected successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['poPending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [PO].[Information] SET ApprovalStatus = 'PENDING', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE PONo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Purchase Order Pending Remarks has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['joApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [JO].[JobOrderInformation] SET ApprovalStatus = 'APPROVED', Status = 'APPROVED', ApprovedByUserId = '{$approvedBy}', DateApproved = GetDate() WHERE JobOrderID = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Job Order Approval has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['joReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [JO].[JobOrderInformation] SET ApprovalStatus = 'REJECTED', Status = 'APPROVED', ApprovedByUserId = '{$approvedBy}', DateApproved = GetDate() WHERE JobOrderID = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Job Order Rejected successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['rrApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [RR].[Information] SET NotedStatus = 'APPROVED', NotedBy = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}' WHERE RRNo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Receiving Report Approval has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['rrReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [RR].[Information] SET NotedStatus = 'REJECTED', NotedBy = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}' WHERE RRNo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Receiving Report Rejected successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['rrPending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [RR].[Information] SET NotedStatus = 'PENDING', NotedBy = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}' WHERE RRNo = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Receiving Report Pending Remarks has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}


	elseif(isset($_POST['mngrLeaveApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET ApprovalStatus = 'APPROVED', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Managers Leave Approval has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['mngrLeaveReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET ApprovalStatus = 'REJECTED', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Managers Leave has been Rejected successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['mngrLeavePending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET ApprovalStatus = 'PENDING', ApprovedById = '{$approvedBy}', DateApproved = GetDate(), ApprovalRemarks = '{$remarks}' WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("Managers Leave reset to pending has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}


	elseif(isset($_POST['ogmLeaveApproval']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET NotedStatus = 'APPROVED', NotedById = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}', RecommendingStatus = 'APPROVED', RecommendedById = '{$approvedBy}', DateRecommended = GetDate(), RecommendedRemarks = '{$remarks}'  WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("OGM Leave Approval has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['ogmLeaveReject']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET NotedStatus = 'REJECTED', NotedById = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}', RecommendingStatus = 'REJECTED', RecommendedById = '{$approvedBy}', DateRecommended = GetDate(), RecommendedRemarks = '{$remarks}'  WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("OGM Leave has been Rejected successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}
	elseif(isset($_POST['ogmLeavePending']))
	{
		$upd = sqlsrv_query($conn, "UPDATE [HR.ExtensionDB].[Leave].[Information] SET NotedStatus = 'PENDING', NotedById = '{$approvedBy}', DateNoted = GetDate(), NotedRemarks = '{$remarks}', RecommendingStatus = 'PENDING', RecommendedById = '{$approvedBy}', DateRecommended = GetDate(), RecommendedRemarks = '{$remarks}'  WHERE LeaveId = '{$key}'");
		if($upd == true)
		{
			echo '<script>alert("OGM Leave reset to pending has been sent successfully."); location.href="../"</script>';
		}
		else
		{
			echo 'Error';
		}

	}




	else
	{
		header('loaction:../');

	}

?>