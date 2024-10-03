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


// Handle profile update
if (isset($_POST['submit'])) {
    // Get the updated user details from the form
    $name = $_POST['name'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['pass'];

    // Update query to modify the user's information in the database
    $update_query = "UPDATE teacherdetail SET 
        name = '$name', 
        lname = '$lname', 
        age = '$age', 
        phone = '$phone', 
        address = '$address', 
        state = '$state', 
        city = '$city', 
        email = '$email', 
        username = '$username', 
        pass = '$password' 
        WHERE uid = {$_SESSION['user']['uid']}"; // Assuming `id` is the primary key

    if ($con->query($update_query) === TRUE) {
        echo"<script>";
            echo "window.location.href='teacherprofile.php'";
        echo"</script>";
        // Update session data with the latest user info
        $_SESSION['user'] = array_merge($_SESSION['user'], $_POST);
    } else {
        echo "Error updating profile: " . $con->error;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Profile Update</title>
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

   

    #collapsenav:hover{
        background: rgb(146, 94, 226);
        background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);
        
    }

  body{
    background-image:url(image/dark_webback.png);
  }

  /* Course Menu */



  .btn-success{
    background: rgb(146, 94, 226);
    background: linear-gradient(0deg, rgba(146, 94, 226, 1) 0%, rgba(174, 137, 233, 1) 100%);

    -webkit-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
-moz-box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
box-shadow: -1px 1px 9px 0px rgba(0,0,0,0.75);
  }


  .form-control{

-webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
}


.image-container {
    position: relative;
    display: inline-block;
}

.rounded-image {
    border-radius: 50%;
    width: 50px;
    height: 50px;
    object-fit: cover;
    border: 3px solid #ccc;
    z-index: 2;
    position: relative;
}

.spinner-border {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 60px;
    height: 60px;
    z-index: 1;
    animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: translate(-50%, -50%) rotate(0deg); }
    100% { transform: translate(-50%, -50%) rotate(360deg); }
}


