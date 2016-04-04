<!DOCTYPE html>
<?php
session_start();
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
	mail($admin_email, "$subject", $comment, "From:" . $email);
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
	<li><a href="home.php">> Etusivu</a></li>
		<li><a href="#">> Mittaustulokset</a>
		<ul>
		<li><a href="insert.php">> Syötä mittaustuloksia</a></li>
		<li><a href="search.php">> Hae mittaustuloksia</a></li>
		</ul>
	</li>
	<li><a href="service.php">> Tulosten tulkinta</a></li>
	<li><a href="profile.php">> Henkilötiedot</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
</ul>
</div>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Kirjoita viestisi ylläpidolle ja paina 'Lähetä'!</span></a>
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Ota yhteyttä palvelun ylläpitoon:</h2><br>

<form method="post" class="basic">

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
    <li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php"><span class="active">> Ota yhteyttä</span></a></li>
	<li style="float: right;"><p>Kirjautuneena: <?php echo $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></p></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>