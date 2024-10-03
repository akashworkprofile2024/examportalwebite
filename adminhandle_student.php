<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "examportal";


$con = new mysqli($host, $user, $password, $db);

//  check Connection establish

// if($con->connection_error)
// {
//     die("Connection failed" . $con->connection_error);
// }
// else
// {
//     echo "Connection Established";
// }

session_start();



$user = $_SESSION['user'];



// Get total students
$sql_students = "SELECT COUNT(*) as total_students FROM studentdetail";
$result_students = $con->query($sql_students);
$total_students = 0;
if ($result_students->num_rows > 0) {
    $row_students = $result_students->fetch_assoc();
    $total_students = $row_students['total_students'];
}

// Get total teachers
$sql_teachers = "SELECT COUNT(*) as total_teachers FROM teacherdetail";
$result_teachers = $con->query($sql_teachers);
$total_teachers = 0;
if ($result_teachers->num_rows > 0) {
    $row_teachers = $result_teachers->fetch_assoc();
    $total_teachers = $row_teachers['total_teachers'];
}

// Calculate total members (students + teachers)
$total_members = $total_students + $total_teachers;




// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
</head>

<style>


     body{
        background-image:url(../databits-project/image/dark_webback.png);
     }

    .sidebar {
        background-color: #8a2be2;
        min-height: 100vh;
        padding: 20px;
    }

    .nav-link {
        color: white;
        margin-bottom: 10px;
    }

    .nav-link.active {
        background-color: #6a1bb2;
        border-radius: 5px;
    }

    .nav-link:hover{
        color:#FFFF;
        font-weight:bold;
    }

    .sidebar-icon {
        width: 30px;
        margin-right: 10px;
    }

    .avatar {
        width: 50px;
        border-radius: 50%;
    }

    .card {
        background-color: #f3f4fa;
        border: none;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    }

    .card-body h5 {
        font-size: 1.25rem;
        color: #8a2be2;
    }

    .instructor-avatar {
        width: 50px;
    }

    .card-link {
        color: #8a2be2;
        text-decoration: none;
    }

    .card-link:hover {
        text-decoration: underline;
    }

/* BANNER SECTION */
    #welcomeheader {
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;

    }

    #welcomeheader2 {
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        border-top-right-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    #collapsenav:hover{
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        
    }

 



  .btn-success{
    background: rgb(146, 94, 226);
    background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);

    -webkit-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
  }


/* STATUS SECTION  */
   #cardconfig{
       color:rgb(173, 135, 233);
   }
 
   .borderconfig{
        border-style:solid;
        border-width:2px;
        border-color:rgba(173, 135, 233,0.6);
        border-radius:10px;
        
   }


   @keyframes scale-up-hor-left {
    0% {
    transform: scaleX(0.4);
    transform-origin: 0% 0%;
  }
  100% {
    transform: scaleX(1);
    transform-origin: 0% 0%;
  }
}

    .sildeanimation:hover{
        background-color: #6a1bb2;
        border-radius: 5px;
	    animation: scale-up-hor-left 0.5s cubic-bezier(0.390, 0.575, 0.565, 1.000) both;
    }    
  

 
</style>

