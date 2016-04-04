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
					$tulos1 = $mittaus . $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'pressure') 
				{	
					$mittaus = "Verenpaine: ";
					$paine = explode("/",$row["Arvo"]);					
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$tulos2 = $mittaus . $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'temperature' && $row["measurement_unit"] == 'C') 
				{	
					$mittaus = "Lämpötila :"; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$tulos3 = $mittaus . $row["Arvo"]." &deg".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'weight') 
				{
					$mittaus = "Paino: ";
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$paino = $row["Arvo"]; 
					$tulos4 = $mittaus . $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>"."<br>";
				}
				elseif($row["measurement_name"] == 'height') 
				{	
					$mittaus = "Pituus: "; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$pituus = $row["Arvo"];				
					$tulos5 = $mittaus . $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"];

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
	<li><a href="#"><span class="active">> Mittaustulokset</span></a>
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
<a class="tooltip" href="#"><img src="question.png"><span>Tarkista syöttämäsi tiedot, kun olet valmis paina 'Seuraava'!</span></a>
<div class="cc">
<h2>Vaihe 2; tarkista syöttämäsi tiedot: </h2>
<div class="laatikko1">
<?php 
echo $tulos1;
echo $tulos2;
echo $tulos3;
echo $tulos4;
echo $tulos5;
 ?>
</div>	
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='service.php'">Seuraava</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button><br>		
</div>
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