<?php
session_start();
require 'includes/config.inc.php'; // Include database configuration file
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Submit Complaint</title>
	<!-- css files -->
	<link rel="stylesheet" href="web_home/css_home/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
	<link rel="stylesheet" href="web_home/css_home/style.css" type="text/css" media="all"/>
	<link rel="stylesheet" href="web_home/css_home/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        /* background-color: #f4f4f4; */
    }
    .main-container {
        max-width: 600px;
        margin: 0 auto 250px auto;
        padding: 20px;
        border-color: black;
        border-radius: 5px;
        box-shadow: -3px 12px 10px rgba(0, 0, 0, 0.1);
        position: relative;
        top:130px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    label {
        font-weight: bold;
    }
    input[type="text"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }
    textarea {
        height: 150px;
    }
    input[type="submit"] {
        background-color: #ff000f;
        color: #fff;
        border: none;
        padding: 10px 20px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }
    input[type="submit"]:hover {
        background-color: black;
    }
</style>
<link href="web_home/css_home/slider.css" type="text/css" rel="stylesheet" media="all">


	<!-- //css files -->
</head>
<body>

<header>
	<div class="container agile-banner_nav">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">

			<h1><a class="navbar-brand" href="home.php">COEP <span class="display"></span></a></h1>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active">
						<a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
					</li>

					<li class="nav-item">
						<a class="nav-link" href="services.php">Blocks</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="payment_form.php">Payment</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="complaint_students.php">Complaints</a>
					</li>
					
						<li class="nav-ite">
							<a class="nav-link" href="services_mess.php">Mess</a>
						</li>

					<li class="dropdown nav-item">
						<a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown"><?php echo $_SESSION['roll']; ?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu agile_short_dropdown">
							<li>
								<a href="profile.php">My Profile</a>
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

<div class="main-container">
    <h2>Submit Complaint</h2>
    <form id="complaintForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="studentId">Student ID:</label>
        <input type="text" id="studentId" name="studentId" required>

        <label for="roomNo">Room No.:</label>
        <input type="text" id="roomNo" name="roomNo" required>

        <label for="hostelBlock">Hostel Block:</label>
        <input type="text" id="hostelBlock" name="hostelBlock" required>

        <label for="complaint">Complaint:</label>
        <textarea id="complaint" name="complaint" required></textarea>

        <input type="submit" value="Submit">
    </form>
    <?php
        // PHP backend processing
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data and sanitize
            $studentId = $_POST["studentId"];
            $roomNo = $_POST["roomNo"];
            $hostelBlock = $_POST["hostelBlock"];
            $complaint = $_POST["complaint"];

            
            // Prepare and execute the SQL statement to insert complaint
            $sql = "INSERT INTO Complaints (Student_id, Room_No, Hostel_id, Message) VALUES ('$studentId', '$roomNo', '$hostelBlock', '$complaint')";
            $result = mysqli_query($conn, $sql);
            
            // Check if the insertion was successful
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Complaint submitted successfully.');</script>";
            } else {
                echo "<script>alert('Error submitting complaint: " . mysqli_error($conn) . "');</script>";
            }
        }
    ?>
</div>







</body>
</html>
