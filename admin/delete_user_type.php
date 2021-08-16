<?php
require_once('../index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->delete_user_type($_GET['UserTypeID']);
	if($rs==1)
	{
		header('Location: user_types.php');
	}
	else
	{
		header('Location: user_types.php?error=1');
	}	
?>