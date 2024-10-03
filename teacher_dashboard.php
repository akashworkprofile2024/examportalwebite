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
    <title>Teacher Dashboard</title>
    <!-- Bootstrap -->
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH' crossorigin='anonymous'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' integrity='sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz' crossorigin='anonymous'></script>
</head>

<style>

     

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
        width: 150px;
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

  body{
    background-image:url(image/dark_webback.png);
  }

  .btn-success{
    background: rgb(146, 94, 226);
    background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);

    -webkit-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
  }

  .image-container {
            position: relative;
            display: inline-block;
        }

        .rounded-image {
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            border: 3px solid #ccc;        

            z-index: 2;
            position: relative;
        }


        .spinner-border {
            position: absolute;
            top: 38.0%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 149px;
            height: 149px;
            z-index: 1;
            animation: spin 2s linear infinite;
            color:#A880E7;
        }

        @keyframes spin {
            0% { transform: translate(-50%, -50%) rotate(0deg); }
            100% { transform: translate(-50%, -50%) rotate(360deg); }
        }

  
        #notice{
            background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
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
                    <a class="navbar-brand" href="#">Student Dashboard</a>
                </div>

            </nav>

            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-sm-3 col-lg-2 d-sm-block bg-purple sidebar collapse show">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item ">
                            <img class="img-fluid" src="image/teachersidebar.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link active disabled" href="#">
                                <b class='text-light' style="font-size:20px;">DashBoard</b>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation ">
                            <a class="nav-link text-light" href="#">
                                Notice
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Result
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="create_exam.php">
                                Create Exam
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="teacherprofile.php">
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

            <!-- Main Content -->
            <main class="col-sm-9 ms-sm-auto col-lg-10 px-sm-4">
                <div class="user-info d-flex justify-content-end mt-1">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['image']); ?>" alt="User Avatar" class="avatar">
                    <div class="ms-3">
                        
                        <h5 class="mb-0 text-light"><?php echo htmlspecialchars($user['name']). " ". htmlspecialchars($user['lname'])?></h5>
                        <small class="fw-bold text-light">Enrolled: <?php echo htmlspecialchars($user['dept'])?></small>
                    </div>
                </div><br>

                <!-- Banner Name / Image  -->
                <div class="row">
                    <div id="welcomeheader" class="col-sm-12 rounded  d-flex justify-content-center flex-wrap flex-sm-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light" style="text-shadow: 1px 2px 5px rgba(0,0,0,0.6);">Welcome back , <?php echo htmlspecialchars($user['name'])?>!<br><span class="h5 ">Empowering students to reach new heights</span></h1><br>
                        <img id="bannerimage"   class=" mx-5 me-5 img-fluid" width="400" height="500" src="image/teacherbanner.gif" alt="studentbannerimage">
                    </div>
                   
                </div>

                <!-- Student Section -->
                <div class="row">
                <div class="col-sm-4  ">
                        <div class="card text-center bg-dark" style='border:2px solid #AA86E8'>
                            <div class="card-body">
                                <h5 style='color:#AA86E8'>Course Name</h5>
                                <p class="fw-bold text-light " ><?php echo htmlspecialchars($user['dept'])?></p>
                            </div>
                        </div>
                    </div>  

                    <div class="col-sm-4">
                        <div class="card text-center bg-dark" style='border:2px solid #AA86E8'>
                            <div class="card-body">
                                <h5 style='color:#AA86E8'>Student Enrolled</h5>
                                <p class="fw-bold text-light"><?php echo htmlspecialchars('3 '. $user['fees'])?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card text-center bg-dark" style='border:2px solid #AA86E8'>
                            <div class="card-body">
                                <h5 style='color:#AA86E8'>Passed Student</h5>
                                <p class="fw-bold text-light" ><?php echo htmlspecialchars('₹ '. $user['paid'])?></p>
                            </div>
                        </div>
                    </div>
                    
                </div>

                <!-- ADVERTISE Courses Section -->
                <div class="row mt-4">
                <div class="col-sm-4">
                        <div class="card text-center bg-dark rounded" style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <img src="image/cyberimg.gif" class='img-fluid w-50'   alt="">    
                            <h5 class="mt-1"></h5>
                            <span class='text-light fw-bold h5'>Cyber Security</span><br><br>
                                <a href="#" class="btn btn-success border fw-bold">View</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 ">
                        <div class="card text-center bg-dark rounded" style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <img src="image/webdevimg.gif" class='img-fluid w-50' alt="">    
                            <h5 class="mt-1"></h5>
                            <span class='text-light fw-bold h5'>Development</span><br><br>

                                <a href="#" class="btn btn-success border fw-bold">View</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 ">
                        <div class="card text-center bg-dark rounded " style="border:2px solid #AA86E8 ">
                            <div id="webdev" class="card-body bg-dark rounded ">
                            <img src="image/digitaimg.gif" class='img-fluid w-50' alt="">    
                            <h5 class="mt-1"></h5>
                            <span class='text-light fw-bold h5'>Digiatal Marketing</span><br><br>
                                <a href="#" class="btn btn-success border  fw-bold">View</a>
                            </div>
                        </div>
                    </div>
                </div><br><br>
            </main>
        </div>
    </div>
</body>

</html>
