<?php
require_once('../index_model.php');

	$DepartmentName=$_POST['DepartmentName'];

	$indObj = new IndexModel();
	$rs = $indObj->insert_department($DepartmentName);
	if($rs==1)
	{
		header('Location: departments.php');
	}
	else
	{
		header('Location: new_department.php');
	}	
?>