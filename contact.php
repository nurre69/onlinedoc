<!DOCTYPE html>
<?php
session_start();
	$title = "Ota yhteyttä";
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
	$subject = $_REQUEST['subject'];
	$comment = $_REQUEST['message'];
	if (isset($_POST['send']))
	{
	mail($admin_email, $subject, $comment, "From:" . $email);
		if (@mail($admin_email, $subject, $comment))
	{
		$_SESSION["msg"] = "Viestisi on lähetetty ylläpidolle.";
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
<a class="tooltip" href="#"><img src="question.png"><span>Kirjoita viestisi ylläpidolle ja paina 'Lähetä'!</span></a>
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Ota yhteyttä palvelun ylläpitoon:</h2><br>
<div class="cc">
<form method="post" class="minimal">

	<label for="subject">Aihe: </label>
	<select size="1" name="subject" id="subject" tabindex="1">
	<option value="Ongelma palvelussa">Ongelma palvelussa</option>
	<option value="Palaute">Palaute</option>
	<option value="Muuta">Muuta</option>
	</select>

	<label for="message">Viesti: </label>
	<textarea autofocus class="minimal" name="message" rows="7" cols="60" required id="message" tabindex="2"></textarea><br><br>

	<div class="bc">
	<button type="submit" class="button-minimal" name="send" tabindex="3"><i class="fa fa-reply" aria-hidden="true"></i> Lähetä viesti</button>
	<button type="button" class="button-minimal" tabindex="4" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
	</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>