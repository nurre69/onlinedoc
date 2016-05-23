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
		<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	</head>
<body>
<div class="bg">
    <a href="home.php"  tabindex="10">
        <img class="logo" src="drlogo.png" onclick="location.href='index.php'">
    </a>
<nav>
<ul class="menu">
<?php 
	if($title == 'Kirjaudu sisään')
	{
?>		
	<li class="active"><a href="login.php" tabindex="11"><i class="fa fa-sign-in" aria-hidden="true"></i> Kirjaudu sisään</a></li>
	<li><a href="register.php" tabindex="12"><i class="fa fa-user-plus" aria-hidden="true"></i> Rekisteröityminen</a></li>
	<li><a href="#" tabindex="13"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	<ul>
			<li><a href="contact2.php" tabindex="14"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
	</ul>
	</li>
<?php }
	elseif($title == 'Rekisteröityminen') 
	{
?>
	<li><a href="login.php" tabindex="11"><i class="fa fa-sign-in" aria-hidden="true"></i> Kirjaudu sisään</a></li>
	<li class="active"><a href="register.php" tabindex="12"><i class="fa fa-user-plus" aria-hidden="true"></i> Rekisteröityminen</a></li>
	<li><a href="#" tabindex="13"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	<ul>
			<li><a href="contact2.php" tabindex="14"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
	</ul>
	</li>
<?php }
	elseif($title == 'Ota yhteyttä') 
	{
?>
	<li><a href="login.php" tabindex="11"><i class="fa fa-sign-in" aria-hidden="true"></i> Kirjaudu sisään</a></li>
	<li><a href="register.php" tabindex="12"><i class="fa fa-user-plus" aria-hidden="true"></i> Rekisteröityminen</a></li>
	<li class="active"><a href="#" tabindex="13"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	<ul>
			<li class="active"><a href="contact2.php" tabindex="14"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
	</ul>
	</li>
<?php }
	else {
?>			
	<li><a href="login.php" tabindex="11"><i class="fa fa-sign-in" aria-hidden="true"></i> Kirjaudu sisään</a></li>
	<li><a href="register.php" tabindex="12"><i class="fa fa-user-plus" aria-hidden="true"></i> Rekisteröityminen</a></li>
	<li><a href="#" tabindex="13"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	<ul>
			<li><a href="contact2.php" tabindex="14"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
	</ul>
	</li>
<?php
	}
?>
</ul>
</nav>