<?php
require_once('../index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->delete_department($_GET['DepartmentID']);
	if($rs==1)
	{
		header('Location: departments.php');
	}
	else
	{
		header('Location: departments.php?error=1');
	}
