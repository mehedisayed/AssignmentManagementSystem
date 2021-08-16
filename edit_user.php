<html>
<head>
  <title>Edit User</title>
  <link rel="stylesheet" href="css.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</head>

<body>
  <div class="container mt-2">
    <div class="row">
      <!-- first row -->
      <div class="col-12 mb-2 bg-light">
      <nav class="navbar navbar-expand-lg navbar-light bg-light justify-content-end">
      
      <a class="btn btn-warning ml-2" href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>
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
                <a class="nav-link btn btn-info mb-2" href="profile.php">
                  Profile
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link btn btn-info mb-2" href="users.php">
                  Users
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

            require_once('index_model.php');
            $indObj = new IndexModel();
            $rs = $indObj->getUserInfoByID($_GET['UserID']);
            while($r= mysqli_fetch_assoc($rs))
            {
          ?>

          <form method="POST"  action="insert_user.php" name="datavalid" onsubmit="return validateForm()">
            <div class="form-group row">
              <label for="UserName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-4">
                <input type="text" class="form-control form-control-sm" name="UserName" value=<?php echo $r['UserName'] ?> required>
              </div>
            </div>

            <div class="form-group row">
              <label for="UserEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-4">
                <input type="email" class="form-control form-control-sm" name="UserEmail" value=<?php echo $r['UserEmail'] ?> required>
              </div>
            </div>

            <div class="form-group row">
              <label for="Status" class="col-sm-2 col-form-label">Status</label>
              <div class="col-4">
                <?php
                if($r['Status'] == 1)
                {
                  ?>
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Active" value="1" checked>
                  <label class="form-check-label" for="Active">Acitve</label>
                  </div>
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Deactivated" value="0">
                  <label class="form-check-label" for="Deactivated">Deactivated</label>
                </div>
                  <?php
                }
                else{
                  ?>
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Active" value="1">
                  <label class="form-check-label" for="Active">Acitve</label>
                  </div>
                  <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="Status" id="Deactivated" value="0" checked>
                  <label class="form-check-label" for="Deactivated">Deactivated</label>
                </div>
                <?php
                }
                ?>
              </div>
            </div>

            <div class="form-group row">
              <label for="UserTypeID" class="col-sm-2 col-form-label">User Type</label>
              <div class="col-4">
                <select class="form-control" id="UserTypeID" name="UserTypeID">
                  <?php 
                  require_once('index_model.php');
                  $indObj = new IndexModel();
                  $rs = $indObj->getAllUserTypesInfo();
                  while($d= mysqli_fetch_assoc($rs))
                  {
                      echo $str="<option value=".$d["UserTypeID"].">".$d["UserTypeTitle"]."</option>";
                  }	
                  ?>
                  </select>
              </div>
            </div>

            <div class="form-group row">
            <label for="DepartmentID" class="col-sm-2 col-form-label">Department</label>
              <div class="col-4">
                <select class="form-control" id="DepartmentID" name="DepartmentID">
                  <option value="0">--None--</option>
                  <?php 
                  require_once('index_model.php');
                  $indObj = new IndexModel();
                  $rs = $indObj->getAllDepartmentsInfo();
                  while($d= mysqli_fetch_assoc($rs))
                  {
                      echo $str="<option value=".$d["DepartmentID"].">".$d["DepartmentName"]."</option>";
                  }	
                }
                  ?>
                  </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary"> Save</button>

          </form>
          <script>
            function validateForm() {
              var UserName = document.forms["datavalid"]["UserName"].value;
              var UserEmail = document.forms["datavalid"]["UserEmail"].value;
              var Status = document.forms["datavalid"]["Status"].value;
              var UserTypeID = document.forms["datavalid"]["UserTypeID"].value;
              var DepartmentID = document.forms["datavalid"]["DepartmentID"].value;

              if(UserTypeID != 3 && DepartmentID == 0)
              {
                alert("Please select a department");
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