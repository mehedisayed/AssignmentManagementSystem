<?php
require_once('../index_model.php');
$indObj = new IndexModel();

$SectionID = $_POST['SectionID'];
$Students = $_POST['Students'];
$n = count($Students);
for ($i = 0; $i < $n; $i++) {
	$rs = $indObj->insert_student_section($SectionID, $Students[$i]);
}
header('Location: students.php?SectionID=' . $SectionID);
