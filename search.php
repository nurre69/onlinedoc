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
	$typeid = $_POST["mittari"];
	$ssn = $_SESSION["ssn"];

	if($typeid == '1') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 1
				ORDER BY m.timestamp DESC
				LIMIT 5";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.m.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = "Verensokeri ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '2') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 2
				ORDER BY m.timestamp DESC
				LIMIT 5";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.m.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = "Verenpaine ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '3') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 3
				ORDER BY m.timestamp DESC
				LIMIT 5";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.m.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = "Lämpötila ".$row["Arvo"]." &deg".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '4') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 5
				ORDER BY m.timestamp DESC
				LIMIT 5";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.m.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = "Paino ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '5') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 6
				ORDER BY m.timestamp DESC
				LIMIT 5";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.m.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = "Pituus ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}
if (empty($tulos))
{
	?>
	<style type="text/css">
	.laatikko2{ display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.laatikko2{ display:block; }
	</style>
	<?php
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
<a class="tooltip" href="#"><img src="question.png"><span>Valitse mittaustyyppi, jota haluat tarkastella ja paina 'Hae tiedot'!</span></a>
<div class="cc">
<h2>Mittaustietojen haku: </h2>
				<form action="#" method="post" class="basic2">
		<label for="mittari">Mittauksen tyyppi: </label>
		<select size="1" class="perus" name="mittari">
						<option value="1">Verensokeri</option>
						<option value="2">Verenpaine</option>
						<option value="3">Lämpötila</option>
						<option value="4">Paino</option>
						<option value="5">Pituus</option>	
					</select>
					<div class="bc">
					<button type="submit" class="button-minimal">Hae tiedot</button>
					<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button><br>
					</div>
			</form>
			</div>
<div class="laatikko2">
<?php echo $tulos; ?>
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