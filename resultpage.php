<?php
$con = mysqli_connect('localhost', "root", "", "examportal");

session_start();
$user = $_SESSION['user'];
$name=$_SESSION['name'];
$lname=$_SESSION['lname'];


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
    <title>Result Board</title>
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
                     
                     
                  .nextbtn{
            background-image: linear-gradient(to right, #1FA2FF 0%, #12D8FA  51%, #1FA2FF  100%);
            margin: 10px;
            padding: 10px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            /* box-shadow: 0 0 20px #eee; */
            border:none;
            border-radius: 10px;
            display: block;
          }

          .nextbtn:hover {
            background-position: right center; /* change the direction of the change here */
            color: black;
            text-decoration: none;
          }
           

          .prebtn{
            background-image: linear-gradient(to right, #FF512F 0%, #DD2476  51%, #FF512F  100%);
            margin: 10px;
            padding: 10px 45px;
            text-align: center;
            text-transform: uppercase;
            transition: 0.5s;
            background-size: 200% auto;
            color: white;            
            /* box-shadow: 0 0 20px #eee; */
            border:none;
            border-radius: 10px;
            display: block;
          }
          .prebtn:hover {
            background-position: right center; /* change the direction of the change here */
            color: black;
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
                            <img class="img-fluid" src="image/dashheadericon.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="student_dashboard.php">
                                <span class='text-light'>DashBoard</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="#">
                                Courses
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link  text-light" href="examlogin.php">
                                Exam
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link mt-1 active disabled text-light" href="#">
                               <b>Result</b> 
                            </a>
                        </li>
                        
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="student_reg.html">
                                Register Course
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="studentprofile.php">
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
                        <small class="fw-normal text-light">Enrolled: <?php echo htmlspecialchars($user['dept'])?></small>
                    </div>
                </div><br>

                <!-- Banner Name / Image  -->
                <div class="row">
                    <div id="welcomeheader" class="col-sm-12 rounded  d-flex justify-content-center flex-wrap flex-sm-nowrap align-items-center pt-3 pb-2 mb-3">
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light" style=" text-shadow: 1px 2px 5px rgba(0,0,0,0.6);">Welcome back , <?php echo htmlspecialchars($user['name'])?>!<br><span class="h5">Give Good effort!. Review the mistakes and come back stronger!</span></h1><br>
                        <img id="bannerimage"   class=" mx-5 me-5 img-fluid" width="400" height="200" src="image/examphoto.gif" alt="studentbannerimage">
                    </div>
                   
                </div>

                <!-- Result - Section -->
                <div class="container-fluid rounded-3 bg-dark pb-5" id="examareaconfig">
                    <?php
                        $con=mysqli_connect("localhost","root","","examportal");
                        // echo "<span class='text-light'>Connected</span>";  
                      
                        
                        $storeusername = htmlspecialchars($user['username']);
                       
                        
                          
                        //  Fetch Student Student data
                        $sql="SELECT * FROM studentdetail WHERE username='$storeusername'";
                        $studentstore=$con->query($sql);
                        $student_table = mysqli_fetch_assoc($studentstore);
                        $student_uid = $student_table['uid'];
                        $student_dept = $student_table['dept'];
                        $student_exam_permit=$student_table['exam_permit'];
                        

                        // Fetch Result data

                        $studentresult="SELECT * FROM result WHERE  uid='$student_uid'";
                        $resultfetch=$con->query($studentresult);
                        // $result_table = mysqli_fetch_assoc($resultfetch);
                        // $result_uid = $result_table['uid'];
                        // $result_dept=$result_table['dept'];
                        
                        echo "<div class='text-center text-light h1 mt-5'>";
                           echo 'Result';
                        echo "</div>";

                        echo "<div class='d-flex justify-content-center mt-4'>";
                        echo "<table class='col-12 table-bordered text-center table-dark'>";
                        echo "<thead>"; 
                        echo "<tr class='text-light h5'>";
                        echo"<th scope='col-sm'>UID</th>";
                        echo"<th scope='col-sm'>Name</th>";
                        echo"<th scope='col-sm'>Last Name</th>";
                        echo"<th scope='col-sm'>Department Exam</th>";
                        echo"<th scope='col-sm'>Total marks</th>";
                        echo"<th scope='col-sm'>Percentage</th>";
                        echo"<th scope='col-sm'>Qualified</th>";
                        echo"</tr>";
                        echo "</thead>";
                        echo"<tbody>";
                        if ($resultfetch->num_rows > 0) {
                            // output data of each row
                            while($row = $resultfetch->fetch_assoc()) {
                                echo "<tr class='text-light h5 '>";
                                echo "<td>" . $row['uid'] . "</td>";
                                echo "<td>" . $row['studentname'] . "</td>";
                                echo "<td>" . $row['studentlname'] . "</td>";
                                echo "<td>" . $row['dept'] . "</td>";
                                echo "<td>" . $row['total_marks'] . "</td>";
                                echo "<td>" . $row['percentage'].'%' . "</td>";
                                echo "<td>" . $row['pass_fail'] . "</td>";
                                echo "</tr>";   
                            }
                          } else {
                            // echo "<span class='text-light'>0 results</span>";
                          }
                        
                          echo "</tbody>";
                          echo "</table>";
                         echo "</div>";         
                    ?>
                </div>
      
            </main>
        </div>
    </div>
    
</body>
</html>
