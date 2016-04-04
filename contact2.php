<!DOCTYPE html>
<?php
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
<html lang="en">
	<head>
		<title>onlinedoc -lääkäripalvelu</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="css" media="screen" href="tyyli.css" />
		<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	</head>
<body>
<div class="bg">
<div style="margin-left: 20%; margin-right: 20%;">
<img class="c" src="drlogo.png">
</div>
<div class="menu"
<ul class="menu">
    <li><a href="login.php">> Kirjaudu sisään</a></li>
	<li><a href="register.php">> Rekisteröidy</a></li>
</ul>
</div>
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
<div class="menu"
<ul class="menu">
    <li><a href="about2.php">> Tietoa meistä</a></li>
	<li><a href="contact2.php"><span class="active">>Ota yhteyttä</span></a></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>