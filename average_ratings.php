<?php
// Include database connection
session_start();
require 'includes/config.inc.php';

// Query to get average ratings for all rooms including the hostel block
$sql = "SELECT RoomID, Hostel_block, AVG(NeatnessRating) AS AverageNeatnessRating, AVG(CleanlinessRating) AS AverageCleanlinessRating, AVG(MaintenanceRating) AS AverageMaintenanceRating FROM RoomRatings GROUP BY RoomID, Hostel_block";
$result = mysqli_query($conn, $sql);

// Check for errors in query execution
if (!$result) {
    die('Error: ' . mysqli_error($conn));
}

// Display average ratings with hostel block
if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr><th>Hostel Block</th><th>Room</th><th>Average Neatness</th><th>Average Cleanliness</th><th>Average Maintenance</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>" . $row['Hostel_block'] . "</td><td>" . $row['RoomID'] . "</td><td>" . $row['AverageNeatnessRating'] . "</td><td>" . $row['AverageCleanlinessRating'] . "</td><td>" . $row['AverageMaintenanceRating'] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No ratings available";
}

mysqli_close($conn);
?>
