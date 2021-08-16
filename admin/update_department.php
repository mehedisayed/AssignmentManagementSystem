<?php
require_once('../index_model.php');

	$DepartmentName = $_POST['DepartmentName'];
	$DepartmentID = $_POST['DepartmentID'];
	$indObj = new IndexModel();
	$rs = $indObj->update_department($DepartmentID,$DepartmentName);
	 if($rs==1)
	 {
	 	header('Location: departments.php');
	 }
	 else
	 {
	 	header('Location: new_department.php');
	 }	
?>