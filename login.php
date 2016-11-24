<?php
	session_start();

	if($_GET['logout']==1 AND $_SESSION['id']){session_destroy();
		$message="You have been logged out!";
	}
	
	include("connection.php");

	if($_POST['submit']=='Sign up'){
		$message="";
		if(!$_POST['email']) $error .= "<br />Please enter your email";
			else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $error.="<br />Please enter a valid email";
		
		if(!$_POST['password']) $error .= "<br />Please enter password";
			else{
				if(strlen($_POST['password'])<8) $error .= "<br />Please enter password with at least 8 characters";
				if(!preg_match('/[A-Z]/', $_POST['password'])) $error .= "<br />Please include min 1 capital letter";
			}
		if($error) $error = "There were error(s)in your sign up details".$error;
		
		else{
			
			if(mysqli_connect_error()){
				echo "Could not connect to database";
			}
			$query= "SELECT * FROM `users` WHERE email ='".mysqli_real_escape_string($link, $_POST['email'])."'";
			$result = mysqli_query($link, $query);
			$results = mysqli_num_rows($result);
			
			if($results) $error = "That email address is already registered. Do you want to log in?";
			else{
				$query = "INSERT INTO `users` (`email`, `password`, `location`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".md5(md5($_POST['email']).$_POST['password'])."', '')";
				mysqli_query($link, $query);
				$message = "You have been signed up! Please log in to continue";
				$_SESSION['id']=mysqli_insert_id($link); //return most recent id entered
				
				
				//redirect to main  page
				//header("location:index.php");
				
				
			}
		}
	}
	
	if($_POST['submit']=='Log in'){
		$message = "";
		$query = "SELECT * FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['loginemail'])."'AND password='" .md5(md5($_POST['loginemail']) .$_POST['loginpassword']). "'LIMIT 1";
		$result = mysqli_query($link, $query);
		$row = mysqli_fetch_array($result);
		if($row){
			$_SESSION['id']=$row['id'];
			header("location:mainpage.php");
		}
		else{
			$error = "You have entered an incorrect email or password. Please try again";
		}
	}

?>


