<?php
require_once('../index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->delete_course($_GET['CourseID']);
	if($rs==1)
	{
		header('Location: courses.php');
	}
	else
	{
		header('Location: courses.php?error=1');
	}
