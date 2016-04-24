<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?php echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width">
		<script type="text/javascript">
				if (screen.width <= 435) { 
					document.write('<link href="pieni.css" type="text/css" rel="stylesheet">');
				} 
				else { 
					document.write('<link href="tyyli.css" type="text/css" rel="stylesheet">');
				} 
			</script>
		<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	</head>
<body>
<div class="bg">
<img class="logo" src="drlogo.png">
<nav>
<ul class="menu">
<?php 
	if($title == 'Kirjaudu sisään')
	{
?>		
	<li><a href="login.php"><span class="active">> Kirjaudu sisään</span></a></li>
	<li><a href="register.php">> Rekisteröidy</a></li>
<?php }
	elseif($title == 'Rekisteröidy') 
	{
?>
	<li><a href="login.php">> Kirjaudu sisään</a></li>
	<li><a href="register.php"><span class="active">> Rekisteröidy</span></a></li>
<?php }
	else {
?>			
	<li><a href="login.php">> Kirjaudu sisään</a></li>
	<li><a href="register.php">> Rekisteröidy</a></li>
<?php
	}
?>
</ul>
</nav>