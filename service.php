<?php
session_start();
	$title = "Tulosten tulkinta";
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
					$mittaus = "Verensokeri: "; 
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					if ($arvo < 4){ 
						$viesti1 = "Verensokerisi on vaarallisen alhainen, hakeudu lääkäriin."; 
					}
					elseif ($arvo > 6){ 
						$viesti1 = "Verensokerisi on vaarallisen kohonnut, hakeudu lääkäriin."; 
					}
					else {
						$viesti1 = "Verensokerisi on normaalilla tasolla.";
					}
					$tulos1 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>"."<br>"."<br>";
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
					$mittaus = "Verenpaine: ";
					$paine = explode("/",$row["value"]);					
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
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
					$tulos2 = $arvo." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>"."<br>"."<br>";
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
					$mittaus = "Ruumiinlämpö :"; 
					$arvo = str_replace(',', '.', $row["value"]);
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);
					if ($arvo < 34){ 
						$box4 = "boxerr err";
						$viesti3 = "Ruumiinlämpösi on alhainen, hakeudu lääkäriin."; 
					}
					elseif ($arvo > 37){ 
						$box4 = "boxerr err";
						$viesti3 = "Ruumiinlämpösi on kohonnut, hakeudu lääkäriin."; 
					}
					else {
						$viesti3 = "Ruumiinlämpösi on normaalilla tasolla.";
					}
					$tulos3 = $arvo." &deg;".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>"."<br>"."<br>";
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
					$mittaus = "Paino: ";
					$aika = $row["timestamp"];
					$aika = date("d.m.Y H.i.s", strtotime($aika));
					$aika = explode(" ", $aika);;
					$paino = $row["value"];
					$tulos4 = $paino." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>";
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
					$mittaus = "Pituus: "; 
					$row["value"] = str_replace(',', '.', $row["value"]);
					$pituus = $row["value"];				
					$tulos5 = $pituus." ".$row["measurement_unit"].", mittausaika: ".$aika[0].", klo: ".$aika[1]."<br>"."<br>"."<br>";	
				
					$pituus = pow($pituus/100,2);
					$bmi = $paino/$pituus;
					$bmi = number_format((float)$bmi, 1, '.', '');
					if ($bmi < 18.5) {
						$box4 = "boxerr err";
						$viesti4 = "Painoindeksi: ". $bmi .". Olet hieman alipainoinen.";
					} elseif ($bmi > 24.9) {
						$box4 = "boxerr err";
						$viesti4 = "Painoindeksi: ". $bmi .". Olet hieman ylipainoinen.";
					} else {
						$viesti4 = "Painoindeksi: ". $bmi .". Olet normaalipainoinen.";
					}
			}		
		} 
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Tällä sivulla näet tuloksiesi perusteella tehdyt tulkinnat!</span></a>
<div class="cc">
<div class="laatikkovs">
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 1 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { ?>
			<style type="text/css">
			.laatikkovs { display:none; }
			</style>
			<?php
			} else { ?>
			<style type="text/css">
			.laatikkovs { display:block; }
			</style>
			<?php	
			}
?>
<p class="arvo">
Verensokeri:
</p>
<?php echo $tulos1; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti1; ?></span>
</div>
</div>
<div class="laatikkovp">
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 2 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { ?>
			<style type="text/css">
			.laatikkovp { display:none; }
			</style>
			<?php
			} else { ?>
			<style type="text/css">
			.laatikkovp { display:block; }
			</style>
			<?php	
			}
?>
<p class="arvo">
Verenpaine:
</p>
<?php echo $tulos2; ?>
<div class="boxnot not" style="display: inline">
<span><?php echo $viesti2; ?></span>
</div>
</div>
<div class="laatikkorl">
<?php
$sql = "select value from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = 3 order by timestamp desc limit 1";
			$result = $conn->query($sql);
			if($result->num_rows < 1) { ?>
			<style type="text/css">
			.laatikkorl { display:none; }
			</style>
			<?php
			} else { ?>
			<style type="text/css">
			.laatikkorl { display:block; }
			</style>
			<?php	
			}
?>
<p class="arvo">
Ruumiinlämpö:
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
<button type="button" onclick="location.href='home.php'" class="button-minimal"><i class="fa fa-home" aria-hidden="true"></i> Etusivulle</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
</div>
</div>		
<?php
include_once 'footer2.php';
?>