<?php
require_once('index_model.php');
	$indObj = new IndexModel();
	$rs = $indObj->check_login($_POST['email'],$_POST['password']);
	if($rs==0){
		header('Location: login.php?error=1');
	}
	else{
		while($d=mysqli_fetch_assoc($rs))
		{
			if($d['UserTypeID']== 1)
			 {
			 	header('Location: student.php');
		    }
			 else if($d['UserTypeID']== 2)
			 {
		   	header('Location: teacher.php');
			 }
			 else if($d['UserTypeID']== 3)
		   {
			 	header('Location: admin.php');
			 }
		}
	}
	
?>