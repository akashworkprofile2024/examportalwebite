
<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "examportal";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user ID, table name, and action
$uid = $_GET['uid'];
$table = $_GET['table'];
$action = $_GET['action'];

if ($table == 'studentdetail' || $table == 'teacherdetail') {
    if ($action == 'approve') {
        // Update user status to approved
        $sql = "UPDATE $table SET status = 'approved' WHERE uid = $uid";
    } elseif ($action == 'discard') {
        // Delete the user record
        $sql = "DELETE FROM $table WHERE uid = $uid";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Action performed successfully on $table.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid table name.";
}

$conn->close();
?>
