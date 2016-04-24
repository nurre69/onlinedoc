<!DOCTYPE html>
<?php
session_start();
	$title = "Mittaustulokset";
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
	$typeid = test_input($_POST["mittari"]);
	$ssn = $_SESSION["ssn"];
	$arvo = test_input($_POST["value"]);
	$laskuri = 0;
	
	if($typeid == '1')  
	{
		if ($arvo <= 0) 
		{
			$_SESSION["error"] = "Sokeriarvo täytyy olla suurempi kuin 0!";
		}
		elseif ($arvo <= 2 || $arvo >= 20){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif (preg_match('/^([0-9]{1,2}),([0-9]{1})|([0-9]{1,2})$/', $arvo)){ 
			$sql = "INSERT INTO measurements (value, typeid, ssn)
				VALUES ('$arvo', '$typeid', '$ssn')";
			
			$result = $conn->query($sql);
	
			if(!$result)	{ $_SESSION["error"] = "Pieleen meni!"; }
	
			else 	
			{
				$_SESSION["msg"] = "Mittaustulokset tallennettu.";
				
				$arvo = str_replace(',', '.', $arvo);
			}
		} else {
			$_SESSION["error"] = "Sokeriarvo pitää syöttää muodossa x,x!";
		}
	}
	if($typeid == '2')
	{
		$paine = explode("/",$arvo);
		if ($arvo <= 0)
		{
			$_SESSION["error"] = "Verenpaine täytyy olla suurempi kuin 0!"; 
		}
		elseif ($paine[0] <= 70 || $paine[0] >= 200){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif ($paine[1] <= 40 || $paine[1] >= 130){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif (preg_match("~^([0-9]{2,3})[/]([0-9]{2,3})$~", $arvo)){ 
			$sql = "INSERT INTO measurements (value, typeid, ssn)
			VALUES ('$arvo', '$typeid', '$ssn')";
			
			$result = $conn->query($sql);
	
			if(!$result) { $_SESSION["error"] = "Pieleen meni!"; }
	
			else 	
			{
				$_SESSION["msg"] = "Mittaustulokset tallennettu.";
			}
		} else {
				$_SESSION["error"] = "Verenpaine pitää syöttää muodossa xx/xx!";
		}
	}
	if($typeid == '3')
	{
		if ($arvo <= 0) 
		{
			$_SESSION["error"] = "Lämpötilan täytyy olla suurempi kuin 0!";
		}
		elseif ($arvo <= 30 || $arvo >= 50){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif (preg_match('/^([0-9]{2}),([0-9]{1})|([0-9]{2})$/', $arvo)){
		 	
			$sql = "INSERT INTO measurements (value, typeid, ssn)
			VALUES ('$arvo', '$typeid', '$ssn')";
			
			$result = $conn->query($sql);
	
			if(!$result)
				{ $_SESSION["error"] = "Pieleen meni!"; }
			else 	
			{
				$_SESSION["msg"] = "Mittaustulokset tallennettu.";
			}	
		} else {
			$_SESSION["error"] = "Lämpötila pitää syöttää muodossa xx,x!"; 
		}
	}
	if($typeid == '4')
	{
		if ($arvo <= 0)
		{
			$_SESSION["error"] = "Painon täytyy olla suurempi kuin 0!"; 
		}
		elseif ($arvo <= 30 || $arvo >= 300){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif (preg_match('/^([0-9]{2,3})|([0-9]{2,3},[0-9]{1})$/', $arvo)){
			$sql = "INSERT INTO measurements (value, typeid, ssn)
			VALUES ('$arvo', '5', '$ssn')";
			
			$result = $conn->query($sql);
	
			if(!$result)
				{ $_SESSION["error"] = "Pieleen meni!"; }
			else 	
			{
				$_SESSION["msg"] = "Mittaustulokset tallennettu. ";
			}
		} else {
			$_SESSION["error"] = "Paino pitää syöttää muodossa xx,x!"; 
		}
	}	
	if($typeid == '5')
	{
		if ($arvo <= 0){
			$_SESSION["error"] = "Pituuden täytyy olla suurempi kuin 0!"; 
		}
		elseif ($arvo <= 100 || $arvo >= 230){
			$_SESSION["error"] = "Syötä realistisia arvoja!"; 
		}
		elseif (preg_match('/^([0-9]{2,3},[0-9]{1})|([0-9]{2,3})$/', $arvo)){
			$sql = "INSERT INTO measurements (value, typeid, ssn)
			VALUES ('$arvo', '6', '$ssn')";
			
			$result = $conn->query($sql);
	
			if(!$result)
				{ $_SESSION["error"] = "Pieleen meni!"; }
			else 	
			{
				$_SESSION["msg"] = "Mittaustulokset tallennettu.";
			}
		} else {
			$_SESSION["error"] = "Pituus pitää syöttää muodossa xx,x!"; 
		}
	}
	
	$typeid = $_POST["mittari2"];
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
	$typeid = $_POST["mittari3"];
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
					$arvo = "Verensokeri ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
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
					$arvo = "Verenpaine ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
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
					$arvo = "Lämpötila ".$row["Arvo"]." &deg".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
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
					$arvo = "Paino ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
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
					$arvo = "Pituus ".$row["Arvo"]." ".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
					$summa[] = $arvo;
			}
			$tulos = implode($summa);
		}
	}
	
	$to = $_REQUEST['to'];
	$email = $_SESSION["email"];
	$subject = "Mittaustulokset";
	$comment = $tulos;
	if (isset($_POST['send']))
	{
	mail($to, $subject, $comment, "From:" . $email);
		if (@mail($admin_email, $subject, $comment))
	{
		$_SESSION["msg"] = "Mittaustuloksesi ovat lähetetty valitsemaasi sähköpostiin.";
	} else {
		$_SESSION["error"] = "Tapahtui virhe.";
	}
	}
if (empty($_SESSION["error"]))
{
	?>
	<style type="text/css">
	.boxerr { display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.boxerr { display:inline; }
	</style>
	<?php
}
if (empty($_SESSION["msg"]))
{
	?>
	<style type="text/css">
	.boxsuc { display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.boxsuc { display:inline; }
	</style>
	<?php
}
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Valitse mittauksesi tyyppi ja syötä arvo alla olevaan kenttään ja paina 'Lähetä'!</span></a>
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<div class="cc" style="margin-bottom: 10px; border: 1px solid black; padding: 15px; background: white; border-radius: 5px;">
<h2>Mittaustietojen syöttö: </h2>
	<form action="#" method="post" class="basic2">
		<label for="mittari">Mittauksen tyyppi: </label>
		<select size="1" name="mittari" class="perus">
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
		</select><br>
		<label for="value">Mitattu arvo: </label>
		<input type="text" name="value" required><br><br>
<div class="bc">
<button type="submit" name="submit" class="button-minimal">Lähetä</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button><br><br>
</div>
</form>
</div>
<div class="cc" style="margin-bottom: 10px; border: 1px solid black; padding: 15px; background: white; border-radius: 5px;">
<h2>Mittaustietojen haku: </h2>
		<form action="#" method="post" class="basic2">
		<label for="mittari2">Mittauksen tyyppi: </label>
		<select name="mittari2">
						<option value="1" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '1') 
         echo 'selected= "selected"';
          ?>>Verensokeri</option>
						<option value="2" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '2') 
         echo 'selected= "selected"';
          ?>>Verenpaine</option>
						<option value="3" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '3') 
         echo 'selected= "selected"';
          ?>>Lämpötila</option>
						<option value="4" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '4') 
         echo 'selected= "selected"';
          ?>>Paino</option>
						<option value="5" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '5') 
         echo 'selected= "selected"';
          ?>>Pituus</option>
						<option value="6" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '6') 
         echo 'selected= "selected"';
          ?>>Kaikki tiedot</option>	
					</select><br><br>
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
<div class="cc" style="margin-bottom: 10px; border: 1px solid black; padding: 15px; background: white; border-radius: 5px;">
<h2>Mittaustietojen lähetys: </h2>
<form method="post" class="basic2">
		<label for="mittari3">Mittauksen tyyppi: </label>
		<select size="1" name="mittari3">
						<option value="1">Verensokeri</option>
						<option value="2">Verenpaine</option>
						<option value="3">Lämpötila</option>
						<option value="4">Paino</option>
						<option value="5">Pituus</option>
					</select><br>
<label for="to">Vastaanottajan sähköpostiosoite: </label>
	<input type="email" name="to" required><br><br>
	<div class="bc">
	<button type="submit" class="button-minimal" name="send">Lähetä</button>
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
	</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>