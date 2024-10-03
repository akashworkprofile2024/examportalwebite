<?php
// Database connection settings
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "examportal";

// Create a connection to the database
$conn =  mysqli_connect($servername, $username, $password, $dbname);




// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Get POST data
$loginAs = $_POST['loginas'] ?? '';
$username = $_POST['username'] ?? '';
$password = $_POST['pass'] ?? '';

// Validate inputs
if (empty($loginAs) || empty($username) || empty($password)) {
    echo "Missing required fields.";
    exit;
}
                            
// Determine the table to query based on the login role
switch ($loginAs) {
    case 'admin':
        $table = 'admindetail';
        $dashboard = 'admin_dashboard.php';
        break;
    case 'teacher':
        $table = 'teacherdetail';
        $dashboard = 'teacher_dashboard.php';
        break;
    case 'student':
        $table = 'studentdetail';
        $dashboard = 'student_dashboard.php';   
        break;
    default:
        echo "Invalid role selected.";
        exit;
}

// Prepare and execute the SQL query
$stmt = $conn->prepare("SELECT * FROM $table WHERE username = ? AND pass = ?");
$stmt->bind_param('ss', $username, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if any row matches the credentials
if ($result->num_rows > 0) {
    // Fetch user details
    $userDetails = $result->fetch_assoc();
    
    // Check if the user is approved
    if ($userDetails['status'] === 'approved') {
        // Start session and store user details
        session_start();
        $_SESSION['user'] = $userDetails;
        
        // Redirect to the appropriate dashboard
        header("Location: $dashboard");
    } else {
        // Output the message in a div with an ID
        
        echo '<div id="approval-message" style="display: none;">Your account is not yet approved by the admin</div>';
        echo '<script>
                document.getElementById("approval-message").style.display = "block";
                document.getElementById("approval-message").classList.add("slide-down");
              </script>';  
    }
  } else {
       echo "<script>";
       echo "window.alert('Invalid Username or Password')";
       echo "</script>";
   
       echo "<script>";
       echo "window.location.href='index.html'"; 
       echo"</script>";
    }

// Close the statement and connection
$stmt->close();
$conn->close();
?>

<style>
#approval-message {
    width: 100%;
    margin: 20px 0;
    padding: 10px;
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    border-radius: 5px;
    text-align: center;
    opacity: 0;
    transform: translateY(-20px);
    transition: all 0.5s ease-in-out;
}

#approval-message.slide-down {
    opacity: 1;
    transform: translateY(0);
}
</style>
