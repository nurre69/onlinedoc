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
$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 1 order by timestamp desc limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus1 = "Verensokeri: "; 
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);			
					$tulos1 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";
			}
		}
$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 2 order by timestamp desc limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus2 = "Verenpaine: ";
					$paine = explode("/",$row["value"]);					
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					$tulos2 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";
			}
		}
$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 3 order by timestamp desc limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus3 = "Ruumiinlämpö :"; 
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);			
					$tulos3 = $arvo." &deg;".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";
			}
		}
$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 4 order by timestamp desc limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus4 = "Paino: ";
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);			
					$tulos4 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";
			}
		}
$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 5 order by timestamp desc limit 1";
$result = $conn->query($sql);
if($result->num_rows > 0) 
		{
			while($row = $result->fetch_assoc()) 
			{	
					$mittaus5 = "Pituus: "; 
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);			
					$tulos5 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";	
			}		
		} 
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Jos tiedot näyttävät oikeilta, paina 'Seuraava'!</span></a>
<div class="bc">
<h2>Vaihe 2; tarkista syöttämäsi tiedot: </h2>
<div class="laatikko1">
<p class="arvo">
<?php echo $mittaus1; ?>
</p>
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 1 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { 
				echo "Sinulla ei ole verenpainearvoja järjestelmässä.";
			} else {
				echo $tulos1;
			}
?>
<p class="arvo">
<?php echo $mittaus2; ?>
</p>
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 2 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { 
				echo "Sinulla ei ole verensokeriarvoja järjestelmässä.";
			} else {
				echo $tulos2;
			}
?>
<p class="arvo">
<?php echo $mittaus3; ?>
</p>
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 3 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { 
				echo "Sinulla ei ole ruumiinlämpöarvoja järjestelmässä.";
			} else {
				echo $tulos3;
			}
?>
<p class="arvo">
<?php echo $mittaus4; ?>
</p>
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 4 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { 
				echo "Sinulla ei ole painoarvoja järjestelmässä.";
			} else {
				echo $tulos4;
			}
?>
<p class="arvo">
<?php echo $mittaus5; ?>
</p>
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 5 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { 
				echo "Sinulla ei ole pituusarvoja järjestelmässä.";
			} else {
				echo $tulos5;
			}
?><br>
</div>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='service.php'"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Seuraava</button>
<button type="button" class="button-minimal" onclick="location.href='insert2.php'"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button><br>		
</div>
</div>
</div>
<?php
include_once 'footer2.php';
?>