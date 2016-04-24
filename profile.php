<!DOCTYPE html>
<?php
session_start();
	$title = "Henkilötiedot";
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
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Tästä näet omat henkilökohtaiset tietosi. Voit muuttaa niitä painamalla 'Muuta tietoja'!</span></a>
<div class="laatikko1">
<?php echo "Asiakas: " . $_SESSION["fn"] . " " . $_SESSION["ln"]; ?>
</div>
<div class="laatikko1">
<?php echo "Sosiaaliturvatunnus: " . $_SESSION['ssn']; ?>
</div>
<div class="laatikko1">
<?php echo "Osoite: " . $_SESSION["address"]; ?>
</div>
<div class="laatikko1">
<?php echo "Sähköposti: " . $_SESSION["email"]; ?>
</div>
<div class="laatikko1">
<?php echo "Syntymäaika: " . $_SESSION["dateofbirth"]; ?>
</div>
<div class="laatikko1">
<?php echo "Käyttäjätunnus: " . $_SESSION["user"]; ?>
</div>
<div class="laatikko1">
<?php echo "Salasana: " . $_SESSION["password"]; ?>
</div><br>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='change.php'">Muuta tietoja</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</div>
</div>
<?php
include_once 'footer2.php';
?>