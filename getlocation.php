<?php
session_start();
include('connection.php');


$city = $_GET['city'];
$date1 = $_GET['date1'];
$query1 = $_GET['query1'];
$dayNo = $_GET['dayNo'];
$stime = $_GET['stime'];
$etime = $_GET['etime'];
?>

<!DOCTYPE html>
<html>
<head>
	
<title>Venues</title>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
			.btn-space{
				margin-bottom: 10px;
				margin-right: 10px;
				padding-;
			}
		  </style>
	<link rel="stylesheet" type="text/css" href="style.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body onload="javascript:get_response(create_obj)">

<!-- Header -->
<header class="header">
        <nav class="navbar navbar-expand fixed-top py-3 navi">
            <div class="container justify-center">
                <a href="#" class="navbar-brand text-uppercase font-weight-bold">Your travel guide</a>
                                
                <div id="navbarSupportedContent" class="collapse navbar-collapse header-right">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="home1.php" class="nav-link text-uppercase font-weight-bold"> Home <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold"> Signup <span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a href="#" class="nav-link text-uppercase font-weight-bold">About</a></li>
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>


<!-- Content -->

	<div class="bg-contact3">
		<div class="container-contact3">
			<div class="wrap-contact3 container-fluid d-flex-content-center p-2"><center>
				<div class="btn-group-verticl" id="venue1">
			<h1 id="ven"></h1>
			<p id="not_found"></p>
<script>
var outp1;
var date1 = "<?php echo $date1; ?>"
var city = "<?php echo $city; ?>";
var	CLIENT_ID = "Q4NKLGQUILM3Z10LF5MDVPYP3YA02VIF4YUW1APUI3LKXN0Z";
var CLIENT_SECRET = "YNOXSSQKQ3FW4SRYQSFA404KLLVNXKCYZOUMHH0ERXMRXZWY";
var QUERY = "<?php echo $query1; ?>";
var dayNo = <?php echo $dayNo; ?>;
var stime = "<?php echo $stime; ?>";
var etime = "<?php echo $etime; ?>";
var YYYYMMDD = 20190327;
var Response;
var i;
var stars = 0;

function get_response(callback){
	const Http = new XMLHttpRequest();
	const url = "https://api.foursquare.com/v2/venues/search?near="+city+"&query="+QUERY+"&client_id="+CLIENT_ID+"&client_secret="+CLIENT_SECRET+"&v="+YYYYMMDD;
		
	Http.open("GET", url);
	Http.send();
	Http.onreadystatechange=(e)=>{
		outp1 = Http.responseText;
		callback();
	}
}
var flag2 = 1;

function create_obj(){
		
		var i;
		document.getElementById("ven").innerHTML = QUERY;
		Response = JSON.parse(outp1);
		console.log(outp1);
		
		if(flag2 == 1){
			
			for (i = 0; i < Response.response.venues.length; i++) {
				var id = Response.response.venues[i].id;
				var name = Response.response.venues[i].name;
				var lat = Response.response.venues[i].location.lat;
				var lng = Response.response.venues[i].location.lng;
	
	
				var outp2 = "";
		
		/*fun(stars);
		
		function stars(){
			console.log("hi1");
			const Http1 = new XMLHttpRequest();
			const url1 = "https://api.foursquare.com/v2/venues/"+id+"&client_id="+CLIENT_ID+"&client_secret="+CLIENT_SECRET+"&v="+YYYYMMDD;
		
			Http1.open("GET", url1);
			Http1.send();
			Http1.onreadystatechange=(e)=>{
				outp2 = Http1.responseText;
				 //return JSON.parse(outp2);
			}
		}
		
		function fun(callback){console.log("hi"); callback();}
		
		
		var Response2 = outp2;
		console.log(Response2);
		var rate = Response2.response.venue.rating;
		*/
				var btn = document.createElement("div");
				btn.innerHTML = name;
		//btn.setAttribute("class","btnsize");
				btn.setAttribute("type","button");
				btn.setAttribute("id","btn"+i);
				btn.setAttribute("class", "btn btn-sm btn-outline-primary btn-space");
				btn.setAttribute("onclick","create_session('"+name+"',"+lat+","+lng+")");
				document.getElementById("venue1").appendChild(btn);
			}
			
			var btn1 = document.createElement("center");
			btn = document.createElement("button");
			btn.innerHTML = "click to skip";
			btn.setAttribute("class", "btn btn-danger");
			btn.setAttribute("style","margin-bottom:16px");
			btn.setAttribute("onclick","del_query()");
			btn1.appendChild(btn);
			document.getElementById("venue1").appendChild(btn1);
			
			flag2 = 0;
		}
}

function create_session(name1, lat1, lng1){
	window.location = "like_session.php?date1="+date1+"&stime="+stime+"&etime="+etime+"&dayNo="+dayNo+"&type="+QUERY+"&name="+name1+"&lat="+lat1+"&lng="+lng1+"&flag=1";
}

function del_query(){
	window.location = "like_session.php?date1="+date1+"&stime="+stime+"&etime="+etime+"&dayNo="+dayNo+"&type="+QUERY+"&flag=0";
}
</script>
</div>
</center>
</div>
</div>
</div>

<div id="dropDownSelect1"></div>
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>

