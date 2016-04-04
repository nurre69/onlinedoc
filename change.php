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

function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$user = htmlspecialchars($data);
	return $data;
}
	include 'connection.php';
	
	$last = $_POST["lastname"];
	$first = $_POST["firstname"];
	$addr = $_POST["address"];
	$email = $_POST["email"];
	$user = $_POST["username"];
	$pw = $_POST["password"];
	$ssn = $_SESSION['ssn'];
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{	
			$first = test_input($first);
			$last = test_input($last);
			$addr = test_input($addr);
			$email = test_input($email);
			$user = test_input($user);
			$pw = test_input($pw);
	}
	if($first && $last && $addr && $email && $user && $pw) 
	{		
		
		$sql1 = "UPDATE person
					SET firstname = '$first', lastname = '$last', username = '$user', password = '$pw',
						address = '$addr', email = '$email'
					WHERE ssn = '$ssn'";
	
		$result1 = $conn->query($sql1);
	
		if(!$result1)
			$_SESSION["error"] = "Virhe: Tuntematon virhe.";
		else 	
		{
			$_SESSION["ssn"] = $ssn;
			$_SESSION["fn"] = $first;
			$_SESSION["ln"] = $last;
			$_SESSION["addr"] = $addr;
			$_SESSION["email"] = $email;
			$_SESSION["user"] = $user;
			$_SESSION["password"] = $pw;
			$_SESSION["msg"] = "Tietojen muuttaminen onnistui. Siirryt kohta päävalikkoon.";
			header("refresh:3; url=home.php");
		}
	}
?>
<?php
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
    <li><a href="profile.php"><span class="active">> Henkilötiedot</span></a></li>
		<li><a href="#">> Mittaustulokset</a>
		<ul>
		<li><a href="insert.php">> Syötä mittaustuloksia</a></li>
		<li><a href="search.php">> Hae mittaustuloksia</a></li>
		</ul>
	</li>
	<li><a href="service.php">> Diagnoosi</a></li>
	<li style="float: right;"><a href="logout.php">> Kirjaudu ulos</a></li>
</ul>
</div>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Täytä kaikki kentät ja paina 'Päivitä tiedot'!</span></a>
<div class="boxerr err">
<span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?></span>
</div>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Muuta henkilötietojasi:</h2>
<div class="cc">
<form action="#" method="post" class="register">
	<ul>
		<li>
			<label for="firstname">Etunimi:</label>
			<input type="text" name="firstname" pattern="[A-Öa-ö -]+" value="<?php echo $_SESSION['fn']; ?>" required/><span class="req">Etunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="lastname">Sukunimi:</label>
			<input type="text" name="lastname" pattern="[A-Öa-ö -]+" value="<?php echo $_SESSION['ln']; ?>" required/><span class="req">Sukunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="address">Osoite:</label>
			<input type="text" name="address" pattern="([A-Öa-ö -]+)([0-9]{1,3}) ([A-Z]) ([0-9]{1,3})|([A-Öa-ö -]+)([0-9]{1,3})" value="<?php echo $_SESSION['address']; ?>" required/><span class="req">Virheellinen osoite.</span>
		</li>
		<li>
			<label for="email">Sähköpostiosoite:</label>
			<input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required/><span class="req">Virheellinen sähköpostiosoite.</span>
		</li>
		<li>
			<label for="username">Käyttäjätunnus:</label>
			<input type="text" name="username" pattern="[A-Öa-ö]{5,10}" value="<?php echo $_SESSION['user']; ?>" required/><span class="req">Käyttäjätunnuksen täytyy olla 5-10 merkkiä pitkä ja sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="password">Salasana:</label>
			<input type="text" name="password" pattern="[A-Öa-ö]{5,20}[0-9]{1,20}|[0-9]{1,20}[A-Öa-ö]{5,20}" value="<?php echo $_SESSION['password']; ?>" required/><span class="req">Salasanassa täytyy olla vähintään 5 kirjainta ja yksi numero.</span>
		</li>
	</ul><br>
	<div class="bc">
	<button type="submit" class="button-minimal">Päivitä tiedot</button>	
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
	</div>
</form>
</div>
</div>
<div class="menu"
<ul class="menu">
    <li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
	<li style="float: right;"><p>Kirjautuneena: <?php echo $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></p></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>