<?php
require_once('../index_model.php');
if (!empty($_FILES["fileToUpload"]["name"])) {
	$target_dir = "../uploads/Question/";
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
			$filename = $_POST['Question'];
			unlink($filename);

			$AssignmentID = $_POST['AssignmentID'];
			$AssignmentTitle = $_POST['AssignmentTitle'];
			$AssignmentDetails = $_POST['AssignmentDetails'];
			$StartDate = $_POST['StartDate'];
			$EndDate = $_POST['EndDate'];
			$Status = $_POST['Status'];
			$File_link = "../uploads/Question/" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"]));
			$indObj = new IndexModel();
			$rs = $indObj->update_assignment($AssignmentID, $AssignmentTitle, $AssignmentDetails, $StartDate, $EndDate, $Status, $File_link);
			if ($rs == 1) {
				header('Location: assignments.php?SectionID=' . $_POST['SectionID']);
			} else {
				echo "Sorry, Cannot Insert into Database";
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
} else {
	$AssignmentID = $_POST['AssignmentID'];
	$AssignmentTitle = $_POST['AssignmentTitle'];
	$AssignmentDetails = $_POST['AssignmentDetails'];
	$StartDate = $_POST['StartDate'];
	$EndDate = $_POST['EndDate'];
	$Status = $_POST['Status'];
	$indObj = new IndexModel();
	$rs = $indObj->update_assignmentWithoutQuestion($AssignmentID, $AssignmentTitle, $AssignmentDetails, $StartDate, $EndDate, $Status);
	if ($rs == 1) {
		header('Location: assignments.php?SectionID=' . $_POST['SectionID']);
	} else {
		echo "Sorry, Cannot Insert into Database";
	}
}
