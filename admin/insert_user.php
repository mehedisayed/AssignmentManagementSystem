<?php
require_once('../index_model.php');

	$UserName=$_POST['UserName'];
	$UserEmail=$_POST['UserEmail'];
	$Password=$_POST['Password'];
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
	$rs = $indObj->insert_user($UserName,$UserEmail,$Password,$Status,$UserTypeID,$DepartmentID);
	if($rs==1)
	{
		header('Location: users.php');
	}
	else
	{
		header('Location: new_user.php');
	}	
?>