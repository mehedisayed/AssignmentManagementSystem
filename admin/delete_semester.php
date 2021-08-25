<?php
require_once('../index_model.php');
$indObj = new IndexModel();
$rs = $indObj->delete_semester($_GET['SemesterID']);
if ($rs == 1) {
	header('Location: semesters.php');
} else {
	header('Location: semesters.php?error=1');
}
