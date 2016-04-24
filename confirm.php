<!DOCTYPE html>
<?php
session_start();
	$title = "Varmista syöttämäsi tiedot";
	include_once 'header2.php';
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
$sql = "SELECT max(m.timestamp) AS Aika, m.typeid, m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit
					FROM measurements m
					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
					WHERE m.typeid = 1 AND m.ssn = '$ssn'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus1 = "Verensokeri: "; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$tulos1 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
			}
		}
$sql = "SELECT max(m.timestamp) AS Aika, m.typeid, m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit
					FROM measurements m
					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
					WHERE m.typeid = 2 AND m.ssn = '$ssn'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus2 = "Verenpaine: ";
					$paine = explode("/",$row["Arvo"]);					
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$tulos2 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
			}
		}
$sql = "SELECT max(m.timestamp) AS Aika, m.typeid, m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit
					FROM measurements m
					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
					WHERE m.typeid = 3 AND m.ssn = '$ssn'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus3 = "Lämpötila :"; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$tulos3 = $row["Arvo"]." &deg".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
			}
		}
$sql = "SELECT max(m.timestamp) AS Aika, m.typeid, m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit
					FROM measurements m
					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
					WHERE m.typeid = 5 AND m.ssn = '$ssn'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus4 = "Paino: ";
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$paino = $row["Arvo"]; 
					$tulos4 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";
			}
		}
$sql = "SELECT max(m.timestamp) AS Aika, m.typeid, m.value AS Arvo, m_t.measurement_name, m_t.measurement_unit
					FROM measurements m
					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
					WHERE m.typeid = 6 AND m.ssn = '$ssn'";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus5 = "Pituus: "; 
					$row["Arvo"] = str_replace(',', '.', $row["Arvo"]);
					$pituus = $row["Arvo"];				
					$tulos5 = $row["Arvo"]." ".$row["measurement_unit"].", mittausaika: ".$row["Aika"]."<br>";	
			}		
		} 
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Tarkista syöttämäsi tiedot, kun olet valmis paina 'Seuraava'!</span></a>
<div class="cc">
<h2>Vaihe 2; tarkista syöttämäsi tiedot: </h2>
<div class="laatikko1">
<p class="arvo">
<?php echo $mittaus1; ?>
</p>
<?php echo $tulos1; ?>
<p class="arvo">
<?php echo $mittaus2; ?>
</p>
<?php echo $tulos2; ?>
<p class="arvo">
<?php echo $mittaus3; ?>
</p>
<?php echo $tulos3; ?>
<p class="arvo">
<?php echo $mittaus4; ?>
</p>
<?php echo $tulos4; ?>
<p class="arvo">
<?php echo $mittaus5; ?>
</p>
<?php echo $tulos5; ?><br>
</div>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='service.php'">Seuraava</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button><br>		
</div>
</div>
</div>
<?php
include_once 'footer2.php';
?>