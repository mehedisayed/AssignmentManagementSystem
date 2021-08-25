<?php
class IndexModel
{
	public $host;
	public $user;
	public $pass;
	public $dbname;
	public $con;
	public function IndexModel()
	{
		$this->host = "localhost:3306";
		$this->user = "root";
		$this->pass = "";
		$this->dbname = "ams";
		$this->con =  new mysqli($this->host, $this->user, $this->pass, $this->dbname);
	}
	public function check_login($email, $password)
	{
		$q = "SELECT * FROM users WHERE UserEmail='" . $email . "' and Password='" . $password . "' and Status=1";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			if (mysqli_num_rows($r) == 0) {
				return 0;
			}
			return $r;
		}
	}
	public function getAllUsersInfo()
	{
		$q = "SELECT *,UserTypeTitle,DepartmentName FROM users LEFT OUTER JOIN department on users.DepartmentID = department.DepartmentID LEFT OUTER JOIN usertype on users.UserTypeID= usertype.UserTypeID";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllCoursesInfo()
	{
		$q = "SELECT *,DepartmentName FROM courses LEFT OUTER JOIN department on courses.DepartmentID = department.DepartmentID";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllUserTypesInfo()
	{
		$q = "SELECT * FROM usertype";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllDepartmentsInfo()
	{
		$q = "SELECT * FROM department";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllSemestersInfo()
	{
		$q = "SELECT * FROM semester";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getUserInfoByID($UserID)
	{
		$q = "SELECT *,UserTypeTitle,DepartmentName FROM users LEFT OUTER JOIN department on users.DepartmentID = department.DepartmentID LEFT OUTER JOIN usertype on users.UserTypeID= usertype.UserTypeID where users.UserID=" . $UserID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}

	public function insert_user($UserName, $UserEmail, $Password, $Status, $UserTypeID, $DepartmentID)
	{
		$q = "INSERT INTO `users` (`UserID`, `UserName`, `UserEmail`, `Password`, `Status`, `UserTypeID`, `DepartmentID`) VALUES (NULL,'" . $UserName . "','" . $UserEmail . "','" . $Password . "'," . $Status . " ," . $UserTypeID . "," . $DepartmentID . ")";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_user_type($UserTypeTitle)
	{
		$q = "INSERT INTO `usertype` (`UserTypeID`, `UserTypeTitle`) VALUES (NULL,'" . $UserTypeTitle . "')";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_department($DepartmentName)
	{
		$q = "INSERT INTO `department` (`DepartmentID`, `DepartmentName`) VALUES (NULL,'" . $DepartmentName . "')";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_semester($SemesterTitle, $Status)
	{
		$q = "INSERT INTO `semester` (`SemesterID`, `SemesterTitle`,`Status`) VALUES (NULL,'" . $SemesterTitle . "'," . $Status . ")";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function delete_user($UserID)
	{
		$q = "DELETE from users where `UserID`=" . $UserID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function delete_user_type($UserTypeID)
	{
		$q = "DELETE from usertype where `UserTypeID`=" . $UserTypeID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function delete_department($DepartmentID)
	{
		$q = "DELETE from department where `DepartmentID`=" . $DepartmentID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_user($UserID, $UserName, $UserEmail, $Status, $UserTypeID, $DepartmentID)
	{
		$q = "UPDATE `users` SET `UserName`='" . $UserName . "', `UserEmail`='" . $UserEmail . "', `Status`=" . $Status . ", `UserTypeID`=" . $UserTypeID . ", `DepartmentID`=" . $DepartmentID . " WHERE `UserID`=" . $UserID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_user_type($UserTypeID, $UserTypeTitle)
	{
		$q = "UPDATE `usertype` SET `UserTypeTitle`='" . $UserTypeTitle . "' WHERE `UserTypeID`=" . $UserTypeID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_department($DepartmentID, $DepartmentName)
	{
		$q = "UPDATE `department` SET `DepartmentName`='" . $DepartmentName . "' WHERE `DepartmentID`=" . $DepartmentID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_semester($SemesterID, $SemesterTitle, $Status)
	{
		$q = "UPDATE `semester` SET `SemesterTitle`='" . $SemesterTitle . "', `Status`=" . $Status . " WHERE `SemesterID`=" . $SemesterID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function delete_semester($SemesterID)
	{
		$q = "DELETE from `semester` where `SemesterID`=" . $SemesterID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
}
