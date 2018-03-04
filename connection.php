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

$name = $_REQUEST['Name'];
$email = $_REQUEST['Email'];
$phone = (int) $_REQUEST['Phone'];
$yourself = $_REQUEST['whoReport'];
$famorhealth = $_REQUEST['FamOrHealth'];
$age = (int) $_REQUEST['Age'];
$gender = $_REQUEST['gender'];
$disease = $_REQUEST['disease'];
$startdate = $_REQUEST['start'];
$enddate = $_REQUEST['end'];
$addition = $_REQUEST['addinf'];
$term = $_REQUEST['term'];
$lat = $_REQUEST['lat'];
$lon = $_REQUEST['lon'];

$sql = "INSERT INTO epidemic (name, email, phone, yourself, famorhealth, age, gender, disease, startdate, enddate, Addition, term, locationlat, locationlon) VALUES ('$name', '$email', '$phone', '$yourself', '$famorhealth', '$age', '$gender', '$disease', '$startdate', '$enddate', '$addition', '$term', '$lat', '$lon')";
if(mysqli_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}		
?>