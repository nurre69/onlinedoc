<!DOCTYPE html>
<?php
session_start();
if($_SESSION["logged_in"] == 'yes'){
	include('connection.php');

        if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 600)) {
		session_unset();
		session_destroy();
		header("location: error.php");
	}
} else {
	header("location: error.php");
}
$_SESSION['LAST_ACTIVITY'] = time();
?>
<html lang="en">
	<head>
		<title>onlinedoc -lääkäripalvelu</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="css" media="screen" href="tyyli.css" />
		<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	</head>
<body>
<div class="bg">
<div style="margin-left: 20%; margin-right: 20%;">
<img class="c" src="drlogo.png">
</div>
<div class="menu"
<ul class="menu">
	<li><a href="home.php"><span class="active">> Etusivu</span></a></li>
		<li><a href="#">> Mittaustulokset</a>
		<ul>
		<li><a href="insert.php">> Syötä mittaustuloksia</a></li>
		<li><a href="search.php">> Hae mittaustuloksia</a></li>
		</ul>
	</li>
	<li><a href="service.php">> Tulosten tulkinta</a></li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
</ul>
</div>
<div class="data">  
<h1>Tervetuloa onlinedoc -lääkäripalveluun</h1><br>
<p style="text-align:center">
Jos haluat aloittaa palvelun käytön helppojen vaiheiden avulla, paina aloita:<br>
</p>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='insert2.php'">ALOITA</button>
</div>
<p style="text-align:center">
Tai vaihtoehtoisesti voit käyttää palvelua vapaasti:<br><br>
Jos haluat katsella tai muuttaa omia terveystietojasti, valitse Mittaustulokset.<br>
Jos haluat tarkastella toimenpiteitä omien tuloksiesi perusteella, valitse Tulosten tulkinta.<br>
Jos haluat katsella tai muuttaa omia tietojasi, valitse Henkilötiedot.<br>
Jos haluat ottaa yhteyttä palvelun ylläpitoon, valitse Ota yhteyttä.<br>
Jos haluat kirjautua ulos, valitse Kirjaudu ulos.<br><br>
</p>
<h3>Joka sivulta löydät ohjeet kysymysmerkkikuvakeesta: </h3><img class="c" src="question.png">
</div>
<div class="menu"
<ul class="menu">
    <li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
	<li style="float: right;"><p>Kirjautuneena: <?php echo $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></p></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>