<?php
require_once('../index_model.php');
$indObj = new IndexModel();
$rs = $indObj->delete_section($_GET['SectionID']);
if ($rs == 1) {
	header('Location: sections.php');
} else {
	header('Location: sections.php?error=1');
}
