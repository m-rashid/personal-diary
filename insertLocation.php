<?php

	include("connection.php");
	$lat = position.coords.latitude;
	$query = "UPDATE users SET location = '".mysqli_real_escape_string($link, $lat)."'WHERE id= '".$_SESSION['id']."'LIMIT 1";

?>
