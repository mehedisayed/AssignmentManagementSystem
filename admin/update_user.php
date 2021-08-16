<?php
require_once('../index_model.php');
	$UserID=$_POST['UserID'];
	$UserName=$_POST['UserName'];
	$UserEmail=$_POST['UserEmail'];
	$Status=$_POST['Status'];
	$UserTypeID=$_POST['UserTypeID'];
	if($UserTypeID ==3)
	{
		$DepartmentID=NULL;
	}
	else
	{
		$DepartmentID=$_POST['DepartmentID'];
	}

	$indObj = new IndexModel();
	$rs = $indObj->update_user($UserID,$UserName,$UserEmail,$Status,$UserTypeID,$DepartmentID);
	 if($rs==1)
	 {
	 	header('Location: users.php');
	 }
	 else
	 {
	 	header('Location: new_user.php');
	 }	
?>