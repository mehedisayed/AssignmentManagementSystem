<?php
class AdminLayout
{

    public function AdminLayout()
    {
    }
    public function Sidebar()
    {
?>
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2 mt-2" href="#"><i class="fa fa-home" aria-hidden="true"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2" href="users.php">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2" href="user_types.php">
                        User Types
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2" href="semesters.php">
                        Semesters
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2" href="departments.php">
                        Departments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-info mb-2" href="courses.php">
                        Courses
                    </a>
                </li>
            </ul>
        </div>
<?php
    }
}
