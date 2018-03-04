<!DOCTYPE html>
<html>
<head>
	<title>Disease Map: Home Page</title>
	<link rel="stylesheet" type="text/css" href="HomePageCSS.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
</head>
<body>
	<div class="header">
		<h1> PhoTheHacker </h1>
	</div>
	<div class= "topnav">
		<a href="HomePage.php">Home</a>
		<a href="about.html">About</a>
		<a href="disease.php">Current Disease</a>
	</div>
	<div class="row">
		<div class= "column map" id="map">
			
    		<script>
		      // Note: This example requires that you consent to location sharing when
		      // prompted by your browser. If you see the error "The Geolocation service
		      // failed.", it means you probably did not give permission for the browser to
		      // locate you.
		      var map, infoWindow;
		      function initMap() {
		        map = new google.maps.Map(document.getElementById('map'), {
		          center: {lat: -34.397, lng: 150.644},
		          zoom: 6
		        });
		        infoWindow = new google.maps.InfoWindow;

		        // Try HTML5 geolocation.
		        if (navigator.geolocation) {
		          navigator.geolocation.getCurrentPosition(function(position) {
		            var pos = {
		              lat: position.coords.latitude,
		              lng: position.coords.longitude
		            };
		            document.getElementById('lat').value = position.coords.latitude;
		            document.getElementById('lon').value = position.coords.longitude;


		            infoWindow.setPosition(pos);
		            infoWindow.setContent('Current Location.');
		            infoWindow.open(map);
		            map.setCenter(pos);
		          }, function() {
		            handleLocationError(true, infoWindow, map.getCenter());
		          });
		        } else {
		          // Browser doesn't support Geolocation
		          handleLocationError(false, infoWindow, map.getCenter());
		        }
		      }

		      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
		        infoWindow.setPosition(pos);
		        infoWindow.setContent(browserHasGeolocation ?
		                              'Error: The Geolocation service failed.' :
		                              'Error: Your browser doesn\'t support geolocation.');
		        infoWindow.open(map);
		      }
		    </script>

			 <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAqI1_wpkulkLqJwe-ERnWFhwQENMpcFMs&callback=initMap" type="text/javascript"></script>
			<!--
			To use this code on your website, get a free API key from Google.
			Read more at: https://www.w3schools.com/graphics/google_maps_basic.asp
			-->


		</div>
	<!-- </div> -->
	<div class="column form">
		<h2>Input Form</h2>
	<!-- <h3>Reporter</h3> -->
	<form action="connection.php" method="post">
		Name (optional):<br>
		<input type="text" name="Name"><br>
		
		Email (optional):<br>
		<input type="email" name="Email"><br>
		
		Phone (optional):<br>
		<input type="text" name="Phone"><br>
		<br>
		Are you reporting your sickness?<br>
		<input type="radio" name="whoReport" value=True> Yes    
		<input type="radio" name="whoReport" value=False> No<br>
		
		<select name="FamOrHealth">
			<option value="fam"> Immediate family member/ legal guardian </option>
			<option value="health"> Health professional </option>
		</select><br>
		<h4>Patient information</h4>
		Age:<br>
		<input type="number" min="0" max="150" name="Age" required> year(s) old. <br>
		Gender:<br>
		<input type="radio" name="gender" value="Male"> Male
		<input type="radio" name="gender" value="Female"> Female
		<input type="radio" name="gender" value="Other"> Other<br>
		What is the disease?<br>
		<select name="disease" id="disease" required>
			<option value="">None</option>
			<option value="asthma"> Asthma </option>
			<option value="cancer"> Cancer </option>
			<option value="chickenpox"> Chickenpox </option>
			<option value="ebola"> Ebola </option>
			<option value="hepatitisB"> Hepatitis B </option>
			<option value="hiv"> HIV/AIDS </option>
			<!-- <option></option>
			<option></option>
			<option></option>
			<option></option> -->
		</select><br>
		Start day * <br>
		<input type="date" name="start" required><br>
		End day <br>
		<input type="date" name="end"><br>
		Latitude (replace if different from default current location):<br>
		<input type="number" step="any" name="lat" id="lat" value=""><br>
		Longtitude (replace if different from default current location):<br>
		<input type="number" step="any" name="lon" id="lon" value=""><br>

		Additional information <br>
		<textarea name="addinf" rows="5" cols="17"> </textarea><br>
		<input type="checkbox" name="term" val="True" required> I agree to the term of usage. <br>


		<br>
		<input type="submit" name="submit" value="submit" onclick="alert('Thank you! You have submitted your form')">
	</form>
			
	</div>
	
</body>
</html>