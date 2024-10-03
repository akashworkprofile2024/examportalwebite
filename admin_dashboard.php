<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "examportal";


$con = mysqli_connect($host, $user, $password, $db);

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
                            <img class="img-fluid w-100 " src="image/adminsidebar.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item mt-2">
                            <a class="nav-link active disabled text-light mt-3" href="#">
                                <b class=" h5 text-light">DashBoard</b>
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
                <div class="text-light text-center">
                    
                </div>
                <div class="user-info d-flex justify-content-end mt-1">
                    <img class='text-light img-fluid' width=50 src="image/adminlogo.png" alt="User Avatar" class="avatar">
                <div class="ms-3">
                <h5 class="mb-0 text-light"><?php echo htmlspecialchars($user['name']). " ". htmlspecialchars($user['lname'])?></h5>
                <small class="fw-normal text-light">Enrolled: <span class="fw-normal text-light">Admin</span></small>
                </div>
                </div><br>

                <!-- BANNER NAME / IMAGE  -->
                <div class="row">
                    <div id="welcomeheader" class="col-sm-6 d-flex justify-content-end flex-wrap flex-sm-nowrap align-items-center pt-1 pb-1 mb-3">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light" style=" text-shadow: 1px 2px 5px rgba(0,0,0,0.6);">Welcome Admin, <?php echo htmlspecialchars($user['name'])?> !<br><span class="h5">Admin Made Simple, You Have Great Responsibility   </span></h1><br>
                    </div>
                    <div id="welcomeheader2" class="col-sm-6  d-flex justify-content-start flex-wrap flex-sm-nowrap align-items-center pt-1 pb-1 mb-3">
                        <img id="bannerimage" width=350 height=100 class="mx-auto img-fluid" src="image/adminbanner.gif" alt="">
                    </div>
                </div>

                <!-- STATUS SECTION -->
                <div class="row">
                <div class="col-sm-4">
                        <div class="card text-center" style="background-color:rgb(31, 31, 31);">
                            <div  class="card-body borderconfig" style="background-color:rgb(31, 31, 31)">
                                <h5 id='cardconfig'>Student Joined</h5>
                                <p class="fw-bold text-light"><?php echo $total_students ?></p>
                            </div>
                        </div>
                    </div>  

                    <div class="col-sm-4">
                        <div class="card text-center" style="background-color:rgb(31, 31, 31)">
                            <div class="card-body borderconfig" style="background-color:rgb(31, 31, 31)">
                                <h5 id='cardconfig'>Teacher Joined</h5>
                                <p class="fw-bold text-light"><?php echo $total_teachers ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center" style="background-color:rgb(31, 31, 31)">
                            <div class="card-body borderconfig" style="background-color:rgb(31, 31, 31)">
                                <h5 id='cardconfig'>Total Members</h5>
                                <p class="fw-bold text-light"><?php echo $total_members?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                 <!-- STUDENT AND TEACHER Section -->
                 <div class="row mt-4 d-flex justify-content-center">
                <div class="col-sm-4 ">
                        <div class="card text-center bg-dark rounded" style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <img src="image/studentadminimg1.gif" class='img-fluid 'alt="" style="width: 55%;">    
                            <h5 class="mt-1"></h5>
                            <span class='text-light fw-bold h5'>Student</span><br><br>
                                <a href="adminhandle_student.php" class="btn btn-success border fw-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-sm-1 "> -->
                        <!--">
                             Nothing just space
                        </div> -->
                    <!-- </div> -->
                    <div class="col-sm-4">
                        <div class="card text-center bg-dark rounded" style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">        
                            <img src="image/teacheradminimg1.gif" class='img-fluid' style="width: 69%;" alt="">    
                            <h5 class="mt-1"></h5><br>
                            <span class='text-light fw-bold h5'>Teacher</span><br><br>
                                <a href="adminhandle_teacher.php" class="btn btn-success border fw-bold">View</a>
                            </div>
                        </div>
                    </div>
                    

                    <div class="col-sm-4">
                        <div class="card text-center bg-dark rounded" style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                               <?php
                                   $con=mysqli_connect('localhost','root','','examportal');
                                   
                                   if(isset($_POST['submit']))
                                   {
                                       $noticedate=$_POST['publishdate']; 
                                       $gennotice=$_POST['notice']; 
                                       $noticesql="INSERT INTO notice(date,notice)VALUES('$noticedate','$gennotice')";
                                       
                                    if (mysqli_query($con, $noticesql)) {
                                        echo "<script>";
                                        echo "window.alert('Notice Published')";
                                        echo"</script>";
                                      
                                      } else {
                                        echo "Error: " . $noticesql . "<br>" . mysqli_error($con);
                                      }
                                      
                                       
                                   }
                               ?>                                 
                               <span class="text-light h5">Generate Notice</span>        
                               <form action="admin_dashboard.php" method="post">
                                  <input type="date" style="border: 3px solid #AA86E8;" class="form-control form-control-md mt-4" name="publishdate" id="publishdate"> 
                                  <input type="text" style="border: 3px solid #AA86E8;" class="form-control form-control-md mt-5" name="notice" id="notice" placeholder="Type Notice ..."> 
                                  <button type="submit" class="btn btn-success border fw-bold mt-5" name="submit" id="submit">Publish</button>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>

                
            </main>
        </div>
    </div>
</body>

</html>
