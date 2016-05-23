<?php
	session_start();
	$title = "Ota yhteyttä";
	include_once 'header1.php';
	$admin_email = "niikan@metropolia.fi";
	$email = $_REQUEST['email'];
	$subject = $_REQUEST['subject'];
	$comment = $_REQUEST['message'];
	if (isset($_POST['send']))
	{
	mail($admin_email, "$subject", $comment, "From:" . $email);
		if (@mail($admin_email, $subject, $comment))
	{
		$_SESSION["msg"] = "Viestisi on lähetetty ylläpidolle.";
	} else {
		$_SESSION["error"] = "Tapahtui virhe, tarkistahan syöttämästi sähköpostiosoitteen.";
	}
	}
?>
<div class="data">
<a class="tooltip" href="#"><img alt="Ohje!" src="question.png"><span>Kirjoita sähköpostiosoitteesi sekä viestisi ylläpidolle ja paina 'Lähetä'!</span></a>
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
<h2>Ota yhteyttä palvelun ylläpitoon:</h2><br>
<div class="cc">
<form method="post" class="minimal">
	<label for="email">Sähköpostisi: </label>
	<input type="email" name="email" id="email" required>
	<label for="subject">Aihe: </label>
	<select size="1" name="subject" id="subject">
	<option value="Ongelma palvelussa">Ongelma palvelussa</option>
	<option value="Palaute">Palaute</option>
	<option value="Muuta">Muuta</option>
	</select>

	<label for="message">Viesti: </label>
	<textarea autofocus class="minimal" id="message" name="message" rows="7" cols="60" required></textarea><br><br>

	<div class="bc">
	<button type="submit" class="button-minimal" name="send"><i class="fa fa-reply" aria-hidden="true"></i> Lähetä viesti</button>
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
	</div>
</form>
</div>
</div>
<?php
include_once 'footer1.php';
?>