<?php
session_start();
	$title = "Mittaustulosten lähetys";
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
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Lähetä haluamasi tiedot eteenpäin:</h2><br>

<form method="post" class="basic2">
<div class="cc">
		<label for="mittari">Mittauksen tyyppi: </label>
		<select size="1" name="mittari">
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