<?php
  // Include database connection
   session_start();
    require 'includes/config.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Room Rate</title>

<!-- css files -->
<link rel="stylesheet" href="web_home/css_home/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="web_home/css_home/style.css" type="text/css" media="all" /> <!-- Style-CSS -->
<link rel="stylesheet" href="web_home/css_home/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- //css files -->


<style>
    .main-container {
        width: 20%;
        text-align: center;
        margin: 50px auto; /* Center the container */
        background-color: #f2f2f2;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow for depth */
        position: relative;
        top: 120px:
    }

    .room-rating {
        margin-bottom: 20px;
    }

    .average-ratings {
        border-top: 1px solid #ccc;
        padding-top: 20px;
        position: relative;
        top: 100px;
    }

    input[type="submit"] {
        background-color: #4CAF50; /* Green */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    input[type="submit"]:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    /* Style for text inputs */
    input[type="text"],
    input[type="number"] {
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box; /* Ensure correct box sizing */
        width: 100%;
    }
    .rate{
        color: red;
        position: relative;
        bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    table th {
        background-color: #f2f2f2;
    }

    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    table tr:hover {
        background-color: #ddd;
    }

   


</style>



</head>
<body>

<!--Header-->
<header>
	<div class="container agile-banner_nav">
		<nav class="navbar navbar-expand-lg navbar-light bg-light" style="width:105%;">

			<h1><a class="navbar-brand" href="home_manager.php">COEP <span class="display"></span></a></h1>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="home_manager.php">Home <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="allocate_room.php">Allocate Rooms</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="allocate_mess_card.php">Allocate Mess</a>
					</li>
					<li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Rooms
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="allocated_rooms.php">Allocated Rooms</a>
							</li>
							<li>
								<a href="empty_rooms.php">Empty Rooms</a>
							</li>
							<li>
								<a href="vacate_rooms.php">Vacate Rooms</a>
							</li>
						</ul>
					</li>
					
					<li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Mess
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="allocated_mess_card.php">Allocated Mess</a>
							</li>
							<li>
								<a href="vacate_mess.php">Vacate Mess</a>
							</li>
						</ul>
					</li>
					<!-- <li class="nav-item">
						<a class="nav-link" href="complaints_manager.php">Complaints</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="visitors_manager.php">Visitors</a>
					</li> -->
                    <li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">Work
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="complaints_manager.php">Complaints</a>
							</li>
							<li>
								<a href="visitors_manager.php">Visitors</a>
							</li>
							<li>
								<a href="manager_room_rating.php">Give Rating</a>
							</li>
						</ul>
					</li>
					<li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><?php echo $_SESSION['username']; ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="admin/manager_profile.php">My Profile</a>
							</li>
							<li>
								<a href="includes/logout.inc.php">Logout</a>
							</li>
						</ul>
					</li>
				</ul>
			</div>

		</nav>
	</div>
</header>
<!--Header-->

<div class="main-container" style="top: 120px;">
    <div class="room-rating">
        <h1 class="rate">Rate Room</h1>
        <form  method="post">
            <label for="hostel-block">Hostel Block:</label>
            <input type="text" id="hostel-block" name="hostel_block" required><br><br>
            <label for="room-number">Room Number:</label>
            <input type="text" id="room-number" name="room_number" required><br><br>
            <label for="cleanliness-score">Cleanliness Score:</label>
            <input type="number" id="cleanliness-score" name="cleanliness_score" min="1" max="10" required><br><br>
            <label for="neatness-score">Neatness Score:</label>
            <input type="number" id="neatness-score" name="neatness_score" min="1" max="10" required><br><br>
            <label for="maintenance-score">Maintenance Score:</label>
            <input type="number" id="maintenance-score" name="maintenance_score" min="1" max="10" required><br><br>
            <input type="submit" value="Submit Rating">
        </form>
    </div>
    
</div>

    <?php
        // Get form data
        $hostel_block = $_POST['hostel_block'];
        $room_number = $_POST['room_number'];
        $cleanliness_score = $_POST['cleanliness_score'];
        $neatness_score = $_POST['neatness_score'];
        $maintenance_score = $_POST['maintenance_score'];



        // Insert rating into database
        $sql = "INSERT INTO RoomRatings (RoomID, NeatnessRating, CleanlinessRating, MaintenanceRating, Hostel_block) VALUES ('$room_number', '$neatness_score', '$cleanliness_score', '$maintenance_score','$hostel_block')";

        if (mysqli_query($conn, $sql)) {
            echo '<script>alert("Rating submitted successfully");</script>';
        } else {
            echo '<script>alert("Error: ' . $sql . '\n' . mysqli_error($conn) . '");</script>';
        }

        
    ?>
    <div class="average-ratings">
        <h2>Average Ratings</h2>
        <?php 
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
    </div>

        

</body>
</html>
