<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="HomePageCSS.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Disease Map: Current Disease</title>
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
			<script >
			<?php
			// <!-- <script type="php"> -->
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "patient";

				$conn = new mysqli($servername, $username, $password, $dbname);

				if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 

				$sql = "SELECT disease, locationlat, locationlon FROM `epidemic`";
				if (mysqli_query($conn, $sql)) {
					$result = mysqli_query($conn, $sql);
					$latlist = array();
					$lonlist = array();
					$diseases = array();
					if (mysqli_num_rows($result) > 0) {
						
						// $row = mysqli_fetch_assoc($result);
						// echo $row["locationlat"] . "<br>";
						while($row = mysqli_fetch_assoc($result)) {
							array_push($latlist, $row["locationlat"]);
							array_push($lonlist, $row["locationlon"]);
							array_push($diseases, $row["disease"]);
						}
					$latlist_json = json_encode($latlist);
					$lonlist_json = json_encode($lonlist);
					$disease_json = json_encode($diseases);
					} else {
						echo "no result";
					}
				} else {
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}

				$conn->close();
			?>
			</script>
			 <script type="text/javascript">
			 
				var map;
				// // var latlist = ["32.325234","30","-75.21897"]
				// // var lonlist = ["156.903274","0","-120.901724"]
				var latlist = <?=$latlist_json ?>;
				var lonlist = <?=$lonlist_json ?>;
				var dislist = <?=$disease_json ?>;


				function initMap() {
			    	map = new google.maps.Map(document.getElementById('map'), {
			          center: {lat: -34.397, lng: 150.644},
			          zoom: 6
			        });
			        if (navigator.geolocation) {
			          navigator.geolocation.getCurrentPosition(function(position) {
			            var pos = {
			              lat: position.coords.latitude,
			              lng: position.coords.longitude
			            };
			            map.setCenter(pos);
			          }, function() {
			            handleLocationError(true, infoWindow, map.getCenter());
			          });
			        } else {
			          // Browser doesn't support Geolocation
			          handleLocationError(false, infoWindow, map.getCenter());
			        }
			  
			        for (var i = 0; i<latlist.length; i++){
				      	var latLng = new google.maps.LatLng(latlist[i],lonlist[i]);
				      	var marker = new google.maps.Marker({
				      		position: latLng,
				      		map: map,
				      		label: {
				      			text: dislist[i],
				      			color: "black",
				      			fontWeight: "bold"
				      		}
				      	});
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
			</div>
			
	
		<div class="column form">
		<h1>I would like to know more about ... </h1>
		<select name="disease" id="disease" onchange="showDiv(this)">
			<option value="">None</option>
			<option value="asthma"> Asthma </option>
			<option value="cancer"> Cancer </option>
			<option value="chickenpox"> Chickenpox </option>
			<option value="ebola"> Ebola </option>
			<option value="hepatitisB"> Hepatitis B </option>
			<option value="hiv"> HIV/AIDS </option>
		</select>

		<script type="text/javascript">
			function showDiv(elem) {
				var diseaselist = ["asthma","cancer","chickenpox","ebola","hepatitisB","hiv"];
				for (var i = 0; i<diseaselist.length; i++){
					if (elem.value == diseaselist[i]) {
						document.getElementById(diseaselist[i]).style.display = "block";
					} else {
						document.getElementById(diseaselist[i]).style.display = "none";
					}
				}
			}
		</script>
		
		<div id="asthma" style="display: none;">
		<h1>Asthma</h1>
		<h3>Overview</h3>
		<p>A condition in which a person's airways become inflamed, narrow and swell, and produce extra mucus, which makes it difficult to breathe.</p>
		<h3>Symptoms</h3>
		<p>Requires a medical diagnosis<br>Asthma may cause difficulty breathing, chest pain, cough, and wheezing. The symptoms may sometimes flare-up.<br>People may experience:<br>Cough: can occur at night, during exercise, can be chronic, dry, with phlegm, mild, or severe<br>Respiratory: difficulty breathing, wheezing, breathing through the mouth, fast breathing, frequent respiratory infections, rapid breathing, or shortness of breath at night<br>Also common: chest tightness, flare, anxiety, early awakening, fast heart rate, or throat irritation</p>
		<h3>Treatment</h3>
		<p>Treatment consists of self-care and bronchodilators<br>Asthma can usually be managed with rescue inhalers to treat symptoms (albuterol) and controller inhalers that prevent symptoms (steroids). Severe cases may require longer-acting inhalers that keep the airways open (formoterol, salmeterol, tiotropium), as well as oral steroids.</p>
		<h5>References</h5>
		<a href="https://www.webmd.com/asthma/default.htm"> WebMD Asthma  </a>
		</div>

		<div id="cancer" style="display: none;">
		<h1>Cancer</h1>
		<h3>Overview</h3>
		<p>Cancer, also called malignancy, is an abnormal growth of cells. There are more than 100 types of cancer, including breast cancer, skin cancer, lung cancer, colon cancer, prostate cancer, and lymphoma. Symptoms vary depending on the type. Cancer treatment may include chemotherapy, radiation, and/or surgery. </p>
		<h3>Symptoms</h3>
		<p>When cancer begins, it produces no symptoms. Signs and symptoms appear as the mass grows or ulcerates. The findings that result depend on the cancer's type and location. Few symptoms are specific. Many frequently occur in individuals who have other conditions. Cancer is a "great imitator". Thus, it is common for people diagnosed with cancer to have been treated for other diseases, which were hypothesized to be causing their symptoms.<br>People may become anxious or depressed post-diagnosis. The risk of suicide in people with cancer is approximately double.</p>
		<h3>Treatment</h3>
		<p>Many treatment options for cancer exist. The primary ones include surgery, chemotherapy, radiation therapy, hormonal therapy, targeted therapy and palliative care. Which treatments are used depends on the type, location and grade of the cancer as well as the patient's health and preferences. The treatment intent may or may not be curative.</p>
		<h3>Cause</h3>
		<p>The majority of cancers, some 90 to 95% of cases, are due to genetic mutations from environmental factors. The remaining 5 to 10% are due to inherited genetics. Environmental, as used by cancer researchers, means any cause that is not inherited genetically, such as lifestyle, economic and behavioral factors and not merely pollution. Common environmental factors that contribute to cancer death include tobacco (25 to 30%), diet and obesity (30 to 35%), infections (15 to 20%), radiation (both ionizing and non-ionizing, up to 10%), stress, lack of physical activity and pollution.</p>
		<h3>Prevention</h3>
		<p>Cancer prevention is defined as active measures to decrease cancer risk. The vast majority of cancer cases are due to environmental risk factors. Many of these environmental factors are controllable lifestyle choices. Thus, cancer is generally preventable. Between 70% and 90% of common cancers are due to environmental factors and therefore potentially preventable.<br>Greater than 30% of cancer deaths could be prevented by avoiding risk factors including: tobacco, excess weight/obesity, poor diet, physical inactivity, alcohol, sexually transmitted infections and air pollution. Not all environmental causes are controllable, such as naturally occurring background radiation and cancers caused through hereditary genetic disorders and thus are not preventable via personal behavior.</p>
		<h5>References</h5>
		<a href="https://en.wikipedia.org/wiki/Cancer"> Wikipedia Cancer</a>
		</div>

		<div id="chickenpox" style="display: none;">
		<h1>Chickenpox</h1>
		<h3>Overview</h3>
		<p>Chickenpox, also known as varicella, is a highly contagious disease caused by the initial infection with varicella zoster virus (VZV). The disease results in a characteristic skin rash that forms small, itchy blisters, which eventually scab over.</p>
		<h3>Symptoms</h3>
		<p>Usually self-diagnosable<br>The most characteristic symptom is an itchy, blister-like rash on the skin.<br>People may experience:<br>Skin: blister, scab, ulcers, or red spots<br>Whole body: fatigue, fever, or loss of appetite<br>Also common: headache, itching, sore throat, or swollen lymph nodes</p>
		<h3>Treatment</h3>
		<p>Treatment mainly consists of easing the symptoms. As a protective measure, people are usually required to stay at home while they are infectious to avoid spreading the disease to others. Cutting the nails short or wearing gloves may prevent scratching and minimize the risk of secondary infections.<br>Although there have been no formal clinical studies evaluating the effectiveness of topical application of calamine lotion (a topical barrier preparation containing zinc oxide, and one of the most commonly used interventions), it has an excellent safety profile. It is important to maintain good hygiene and daily cleaning of skin with warm water to avoid secondary bacterial infection. Scratching may also increase the risk of secondary infection.<br>Paracetamol (acetaminophen) but not aspirin may be used to reduce fever. Aspirin use by someone with chickenpox may cause the serious, sometimes fatal disease of the liver and brain, Reye syndrome. People at risk of developing severe complications who have had significant exposure to the virus may be given intra-muscular varicella zoster immune globulin (VZIG), a preparation containing high titres of antibodies to varicella zoster virus, to ward off the disease.<br>Antivirals are sometimes used.</p>
		<h3>Prevention</h3>
		<p>The chickenpox (varicella) vaccine is the best way to prevent chickenpox. Experts from the Centers for Disease Control and Prevention (CDC) estimate that the vaccine provides complete protection from the virus for nearly 98 percent of people who receive both of the recommended doses. When the vaccine doesn't provide complete protection, it significantly lessens the severity of the disease.<br>The spread of chickenpox can be prevented by isolating affected individuals. Contagion is by exposure to respiratory droplets, or direct contact with lesions, within a period lasting from three days before the onset of the rash, to four days after the onset of the rash. The chickenpox virus is susceptible to disinfectants, notably chlorine bleach (i.e., sodium hypochlorite). Like all enveloped viruses, it is sensitive to desiccation, heat and detergents.</p>
		<h5>References</h5>
		<a href="ttps://www.mayoclinic.org/diseases-conditions/chickenpox/symptoms-causes/syc-20351282?utm_source=Google&utm_medium=abstract&utm_content=Chickenpox&utm_campaign=Knowledge-panel"> Mayo Clinic Chickenpox</a>
		</div>

		<div id="ebola" style="display: none;">
		<h1>Ebola</h1>
		<h3>Overview</h3>
		<p>Ebola virus disease (EVD), also known as Ebola hemorrhagic fever (EHF) or simply Ebola, is a viral hemorrhagic fever of humans and other primates caused by ebolaviruses.The disease has a high risk of death, killing between 25 and 90 percent of those infected, with an average of about 50 percent. This is often due to low blood pressure from fluid loss, and typically follows six to sixteen days after symptoms appear.</p>
		<h3>Symptoms</h3>
		<p>Signs and symptoms typically start between two days and three weeks after contracting the virus with a fever, sore throat, muscular pain, and headaches. Then, vomiting, diarrhea and rash usually follow, along with decreased function of the liver and kidneys. At this time, some people begin to bleed both internally and externally.</p>
		<h3>Treatmemt</h3>
		<p>Standard support:<br>Treatment is primarily supportive in nature. Early supportive care with rehydration and symptomatic treatment improves survival. Rehydration may be via the oral or by intravenous route. These measures may include management of pain, nausea, fever and anxiety. The World Health Organization recommends avoiding the use of aspirin or ibuprofen for pain due to the bleeding risk associated with use of these medications.<br>Blood products such as packed red blood cells, platelets or fresh frozen plasma may also be used. Other regulators of coagulation have also been tried including heparin in an effort to prevent disseminated intravascular coagulation and clotting factors to decrease bleeding. Antimalarial medications and antibiotics are often used before the diagnosis is confirmed,[118] though there is no evidence to suggest such treatment helps. A number of experimental treatments are being studied.<br>If hospital care is not possible, the World Health Organization has guidelines for care at home that have been relatively successful. In such situations, recommendations include using towels soaked in bleach solutions when moving infected people or bodies and applying bleach on stains. It is also recommended that the caregivers wash hands with bleach solutions and cover their mouth and nose with a cloth<br>Intensive care:<br>Intensive care is often used in the developed world. This may include maintaining blood volume and electrolytes (salts) balance as well as treating any bacterial infections that may develop. Dialysis may be needed for kidney failure, and extracorporeal membrane oxygenation may be used for lung dysfunction</p>
		<h3>Cause</h3>
		<p>EVD in humans is caused by four of five viruses of the genus Ebolavirus. The four are Bundibugyo virus (BDBV), Sudan virus (SUDV), Taï Forest virus (TAFV) and one simply called Ebola virus (EBOV, formerly Zaire Ebola virus). EBOV, species Zaire ebolavirus, is the most dangerous of the known EVD-causing viruses, and is responsible for the largest number of outbreaks. The fifth virus, Reston virus (RESTV), is not thought to cause disease in humans, but has caused disease in other primates. All five viruses are closely related to marburgviruses and able to spread by direct contact with body fluids of an infected human or other animals</p>
		<h3>Prevention</h3>
		<p>Prevention for Ebola virus disease includes infection control, isolation, and contact tracing.</p>
		<h5>References</h5>
		<a href="https://en.wikipedia.org/wiki/Ebola_virus_disease"> Wikipedia Ebola virus disease</a>
		</div>

		<div id="hepatitisB" style="display: none;">
		<h1>Hepatitis B</h1>
		<h3>Overview</h3>
		<p>Hepatitis B is an infectious disease caused by the hepatitis B virus (HBV) that affects the liver. It can cause both acute and chronic infections</p>
		<h3>Symptoms</h3>
		<p>Acute infection with hepatitis B virus is associated with acute viral hepatitis, an illness that begins with general ill-health, loss of appetite, nausea, vomiting, body aches, mild fever, and dark urine, and then progresses to development of jaundice. It has been noted that itchy skin has been an indication as a possible symptom of all hepatitis virus types. The illness lasts for a few weeks and then gradually improves in most affected people. A few people may have a more severe form of liver disease known as (fulminant hepatic failure) and may die as a result. The infection may be entirely asymptomatic and may go unrecognized.</p>
		<h3>Treatment</h3>
		<p>Acute hepatitis B infection does not usually require treatment and most adults clear the infection spontaneously. Early antiviral treatment may be required in fewer than 1% of people, whose infection takes a very aggressive course (fulminant hepatitis) or who are immunocompromised. On the other hand, treatment of chronic infection may be necessary to reduce the risk of cirrhosis and liver cancer. Chronically infected individuals with persistently elevated serum alanine aminotransferase, a marker of liver damage, and HBV DNA levels are candidates for therapy. Treatment lasts from six months to a year, depending on medication and genotype. Treatment duration when medication is taken by mouth, however, is more variable and usually longer than one year</p>
		<h3>Cause</h3>
		<p>Transmission of hepatitis B virus results from exposure to infectious blood or body fluids containing blood. It is 50 to 100 times more infectious than human immunodeficiency virus (HIV). Possible forms of transmission include sexual contact, blood transfusions and transfusion with other human blood products, re-use of contaminated needles and syringes, and vertical transmission from mother to child (MTCT) during childbirth. Without intervention, a mother who is positive for HBsAg has a 20% risk of passing the infection to her offspring at the time of birth. This risk is as high as 90% if the mother is also positive for HBeAg. HBV can be transmitted between family members within households, possibly by contact of nonintact skin or mucous membrane with secretions or saliva containing HBV. However, at least 30% of reported hepatitis B among adults cannot be associated with an identifiable risk factor. Breastfeeding after proper immunoprophylaxis does not appear to contribute to mother-to-child-transmission (MTCT) of HBV. The virus may be detected within 30 to 60 days after infection and can persist and develop into chronic hepatitis B. The incubation period of the hepatitis B virus is 75 days on average but can vary from 30 to 180 days.</p>
		<h3>Prevention</h3>
		<p>This disease is easily preventable by a vaccine.</p>
		<h5>References</h5>
		<a href="https://en.wikipedia.org/wiki/Hepatitis_B">Wikipedia Hepatitis B </a>
		</div>

		<div id="hiv" style="display: none;">
		<h1>HIV/AIDS</h1>
		<h3>Overview</h3>
		<p>Human immunodeficiency virus infection and acquired immune deficiency syndrome (HIV/AIDS) is a spectrum of conditions caused by infection with the human immunodeficiency virus (HIV)</p>
		<h3>Symptoms</h3>
		<p>Following initial infection, a person may not notice any symptoms or may experience a brief period of influenza-like illness. Typically, this is followed by a prolonged period with no symptoms. As the infection progresses, it interferes more with the immune system, increasing the risk of common infections like tuberculosis, as well as other opportunistic infections, and tumors that rarely affect people who have working immune systems. These late symptoms of infection are referred to as acquired immunodeficiency syndrome (AIDS). This stage is often also associated with weight loss</p>	
		<h3>Treatment</h3>
		<p>There is currently no cure or effective HIV vaccine. Treatment consists of highly active antiretroviral therapy (HAART) which slows progression of the disease. As of 2010 more than 6.6 million people were taking them in low and middle income countries. Treatment also includes preventive and active treatment of opportunistic infections.</p>
		<h3>Cause</h3>
		<p>HIV is transmitted by three main routes: sexual contact, significant exposure to infected body fluids or tissues, and from mother to child during pregnancy, delivery, or breastfeeding (known as vertical transmission).There is no risk of acquiring HIV if exposed to feces, nasal secretions, saliva, sputum, sweat, tears, urine, or vomit unless these are contaminated with blood. It is possible to be co-infected by more than one strain of HIV—a condition known as HIV superinfection</p>
		<h3>Prevention</h3>
		<p>Sexual contact: Consistent condom use reduces the risk of HIV transmission by approximately 80% over the long term.[110] When condoms are used consistently by a couple in which one person is infected, the rate of HIV infection is less than 1% per year.<br>Pre-exposure:Antiretroviral treatment among people with HIV whose CD4 count ≤ 550 cells/µL is a very effective way to prevent HIV infection of their partner (a strategy known as treatment as prevention, or TASP).[130] TASP is associated with a 10 to 20 fold reduction in transmission risk.<br>Post-exposure:A course of antiretrovirals administered within 48 to 72 hours after exposure to HIV-positive blood or genital secretions is referred to as post-exposure prophylaxis (PEP). The use of the single agent zidovudine reduces the risk of a HIV infection five-fold following a needle-stick injury. As of 2013, the prevention regimen recommended in the United States consists of three medications—tenofovir, emtricitabine and raltegravir—as this may reduce the risk further.<br>Mother-to-child:Programs to prevent the vertical transmission of HIV (from mothers to children) can reduce rates of transmission by 92–99%. This primarily involves the use of a combination of antiviral medications during pregnancy and after birth in the infant and potentially includes bottle feeding rather than breastfeeding.</p>
		<h5>References</h5>
		<a href="https://en.wikipedia.org/wiki/HIV/AIDS">Wikipedia HIV/AIDS </a>
		</div>

		<h3>Historical statistics on our website</h3>
		<p>Graph: Number of reports by year</p>
		<p>Graph: Age distribution
		<p>Graph: Gender distribution
	</div>
</body>
</html>