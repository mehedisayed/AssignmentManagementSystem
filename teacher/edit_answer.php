<html>

<head>
  <title>Edit Answer</title>
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
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2 mt-2" href="#"><i class="fa fa-home" aria-hidden="true"></i>
                  Dashboard
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2" href="AllSemester.php">
                  Semesters
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- col 2 -->
      <div class="col-10 bg-transparent">
        <div class="container-fluid">
          <?php
          require_once('../index_model.php');
          $indObj = new IndexModel();
          $rs = $indObj->getAnswerByID($_GET["ID"]);
          while ($d = mysqli_fetch_assoc($rs)) {
          ?>
            <form method="POST" action="update_answer.php" name="datavalid" onsubmit="return validateForm()">
              <div class="form-group row">
                <label for="ID" class="col-sm-2 col-form-label">ID</label>
                <div class="col-4">
                  <input type="text" class="form-control form-control-sm" name="ID" value="<?php echo $d["ID"] ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="StudentID" class="col-sm-2 col-form-label">Student ID</label>
                <div class="col-4">
                  <input type="text" class="form-control form-control-sm" name="StudentID" value="<?php echo $d["StudentID"] ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="UserName" class="col-sm-2 col-form-label">Student Name</label>
                <div class="col-4">
                  <input type="text" class="form-control form-control-sm" name="UserName" value="<?php echo $d["UserName"] ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="SubmissionDate" class="col-sm-2 col-form-label">Submission Date</label>
                <div class="col-4">
                  <input type="text" class="form-control form-control-sm" name="SubmissionDate" value="<?php echo $d["SubmissionDate"] ?>" readonly>
                </div>
              </div>

              <div class="form-group row">
                <label for="Status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-4">
                  <?php
                  if ($d['SubmissionStatus'] == 1) {
                  ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Status" id="Submitted" value="1" checked disabled>
                      <label class="form-check-label" for="Submitted">Submitted</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Status" id="NotSubmitted" value="0" disabled>
                      <label class="form-check-label" for="NotSubmitted">Not Submitted</label>
                    </div>
                  <?php
                  } else {
                  ?>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Status" id="Submitted" value="1" disabled>
                      <label class="form-check-label" for="Submitted">Submitted</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="Status" id="NotSubmitted" value="0" disabled checked>
                      <label class="form-check-label" for="NotSubmitted">Not Submitted</label>
                    </div>
                  <?php
                  }
                  ?>
                </div>
              </div>
              <div class="form-group row">
                <label for="Marks" class="col-sm-2 col-form-label">Marks</label>
                <div class="col-4">
                  <input type="text" class="form-control form-control-sm" name="Marks" value="<?php echo $d["Marks"] ?>">
                </div>
              </div>
              <input type="hidden" name="AssignmentID" id="AssignmentID" value=<?php echo $d["AssignmentID"] ?>>
            <?php
          }
            ?>

            <button type="submit" class="btn btn-primary" name="submit">Save</button>

            </form>
            <script>
              function validateForm() {

              }
            </script>
        </div>
      </div>
    </div>
  </div>
</body>

</html>