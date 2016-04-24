<!DOCTYPE html>
<?php
session_start();
	$title = "Syötä mittaustuloksia";
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
<div class="cc">
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
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>