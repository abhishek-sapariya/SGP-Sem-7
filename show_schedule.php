<?php
session_start();
include('connection.php');

$id = $_SESSION['id'];
$likes = $_SESSION['ulike'];
$city = $_SESSION['ucity'];
$str = "";
$_SESSION['ival'] = 1;
$lat_long="";

for($i = 1; $i < $_SESSION['index']; $i++){
	//$lat_long=$lat_long+$_SESSION['lat'][$_SESSION['ival']]." ".$_SESSION['lng'][$_SESSION['ival']]."<br>";
  if($i==$_SESSION['index']-1)
  {
	 $lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ','.$_SESSION['lng'][$_SESSION['ival']];
	 $_SESSION['mylat'] = $_SESSION['lat'][$_SESSION['ival']];
     $_SESSION['mylng'] = $_SESSION['lng'][$_SESSION['ival']];
  }
  else
  {
    $lat_long .= $_SESSION['lat'][$_SESSION['ival']] . ','.$_SESSION['lng'][$_SESSION['ival']].',';
  }
	$_SESSION['ival'] = $_SESSION['ival'] + 1;
}

$str = "";
$venues = ",";
for($i = 0; $i < strlen($likes) - 1; $i++){
	if($likes[$i] == ","){
		$venues .= $_SESSION[$str].",";
		$str = "";
	}
	else{
		$str .= $likes[$i];
	}
}

$venues .= $_SESSION[$str];
$str = "";

$_SESSION['ival'] = 1;
?>
<?php
//index.php

$subject = 'Travel Guide Suggestions';
$message = '';
$gmap="https://www.google.com/maps/search/?api=1&query=";
$rest=explode(',', $venues);
for($i = 1; $i < $_SESSION['index']; $i++){
  
  $gmap="<tabel border=\"1\"><tr><th>".$rest[$i]."</th><th></th></tr><tr><td></td></tr><tr><td>"."https://www.google.com/maps/search/?api=1&query=".$_SESSION['lat'][$_SESSION['ival']].','.$_SESSION['lng'][$_SESSION['ival']].PHP_EOL.'</tabel>';
	//$gmap="hello";
  $message.=$gmap.' ';
	$_SESSION['ival'] = $_SESSION['ival'] + 1;
}



	
		require 'PHPMailerAutoload.php';
		$mail = new PHPMailer;
		$mail->SMTPDebug = 0;   
		$mail->IsSMTP();								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = '587';								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'travelguide114@gmail.com';					//Sets SMTP username
		$mail->Password = '99111114';					//Sets SMTP password
		$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->From ="travelguide114@gmail.com";					//Sets the From email address for the message
		$mail->FromName ='Abhishek Sapariya';				//Sets the From name of the message
		 $mail->AddAddress($_SESSION['email'],"Customer");		//Adds a "To" address
		//$mail->AddCC($email, $_POST["name"]);	//Adds a "Cc" address
		$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);							//Sets message type to HTML				
		$mail->Subject = $subject;				//Sets the Subject of the message
		$mail->Body = $message;				//An HTML or plain text message body
		$mail->Send();					//Send an Email. Return true on success or false on error
		


?>
<!DOCTYPE html>
        <html lang="en">
        <head>
		  <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <meta http-equiv="X-UA-Compatible" content="ie=edge">
          <title>Travel Guide</title>
          <style>
            #map{
              height:500px;
              width:700px;
            }
          </style>
		  <style>
			.column1 {
				float: left;
				width: 60%;
			}

			.column2 {
				float: right;
				width: 40%;
			}
			.btn-space{
				margin-bottom: 10px;
			}
		  </style>
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        </head>
        <body>
		
		<!-- Header -->
		<header class="header">
        <nav class="navbar navbar-expand fixed-top py-3 navi">
            <div class="container justify-center">
                <a href="#" class="navbar-brand text-uppercase font-weight-bold">Your travel guide</a>
                                
                <div id="navbarSupportedContent" class="collapse navbar-collapse header-right">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="home1.php" class="nav-link text-uppercase font-weight-bold"> Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a href="signout.php" class="nav-link text-uppercase font-weight-bold"> Signout <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a href="aboutus.html" class="nav-link text-uppercase font-weight-bold">About</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>


