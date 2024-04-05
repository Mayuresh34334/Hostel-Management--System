<?php
session_start();
require 'includes/config.inc.php'; // Include the database connection file

// Check if form is submitted to grant permission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grantPermission'])) {
    $requestId = $_POST['requestId'];
    
    // Update the status of the request to "Accepted"
    // $stmt = $conn->prepare("UPDATE visitor_request SET Status = 'Accepted' WHERE Request_id = ?");
    // $stmt->bind_param("i", $requestId);
    // $stmt->execute();
    // $stmt->close();

    // Define your SQL query
        $query = "UPDATE visitor_request SET Status = 'Approved' WHERE Request_id = $requestId";

        // Execute the query
        if ($conn->query($query) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
}

// Fetch visitor requests
$query = "SELECT * FROM Visitor_Request";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visitor Requests</title>

<style>
    table {
    width: 100%;
    border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    button {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }
    h2{
        text-align: center;
    }
    .main-container{
        position: relative;
        top: 150px;
    }

</style>

<!-- css files -->
<link rel="stylesheet" href="web_home/css_home/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="web_home/css_home/style.css" type="text/css" media="all" /> <!-- Style-CSS -->
	<link rel="stylesheet" href="web_home/css_home/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
	<!-- //css files -->

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

<div class="main-container" >
    <h2>Visitor Requests</h2>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Student ID</th>
            <th>Visitor Name</th>
            <th>Visitor Contact</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['Request_id']; ?></td>
                <td><?php echo $row['Student_id']; ?></td>
                <td><?php echo $row['Visitor_name']; ?></td>
                <td><?php echo $row['Visitor_contact']; ?></td>
                <td><?php echo $row['Status']; ?></td>
                <td>
                    <?php if ($row['Status'] == 'Pending'): ?>
                        <form method="post">
                            <input type="hidden" name="requestId" value="<?php echo $row['Request_id']; ?>">
                            <button type="submit" name="grantPermission">Grant Permission</button>
                        </form>
                    <?php else: ?>
                        <span>No action required</span>
                    <?php endif; ?>
                </td>
            </tr>
            
        <?php endwhile; ?>
        <?php
            // Check if form is submitted to grant permission
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['grantPermission'])) {
                    $requestId = $_POST['requestId'];
                    
                    $query = "UPDATE visitors SET status = 'Approved'";
    
                    // Execute the query
                    if ($conn->query($query) === TRUE) {
                        echo "Status updated successfully";
                    } else {
                        echo "Error updating status: " . $conn->error;
                    }   
                
                }
                // Fetch visitor requests
                $query = "SELECT * FROM Visitor_Request";
                $result = $conn->query($query);
            ?>
    </table>
</div>



</body>
</html>
