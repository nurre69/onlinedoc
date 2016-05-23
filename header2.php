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
		<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
			<script src="https://www.amcharts.com/lib/3/serial.js"></script>
			<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
			<script src="http://www.amcharts.com/lib/3/themes/none.js"></script>
			<script src="https://www.amcharts.com/lib/3/amstock.js"></script>
<body>
<div class="bg">
<img class="c" src="drlogo.png" alt="onlinedoc" onclick="location.href='home.php'">
<nav>
<ul class="menu">
<?php 
	if($title == 'onlinedoc -lääkäripalvelu')
	{
?>		
	<li class="active"><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="11"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="12"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="13"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li><a href="profile.php" tabindex="14"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="15"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	<ul>
			<li><a href="contact.php" tabindex="15"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="16"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="17"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
<?php }
	elseif($title == 'Mittaustulokset') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li class="active"><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li class="active"><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="10"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="16"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="17"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	    </ul>	
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="18"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
<?php }
	elseif($title == 'Tulosten tulkinta') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li class="active"><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li class="active"><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="17"><i class="fa fa-phone-square" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
    	</ul>	
    </li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
	<?php }
	elseif($title == 'Ota yhteys lääkäriin') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li class="active"><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="17">"><i class="fa fa-phone-square" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li class="active"><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	    </ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
		<?php }
	elseif($title == 'Henkilötiedot') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li class="active"><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="17"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	    </ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
		<?php }
	elseif($title == 'Muuta henkilötietojasi') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li class="active"><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="17"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	    </ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
	<?php }
	elseif($title == 'Kuvaajat') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li class="active"><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li class="active"><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
    	</ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
    	<ul>
			<li><a href="contact.php" tabindex="17"><i class="fa fa-phone-square" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
	    </ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
	<?php }
	elseif($title == 'Ota yhteyttä') 
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
    	<ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
    	</ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li class="active"><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
    	<ul>
			<li class="active"><a href="contact.php" tabindex="17"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
    	</ul>
	</li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
		<?php }
	else
	{
?>
	<li><a href="home.php" tabindex="10"><i class="fa fa-home" aria-hidden="true"></i> Etusivu</a></li>
	<li><a href="#" tabindex="11"><i class="fa fa-bars" aria-hidden="true"></i> Toiminnot</a>
	    <ul>
			<li><a href="measurements.php" tabindex="12"><i class="fa fa-heartbeat" aria-hidden="true"></i> Mittaustulokset</a></li>
			<li><a href="service.php" tabindex="13"><i class="fa fa-medkit" aria-hidden="true"></i> Tulosten tulkinta</a></li>
			<li><a href="charts.php" tabindex="14"><i class="fa fa-area-chart" aria-hidden="true"></i> Kuvaajat</a></li>
	    </ul>
	</li>
	<li><a href="profile.php" tabindex="15"><i class="fa fa-user" aria-hidden="true"></i> Henkilötiedot</a></li>
	<li><a href="#" tabindex="16"><i class="fa fa-envelope" aria-hidden="true"></i> Yhteydenotto</a>
	    <ul>
			<li><a href="contact.php" tabindex="17"><i class="fa fa-optin-monster" aria-hidden="true"></i> Ota yhteys ylläpitoon</a></li>
			<li><a href="contactd.php" tabindex="18"><i class="fa fa-user-md" aria-hidden="true"></i> Ota yhteys lääkäriin</a></li>
    	</ul>	
    </li>
	<li style="float: right;"><a href="logout.php" tabindex="19"><i class="fa fa-sign-out" aria-hidden="true"></i> Kirjaudu ulos</a></li>
<?php
	}
	?>
</ul>
</nav>