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

function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
include 'connection.php';
$ssn = $_SESSION["ssn"];
$sql = "select m.typeid, mt.measurement_unit, m.value AS Arvo, m.timestamp AS Aika, mt.measurement_name
from measurements m
    join (select max(timestamp) maxtimestamp, typeid
          from measurements 
          group by typeid) m2 on m.timestamp = m2.maxtimestamp
                             and m.typeid = m2.typeid
    join measurement_type mt on m.typeid = mt.typeid
where m.ssn = '$ssn'
";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			
			while($row = $result->fetch_assoc()) 
			{	
				if($row["measurement_name"] == 'glucose') 
				{	
					$mittaus = "Verensokeri: "; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					if ($row["Arvo"] < 4){ 
						$viesti1 = "Verensokerisi on vaarallisen alhainen, hakeudu lääkäriin."; 
					}
					elseif ($row["Arvo"] > 6){ 
						$viesti1 = "Verensokerisi on vaarallisen kohonnut, hakeudu lääkäriin."; 
					}
					else {
						$viesti1 = "Verensokerisi on normaalilla tasolla.";
					}
					$tulos1 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'pressure') 
				{	
					$mittaus = "Verenpaine: ";
					$paine = explode("/",$row["Arvo"]);					
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					if ($paine[0] < 90 && $paine[1] < 60 ){ 
						$viesti2 = "Systolinen ja diastolinen paine alhaisia, hakeudu lääkäriin."; 
					}
					elseif ($paine[0] < 90 && $paine[1] > 110 ){ 
						$viesti2 = "Systolinen painen alhainen ja diastolinen paine kohonnut, hakeudu lääkäriin."; 
					}
					elseif ($paine[0] > 180 && $paine[1] > 110 ){ 
						$viesti2 = "Systolinen ja diastolinen paine kohonneita, hakeudu lääkäriin."; 
					}
					elseif ($paine[0] > 180 && $paine[1] < 60 ){ 
						$viesti2 = "Systolinen paine kohonnut ja diastolinen paine alhainen, hakeudu lääkäriin."; 
					}
					else {
						$viesti2 = "Verenpaine normaalilla tasolla.";
					}
					$tulos2 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'temperature' && $row["measurement_unit"] == 'C') 
				{	
					$mittaus = "Lämpötila :"; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					if ($row["Arvo"] < 34){ 
						$viesti3 = "Lämpötilasi on alhainen, hakeudu lääkäriin."; 
					}
					elseif ($row["Arvo"] > 37){ 
						$viesti3 = "Lämpötilasi on kohonnut, hakeudu lääkäriin."; 
					}
					else {
						$viesti3 = "Lämpötilasi on normaalilla tasolla.";
					}
					$tulos3 = $row["Arvo"]." &deg".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'weight') 
				{
					$mittaus = "Paino: ";
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$paino = $row["Arvo"]; 
					$tulos4 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
				}
				elseif($row["measurement_name"] == 'height') 
				{	
					$mittaus = "Pituus: "; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$pituus = $row["Arvo"];				
					$tulos5 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>"."<br>";	
				
					$pituus = pow($pituus/100,2);
					$bmi = $paino/$pituus;
					$bmi = number_format((float)$bmi, 1, '.', '');
					if ($bmi < 18.5) {
						$viesti4 = "Painoindeksi: ". $bmi .". Olet hieman alipainoinen.";
					} elseif ($bmi > 24.9) {
						$viesti4 = "Painoindeksi: ". $bmi .". Olet hieman ylipainoinen.";
					} else {
						$viesti4 = "Painoindeksi: ". $bmi .". Olet normaalipainoinen.";
					}

				}		
			} 
			
		}
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
	<li><a href="service.php"><span class="active">> Tulosten tulkinta</span></a></li>
	 <li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">Kirjaudu ulos</a></li>
</ul>
</div>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Tällä sivulla näet tuloksiesi perusteella tehdyt tulkinnat!</span></a>
<div class="cc">
<div class="laatikko1">
<p class="arvo">
Verensokeri:
</p>
<?php echo $tulos1; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti1; ?></span>
</div>
</div>

<div class="laatikko1">
<p class="arvo">
Verenpaine:
</p>
<?php echo $tulos2; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti2; ?></span>
</div>
</div>

<div class="laatikko1">
<p class="arvo">
Lämpötila:
</p>
<?php echo $tulos3; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti3; ?></span>
</div>
</div>

<div class="laatikko1">
<p class="arvo">
Paino ja pituus:
</p>
<?php echo $tulos4; ?>
<?php echo $tulos5; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti4; ?></span>
</div>
</div>
</div>
<div class="bc">
<button type="button" onclick="location.href='feedback.php'" class="button-minimal">Valmis</button>
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