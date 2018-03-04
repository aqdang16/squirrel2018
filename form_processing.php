<?php  
$link = mysql_connect("localhost", "root", "123456", "patience");

if ($link === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}

$name = $_REQUEST['Name'];
$email = $_REQUEST['Email'];
$phone = (int) $_REQUEST['Phone'];
$yourself = $_REQUEST['whoReport'];
$famorhealth = $_REQUEST['FamOrHealth'];
$age = (int) $_REQUEST['Age'];
$gender = $_REQUEST['gender'];
$disease = $_REQUEST['disease'];
$startdate = (date) $_REQUEST['start'];
$enddate = (date) $_REQUEST['end'];
$addition = $_REQUEST['addinf'];
$term = $_REQUEST['term');
$lat = 0;
$lon = 0;

$sql = "INSERT INTO epidemic (name, email, phone, yourself, famorhealth, age, gender, disease, startdate, enddate, Addition, locationlat, locaionlon) VALUES ('$name', '$email', '$phone', '$yourself', '$famorhealth', '$age', '$gender', '$disease', '$startdate', '$enddate', '$addition', '$term', '$lat', '$lon')";
if(mysqli_query($link, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// close connection
mysqli_close($link);

?>