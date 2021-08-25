<?php
require_once('../index_model.php');

$SemesterTitle = $_POST['SemesterTitle'];
$Status = $_POST['Status'];
$SemesterID = $_POST['SemesterID'];
$indObj = new IndexModel();
$rs = $indObj->update_semester($SemesterID, $SemesterTitle, $Status);
if ($rs == 1) {
	header('Location: semesters.php');
} else {
	header('Location: new_semester.php');
}
