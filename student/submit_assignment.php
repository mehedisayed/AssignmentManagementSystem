<?php
require_once('../index_model.php');

$target_dir = "../uploads/Answers/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if ($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
}

if (file_exists($target_file)) {
	echo "Sorry, file already exists.";
	$uploadOk = 0;
}

if (
	$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif"
) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}


if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
		session_start();
		$AssignmentID = $_POST['AssignmentID'];
		$StudentID = $_SESSION["UserID"];
		$File_link = "../uploads/Answers/" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
		$SubmissionDate = date("Y-m-d H:i:s");
		$SubmissionStatus = 1;
		$indObj = new IndexModel();
		echo "<script>alert('" . $SubmissionDate . "')</script>";
		$rs = $indObj->insert_assignment_submission($AssignmentID, $StudentID, $File_link, $SubmissionDate, $SubmissionStatus);
		if ($rs == 1) {
			header('Location: show_assignment.php?AssignmentID=' . $_POST['AssignmentID']);
		} else {
			echo "Sorry, Cannot Insert into Database";
		}
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
