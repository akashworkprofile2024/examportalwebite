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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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
                        <li class="nav-item">
                            <a class="nav-link active mt-1 disabled text-light" href="#">
                                <b>Exam</b>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link  text-light" href="#">
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
                        <h1 class="h1-sm mt-5 mb-5 pt-5 pb-5 ms-5 text-light">Welcome back , <?php echo htmlspecialchars($user['name'])?>!<br><span class="h5">Challenge Yourself, Conquer the Exam </span></h1><br>
                        <img id="bannerimage"   class=" mx-5 me-5 img-fluid" width="400" height="200" src="image/examphoto.gif" alt="studentbannerimage">
                    </div>
                   
                </div>

                <!-- Exam - login - Section -->

                <div class="container-fluid rounded-3  pt-5 pb-5 " id="examareaconfig" style="background-image:url('image/result.gif');">
                <?php
// Database connection
$con=mysqli_connect("localhost","root","","examportal");
session_start();

// Retrieve user info from session
$fetchuid = $_SESSION['uid'];
$fetchuser = $_SESSION['username'];
$fetchdept = $_SESSION['dept'];
$fetchname=$_SESSION['name'];
$fetchlname=$_SESSION['lname'];






// Make sure user ID and answers are available
if (isset($_SESSION['uid']) && isset($_SESSION['answers'])) {

    $total_marks = 0;
    $correct_answers = 0;
    $total_questions = 0;
    $user_answers = $_SESSION['answers'];  // User's answers stored in session

    // Fetch the student's exam table based on the exam permit
    $sql = "SELECT * FROM studentdetail WHERE username='$fetchuser'";
    $studentstore = $con->query($sql);
    $student_table = mysqli_fetch_assoc($studentstore);
    $student_exam_permit = $student_table['exam_permit'];

    // Fetch all questions from the exam table
    $exam_table = "SELECT * FROM $student_exam_permit";
    $exam_store = $con->query($exam_table);

    // Loop through the questions and calculate the result
    if ($exam_store->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($exam_store)) {
            $total_questions++;
            $qid = $row['qid'];
            $correct_answer = $row['correct_anwser']; // Correct answer from the database
            $marks = $row['marks'];

            // Check if the user's answer matches the correct answer
            if (isset($user_answers[$total_questions - 1]) && $user_answers[$total_questions - 1] == $correct_answer) {
                $correct_answers++;
                $total_marks += $marks; // Add marks for correct answer
            }
        }
    }

    // Calculate percentage
    $percentage = ($total_marks / ($total_questions)) * 100;  // Assuming 1 mark per question

    // Determine pass or fail (assuming 40% is the pass mark)
    $pass_fail = ($percentage >= 50) ? 'Pass' : 'Fail';

    // Insert or update the result in the result table
    $sql_result = "INSERT INTO result (uid,dept,studentname,studentlname,total_marks, percentage, pass_fail,examstatus) VALUES ('$fetchuid','$fetchdept','$fetchname','$fetchlname','$total_marks', '$percentage', '$pass_fail','given')
                   ON DUPLICATE KEY UPDATE total_marks='$total_marks', percentage='$percentage', pass_fail='$pass_fail'";
    
         

    if ($con->query($sql_result) === TRUE) {
    // Update the examstatus column in the studentdetail table
    $update_exam_status = "UPDATE studentdetail SET examstatus='given' WHERE username='$fetchuser'";
    if ($con->query($update_exam_status) === TRUE) {
        echo "<div class='text-center mt-5 pt-5 mb-5 pb-5'>";
        echo "<br><br>";
        echo "<span class='h3 text-light'> Exam Submitted Successfully<span><br><br><br>";
        echo "</div>";
    } else {
        echo "Error updating exam status: " . $con->error;
    }
} else {
    echo "Error saving result: " . $con->error;
}


    // Display the result
    // echo "<h2>Result</h2>";
    
    // echo "Course Name: ".$fetchdept."<br>";
    // echo "Total Questions: " . $total_questions . "<br>";
    // echo "Correct Answers: " . $correct_answers . "<br>";
    // echo "Total Marks: " . $total_marks . "<br>";
    // echo "Percentage: " . $percentage . "%<br>";
    // echo "Status: " . $pass_fail . "<br>";

} else {
    echo "No exam data found. Please take the exam first.";
}

// Close the database connection
$con->close();
?>


                </div>
            </main>
        </div>
    </div>


</body>
</html>
