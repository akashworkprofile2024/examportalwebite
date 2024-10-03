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
    header("Location: ../databits-project/index.html");
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
        background-image:url(image/dark_webback.png);
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
        color:#FFFFFF;
        font-weight:bold;
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

    #welcomeheader {
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        /* background-color: rgb(31, 31, 31); */
        border-top-left-radius: 10px;
        border-bottom-left-radius: 10px;

    }

    #welcomeheader2 {
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        /* border-top-right-radius: 10px;
        border-bottom-right-radius: 10px; */
        /* border-radius:10px; */
    }

    #collapsenav:hover{
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        
    }



  /* Course Menu */

  .btn-success{
    background: rgb(146, 94, 226);
    background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);

    -webkit-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
  }

  a{
    text-decoration:none;
    color:white;
  }


  @keyframes slide-fwd-center {
  0% {
    transform: translateZ(0) scale(1);
  }
  100% {
    transform: translateZ(160px) scale(1.10);
  }
}


  .approvebtn{

            background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA  51%, #1FA2FF  100%);
            margin: 10px;
            padding: 10px 10px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 3px #000000;
            border-radius: 10px;
            display: block;
            text-decoration:none;
            
          }



          .approvebtn:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
            animation: slide-fwd-center 1s ease forwards;
            a{
                color:black;
            }
          }

    .discardbtn{
            background-image: linear-gradient(to right, #FF512F 0%, #DD2476  51%, #FF512F  100%);
            margin: 10px;
            padding: 1px 16px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            box-shadow: 0 0 3px #000000;
            border-radius: 10px;
            display: block;
            
          }

          .discardbtn:hover {
            background-position: right center; /* change the direction of the change here */
            color: #fff;
            text-decoration: none;
	        animation: slide-fwd-center 1s ease forwards;
            a{
                color:black;
            }
          }


    
         
  

  
</style>

<body id="bodyconfig">
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar for toggling sidebar -->
            <nav class="navbar navbar-expand-sm navbar-light bg-light d-sm-none">
                
                <div class="container-fluid ">
                    <button id="collapsenav" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">Admin Dashboard</a>
                </div>

            </nav>

            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-sm-3 col-lg-2 d-sm-block bg-purple sidebar collapse show">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column ">
                        <li class="nav-item">
                            <img class="img-fluid " src="image/adminsidebar.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item mt-3 sildeanimation ">
                            <a class="nav-link" href="admin_dashboard.php">
                                <span class='text-light'>DashBoard</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Courses
                            </a>
                        </li>
                        <li class="nav-item h6 sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Result
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active disabled text-light" href="#">
                                <span class="h5 text-light">Notifications</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Request
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

            <!-- MAIN CONTENT -->
            <main class="col-sm-9 ms-sm-auto col-lg-10 px-sm-4">
                <div class="user-info d-flex justify-content-end mt-1">
                    <img src="#" alt="User Avatar" class="avatar text-light">
                    <div class="ms-3">
                        
                        <h5 class="mb-0 text-light"><?php echo htmlspecialchars($user['name']). " ". htmlspecialchars($user['lname'])?></h5>
                        <small class="fw-normal text-light">Enrolled: <span class="fw-normal text-light">Admin</span></small>
                    </div>
                </div><br>

                <!-- BANNER NAME / IMAGE  -->
                <div class="row ">
                    <div id="welcomeheader" class="col-sm-12 d-flex rounded-4 justify-content-center flex-wrap flex-sm-nowrap align-items-center pt-3 pb-2 mb-3 ">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 me-5 text-light" style=" text-shadow: 1px 2px 5px rgba(0,0,0,0.6);">Admin , <?php echo htmlspecialchars($user['name'])?> !<br><span class="h5">You Got  Notifications , Manage Notifications</span></h1> <span class='d-flex ms-5 justify-content-end'><img id="bannerimage" class=" ms-5  img-fluid " width=300 height=200 src="image/notify.gif" alt=""></span>
                    </div>
                    
                </div>

                <!-- PENDING SECTION -->
                <div class="row d-flex justify-content-center">
                <div class="col-sm-12 ">
                        <div class="card text-center" style='border-radius:15px; background-color:#1F1F1F'>
                            <div class="card-body border border-dark" style="background-color:#1F1F1F; border-radius:15px;">
                            <?php
                               // DATABASE CONNECTION
                               $servername = "localhost";
                               $username = "root";
                               $password = "";
                               $dbname = "examportal";
                               
                               $conn = new mysqli($servername, $username, $password, $dbname);
                               
                               if ($conn->connect_error) {
                                   die("Connection failed: " . $conn->connect_error);
                               }
                               
                               // FETCH PENDING STUDENTS
                               $sql_students = "SELECT uid, username, email FROM studentdetail WHERE status = 'pending'";
                               $result_students = $conn->query($sql_students);
                               
                               if ($result_students->num_rows > 0) {
                                echo "<div class='row' style='background-color:rgb(24, 24, 24);border-radius:15px'>";
                                  echo "<h2 class='text-light mt-1 '>Pending Student Registrations</h2>";
                                     while($row = $result_students->fetch_assoc()) {
                                       echo "<p>";

                                       echo "<span class='fw-bold text-light'>Username:&nbsp&nbsp</span><span class='text-light'>" . $row['username'] . "</span><br>";
                                       echo "<span class='fw-bold text-light'>Email:&nbsp&nbsp</span><span class='text-light'>" . $row['email'] . "</span><br>";

                                   
                                       
                                      echo "<div class='col-sm-12 d-flex justify-content-center'>";
                                       echo "<button class='btn approvebtn slide-fwd-center fw-bold'><a href='admin_operation.php?uid=" . $row['uid'] . "&table=studentdetail&action=approve'>Approve</a></button>&nbsp ";
                                       echo "<button class='btn discardbtn fw-bold'><a  href='admin_operation.php?uid=" . $row['uid'] . "&table=studentdetail&action=discard'>Discard</a></button>";
                                      echo "</div>";
                                       

                                    echo"</div>";
                                    echo "</p>";
                                        }
                                } else {
                                    echo"<div class='h2 text-light'>Student Registrations</div>"."<br>";
                                    echo "<span class='fw-bold text-light'>No pending student registrations.</span>"."<br><br>";
                                    
                                }

                                // FETCHING PENDING TEACHER 
                                $sql_teachers = "SELECT uid, username, email FROM teacherdetail WHERE status = 'pending'";
                                $result_teachers = $conn->query($sql_teachers);
                                
                                if ($result_teachers->num_rows > 0) {
                                 echo "<div class='row' style='background-color:rgb(24, 24, 24);border-radius:15px'>";   
                                 echo "<h2 class='text-light mt-1'>Pending Teacher Registrations</h2>";
                                 while($row = $result_teachers->fetch_assoc()) {
                                    echo "<p>";
                                    echo "<span class='fw-bold text-light'>Username:&nbsp&nbsp</span><span class='text-light'>" . $row['username'] . "</span><br>";
                                    echo "<span class='fw-bold text-light'>Email:&nbsp&nbsp</span><span class='text-light'>" . $row['email'] . "</span><br>";
                                    
                                    
                                       echo "<div class='col-sm-12 d-flex justify-content-center'>";
                                           echo "<button class='btn approvebtn fw-bold'><a  href='admin_operation.php?uid=" . $row['uid'] . "&table=teacherdetail&action=approve'>Approve</a></button> &nbsp ";
                                           echo "<button  class='btn discardbtn fw-bold'><a  href='admin_operation.php?uid=" . $row['uid'] . "&table=teacherdetail&action=discard'>Discard</a>";
                                       echo "</div>";
                                    echo "</p>";
                                    }
                                 } else {
                                     echo "<div class='h2 text-light'>Teacher Registerations</div>"."<br>";
                                     echo "<span class='fw-bold text-light'>No pending teacher registrations.</span>";
                                 }

                                 $conn->close();
                                 ?>  
                                
                            </div>
                        </div>
                    </div>  
             
                </div>

                </div>
            </main>
        </div>
    </div>
</body>

</html>



