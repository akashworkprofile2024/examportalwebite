<?php

$con = mysqli_connect("localhost", "root", "", "examportal");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

session_start();


$teacher_id = $_POST['teacher_id'];
$rating = $_POST['rating'];

$student_id=$_SESSION['stuid'];
$student_name=$_SESSION['stuname'];


// Insert the rating into the database
$sql = "INSERT INTO teacher_ratings (teacher_id, student_id, rating) VALUES (?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("iii", $teacher_id, $student_id, $rating);

if ($stmt->execute()) {
  echo"<script>
  window.alert('Submit ratings');
  window.location.href='student_dashboard.php';
</script>";
} else {
    echo "Error: " . $con->error;
}
$stmt->close();

$updatesql = "UPDATE  studentdetail SET rating='given' WHERE name='$student_name'";
if (mysqli_query($con, $updatesql)) {
    // echo "Record updated successfully";
  } else {
    // echo "Error updating record: " . mysqli_error($conn);
  }

$con->close();
?>
