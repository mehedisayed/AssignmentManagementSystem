<?php
require_once('../index_model.php');

	$UserTypeTitle=$_POST['UserTypeTitle'];
	$UserTypeID=$_POST['UserTypeID'];
	$indObj = new IndexModel();
	$rs = $indObj->update_user_type($UserTypeID,$UserTypeTitle);
	 if($rs==1)
	 {
	 	header('Location: user_types.php');
	 }
	 else
	 {
	 	header('Location: new_user_type.php');
	 }	
?>