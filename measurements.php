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
			$_SESSION["error"] = "Ruumiinlämmön täytyy olla suurempi kuin 0!";
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
			$_SESSION["error"] = "Ruumiinlämpö pitää syöttää muodossa xx,x!"; 
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
			VALUES ('$arvo', '$typeid', '$ssn')";
			
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
			VALUES ('$arvo', '$typeid', '$ssn')";
			
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
					$arvo = "Ruumiinlämpö ".$row["Arvo"]." &deg".$row["measurement_unit"].", mitattu: ". $aika[0].", klo: ".$aika[1]."\r\n";
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
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Valitse mittauksesi tyyppi ja syötä arvo alla olevaan kenttään ja paina 'Lähetä'!</span></a>
<?php
if (!empty($_SESSION["error"]))
{
	?>
<div class="bc">
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div></div>
<?php }
?>
<?php
if (!empty($_SESSION["msg"]))
{
	?>
<div class="bc">
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div></div>
<?php }
?>
<div class="cc" style="border: 1px solid black; margin-top: 20px; margin-bottom: 10px; padding: 15px; background: white;">
<h2>Mittaustietojen syöttö: </h2>
	<form action="#" method="post" class="basic2">
		<label for="mittari">Mittauksen tyyppi: </label>
		<select size="1" name="mittari" class="perus" id="mittari">
		<option value="1" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '1') 
         echo 'selected= "selected"';
          ?>>Verensokeri</option>
		<option value="2" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '2') 
         echo 'selected= "selected"';
          ?>>Verenpaine</option>
		<option value="3" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '3') 
         echo 'selected= "selected"';
          ?>>Ruumiinlämpö</option>
		<option value="4" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '4') 
         echo 'selected= "selected"';
          ?>>Paino</option>
		<option value="5" <?php if(isset($_POST['mittari']) && $_POST['mittari'] == '5') 
         echo 'selected= "selected"';
          ?>>Pituus</option>	
		</select><br>
		<label for="value">Mitattu arvo: </label>
		<input type="text" name="value" required id="value" tabindex="1"><br><br>
<div class="bc">
<button type="submit" name="input" class="button-minimal"><i class="fa fa-upload" aria-hidden="true"></i> Syötä tiedot</button><br><br>
</div>
</form>
</div>
<div class="cc" style="border: 1px solid black; margin-bottom: 10px; padding: 15px; background: white;">
<h2>Mittaustietojen haku: </h2>
		<form action="#" method="post" class="basic2">
		<label for="mittari2">Mittauksen tyyppi: </label>
		<select name="mittari2" id="mittari2">
						<option value="1" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '1') 
         echo 'selected= "selected"';
          ?>>Verensokeri</option>
						<option value="2" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '2') 
         echo 'selected= "selected"';
          ?>>Verenpaine</option>
						<option value="3" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '3') 
         echo 'selected= "selected"';
          ?>>Ruumiinlämpö</option>
						<option value="4" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '4') 
         echo 'selected= "selected"';
          ?>>Paino</option>
						<option value="5" <?php if(isset($_POST['mittari2']) && $_POST['mittari2'] == '5') 
         echo 'selected= "selected"';
          ?>>Pituus</option>
					</select><br><br>
					<div class="bc">
					<button type="submit" name="submit" class="button-minimal"><i class="fa fa-search" aria-hidden="true"></i> Hae tiedot</button><br>
					</div>
			</form>
			</div>
<?php

	$typeid = $_POST["mittari2"];
	$ssn = $_SESSION["ssn"];

