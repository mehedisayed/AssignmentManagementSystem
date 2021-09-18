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
	public function getAllTeachersInfo()
	{
		$q = "SELECT *,UserTypeTitle,DepartmentName FROM users LEFT OUTER JOIN department on users.DepartmentID = department.DepartmentID LEFT OUTER JOIN usertype on users.UserTypeID= usertype.UserTypeID where users.UserTypeID=2";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAssignmentInfoBySectionID($SectionID)
	{
		$q = "SELECT * FROM assignments where SectionID=" . $SectionID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getQuestionBySectionID($AssignmentID)
	{
		$q = "SELECT * FROM assignments where AssignmentID=" . $AssignmentID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAssignmentSubmissionInfoBySectionIDStudentID($AssignmentID, $StudentID)
	{
		$q = "SELECT * FROM student_assignment_submission where AssignmentID=" . $AssignmentID . " and StudentID=" . $StudentID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAssignmentSubmissionInfoBYAssignmentID($AssignmentID)
	{
		$q = "SELECT student_assignment_submission.*,users.UserName FROM student_assignment_submission LEFT OUTER JOIN users on users.UserID=student_assignment_submission.StudentID where AssignmentID=" . $AssignmentID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAnswerByID($ID)
	{
		$q = "SELECT student_assignment_submission.*,users.UserName FROM student_assignment_submission LEFT OUTER JOIN users on users.UserID=student_assignment_submission.StudentID where ID=" . $ID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllStudentsInfo()
	{
		$q = "SELECT *,UserTypeTitle,DepartmentName,CONCAT(users.UserName,'[',users.UserID,']') as UserInfo FROM users LEFT OUTER JOIN department on users.DepartmentID = department.DepartmentID LEFT OUTER JOIN usertype on users.UserTypeID= usertype.UserTypeID where users.UserTypeID=1";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllCoursesInfo()
	{
		$q = "SELECT *,DepartmentName,courses.DepartmentID FROM courses LEFT OUTER JOIN department on courses.DepartmentID = department.DepartmentID";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}

	public function getAllSectionInfo()
	{
		$q = "SELECT * FROM `section` LEFT OUTER JOIN users on section.TeacherID=users.UserID LEFT OUTER JOIN courses on courses.CourseID=section.CourseID LEFT OUTER JOIN semester on semester.SemesterID=section.SemesterID";
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getSectionBySemesterIDCourseID($SemesterID, $CourseID)
	{
		$q = "SELECT * FROM `section` LEFT OUTER JOIN users on section.TeacherID=users.UserID LEFT OUTER JOIN courses on courses.CourseID=section.CourseID LEFT OUTER JOIN semester on semester.SemesterID=section.SemesterID where section.CourseID=" . $CourseID . " and section.SemesterID=" . $SemesterID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getStudentsBySections($SectionID)
	{
		$q = "SELECT student_section.ID,section.SectionID,section.SectionName,users.UserID,users.UserName FROM `student_section` LEFT OUTER JOIN users on student_section.StudentID=users.UserID LEFT OUTER JOIN section on section.SectionID=student_section.SectionID where student_section.SectionID=" . $SectionID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllStudentSectionInfo($SemesterID, $StudentID)
	{
		$q = "select student_section.*,users.UserName,courses.CourseName,section.SectionName from student_section LEFT OUTER JOIN section on student_section.SectionID=section.SectionID LEFT OUTER JOIN courses on courses.CourseID=section.CourseID LEFT OUTER JOIN users on section.TeacherID=users.UserID WHERE student_section.StudentID=" . $StudentID . " and section.SemesterID=" . $SemesterID;
		$r = mysqli_query($this->con, $q);
		if ($r == false) {
			return 0;
		} else {
			return $r;
		}
	}
	public function getAllTeacherSectionInfo($SemesterID, $TeacherID)
	{
		$q = "select section.*,users.UserName,courses.CourseName from section LEFT OUTER JOIN  courses on courses.CourseID=section.CourseID LEFT OUTER JOIN users on section.TeacherID=users.UserID WHERE section.TeacherID=" . $TeacherID . " and section.SemesterID=" . $SemesterID;
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
	public function insert_assignment_submission($AssignmentID, $StudentID, $File_link, $SubmissionDate, $SubmissionStatus)
	{
		$q = "INSERT INTO `student_assignment_submission` (`ID`, `AssignmentID`, `StudentID`, `File_link`, `SubmissionDate`, `SubmissionStatus`) VALUES (NULL,'" . $AssignmentID . "','" . $StudentID . "','" . $File_link . "',CAST('" . $SubmissionDate . "' AS DATE)," . $SubmissionStatus . ")";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_assignment($AssignmentTitle, $AssignmentDetails, $StartDate, $EndDate, $Status, $SectionID, $File_link)
	{
		$q = "INSERT INTO `assignments` (`AssignmentID`, `AssignmentTitle`, `AssignmentDetails`, `StartDate`, `EndDate`, `Status`, `SectionID`,`Question`) VALUES (NULL,'" . $AssignmentTitle . "','" . $AssignmentDetails . "',CAST('" . $StartDate . "' AS DATE),CAST('" . $EndDate . "' AS DATE)," . $Status . "," . $SectionID . ",'" . $File_link . "' )";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_course($CourseCode, $CourseName, $DepartmentID, $Status)
	{
		$q = "INSERT INTO `courses` (`CourseID`,`CourseCode`, `CourseName`, `DepartmentID`, `Status`) VALUES (NULL,'" . $CourseCode . "','" . $CourseName . "','" . $DepartmentID . "'," . $Status . ")";
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function insert_section($SectionName, $CourseID, $TeacherID, $SemesterID, $Status)
	{
		$q = "INSERT INTO `section` (`SectionID`,`SectionName`, `TeacherID`, `CourseID`, `SemesterID`,`Status`) VALUES (NULL,'" . $SectionName . "','" . $TeacherID . "','" . $CourseID . "'," . $SemesterID . "," . $Status . ")";
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
	public function insert_student_section($SectionID, $StudentID)
	{
		$q = "INSERT INTO `student_section` (`ID`, `StudentID`,`SectionID`) VALUES (NULL," . $StudentID . "," . $SectionID . ")";
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
	public function delete_course($CourseID)
	{
		$q = "DELETE from courses where `CourseID`=" . $CourseID;
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
	public function update_section($SectionID, $SectionName, $CourseID, $TeacherID, $SemesterID, $Status)
	{
		$q = "UPDATE `section` SET `SectionName`='" . $SectionName . "', `CourseID`='" . $CourseID . "', `TeacherID`=" . $TeacherID . ", `SemesterID`=" . $SemesterID . ", `Status`=" . $Status . " WHERE `SectionID`=" . $SectionID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_course($CourseID, $CourseCode, $CourseName, $DepartmentID, $Status)
	{
		$q = "UPDATE `courses` SET `CourseCode`='" . $CourseCode . "', `CourseName`='" . $CourseName . "', `DepartmentID`=" . $DepartmentID . ", `Status`=" . $Status . " WHERE `CourseID`=" . $CourseID;
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
	public function update_answer($ID, $Marks)
	{
		$q = "UPDATE `student_assignment_submission` SET `Marks`='" . $Marks . "' WHERE `ID`=" . $ID;
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
	public function update_assignmentWithoutQuestion($AssignmentID, $AssignmentTitle, $AssignmentDetails, $StartDate, $EndDate, $Status)
	{
		$q = "UPDATE `assignments` SET `AssignmentTitle`='" . $AssignmentTitle . "', `AssignmentDetails`='" . $AssignmentDetails . "',`StartDate`= CAST('" . $StartDate . "' AS DATE),`EndDate`= CAST('" . $EndDate . "' AS DATE), `Status`=" . $Status . " WHERE `AssignmentID`=" . $AssignmentID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function update_assignment($AssignmentID, $AssignmentTitle, $AssignmentDetails, $StartDate, $EndDate, $Status, $File_link)
	{
		$q = "UPDATE `assignments` SET `AssignmentTitle`='" . $AssignmentTitle . "', `AssignmentDetails`='" . $AssignmentDetails . "',`StartDate`= CAST('" . $StartDate . "' AS DATE),`EndDate`= CAST('" . $EndDate . "' AS DATE), `Status`=" . $Status . ", `Question`='" . $File_link . "' WHERE `AssignmentID`=" . $AssignmentID;
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
	public function delete_section($SectionID)
	{
		$q = "DELETE from `section` where `SectionID`=" . $SectionID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
	public function remove_student($ID)
	{
		$q = "DELETE from `student_section` where `ID`=" . $ID;
		if (mysqli_query($this->con, $q)) {
			return 1;
		} else {
			return 0;
		}
	}
}
