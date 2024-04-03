<?php
session_start();
require 'includes/config.inc.php';

// Retrieve values from AJAX request
$cgpa = $_POST['cgpa'];
$yearOfStudy = $_POST['year_of_study'];
$roll = $_SESSION['roll']; // Assuming you have stored the student's roll number in the session

// Update the Student table
$sql = "UPDATE Student SET CGPA = '$cgpa', Year_of_Study = '$yearOfStudy' WHERE Roll_No = '$roll'";
if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
