<?php include("login.php"); ?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	
    <title>Personal Diary</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
	.navbar-brand{
		font-size:1.8em;
	}
	
	body{
		color: #F2D70A;
	}
	#home{
		background-image:url("diary2.jpg");
		height:400px;
		width:100%;
		background-size:cover;
	}
	#toprow{
		margin-top:100px;
		text-align:center;
	}
	#toprow h1{
		font-size:300%;
	}
	.bold{
		font-weight:bold;
	}
	.marginTop{
		margin-top: 40px;
	}
	.center{
		text-align:center;
	}
	.title{
		margin-top:100px;
		font-size:300%;
	}
	#download{
		background-color:#B0D1FB;
		width:100%;
	}
	.marginBottom{
		margin-bottom:20px;
	}
	.appstoreimage{
		width:250px;
	}
	#map{
		height:300px;
		width: 100%;
	}
	
   </style>

  </head>
  <body data-spy="scroll" data-target=".navbar-collapse">

    
    <div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="" class="navbar-brand"> Personal Diary</a>

		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#home">Home</a></li>
				<li><a href="#map">Location</a></li>
			</ul>
			<form class="navbar-form navbar-right" method="post">
				<div class="form-group">
					<input type="email" placeholder="Email" class="form-control" name="loginemail" value="<? echo addslashes($_POST['loginemail']); ?>" />
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control" name="loginpassword" value="<? echo addslashes($_POST['loginpassword']); ?>"/>
				</div>
				<input type="submit" name="submit" class="btn btn-success" value="Log in" />
			</form>
		</div>

	</div>
    </div>

    <div class="container contentcontainer" id="home">
 	
	<div class="row">
		<div class="col-md-6 col-md-offset-3" id="toprow">
			<h1>Personal Diary</h1>

			<p class="bold">Interested? Sign up below..</p>
			
			<?php
			
				if ($error) {
 			 	
 			 		echo '<div class="alert alert-danger">'.addslashes($error).'</div>';
 			 	
 			 	}
				
				if ($message) {
 			 	
 			 		echo '<div class="alert alert-success">'.addslashes($message).'</div>';
 			 	
 			 	}
			
			?>

			<form class=marginTop form-inline method="post">
			
			 	<div class="form-group">
					
				   <!--	<label for="email">Email</label> -->
					<input type="email" name="email" class="form-control" placeholder="Email" value="<? echo addslashes($_POST['email']); ?>" />
					
				</div>
				
				<div class="form-group">
				
					<!-- <label for="password">Password</label> -->
					<input type="password" name="password" class="form-control" placeholder="Password" value="<? echo addslashes($_POST['password']); ?>" />
					
				</div>
				
				<input type="submit" name="submit" value="Sign up" class="btn btn-success btn-lg marginTop" />

			</form>
				
		</div>
	</div>
	

	
    </div>
	
	<div class="container contentcontainer" id="map"></div>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
	
    <script>
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.

      function initMap() {
		var latit;
		var longi;
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 47.3700, lng: 8.5310},
          zoom: 9
        });
        var infoWindow = new google.maps.InfoWindow({map: map});
		
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
		  
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };
			latit = position.coords.latitude;
			longi = position.coords.longitude;
			//alert(latit+", "+longi);
			
			
			<?php
				$query = "UPDATE users SET location =position.coords.latitude WHERE id = '".$_SESSION['id']."'LIMIT 1";

				mysqli_query($link, $query);
			
			?>
            infoWindow.setPosition(pos);
            infoWindow.setContent('Your location');
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
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2SFdAr1mwwIIAAiQ_DbMzKrI4aGKE_i0&callback=initMap">
    </script>

    <script>
	
	$(".contentcontainer").css("min-height", $(window).height());
	
	//$("#location").css("height", $(window).height()-150);

    </script>
	
  </body>
</html>