.spinner-border{
    background-color: #FBDA61;
    background-image: linear-gradient(45deg, #FBDA61 0%, #FF5ACD 100%);

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

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Navbar for toggling sidebar -->
            <nav class="navbar navbar-expand-sm navbar-light bg-light d-sm-none ">
                
                <div class="container-fluid ">
                    <button id="collapsenav" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="#">Student Dashboard</a>
                </div>

            </nav>

            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-sm-3 col-lg-2 d-sm-block bg-purple sidebar collapse show ">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                    <li class="nav-item ">
                            <img class="img-fluid" src="image/teachersidebar.png" alt="DashBoard-Icon">
                        </li>
                        <li class="nav-item mt-3 sildeanimation">
                            <a class="nav-link text-light" href="teacher_dashboard.php">
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
                        <li class="nav-item sildeanimation">
                            <a class="nav-link text-light" href="create_exam.php">
                                Create Exam
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link disabled active text-light mt-1" href="#">
                                <b>Profile Info</b>
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
                  
                </div><br>

                <!-- Banner Name / Image  -->
                <div class="row">
                    <div  class="row custom-row   ">
                                   
                                   <div id="backimagereg" class="col-*-*">
                                      <div class=" h2 text-center text-white mt-2 me-5" style="font-size: x-larger;"><span style="color:white;">Profile</span> &nbsp;<div class="image-container">
                              <div  class="spinner-border text-dark"  role="status"></div>
                              <img src="data:image/jpeg;base64,<?php echo base64_encode($user['image']); ?>" alt="Rounded Image" class="rounded-image">
                          </div> &nbsp;<span  style="color:white;">Info</span></div> 

                          <style>
                            .form-control{
                                border: 3px solid #AA86E7;
                            }
                          </style>
                                     
                                      <form action="teacherupdate_profile.php" method="post" class="text-dark">
                                      
                                      
                                          <div class="row g-2 ">  
                      
                                      
                                              <!-- Student Name -->
                                               
                                              <header><h5 class="mt-2 text-light">Name</h4></header>
                                                  
                                                  <div class="col form-floating">
                                                   <input type="text" class=" form-control form-control-md" id="name" name="name"  value="<?php echo htmlspecialchars($user['name'])?>"    >
                                                   <label  for="name" >First Name</label>
                                               </div> 
                                             
                                               <!-- Student Last Name  -->
                                             
                                               <div class="col form-floating">
                                                   <input type="text" class="form-control form-control-md" id="lname" name="lname" value="<?php echo htmlspecialchars($user['lname'])?>"  >
                                                   <label for="lname">Last Name</label>
                                               </div>
                                          </div>
                      
                      
                                          <!-- Student Age -->
                                          <header><h5 class="mt-2 text-light">Age</h4></header>
                                              <div class="form-floating">
                                                  <input type="tel" class="form-control" id="age"  name="age" value="<?php echo htmlspecialchars($user['age'])?>"  >
                                                  <label for="age" class="form-label">Age</label>
                                              </div>
                      
                      
                                              <!-- Student Phone Number  -->
                      
                                          <header><h5 class="mt-2 text-light">Phone</h4></header>
                                          <div class="form-floating">
                                              <input type="tel" class="form-control form-control-md" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone'])?>"  >
                                              <label for="phone" class="form-label">Enter Mobile / TelePhone</label >
                                          </div>
                      
                      
                                         <!-- Student Department  -->
                      
                                              <header><h5 class="mt-3 text-light">Department</h4></header>
                                                  <div class=form-floating>
                                                  <input type="tel" class="form-control" id="dept"  name="dept" value="<?php echo htmlspecialchars($user['dept'])?>"  >
                                                  <label for="dept" class="form-label">Department Alotted</label>
                                                  </div>     
                      
                                              <!-- Student Address  -->
                      
                                                  <header><h5 class="mt-3 text-light">Address</h4></header>
                                                      <div class="form-floating">
                                                          <input type="text" class="form-control " id="address" name="address" value="<?php echo htmlspecialchars($user['address'])?>"  >
                                                          <label for="address" class="form-label">Address</label> 
                                                         
                                                      </div> 
                      
                      
                                               <div class="row g-2 mb-4">  
                                      
                                                  <!-- Student State -->
                                                  <header><h5 class="mt-3 text-light">State / City</h4></header>
                                                      
                                                      <div class="col mt-1">
                                                      <div class=form-floating>
                                                        <input type="text" class="form-control" id="state"  name="state" value="<?php echo htmlspecialchars($user['state'])?>"  >
                                                        <label for="state" class="form-label">State</label>
                                                      </div>
                                              
                                                      </div> 
                                                 
                                                   <!-- Student City  -->
                                                  
                                                   <div class="col mt-1">
                                                   <div class=form-floating>
                                                        <input type="text" class="form-control" id="city"  name="city" value="<?php echo htmlspecialchars($user['city'])?>"  >
                                                        <label for="city" class="form-label">City</label>
                                                      </div>
                                                  </div>     
                                              </div>
                      
                      
                                              <!-- Student Email -->
                      
                                          <header><h5 class="mt-3 text-light">Email</h4></header>
                                              <div class="form-floating">
                                                  <input type="email" class="form-control form-control-md" id="email" name="email" value="<?php echo htmlspecialchars($user['email'])?>"  >
                                                  <label for="email" class="form-label ">Email Address</label>
                                              </div>
                      
                      
                      
                                              <!-- Student Username -->
                      
                                          <header><h5 class="mt-3 text-light">Username</h4></header>
                                              <div class="form-floating">
                                                  <input type="text" class="form-control form-control-md" id="username" name="username" value="<?php echo htmlspecialchars($user['username'])?>"  >
                                                  <label for="username" class="form-label ">Username</label>
                                              </div>
                      
                                              <!-- Student Password -->
                                              <header><h5 class="mt-3 text-light">Password</h4></header>
                                              <div class="form-floating">
                                                  <input type="password" class="form-control form-control-md" id="pass" name="pass" value="<?php echo htmlspecialchars($user['pass'])?>"  >
                                                  <label for="pass" class="form-label ">Password</label>
                                              </div><br>

                                              <div class="d-flex justify-content-center">  
                                                <button type="submit" name="submit" id="submit" class='btn btn-primary fw-bold text-center mb-2'>Save Changes</button>
                                              </div> 
                                      </form>

                            
                </div>

                
            </main>
           
        </div>
    </div>

    
</body>
</html>
