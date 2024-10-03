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
    <title>Create Exam</title>
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

        #textconfig{
                    /** TEXT GRADIENT */ 
                     color: #e554ff; background-image: -webkit-linear-gradient(45deg, #e554ff 0%, #00e1ff 33%, #9e66ff 67%); background-clip: text; -webkit-background-clip: text; text-fill-color: transparent; -webkit-text-fill-color: transparent;
    
                     }  

        .form-control{
            border:3px solid  #AA86E8;

        }  
        
        
        .btnconfig{         
                    
                    background-image: linear-gradient(to right, #02AAB0 0%, #00CDAC  51%, #02AAB0  100%);
                    /* margin: 5px; */
                    padding: 10px 20px;
                    text-align: center;
                    text-transform: uppercase;
                    transition: 0.5s;
                    background-size: 200% auto;
                    color: white;            
                    /* box-shadow: 0 0 5px #000000; */
                    border-radius: 10px;
                    display: block;
        }
        
        .btnconfig:hover {
                    background-position: right center; /* change the direction of the change here */
                    color: #fff;
                    text-decoration: none;
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
                        <li class="nav-item mt-3 sildeanimation" >
                            <a class="nav-link" href="teacher_dashboard.php">
                                DashBoard
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
                        <li class="nav-item mt-1 ">
                            <a class="nav-link active disabled text-light" href="#">
                                <b>Create Exam</b>
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
                <!-- <div class="row">
                    <div id="welcomeheader" class="col-sm-12 rounded  d-flex justify-content-center flex-wrap flex-sm-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light">Welcome back , <?php echo htmlspecialchars($user['name'])?>!<br><span class="h5">Always stay updated in your student portal</span></h1><br>
                        <img id="bannerimage"   class=" mx-5 me-5 img-fluid" width="300" height="200" src="image/file2.gif" alt="studentbannerimage">
                    </div>
                   
                </div> -->

                

                <!-- ADVERTISE Courses Section -->
                <div class="row d-flex justify-content-center  mt-1 ">          
                <div class="col-sm-4 bg-dark rounded-4" style="border:3px solid  #AA86E8;">
                         <?php
                              $con=mysqli_connect("localhost","root","","examportal");
                             
                              $storeexam=htmlspecialchars($user['exam_permit']);
                              $fecthexamcenter=$storeexam;
                              
                              if(isset($_POST['submit']))
                              {
                                 $question=$_POST['question'];
                                 $optiona=$_POST['optiona'];
                                 $optionb=$_POST['optionb'];
                                 $optionc=$_POST['optionc'];
                                 $optiond=$_POST['optiond'];
                                 $correctans=$_POST['correctans'];
                                 $marks=$_POST['marks'];

                                 $sql = mysqli_query($con, "INSERT INTO $fecthexamcenter(question,option_a,option_b,option_c,option_d,correct_anwser,marks) 
                                       VALUES ('$question','$optiona','$optionb','$optionc','$optiond','$correctans',$marks)");
                              }

                         ?>

                        <form action="create_exam.php" method="post">
                            <div class="text-light text-center h3 mt-1" id='textconfig'>Create Exam</div>
                            
                            <div class="form-group">
                                <label for="question" class="form-label text-light h5">Enter Question</label>
                                <textarea class="form-control" name="question" id="question" row='3'></textarea>
                            </div><br>
    
                            <div class="form-group">
                                <label for="optiona" class="form-label text-light h5">Option A</label>
                                <input type="text" class="form-control" name="optiona" id="optiona">
                            </div><br>
    
                            <div class="form-group">
                                <label for="optionb" class="form-label text-light h5">Option B</label>
                                <input type="text" class="form-control" name="optionb" id="optionb">
                            </div><br>
    
                            <div class="form-group">
                                <label for="optionc" class="form-label text-light h5">Option C</label>
                                <input type="text" class="form-control" name="optionc" id="optionc">
                            </div><br>
    
                            <div class="form-group">
                                <label for="optiond" class="form-label text-light h5">Option D</label>
                                <input type="text" class="form-control" name="optiond" id="optiond">
                            </div><br>

                            <div class="form-group">
                                <label for="correctans" class="form-label text-light h5">Correct Answer</label>
                                <input type="text" class="form-control" name="correctans" id="correctans">
                            </div><br>

                            <div class="form-group">
                                <label for="marks" class="form-label text-light h5">Marks</label>
                                <input type="tel" class="form-control" name="marks" id="marks">
                            </div><br>
                            <div class="d-flex justify-content-center mb-2"> 
                            <input class="btn btnconfig fw-bold" type="submit" name="submit" id="submit" value="SUBMIT QUESTION">
                            </div> 
                        </form>
                </div>
                    
            </main>
        </div>
    </div>
</body>

</html>
