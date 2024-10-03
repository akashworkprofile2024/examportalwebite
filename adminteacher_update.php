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
  

    .form-control{
        border: 3px solid #AA86E8;
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
                            <img class="img-fluid" src="image/dashheadericon.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item">
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


                
                <div class="h1 text-light text-center">Update Teacher Details</div>  

                 <!-- STUDENT AND TEACHER Section -->
                 <div class="row mt-5 d-flex justify-content-center">
                <div class="col-sm-12 ">
                        <div class="card text-center bg-dark rounded" style="border:3px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <?php
$con = mysqli_connect("localhost", "root", "", "examportal");

if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    // Fetch student details
    $sql = "SELECT * FROM teacherdetail WHERE uid = $teacher_id";
    $result = $con->query($sql);
    $teacher = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    // Get updated data from form
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $dept = $_POST['dept'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Update query
    $update_sql = "UPDATE teacherdetail SET 
                    name = '$name',
                    lname = '$lname',
                    age = '$age',
                    phone = '$phone',
                    dept = '$dept',
                    username = '$username',
                    pass = '$password'
                  WHERE uid = $teacher_id";

    if ($con->query($update_sql) === TRUE) {
        echo "<div class='alert alert-success'>Record updated successfully</div>";
    } else {
        echo "<div class='alert alert-danger'>Error updating record: " . $con->error . "</div>";
    }
}
?>

<!-- HTML form for editing the student details -->
<div class="container mt-1 text-light">
    
    <form method="POST">
        <div class="mb-3 text-light text-start h6">
            <label for="name" class="form-label fw-bold">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $teacher['name']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="lname" class="form-label fw-bold">Last Name:</label>
            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $teacher['lname']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="age" class="form-label fw-bold">Age:</label>
            <input type="text" class="form-control" id="age" name="age" value="<?php echo $teacher['age']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="phone" class="form-label fw-bold">Phone:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $teacher['phone']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="dept" class="form-label fw-bold">Department:</label>
            <input type="text" class="form-control" id="dept" name="dept" value="<?php echo $teacher['dept']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="username" class="form-label fw-bold">Username:</label>
            <input type="text" class="form-control" id="username" name="username" value="<?php echo $teacher['username']; ?>" required>
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label fw-bold">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $teacher['pass']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary fw-bold" name="update">Update</button>
        &nbsp;&nbsp;
        <button type="submit" class="btn btn-danger fw-bold"><a class="text-light" style="text-decoration: none;" href="adminhandle_teacher.php">Close</a></button>
    </form>
</div>

<?php
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
