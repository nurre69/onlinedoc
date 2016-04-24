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
<img class="c" src="drlogo.png" alt="onlinedoc">
<nav>
<ul class="menu">
<?php 
	if($title == 'onlinedoc -lääkäripalvelu')
	{
?>		
	<li><a href="home.php"><span class="active">> Etusivu</span></a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php"><span class="active">> Mittaustulokset</span></a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
<?php }
	elseif($title == 'Mittaustulokset') 
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php"><span class="active">> Mittaustulokset</span></a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
<?php }
	elseif($title == 'Tulosten tulkinta') 
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php">> Mittaustulokset</a></li>
			<li><a href="service.php"><span class="active">> Tulosten tulkinta</span></a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
	<?php }
	elseif($title == 'Ota yhteys lääkäriin') 
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php">> Mittaustulokset</a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php"><span class="active">> Yhteys lääkäriin</span></a></li>
	</ul>
	</li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
		<?php }
	elseif($title == 'Henkilötiedot') 
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php">> Mittaustulokset</a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php"><span class="active">> Henkilötiedot</span></a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
		<?php }
	elseif($title == 'Muuta henkilötietojasi') 
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php">> Mittaustulokset</a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php"><span class="active"><span class="active">> Henkilötiedot</span></a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
		<?php }
	else
	{
?>
	<li><a href="home.php">> Etusivu</a></li>
	<li><a href="#">> Toiminnot</a>
	<ul>
			<li><a href="measurements.php">> Mittaustulokset</a></li>
			<li><a href="service.php">> Tulosten tulkinta</a></li>
			<li><a href="contactd.php">> Yhteys lääkäriin</a></li>
	</ul>
	</li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
<?php
	}
	?>

</ul>
</nav>