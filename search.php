<!DOCTYPE html>
<?php
session_start();
	$title = "Hae mittaustuloksia";
	include_once 'header2.php';;
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
	$limit = $_POST["raja"];

	if($typeid == '1') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 1
				ORDER BY m.timestamp DESC";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus = "Verensokeri:";
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = $row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '2') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 2
				ORDER BY m.timestamp DESC";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus = "Verenpaine:";
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = $row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '3') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 3
				ORDER BY m.timestamp DESC";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus = "Lämpötila:";
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = $row["Arvo"]." &deg".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '4') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 5
				ORDER BY m.timestamp DESC";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus = "Paino:";
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = $row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}	
	elseif($typeid == '5') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn' and m.typeid = 6
				ORDER BY m.timestamp DESC";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus = "Pituus:";
					$aika = $row["Aika"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$arvo = $row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}
	elseif($typeid == '6') 
	{
		$sql = "SELECT m.value AS Arvo, m_t.measurement_unit, m_t.measurement_name, m.timestamp AS Aika
				FROM measurements m 
				INNER JOIN measurement_type m_t ON m.typeid = m_t.typeid
				where m.ssn = '$ssn'
				ORDER BY m_t.typeid";
				
		$result = $conn->query($sql);

		if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$aika = $row["Aika"];
					$mittaus = "Kaikki tiedot:";
					$mittaust = $row["measurement_name"];
					if ($row["measurement_name"] == "glucose"){
						$mittaust = "Verensokeri:";
					} elseif ($row["measurement_name"] == "pressure"){
						$mittaust = "Verenpaine:";
					} elseif ($row["measurement_name"] == "temperature"){
						$mittaust = "Lämpötila:";
					} elseif ($row["measurement_name"] == "weight"){
						$mittaust = "Paino:";
					} elseif ($row["measurement_name"] == "height"){
						$mittaust = "Pituus:";
					}
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					if ($row["measurement_name"] == "temperature"){
						$arvo = $mittaust." ".$row["Arvo"]."&deg".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					} else {
					$arvo = $mittaust." ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."<br>";
					}
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
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Valitse mittaustyyppi, jota haluat tarkastella ja paina 'Hae tiedot'!</span></a>
<div class="cc">
<h2>Mittaustietojen haku: </h2>
				<form action="#" method="post" class="basic2">
		<label for="mittari">Mittauksen tyyppi: </label>
		<select name="mittari">
						<option value="1" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '1') 
         echo 'selected= "selected"';
          ?>>Verensokeri</option>
						<option value="2" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '2') 
         echo 'selected= "selected"';
          ?>>Verenpaine</option>
						<option value="3" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '3') 
         echo 'selected= "selected"';
          ?>>Lämpötila</option>
						<option value="4" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '4') 
         echo 'selected= "selected"';
          ?>>Paino</option>
						<option value="5" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '5') 
         echo 'selected= "selected"';
          ?>>Pituus</option>
						<option value="6" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '6') 
         echo 'selected= "selected"';
          ?>>Kaikki tiedot</option>	
					</select>
					<div class="bc">
					<button type="submit" class="button-minimal">Hae tiedot</button>
					<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button><br>
					</div>
			</form>
			</div>
<div class="laatikko2">
<p class="arvo">
<?php echo $mittaus; ?>
</p>
<?php echo $tulos; ?>
</div>			
</div>
<nav>
<ul class="menu">
    <li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
	<li style="float: right;"><p>Kirjautuneena: <?php echo $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></p></li>
</ul>
</nav>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016
</footer>
</div>
</body>
</html>