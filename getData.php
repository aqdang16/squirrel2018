<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "patient";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT locationlat, locationlon FROM `epidemic`";
if (mysqli_query($conn, $sql)) {
	$result = mysqli_query($conn, $sql);
	$latlist = array();
	$lonlist = array();
	if (mysqli_num_rows($result) > 0) {
		// $row = mysqli_fetch_assoc($result);
		// echo $row["locationlat"] . "<br>";
		while($row = mysqli_fetch_assoc($result)) {
			array_push($latlist, $row["locationlat"]);
			array_push($lonlist, $row["locationlon"]);

			// echo "lat: " . $row["locationlat"] . " lon: " . $row["locationlon"] ."<br>";
		}
	} else {
		echo "no result";
	}
} else {
	echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
$conn->close();
?>