<!-- Content -->
		
		
		<div class="bg-contact3">

			<div class="container-contact3 container-fluid">
				<div class="row">
					<div class="column1">

						<div class="split left">
								<center><h2><font color="Black">Your Route</font></h2></center>
								<div id="map"></div>
						</div>
					</div>
					<div class="column2">
						<div class="split right">
								<center><h2><font color="Black">Venue List</font></h2></center>
								<div class="wrap-contact3" id="ven"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			function initMap(){
			// Map options
			var options = {
				zoom:12,
				center:{lat:40.355048,lng:-79.835499}
			}
						
			function calcDistance(p1, p2) {
				return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
			}


							// New map
			var map = new google.maps.Map(document.getElementById('map'), options);
			var directionsService = new google.maps.DirectionsService();
			var directionsDisplay = new google.maps.DirectionsRenderer();
              directionsDisplay.setMap(map);
              var request = {   travelMode: google.maps.TravelMode.DRIVING, optimizeWaypoints: true, waypoints: []  };

              // Listen for click on map
              google.maps.event.addListener(map, 'click', function(event){
                // Add marker
                addMarker({coords:event.latLng});
              });

				var noOfMarker = <?php echo $_SESSION['index'] - 1;?>;
              // Array of markers
              var markers=[
			  {
				   coords:{lat:25.4920,lng:81.8639}
           
				  
			  }];
				
				var my_lat = <?php echo $_SESSION['mylat'];?>;
				markers[0].coords.lat = parseFloat(my_lat);
				var my_lng = <?php echo $_SESSION['mylng'];?>;
				markers[0].coords.lng = parseFloat(my_lng);
			  
			var l_name = '<?php echo $venues; ?>';
			var cs = '<?php echo $lat_long?>';
			var ay = cs.split(",");
			var loc_name = l_name.split(",");
		
			var l = ay.length-1;
			var distance=new Array(l+1);
			 for(var i=0; i <ay.length; i=i+2){
				  //coords = new Object();
				 lat = ay[i];
				 lng = ay[i+1];
				  lng=parseFloat(lng);
				  lat=parseFloat(lat);
				  temp={coords:{lat,lng}};
				  markers.push(temp);
			 }
			 
			  
//calculates distance between two points in km's
        var ct=1;
		var mn=2000000;
        for(var j=1;j<markers.length;j++)
        {
			var p1 = new google.maps.LatLng(markers[0].coords.lat,markers[0].coords.lng);
			var p2 = new google.maps.LatLng(markers[j].coords.lat,markers[j].coords.lng);
			distance[ct]=calcDistance(p1, p2);
			if(mn > parseFloat(distance[ct])){
				mn = distance[ct];
			}
			ct++;
        }
        console.log("min distance="+mn);
		
		
		for(var i=1; i < ct; i++){
			var k = parseFloat(distance[i]);
			var lat1 = markers[i].coords.lat;
			var lng1 = markers[i].coords.lng;
			var name_loc = loc_name[i];
			
			var j = i - 1;
			
			while(j >= 1 && parseFloat(distance[j]) > k){
				markers[j+1].coords.lat = markers[j].coords.lat;
				markers[j+1].coords.lng = markers[j].coords.lng;
				distance[j+1] = distance[j];
				loc_name[j+1] = loc_name[j];
				j--;
			}
			
			
			markers[j+1].coords.lat = lat1;
			markers[j+1].coords.lng = lng1;
			distance[j+1] = k;
			loc_name[j+1] = name_loc;
		}
		
		for(i=1; i<markers.length; i++){
			btn = document.createElement("div");
			btn.innerHTML = loc_name[i]+" &nbsp &nbsp &nbsp Distance:"+distance[i];
	//		btn.setAttribute("class","btnsize");
			btn.setAttribute("id","btn"+i);
			btn.setAttribute("class", "class=btn btn-sm btn-outline-primary font-weight-bold btn-space")
			btn.setAttribute("onclick", "#");
			document.getElementById("ven").appendChild(btn);
		}
		
		
			var i;
              // Loop through markers
              for(i = 0;i < markers.length;i++){
                // Add marker
                addMarker(markers[i]);
              }

              // Add Marker Function
              function addMarker(props){
                var marker = new google.maps.Marker({
                  position:props.coords,
                  map:map,
                  icon:props.iconImage
                });

                // Check for customicon
                if(props.iconImage){
                  // Set icon image
                  marker.setIcon(props.iconImage);
                }

                // Check content
                if(props.content){
                  var infoWindow = new google.maps.InfoWindow({
                    content:props.content
                  });

                  marker.addListener('click', function(){
                    infoWindow.open(map, marker);
                  });
                }     
                if (i === 0) { 
                    request.origin = props.coords; 
                }
                else if (i === markers.length - 1) {
                    request.destination = props.coords;
                    }
                    else {
                        if (props.coords) {
                        request.waypoints.push({
                        location: props.coords,
                        stopover: true
                            })
                        }

                    }
                //End of Add Marker Function
                }
            directionsService.route(request,function(response,status){
                if (status == "OK"){
                    directionsDisplay.setDirections(response)
                }
            })
            }
          </script>
          <script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCIZsk8SNPVQMm8Tu4TXieZT0xIqkMSECo&callback=initMap&libraries=geometry">
            </script>

           

        </body>
        </html>