<?php
session_start();
    require 'includes/config.inc.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visitor Page</title>

<!-- css files -->
<link rel="stylesheet" href="web_home/css_home/bootstrap.css"> <!-- Bootstrap-Core-CSS -->
<link rel="stylesheet" href="web_home/css_home/style.css" type="text/css" media="all"/>
<link rel="stylesheet" href="web_home/css_home/fontawesome-all.css"> <!-- Font-Awesome-Icons-CSS -->
<!-- css files -->



<!-- testimonials css -->
<link rel="stylesheet" href="./web_home/css_home/flexslider.css" type="text/css" media="screen" property="" /><!-- flexslider css -->
<!-- //testimonials css -->

<!-- web-fonts -->
<link href="//fonts.googleapis.com/css?family=Poiret+One&amp;subset=cyrillic,latin-ext" rel="stylesheet">
<!-- //web-fonts -->


<style>
    /* CSS styles */
    body {
        font-family: Arial, sans-serif;
    }
    .main-container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        position: relative;
        top: 150px;
    }
    label {
        font-weight: bold;
    }
    input[type="text"],
    input[type="number"],
    select {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        padding: 10px;
        background-color: #ff000f;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        position: relative;
        top: 10px;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
    .error {
        color: red;
    }
    h2{
        text-align: center;
    }
</style>

<style>
    .status-table {
        width: 100%;
        border-collapse: collapse;
    }

    .status-table th,
    .status-table td {
        border: 1px solid #dddddd;
        padding: 8px;
        text-align: left;
    }

    .status-table th {
        background-color: #f2f2f2;
    }

    .status-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>



<script type="text/javascript" src="./web_home/js/jquery-2.2.3.min.js"></script>
<script src="./web_profile/js/jquery-2.1.3.min.js" type="text/javascript"></script>
<script type="text/javascript" src="./web_home/js/bootstrap.js"></script> 


<script src="./web_home/js/visitorsNavbar.js"></script>




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

<div id="navigation"  style="position:absolute; top:100px; left:50%;" class="w3_agile">
    <ul style="display:flex; list-style:none;">
			<li class="selected" style="margin:0px 10px 0px 10px ">
				<a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Info</span></a>
			</li>
			<li  style="margin:0px 10px 0px 10px ">
				<a href="#"><i class="fa fa-folder" aria-hidden="true"></i><span>Status</span></a>
			</li>
	</ul>
</div>


<div id="main-box" class="main-container">


    <form id="visitorForm"  style="display:flex;" method="POST">



    
        <fieldset> 
            
            <h2>Visitor Information</h2>
            <input type="hidden" name="student_id" value="<?php echo $_SESSION['roll']; ?>">
            <label for="numVisitors">Number of Visitors:</label>
            <input type="number" id="numVisitors" name="numVisitors" min="1" required>
            <div id="visitorDetails">
                <label for="visitorName">Visitor Name:</label>
                <input type="text" name="visitorName[]" required>

                <label for="contact">Contact No.:</label>
                <input type="text" name="contact[]" required>
                
                <label for="relation">Relation:</label>
                <input type="text" name="relation[]" required>
                
                <label for="arrivalTime">Time of Arrival (8:00 AM to 8:00 PM):</label>
                <input type="time" name="arrivalTime[]" min="08:00" max="20:00" required>
            </div>
            <input type="submit" value="Submit">



        </fieldset>





        <fieldset style="display:none">

        <h2 style="text-align:center;">Status of Request</h2>
        <table class="status-table"  >
            <tr>
                <th>Visitor Name</th>
                <th>Status</th>
            </tr>
            <?php
            // Query to fetch status of requests made by the current student
            $query = "SELECT Visitor_name, Status FROM Visitor_Request WHERE Student_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $_SESSION['roll']);
            $stmt->execute();
            $result = $stmt->get_result();

            // Display the status of each request
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['Visitor_name'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "</tr>";
            }
            $stmt->close();
            ?>
        </table>


        </fieldset>
    </form>

</div>





<script>
    // JavaScript for adding additional visitor details fields
    document.getElementById('numVisitors').addEventListener('input', function() {
        var numVisitors = parseInt(this.value);
        var visitorDetails = document.getElementById('visitorDetails');
        visitorDetails.innerHTML = ''; // Clear previous fields
        
        for (var i = 0; i < numVisitors; i++) {
            var visitorDiv = document.createElement('div');
            visitorDiv.innerHTML = `
                <label for="visitorName">Visitor Name:</label>
                <input type="text" name="visitorName[]" required>
                
                <label for="relation">Relation:</label>
                <input type="text" name="relation[]" required>

                <label for="relation">Contact No.:</label>
                <input type="text" name="contact[]" required>
                
                <label for="arrivalTime">Time of Arrival (8:00 AM to 8:00 PM):</label>
                <input type="time" name="arrivalTime[]" min="08:00" max="20:00" required>
            `;
            visitorDetails.appendChild(visitorDiv);
        }
    });
</script>

<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numVisitors = $_POST['numVisitors'];
    $student_id = $_SESSION['roll']; // Retrieve student ID from session variable
    
    
    // Prepare and execute SQL statement to insert visitor details into the database
    $stmt = $conn->prepare("INSERT INTO Visitor_Request (Student_id, Visitor_name, Visitor_contact, Purpose, Status) VALUES (?, ?, ?, ?, ?)");
    
    for ($i = 0; $i < $numVisitors; $i++) {
        $visitorName = $_POST['visitorName'][$i];
        $visitorContact = $_POST['contact'][$i]; // Corrected to retrieve contact
        $relation = $_POST['relation'][$i];
        $arrivalTime = $_POST['arrivalTime'][$i];
        
        // Set other values
        $purpose = "Visit";
        $status = "Pending";
        
        // Bind parameters
        $stmt->bind_param("sssss", $student_id, $visitorName, $visitorContact, $purpose, $status);
        
        // Execute the statement
        $stmt->execute();
    }
    
    // Close statement and connection
    $stmt->close();
    
    
    // Redirect to a success page or do other actions
    //header("Location: success.php");
    //exit();
    echo "<script>alert('Request sent');</script>";
}
?>




</body>
</html>

