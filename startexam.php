<?php

$con = mysqli_connect('localhost', "root", "", "examportal");

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
$name=$_SESSION['name'];
$lname=$_SESSION['lname'];


if (isset($_POST['submit'])) { 
    header("Location:resultbackend.php");
    exit(); // Ensure no further code is executed
}

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
                    }

                    .submitbtnconfig{
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

                    .submitbtnconfig:hover {
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
         
        
        .hp{
            border:3px solid #AA86E8;
            border-right-style: none;
            border-top-style: none;
            border-bottom-style: none;
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
                            <a class="nav-link disabled text-light" href="#">
                                <span class='text-light'>DashBoard</span>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link disabled text-light" href="#">
                                Courses
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link disabled text-light" href="#">
                                Result
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active mt-1 disabled text-light" href="#">
                                <b>Exam</b>
                            </a>
                        </li>
                        <li class="nav-item sildeanimation ">
                            <a class="nav-link disabled text-light" href="#">
                                Notice
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link disabled text-light" href="#">
                                Schedule
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link disabled text-light" href="#">
                                Register Course
                            </a>
                        </li>
                        <li class="nav-item sildeanimation">
                            <a class="nav-link disabled text-light" href="#">
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

                <!-- Exam - Section -->
                <div class="container-fluid rounded-3 bg-dark" id="examareaconfig">   
                <?php
    $con = mysqli_connect("localhost", "root", "", "examportal");

    $fetchdept = $_SESSION['dept'];
    $fetchuser = $_SESSION['username'];
    $fetchuid = $_SESSION['uid'];

    $_SESSION['uid'] = $fetchuid;

    // Fetch Student department
    $sql = "SELECT * FROM studentdetail WHERE username='$fetchuser'";
    $studentstore = $con->query($sql);
    $student_table = mysqli_fetch_assoc($studentstore);
    $student_dept = $student_table['dept'];
    $student_exam_permit = $student_table['exam_permit'];

    if ($fetchdept == $student_dept) {
        // Check if the current question is set, if not start from the first question
        if (!isset($_SESSION['current_question'])) {
            $_SESSION['current_question'] = 0;
        }

        // Fetch all exam questions
        $exam_table = "SELECT * FROM $student_exam_permit";
        $exam_store = $con->query($exam_table);
        $questions = [];
        while ($row = mysqli_fetch_assoc($exam_store)) {
            $questions[] = $row;
        }

        // Total number of questions
        $total_questions = count($questions);

        // Check if the form is submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Store the selected answer
            if (isset($_POST['options'])) {
                $_SESSION['answers'][$_SESSION['current_question']] = $_POST['options'];
            }

            // Determine the action (next, previous, go to specific question)
            if (isset($_POST['action'])) {
                if ($_POST['action'] === 'next' && $_SESSION['current_question'] < $total_questions - 1) {
                    $_SESSION['current_question']++;
                }

                if ($_POST['action'] === 'previous' && $_SESSION['current_question'] > 0) {
                    $_SESSION['current_question']--;
                }

                if ($_POST['action'] === 'go_to_question') {
                    $_SESSION['current_question'] = (int)$_POST['go_to_question'];
                }
            }
        }

        // Get the current question
        $current_question = $_SESSION['current_question'];
        $question = $questions[$current_question]['question'];
        $optiona = $questions[$current_question]['option_a'];
        $optionb = $questions[$current_question]['option_b'];
        $optionc = $questions[$current_question]['option_c'];
        $optiond = $questions[$current_question]['option_d'];

        // Display the question and options
        echo "<form action='' method='post' id='examForm'>";
        echo "<div class='row'>";
        
        // Left side: Question and navigation
        echo "<div class='col-sm-10'>";
        echo "<p class='text-light h5 mt-4'><strong class='text-light'>Question " . ($current_question + 1) . ":</strong> " . $question . "</p>" . "<br>";
        echo "<div class='mt-3 h5 text-light'>";
        echo "<input type='radio' name='options' value='a' " . (isset($_SESSION['answers'][$current_question]) && $_SESSION['answers'][$current_question] == 'a' ? 'checked' : '') . "> " . $optiona . "<br><br>";
        echo "<input type='radio' name='options' value='b' " . (isset($_SESSION['answers'][$current_question]) && $_SESSION['answers'][$current_question] == 'b' ? 'checked' : '') . "> " . $optionb . "<br><br>";
        echo "<input type='radio' name='options' value='c' " . (isset($_SESSION['answers'][$current_question]) && $_SESSION['answers'][$current_question] == 'c' ? 'checked' : '') . "> " . $optionc . "<br><br>";
        echo "<input type='radio' name='options' value='d' " . (isset($_SESSION['answers'][$current_question]) && $_SESSION['answers'][$current_question] == 'd' ? 'checked' : '') . "> " . $optiond . "<br><br>";
        echo "</div>";

        echo "<input type='hidden' name='action' value=''>";
        
        // Navigation buttons
        echo "<div class='d-flex justify-content-center pb-3'>";
        if ($current_question > 0) {
            echo "<button class='prebtn fw-bold' type='submit' onclick=\"document.getElementsByName('action')[0].value='previous';\">Previous</button>&nbsp&nbsp&nbsp";
        }
        if ($current_question < $total_questions - 1) {
            echo "<button class='nextbtn fw-bold' type='submit' onclick=\"document.getElementsByName('action')[0].value='next';\">Next</button>";
        } else {
            echo "<button class='btn fw-bold submitbtnconfig' type='submit' name='submit'>Submit</button>";
        }
        echo "</div>";
        echo "</div>"; // End of left-side column

        // Right side: Question hopping section    
        echo "<div class='col-sm-2 hp'>";
        echo "<div class='d-flex justify-content-center mt-4'>";
        echo "<span class='text-light text-end h5'>Question List View<span><br>";
        echo "</div>";
        echo "<div class='question-hopping d-flex flex-wrap justify-content-center'>";
        
        for ($i = 0; $i < $total_questions; $i++) {
            $color = isset($_SESSION['answers'][$i]) ? 'green' : 'red';
            echo "<button type='submit' class='btn btn-sm' style='background-color: $color; color: white; margin: 5px;' onclick=\"document.getElementsByName('action')[0].value='go_to_question'; document.getElementsByName('go_to_question')[0].value='$i';\">" . ($i + 1) . "</button>";
        }
        echo "</div>";
        echo "</div>"; // End of right-side column

        echo "</div>"; // End of row

        // Hidden input for question hopping
        echo "<input type='hidden' name='go_to_question' value=''>";

        echo "</form>";
    } else {
        echo "Database not found";
    }
?>

<script>
    // Prevent opening new tabs or windows
    document.addEventListener('keydown', function(event) {
        if (event.ctrlKey && (event.key === 't' || event.key === 'n' || event.key === 'w')) {
            event.preventDefault();
            alert("You cannot open a new tab during the exam.");
        }
    });

    // Disable right-click
    document.addEventListener('contextmenu', function(event) {
        event.preventDefault();
        alert("Right-click is disabled during the exam.");
    });

    // Detect tab switching
    window.onblur = function() {
        alert("Do not switch tabs during the exam!");
        // You can take additional actions here like logging the event or ending the exam
    };

    window.onfocus = function() {
        console.log("Welcome back to the exam!");
    };
</script>


            </div>
            </main>
        </div>
    </div>
    
</body>
</html>