if (isset($_POST['submit'])){				
		$sql = "select value from measurements 
					where ssn = '$ssn' and typeid = '$typeid' limit 1";
	
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc()) 
		{
			if(!$_SESSION["height"]) { $_SESSION["height"] = $row["value"]/100; }
		}
			
		$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = $typeid order by timestamp desc limit 20";
	
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) 
		{ ?>
<table class="tulokset">
	<tr>
	<td colspan="3"><?php if($typeid == 1){ 
							echo "Verensokeri"; 
							$mittaus = "Verensokeri";
							$min = 4;
							$max = 6;	
						}
						elseif($typeid == 2) 
						{ 
							echo "Verenpaine"; 
							$mittaus = "Verenpaine";
							
							$minAla = 70;
							$minYla = 100;
							$maxAla = 90;
							$maxYla = 140;
						}
						elseif($typeid == 3) 
						{
							echo "Ruumiinlämpö"; 
							$mittaus = "Ruumiinlämpö";	
							$min = 35.8;
							$max = 37.8;
						}					
						elseif($typeid == 4) 
						{ 
							echo "Paino"; 
							$mittaus = "Paino";
							$min = $_SESSION["height"]*100 - 110;
							$max = $_SESSION["height"]*100 - 90;
						}
						elseif($typeid == 4) 
						{ 
							echo "Paino"; 
							$mittaus = "Paino";
							$min = $_SESSION["height"]*100 - 110;
							$max = $_SESSION["height"]*100 - 90;
						}	
						elseif($typeid == 5) 
						{ 
							echo "Pituus"; 
							$mittaus = "Pituus";
							$min = 0;
							$max = 300;
						}	
				?></td>
				</tr>
			
				<tr>
					<th>#</th>
					<th>Mittausaika</th>
					<th>Mitattu arvo</th>
				</tr>		
		<?php
			$i = 1;
			
			while($row = $result->fetch_assoc()) 
			{
				$arvo = str_replace(',', '.', $row["value"]);
				
				$aika = $row["timestamp"];
				$aika = date("d.m.Y H.i.s", strtotime($aika));
						
				$aika = explode(" ", $aika);
				
			?>	<tr>
					<td>
						<?php echo $i; ?>
					</td>
					<td>
						<?php echo $aika[0]." klo ".$aika[1]?>
					</td>
					<td>
						<?php 
						if($typeid == 3) { 
												echo $arvo." °".$row["measurement_unit"] ;
												$unit = "°" . $row["measurement_unit"]; 
												}else { 
							  					echo $arvo." ".$row["measurement_unit"]; 
							  					$unit = $row["measurement_unit"]; 
												}
						if($typeid != 2){	?>
							 &nbsp;
							 <?php
							 if($arvo <= $min || $arvo >= $max) { ?>
								<i class="fa fa-times-circle fa-lg" style="color: red;" aria-hidden="true"></i>
							<?php } else { ?>
								<i class="fa fa-check-circle fa-lg" style="color: green;" aria-hidden="true"></i>
							<?php }
						} else {
										$arvo = explode("/", $row["value"]); ?>
										&nbsp;
										<?php if($arvo[0] >= $minYla && $arvo[1] >= $minAla && $arvo[0] <= $maxYla && $arvo[1] <= $maxAla) { ?>
										<i class="fa fa-check-circle fa-lg" style="color: green;" aria-hidden="true"></i> 
										<?php } else { ?> 
										<i class="fa fa-times-circle fa-lg" style="color: red;" aria-hidden="true"></i> 
										<?php }
									}
							$i++;
						} ?>
					</td>
				</tr>
				<?php
			} ?>
			</table>					
<?php	}

?>	
<div class="cc" style="border: 1px solid black; padding: 15px; background: white;">
<h2>Mittaustietojen lähetys: </h2>
<form method="post" class="basic2">
		<label for="mittari3">Mittauksen tyyppi: </label>
		<select size="1" name="mittari3" id="mittari3">
						<option value="1">Verensokeri</option>
						<option value="2">Verenpaine</option>
						<option value="3">Ruumiinlämpö</option>
						<option value="4">Paino</option>
						<option value="5">Pituus</option>
					</select><br>
<label for="to">Vastaanottajan sähköpostiosoite: </label>
	<input type="email" name="to" required id="to"><br><br>
	<div class="bc">
	<button type="submit" class="button-minimal" name="send"><i class="fa fa-paper-plane" aria-hidden="true"></i> Lähetä tiedot</button>
	</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>