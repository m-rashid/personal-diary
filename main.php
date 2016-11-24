<?
	session_start();
	include("connection.php");
	$query = "SELECT diary FROM users WHERE id='".$_SESSION['id']."' LIMIT 1";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_array($result);
	$diary = $row['diary'];
?>

<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
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
    	#home{
		background-image:url("diary2.jpg");
		height:400px;
		width:100%;
		background-size:cover;
	}
	#about{
		background-image:url("diary2.jpg");
		height:400px;
		width:100%;
		background-size:cover;
	}
	
	#toprow{
		margin-top:70px;
		text-align:center;
	}
	#toprow h1{
		font-size:300%;
	}
	.bold{
		font-weight:bold;
	}
	.marginTop{
		margin-top: 20px;
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
	body{
		color: #F2D70A;
	}
   </style>

  </head>
  <body data-spy="scroll" data-target=".navbar-collapse">

    
    <div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
	
		<div class="pull-right">
			<ul class="nav navbar-nav">
			
				<li><a href="index.php?logout=1">Log out</a></li>
			
			</ul>
			 
		</div>
		<div class="navbar-header">
			<button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="" class="navbar-brand"> Secret Diary</a>

		</div>
		<div class="collapse navbar-collapse pull-left">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#home">Diary</a></li>
				<li><a href="#about">About</a></li>
				<!--<li><a href="#download">Download the App</a></li>-->
			</ul>
		</div>

		

	</div>
    </div>

    <div class="container contentcontainer" id="home">
 	
	<div class="row">
		<div class="col-md-6 col-md-offset-3" id="toprow">
			<h3>What are you thinking?</h3>

			<textarea class = "form-control"><?php echo $diary; ?></textarea>
	
		</div>
	</div>
	
    </div>
	
	<div class="container contentcontainer" id="about">
	
		<div class="col-md-6 col-md-offset-3" id="toprow">
			<h1>Personal Diary</h1>

			 <p class="lead">Your own secret diary wherever you go!</p> 

			<p class="bold">Make use of the text box to type in your thoughts.<br />
			
			The next time you log in, your diary will be in-tact.</p>
		</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script>
 
	$(".contentcontainer").css("min-height", $(window).height());
	
	$("textarea").css("height", $(window).height()-150);
	
	$("textarea").keyup(function() {    //runs when anything entered in text field
		
		//better to use ajax; works when not connected to internet
		$.post("updatediary.php", {diary:$("textarea").val()} ); //post content of text area as diary variable
		
	});
	


    </script>
  </body>
</html>