<body id="bodyconfig">
    <div class="container-fluid">
        <div class="row">
            <!-- NAVBAR FOR TOGGLING SIDEBAR -->
            <nav class="navbar navbar-expand-sm navbar-light bg-light d-sm-none">
                
                <div class="container-fluid ">
                    <button id="collapsenav" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">Admin Dashboard</a>
                </div>

            </nav>

            <!-- SIDEBAR -->
            <nav id="sidebarMenu" class="col-sm-3 col-lg-2 d-sm-block bg-purple sidebar collapse show">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <img class="img-fluid" src="image/adminsidebar.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link text-light" href="admin_dashboard.php">
                                <span class=" text-light">DashBoard</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation ">
                            <a class="nav-link text-light" href="#">
                                Courses
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Result
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="admin_notification.php">
                                Notifications
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="admin_reg.html">
                                Register Course
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="adminprofile.php">
                                Profile Info
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="?logout=true">
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- BANNER SECTION -->
            <main class="col-sm-9 ms-sm-auto col-lg-10 px-sm-4">
                <div class="user-info d-flex justify-content-end mt-1">
                    <img class='text-light img-fluid' width=50 src="image/adminlogo.png" alt="User Avatar" class="avatar">
                    <div class="ms-3">
                        
                        <h5 class="mb-0 text-light"><?php echo htmlspecialchars($user['name']). " ". htmlspecialchars($user['lname'])?></h5>
                        <small class="fw-normal text-light">Enrolled: <span class="fw-normal text-light">Admin</span></small>
                    </div>
                </div><br>


                
                <div class="h1 text-light text-center">Student Enrolled</div>  

                 <!-- STUDENT AND TEACHER Section -->
                 <div class="row mt-5 d-flex justify-content-center">
                <div class="col-sm-12 ">
                        <div class="card text-center bg-dark rounded" style="border:3px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <?php
                                
                            ?>
                             <?php
                                
                                ?>
                                <?php
    $con = mysqli_connect("localhost", "root", "", "examportal");
    // Check connection
    // if (!$con) {
    //     die("Connection failed: " . mysqli_connect_error());
    // }
    
    // Handle delete request
    if (isset($_POST['delete'])) {
        $student_id = $_POST['student_id'];
        $delete_sql = "DELETE FROM studentdetail WHERE uid = $student_id";
        if ($con->query($delete_sql) === TRUE) {
            echo "<div class='alert alert-success'>Record deleted successfully</div>";
        } else {
            echo "<div class='alert alert-danger'>Error deleting record: " . $con->error . "</div>";
        }
    }
    
    // Initialize search parameters
    $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';
    $search_dept = isset($_GET['search_dept']) ? $_GET['search_dept'] : '';
    
    // Modify SQL to include search filters
    $storesql = "SELECT * FROM studentdetail WHERE name LIKE '%$search_name%' AND dept LIKE '%$search_dept%'";
    $runstore_sql = $con->query($storesql);
    
    echo "<div class='container mt-3'>";
    echo "<form method='GET' class='mb-4'>";
    echo "<div class='row'>";
    echo "<div class='col-sm-5'>";
    echo "<input style='border:3px solid #AA86E8' type='text' name='search_name' class='form-control' placeholder='Search by Name' value='" . htmlspecialchars($search_name) . "'>";
    echo "</div>";
    echo "<div class='col-sm-5'>";
    echo "<input style='border:3px solid #AA86E8' type='text' name='search_dept' class='form-control' placeholder='Search by Department' value='" . htmlspecialchars($search_dept) . "'>";
    echo "</div>";
    echo "<div class='col-sm-2'>";
    echo "<button type='submit' class='btn btn-primary fw-bold'>Search</button>";
    echo "</div>";
    echo "</div>";
    echo "</form>";
    
    // Display the student records
    echo "<div class='d-flex justify-content-center mt-2'>";
    echo "<table class='col-12 table-bordered text-center table-dark'>";
    echo "<thead>";
    echo "<tr class='text-light h5'>";
    echo "<th scope='col-sm'>Image</th>";
    echo "<th scope='col-sm'>Name</th>";
    echo "<th scope='col-sm'>Last Name</th>";
    echo "<th scope='col-sm'>Age</th>";
    echo "<th scope='col-sm'>Phone</th>";
    echo "<th scope='col-sm'>Department</th>";
    echo "<th scope='col-sm'>Username</th>";
    echo "<th scope='col-sm'>Password</th>";
    echo "<th scope='col-sm'>Update</th>";
    echo "<th scope='col-sm'>Remove</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    
    if ($runstore_sql->num_rows > 0) {
        while ($row = $runstore_sql->fetch_assoc()) {
            $studentimage = base64_encode($row['image']);
            echo "<tr class='text-light h5 '>";
            echo "<td><img src='data:image/jpeg;base64,$studentimage' class='rounded-circle instructor-avatar'></td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['lname'] . "</td>";
            echo "<td>" . $row['age'] . "</td>";
            echo "<td>" . $row['phone'] . "</td>";
            echo "<td>" . $row['dept'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['pass'] . "</td>";
            echo "<td>
                <form method='GET' action='adminstudent_update.php'>
                    <input type='hidden' name='student_id' value='" . $row['uid'] . "'>
                    <button type='submit' class='btn btn-warning fw-bold'>Update</button>
                </form>
            </td>";
            echo "<td>
                    <form method='POST' onsubmit='return confirm(\"Are you sure you want to delete this student?\");'>
                        <input type='hidden' name='student_id' value='" . $row['uid'] . "'>
                        <button type='submit' name='delete' class='btn btn-danger fw-bold'>Delete</button>
                    </form>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='10' class='text-light'>No students found</td></tr>";
    }
    
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    
    // Close connection
    mysqli_close($con);
    ?>

                            </div>
                        </div>
                   
                </div>

                
            </main>
        </div>
    </div>
</body>

</html>
