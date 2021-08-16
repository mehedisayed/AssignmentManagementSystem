<?php
require_once('../index_model.php');

	$UserTypeTitle=$_POST['UserTypeTitle'];

	$indObj = new IndexModel();
	$rs = $indObj->insert_user_type($UserTypeTitle);
	if($rs==1)
	{
		header('Location: user_types.php');
	}
	else
	{
		header('Location: new_user_type.php');
	}	
?>