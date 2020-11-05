<?php
session_start();
include('connection.php');

$id = $_SESSION['id'];
$_SESSION['ival'] = 0;
$_SESSION['index'] = 1;
$sql2 = "SELECT * FROM schedule1 where userId='$id'";
$result2 = $conn->query($sql2);

$_SESSION['ulike'] = "";
$_SESSION['likes'] = array();
$_SESSION['lat'] = array();
$_SESSION['lng'] = array();
?>
<html>
<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<title>Home</title>
<meta charset="UTF-8">
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
			<div class="container-contact3">
				<div class="wrap-contact3 container-fluid d-flex-cotent-center p-2">
		
<?php

echo "<div class=\"card card-primary\">
		<div class=\"card-header\">
			<div class=\"row\">
				<div class=\"col-md-2\"><h4>Date</h4></div>
				<div class=\"col-md-2\"><h4>Start Time</h4></div>
				<div class=\"col-md-2\"><h4>End Time</h4></div>
				<div class=\"col-md-2\"><h4>City</h4></div>
				<div class=\"col-md-2\"><h4>Show</h4></div>
				<div class=\"col-md-2\"><h4>Option</h4></div>
			</div>
		</div>";

if($result2->num_rows > 0){
	while($row = $result2->fetch_assoc()){
		$date1 = $row['date1'];
		$stime = $row['stime'];
		$etime = $row['etime'];
		$dayNo = $row['day'];
		$city = $row['city'];
		$sd = strtotime($date1);
		
		if(strtotime(date('Y-M-D')) > $sd){
			$sql1 = "DELETE FROM schedule1 where userId='$id' AND date1='$date1'";
			if($conn->query($sql1)){
				header('location: home1.php');
			}
		}
		else{
		
			echo "<div class=\"card-body\">
						<div class=\"row\">
							<div class=\"col-md-2\">".$date1."</div>
							<div class=\"col-md-2\">".$stime."</div>
							<div class=\"col-md-2\">".$etime."</div>
							<div class=\"col-md-2\">".$city."</div>
							<div class=\"col-md-2\"><a href=\"show_details.php?date1=".$date1."&dayNo=".$dayNo."&stime=".$stime."&etime=".$etime."\">Click</a></div>
							<div class=\"col-md-2\"><button class=\"btn btn-success\" onclick=\"delete1('$date1','$stime','$etime','$city')\"><font size=1>Erase</font></button></div>
						</div>
					</div>";
		}
	}
}
echo "</div>";
?>
<br/>
<form class="contact3-form validate-form" name="myForm" onsubmit="return validateForm()" class="login100-form validate-form"  method="POST" action="schedule1.html">
	<center><button class="btn btn-danger" type ="submit" name="signin">
		Create New Schedule
	</button></center>
</form>

		</div>
	</div>
</div>

<div id="dropDownSelect1"></div>

<script>
function delete1(date1, stime, etime, city){
	window.location = "delete_schedule.php?date1="+date1+"&stime="+stime+"&etime="+etime+"&city="+city;
}
</script>

	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
	<script src="js/main.js"></script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>
</body>
</html>