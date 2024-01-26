<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Monthly Fee Details</title>
	<link rel="stylesheet" href="css/style.css">

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		th {
			background-color: #4CAF50;
			color: white;
		}
	</style>
</head>
<body>
	<h2>Monthly Fee Details</h2>
	<table>
		<thead>
			<tr>
				<th>Student ID</th>
				<th>Student Name</th>
				<th>Status</th>
				<th>Month</th>
				<th>Amount Paid</th>
			</tr>
		</thead>
		<tbody>
			<?php
			//Connect to the database
			

			$conn = mysqli_connect('localhost','root','','monthly_fees_db');

			//Check the connection
			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			}
           
			//Query the database to get the monthly bills
			$sql = "SELECT * FROM monthly_fees where student_id='$user_id'";
			$result = mysqli_query($conn, $sql);

			//Display the bills in an HTML table
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "<tr><td>" . $row["student_id"]. "</td><td>" . $row["student_name"]. "</td><td>" . $row["status"]. "</td><td>" . $row["month"]. "</td><td>" . $row["amount"]. "</td></tr>";
			    }
			} else {
			    echo "0 results";
			}

			mysqli_close($conn);
			?>
		</tbody>
	</table>

	<a href="home.php"><button class="delete-btn">Go Back</button></a>
</body>
</html>
