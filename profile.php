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
	<li><a href="home.php">> Etusivu</a></li>
		<li><a href="#">> Mittaustulokset</a>
		<ul>
		<li><a href="insert.php">> Syötä mittaustuloksia</a></li>
		<li><a href="search.php">> Hae mittaustuloksia</a></li>
		</ul>
	</li>
	<li><a href="service.php">> Tulosten tulkinta</a></li>
	<li><a href="profile.php"><span class="active">> Henkilötiedot</span></a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
</ul>
</div>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Tästä näet omat henkilökohtaiset tietosi. Voit muuttaa niitä painamalla 'Muuta tietoja'!</span></a>
<div class="laatikko2">
<?php echo "Asiakas: " . $_SESSION["fn"] . " " . $_SESSION["ln"]; ?>
</div>
<div class="laatikko2">
<?php echo "Sosiaaliturvatunnus: " . $_SESSION['ssn']; ?>
</div>
<div class="laatikko2">
<?php echo "Osoite: " . $_SESSION["address"]; ?>
</div>
<div class="laatikko2">
<?php echo "Sähköposti: " . $_SESSION["email"]; ?>
</div>
<div class="laatikko2">
<?php echo "Syntymäaika: " . $_SESSION["dateofbirth"]; ?>
</div>
<div class="laatikko2">
<?php echo "Käyttäjätunnus: " . $_SESSION["user"]; ?>
</div>
<div class="laatikko2">
<?php echo "Salasana: " . $_SESSION["password"]; ?>
</div><br>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='change.php'">Muuta tietoja</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</div>
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