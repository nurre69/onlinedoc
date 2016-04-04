<!DOCTYPE html>
<?php
session_start();
	include 'connection.php';
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$user = $_POST["username"];
	$comment = "";
	$admin = "admin@onlinedoc.com";
	$subject = "Unohtunut salasana";
	$sql = "SELECT email, password FROM person WHERE username = '$user'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
			{
			$email = $row["email"];
			$comment = "Salasanasi onlinedoc -palveluun on: " . $row["password"] . ". Terveisin, onlinedoc -palvelu.";
			mail($email,$subject,$comment, $admin);
			$_SESSION["msg"] = "Salasana on lähetetty sähköpostiisi.";
			}
	}
	else {
		$_SESSION["error"] = "Virhe: Käyttäjätunnusta ei löydy.";
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
    <li><a href="login.php">> Kirjaudu sisään</a></li>
	<li><a href="register.php">> Rekisteröidy</a></li>
</ul>
</div>
<div class="data">
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<form method="post" action="#" class="minimal">
<h3>Kirjoita käyttäjätunnuksesi niin lähetämme sinulle salasanasi sähköpostiin: </h3>
<input type="text" name="username">
<button type="submit" class="button-minimal">Lähetä</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</form>
</div>
<div class="menu"
<ul class="menu">
    <li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>