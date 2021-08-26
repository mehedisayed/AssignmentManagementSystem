<?php
require_once('../index_model.php');
$indObj = new IndexModel();
$rs = $indObj->remove_student($_GET['ID']);
header('Location: students.php?SectionID=' . $_GET['SectionID']);
