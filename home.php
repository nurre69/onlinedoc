<!DOCTYPE html>
<?php
session_start();
	$title = "onlinedoc -lääkäripalvelu";
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
<h1>Tervetuloa onlinedoc -lääkäripalveluun</h1><br>
<p style="text-align:center">
Jos haluat aloittaa palvelun käytön helppojen vaiheiden avulla, paina aloita:<br>
</p>
<div class="bc">
<button type="button" class="button-minimal" onclick="location.href='insert2.php'" tabindex="1"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> ALOITA</button><br><br>
</div>
<p style="text-align:center">
Tai vaihtoehtoisesti voit käyttää palvelua vapaasti Toiminnot -valikosta.<br><br>
</p>
<h3>Joka sivulta löydät ohjeet kysymysmerkistä: </h3><img class="c" src="question.png" alt="Ohjeet">
</div>
<?php
include_once 'footer2.php';
?>