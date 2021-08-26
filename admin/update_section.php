<?php
require_once('../index_model.php');
	$SectionID=$_POST['SectionID'];
	$SectionName = $_POST['SectionName'];
$TeacherID = $_POST['TeacherID'];
$CourseID = $_POST['CourseID'];
$SemesterID = $_POST['SemesterID'];
$Status = $_POST['Status'];

	$indObj = new IndexModel();
	$rs = $indObj->update_section($SectionID,$SectionName, $CourseID, $TeacherID, $SemesterID, $Status);
	 if($rs==1)
	 {
	 	header('Location: sections.php');
	 }
	 else
	 {
	 	header('Location: new_section.php');
	 }
