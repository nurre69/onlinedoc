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
	$ssn = $_SESSION["ssn"];
	$verensokeri = $_POST["verensokeri"];
	$verenpaine = $_POST["verenpaine"];
	$lämpötila = $_POST["lämpötila"];
	$paino = $_POST["paino"];
	$pituus = $_POST["pituus"];
	
	if (isset($_POST['submit'])){
		if (!empty($_POST["pituus"])) {
			if ($pituus <= 0){
				$_SESSION["error"] = "Pituuden täytyy olla suurempi kuin 0!"; 
			}
			elseif ($pituus <= 100 || $pituus >= 230){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif (preg_match('/^([0-9]{2,3},[0-9]{1})|([0-9]{2,3})$/', $pituus)){
				$sql = "INSERT INTO measurements (value, typeid, ssn) VALUES('$pituus', '5', '$ssn')";
				$result = $conn->query($sql);
				if(!$result) { 
					$_SESSION["error"] = "Pieleen meni!"; 
				}
			} else {
			$_SESSION["error"] = "Pituus pitää syöttää muodossa xx,x!"; 
			}	
		}
		if (!empty($_POST["paino"])) {
			if ($paino <= 0)
			{
				$_SESSION["error"] = "Painon täytyy olla suurempi kuin 0!"; 
			}
			elseif ($paino <= 30 || $paino >= 300){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif (preg_match('/^([0-9]{2,3})|([0-9]{2,3},[0-9]{1})$/', $paino)){
				$sql = "INSERT INTO measurements (value, typeid, ssn) VALUES('$paino', '4', '$ssn')";
				$result = $conn->query($sql);
				if(!$result) { 
					$_SESSION["error"] = "Pieleen meni!"; 
				}
			} else {
			$_SESSION["error"] = "Paino pitää syöttää muodossa xx,x!"; 
			}
			}
		if (!empty($_POST["lämpötila"])) {
			if ($lämpötila <= 0) 
			{
				$_SESSION["error"] = "Ruumiinlämmön täytyy olla suurempi kuin 0!";
			}
			elseif ($lämpötila <= 30 || $lämpötila >= 50){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif (preg_match('/^([0-9]{2}),([0-9]{1})|([0-9]{2})$/', $lämpötila)){
				$sql = "INSERT INTO measurements (value, typeid, ssn) VALUES('$lämpötila', '3', '$ssn')";
				$result = $conn->query($sql);
				if(!$result) { 
					$_SESSION["error"] = "Pieleen meni!"; 
				}
			} else {
			$_SESSION["error"] = "Ruumiinlämpö pitää syöttää muodossa xx,x!"; 
			}
			}
		if (!empty($_POST["verenpaine"])) {
			$paine = explode("/",$verenpaine);
			if ($verenpaine <= 0)
			{
				$_SESSION["error"] = "Verenpaine täytyy olla suurempi kuin 0!"; 
			}
			elseif ($paine[0] <= 70 || $paine[0] >= 200){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif ($paine[1] <= 40 || $paine[1] >= 130){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif (preg_match("~^([0-9]{2,3})[/]([0-9]{2,3})$~", $verenpaine)){
				$sql = "INSERT INTO measurements (value, typeid, ssn) VALUES('$verenpaine', '2', '$ssn')";
				$result = $conn->query($sql);
				if(!$result) { 
					$_SESSION["error"] = "Pieleen meni!"; 
				}
			} else {
				$_SESSION["error"] = "Verenpaine pitää syöttää muodossa xx/xx!";
			}
			}
		if (!empty($_POST["verensokeri"])) {
			if ($verensokeri <= 0) 
			{
			$_SESSION["error"] = "Sokeriarvo täytyy olla suurempi kuin 0!";
			}
			elseif ($verensokeri <= 2 || $verensokeri >= 20){
				$_SESSION["error"] = "Syötä realistisia arvoja!"; 
			}
			elseif (preg_match('/^([0-9]{1,2}),([0-9]{1})|([0-9]{1,2})$/', $verensokeri)){ 
				$sql = "INSERT INTO measurements (value, typeid, ssn) VALUES('$verensokeri', '1', '$ssn')";
				$result = $conn->query($sql);
				if(!$result) { 
					$_SESSION["error"] = "Pieleen meni!"; 
				}
			} else {
			$_SESSION["error"] = "Sokeriarvo pitää syöttää muodossa x,x!";
			}
			}
		if (empty($_SESSION["error"])) {
			$_SESSION["msg"] = "Mittaustulokset hyväksytty, siirryt kohta seuraavaan vaiheeseen."; 
		}
		
	}
if ($_SESSION["msg"] == "Mittaustulokset hyväksytty, siirryt kohta seuraavaan vaiheeseen.") { ?>
<script type="text/javascript">
(function(){
   setTimeout(function(){
     window.location="http://users.metropolia.fi/~niikan/confirm.php";
   },3000); /* 1000 = 1 second*/
})();
</script>
<?php }
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="ohjeita"><span>Valitse mittauksesi tyyppi ja syötä arvo alla olevaan kenttään ja paina 'Lähetä'! Kun olet syöttänyt kaikki tiedot, paina 'Seuraava'!</span></a>
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
<h2>Vaihe 1; syötä mittaustietosi: </h2>
<div class="cc">
	<form action="#" method="post" class="minimal">
		<label for="verensokeri">Verensokeri: </label>
		<input type="text" name="verensokeri" id="verensokeri"><br>
		<label for="verenpaine">Verenpaine: </label>
		<input type="text" name="verenpaine" id="verenpaine"><br>
		<label for="lämpötila">Ruumiinlämpö: </label>
		<input type="text" name="lämpötila" id="lämpötila"><br>
		<label for="paino">Paino: </label>
		<input type="text" name="paino" id="paino"><br>
		<label for="pituus">Pituus: </label>
		<input type="text" name="pituus" id="pituus"><br>
<div class="bc">
<button type="submit" name="submit" class="button-minimal"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Seuraava</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i>Takaisin</button>
</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>