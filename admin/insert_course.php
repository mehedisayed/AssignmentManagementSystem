<?php
require_once('../index_model.php');

$CourseCode = $_POST['CourseCode'];
$CourseName = $_POST['CourseName'];
$DepartmentID = $_POST['DepartmentID'];
$Status = $_POST['Status'];
$indObj = new IndexModel();
$rs = $indObj->insert_course($CourseCode, $CourseName, $DepartmentID, $Status);
if ($rs == 1) {
	header('Location: courses.php');
} else {
	header('Location: new_course.php');
}
