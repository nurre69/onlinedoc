<!DOCTYPE html>
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
	.boxsucc { display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.boxsucc { display:inline; }
	</style>
	<?php
}
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Kirjoita sähköpostiosoitteesi sekä viestisi ylläpidolle ja paina 'Lähetä'!</span></a>
</span>
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsucc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Ota yhteyttä palvelun ylläpitoon:</h2><br>

<form method="post" class="basic">
	<label for="email">Sähköpostisi: </label>
	<input type="email" name="email" required>

	<label for="subject">Aihe: </label>
	<input type="text" name="subject" required>

	<label for="message">Viesti: </label>
	<textarea autofocus style="resize: none; margin-left; auto; margin-right: auto; margin-top: 12px;" name="message" rows="7" cols="60" required></textarea><br><br>

	<div class="bc">
	<button type="submit" class="button-minimal" name="send">Lähetä</button>
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
	</div>
</form>
</div>
<?php
include_once 'footer1.php';
?>