<?php
require_once('../index_model.php');

$ID = $_POST['ID'];
$Marks = $_POST['Marks'];
$indObj = new IndexModel();
$rs = $indObj->update_answer($ID, $Marks);
if ($rs == 1) {
	header('Location: show_submitted_students.php?AssignmentID=' . $_POST['AssignmentID']);
} else {
	echo "Failded to Update.";
}
