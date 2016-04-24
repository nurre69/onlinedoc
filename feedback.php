<!DOCTYPE html>
<?php
session_start();
	$title = "Anna palautetta";
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

$admin_email = "niikan@metropolia.fi";
	$email = $_SESSION["email"];
	$subject = "Palaute";
	$comment = $_REQUEST['message'];
	if (isset($_POST['send']))
	{
	mail($admin_email, $subject, $comment, "From:" . $email);
	}
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Täytä palautelomake ja paina 'Lähetä'!</span></a>
<div class="cc">
<form action="#" method="post" id="feedback">
<p>Olitko tyytyväinen palveluun?
<label><input type="radio" name="service" id="yes" value="yes">Kyllä</label>
<label><input type="radio" name="service" id="no" value="no">Ei</label><br><br>
Mistä sait tietää palvelusta?
<select class="basic2" form="feedback">
	<option value="friend">Kaverilta</option>
	<option value="social">Sosiaalisesta mediasta</option>
	<option value="tv">Televisiosta</option>
</select><br><br>
Muuta kommentoitavaa:<br>
<textarea autofocus style="resize: none; margin-left; auto; margin-right: auto;" form="feedback" name="message" rows="7" cols="45"></textarea><br><br>
<button type="button" onclick="location.href='final.php'" class="button-minimal" name="send">Lähetä</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>