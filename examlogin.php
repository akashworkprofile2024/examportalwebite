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

// Logout functionality
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.html");
    exit();
}


$user = $_SESSION['user'];

// Check if session has a timer end time
if (!isset($_SESSION['examEndTime'])) {
    // Set timer to 1 minute (60 seconds)
    $_SESSION['examEndTime'] = time() + 3; // Current time + 1 min in seconds
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Login</title>
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

  /* Course Menu */

  #digitalmarketing{
    background-image:url(image/digitalmark.png);
    background-repeat: no-repeat;
    background-size: cover;
    border-radius:10px;
  }

  #webdev{
    background-image:url(image/webdev.png);
    background-repeat: no-repeat;
    /* background-size: cover; */
    border-radius:10px;
  }

  .btn-success{
    background: rgb(146, 94, 226);
    background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);

    -webkit-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
  }


  .invalid-feedback {
            display: none;
        }  

          .was-validated .form-control:invalid {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem);
        }

        .was-validated .form-control:valid {
            border-color: #198754;
        }

        .was-validated .form-control:invalid ~ .invalid-feedback {
            display: block;
        }

        .was-validated .form-control:valid ~ .valid-feedback {
            display: block;
        }   
        
        
        #textconfig{
                    /** TEXT GRADIENT */ 
                     color: #e554ff; background-image: -webkit-linear-gradient(45deg, #e554ff 0%, #00e1ff 33%, #9e66ff 67%); background-clip: text; -webkit-background-clip: text; text-fill-color: transparent; -webkit-text-fill-color: transparent;
    
                     }        
  

                     #examareaconfig{
                        border:3px solid  #AA86E8;
                        font-weight: bold;
                    }

                    .btn{
                         background-image: linear-gradient(to right, #DA22FF 0%, #9733EE  51%, #DA22FF  100%);
                         margin: 10px;
                         padding: 10px 45px;
                         text-align: center;
                         text-transform: uppercase;
                         transition: 0.5s;
                         background-size: 200% auto;
                         color: white;            
                         /* box-shadow: 0 0 20px #eee; */
                         border-radius: 10px;
                         display: block;
                       }

                    .btn:hover {
                      background-position: right center; /* change the direction of the change here */
                      color: #fff;
                      text-decoration: none;
                     }                 

                     .navicon {
    width: 55px;  /* Adjust the size as needed */
    height: 55px; /* Adjust the size as needed */
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
                            <img class="img-fluid" src="image/dashheadericon.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link" href="student_dashboard.php">
                                <span class='text-light'>DashBoard</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link" href="#">
                                Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mt-1 disabled text-light" style="font-size:20px;" href="#">
                                <b>Exam</b>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="resultpage.php">
                                Result
                            </a>
                        </li>
                        <li class="nav-item sildeanimation ">
                            <a class="nav-link text-light" href="#">
                                Notice
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="student_reg.html">
                                Register Course
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="profileinfo.php">
                                Profile Info
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link" href="?logout=true">
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
                        <small class="fw-normal text-light">Enrolled: <?php echo htmlspecialchars($user['dept'])?></small>
                    </div>
                </div><br>

                <!-- Banner Name / Image  -->
                <div class="row">
                    <div id="welcomeheader" class="col-sm-12 rounded  d-flex justify-content-center flex-wrap flex-sm-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light" style=" text-shadow: 1px 2px 5px rgba(0,0,0,0.6);">Welcome back , <?php echo htmlspecialchars($user['name'])?>!<br><span class="h5">Challenge Yourself, Conquer the Exam </span></h1><br>
                        <img id="bannerimage"   class=" mx-5 me-5 img-fluid" width="400" height="200" src="image/examphoto.gif" alt="studentbannerimage">
                    </div>
                </div>

                <!-- (Timer - Section) -->
                <div class="container-fluid rounded-3 bg-dark" id="countdown-area">
                    <div class='row-sm d-flex justify-content-center mt-3 pt-5 m-5 p-4'>
                        <div class='col-3'>
                            <div class="h3 text-light text-center">Time Remaining</div><br>
                            <div class="h1 text-light text-center" id="countdown">1:00</div><br>
                            <div class='text-center text-light h4'>GUIDELINES FOR THE EXAM</div>
                        </div>
                    </div>
                    <div id="demo" class="carousel slide " data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="3"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="4"></button>
  </div>
  <!-- The slideshow/carousel -->
  <div class="carousel-inner text-light">
    <div class="carousel-item active text-light text-center">
      <p class='fw-bold' style='font-size:20px'>Integrity Reminder: Academic integrity is crucial. Any form of cheating or plagiarism will result in disciplinary action.<p><br>
    </div>
    <div class="carousel-item text-light text-center">
      <p class='fw-bold' style='font-size:20px'>Prohibited Materials: No outside materials (books, notes, or electronic devices) are allowed during the exam unless explicitly stated.<p><br>
    </div>
    <div class="carousel-item text-light text-center">
      <p class='fw-bold' style='font-size:20px'>Technical Issues: Ensure your device and internet connection are stable. The exam may not be paused for technical difficulties.<p><br>
    </div>
    <div class="carousel-item text-light text-center">
      <p class='fw-bold' style='font-size:20px'>Time Management: The exam has a strict time limit. Plan your time wisely to complete all questions.<p><br>
    </div>
    <div class="carousel-item text-light text-center">
      <p class='fw-bold' style='font-size:20px'>Browser Restrictions: Use only the approved browser. Any attempts to open new tabs or applications may trigger a security alert.<p><br>
    </div>
  </div>
  <!-- Left and right controls/icons -->
  <button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
    <!-- <span class="carousel-control-prev-icon"></span> -->
    <img src="image/left.png" alt="Previous" class="carousel-control-prev-icon, navicon">
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
    <!-- <span class="carousel-control-next-icon"></span> -->
    <img src="image/right.png" alt="Previous" class="carousel-control-next-icon, navicon">

  </button>
</div>
                </div>

                <!-- Exam - login - Section -->
                <div class="container-fluid rounded-3 bg-dark d-none" id="examareaconfig">
                    <div class='row-sm  d-flex justify-content-center mt-3 pt-5 m-5 p-4'>
                        <div class='col-3 '>
                            <form action="examlogin_backend.php" enctype="multipart/form-data" method="post" class="needs-validation" novalidate>
                                 <div class=" h3 text-light text-center" id="textconfig">Exam Login</div><br>
                                 <!-- username -->
                                 <label for="username" class="form-label text-light h5 ">Username</label>
                                 <input id="examareaconfig" class="form-control " type="text" name="username" id="username" required>
                                 <div class=" text-end invalid-feedback text-light">Please provide username.</div><br>

                                 <!-- password -->
                                 <label for="password" class="form-label text-light h5">Password</label>
                                 <input id="examareaconfig" type="password" class="form-control " name="password" id="password" required>
                                 <div class=" text-end invalid-feedback text-light">Please provide password.</div><br>
                                 <div class="d-flex justify-content-center">
                                 <input class="btn fw-bold" type="submit" name="submit" id="submit" value="Login">
                                 </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<script>
    (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        let countdownElement = document.getElementById('countdown');
        let examAreaConfig = document.getElementById('examareaconfig');
        let countdownArea = document.getElementById('countdown-area');

        // PHP passes the session time to JavaScript
        let sessionEndTime = <?php echo $_SESSION['examEndTime'] * 1000; ?>; // Convert to milliseconds

        function updateCountdown() {
            let now = new Date().getTime();
            let distance = sessionEndTime - now;

            if (distance > 0) {
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                seconds = seconds < 10 ? '0' + seconds : seconds;
                countdownElement.innerHTML = minutes + ":" + seconds;
            } else {
                // Time is up
                clearInterval(countdownInterval);
                countdownArea.classList.add('d-none');
                examAreaConfig.classList.remove('d-none');
            }
        }

        let countdownInterval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Run it once initially

 
</script>    
</body>
</html>
