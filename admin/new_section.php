<html>

<head>
  <title>New Section</title>
  <link rel="stylesheet" href="css.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</head>

<body>
  <div class="container mt-2">
    <div class="row">
      <!-- first row -->
      <div class="col-12 mb-2 bg-light">
        <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">

          <a class="btn btn-warning ml-2" href="../logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
            Logout
          </a>
        </nav>
      </div>

      <!-- 2nd row -->
      <!-- col 1 -->
      <div class="col-2 bg-light border">
        <nav class=" d-none d-md-block bg-light sidebar">
          <?php
          require_once('sidebar.php');
          $adminLayout = new AdminLayout();
          $adminLayout->Sidebar();
          ?>
        </nav>
      </div>

      <!-- col 2 -->
      <div class="col-10 bg-transparent">
        <div class="container-fluid">

          <form method="POST" action="insert_section.php" name="datavalid" onsubmit="return validateForm()">

            <div class="form-group row">
              <label for="SectionName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-4">
                <input type="text" class="form-control form-control-sm" name="SectionName" value="" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="Status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-4">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Active" value="1" checked>
                  <label class="form-check-label" for="Active">Acitve</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Deactivated" value="0">
                  <label class="form-check-label" for="Deactivated">Deactivated</label>
                </div>
              </div>
            </div>

            <div class="form-group row">
              <label for="CourseID" class="col-sm-2 col-form-label">Course</label>
              <div class="col-4">
                <select class="form-control" id="CourseID" name="CourseID">
                  <option value="0">--None--</option>
                  <?php
                  require_once('../index_model.php');
                  $indObj = new IndexModel();
                  $rs = $indObj->getAllCoursesInfo();
                  while ($d = mysqli_fetch_assoc($rs)) {
                    echo $str = "<option value=" . $d["CourseID"] . ">" . $d["CourseName"] . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="TeacherID" class="col-sm-2 col-form-label">Teacher</label>
              <div class="col-4">
                <select class="form-control" id="TeacherID" name="TeacherID">
                  <option value="0">--None--</option>
                  <?php
                  require_once('../index_model.php');
                  $indObj = new IndexModel();
                  $rs = $indObj->getAllTeachersInfo();
                  while ($d = mysqli_fetch_assoc($rs)) {
                    echo $str = "<option value=" . $d["UserID"] . ">" . $d["UserName"] . "</option>";
                  }
                  ?>
                </select>
              </div>

            </div>

            <div class="form-group row">
              <label for="SemesterID" class="col-sm-2 col-form-label">Semester</label>
              <div class="col-4">
                <select class="form-control" id="SemesterID" name="SemesterID">
                  <option value="0">--None--</option>
                  <?php
                  require_once('../index_model.php');
                  $indObj = new IndexModel();
                  $rs = $indObj->getAllSemestersInfo();
                  while ($d = mysqli_fetch_assoc($rs)) {
                    echo $str = "<option value=" . $d["SemesterID"] . ">" . $d["SemesterTitle"] . "</option>";
                  }
                  ?>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary"> Save</button>

          </form>
          <script>
            function validateForm() {

              var TeacherID = document.forms["datavalid"]["TeacherID"].value;
              var CourseID = document.forms["datavalid"]["CourseID"].value;
              var SemesterID = document.forms["datavalid"]["SemesterID"].value;
              if (CourseID == 0) {
                alert("Please select a course");
                return false;
              }
              if (TeacherID == 0) {
                alert("Please select a teacher");
                return false;
              }

              if (SemesterID == 0) {
                alert("Please select a semester");
                return false;
              }
            }
          </script>
        </div>
      </div>
    </div>
  </div>
</body>

</html>