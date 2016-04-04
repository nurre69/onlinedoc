<!DOCTYPE html>
<?php
session_start();
include('connection.php');
function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$user = htmlspecialchars($data);
	return $data;
}

	$user = $_POST["username"];
	$pw = $_POST["password"];
	
	$sql = "SELECT * FROM person WHERE typeid = 0";
	
	$result = $conn->query($sql);

	if($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc()) 
		{
		if($user && $pw) 
		{	
			if($row["username"] == $user && $row["password"] == $pw) 
			{
				$_SESSION['fn'] = test_input($row["firstname"]);
				$_SESSION['ln'] = test_input($row["lastname"]);
				$_SESSION['ssn'] = test_input($row["ssn"]);
				$_SESSION["dateofbirth"] = $row["dateofbirth"];
				$_SESSION["address"] = $row["address"];
				$_SESSION["email"] = $row["email"];
				$_SESSION["user"] = $row["username"];
				$_SESSION["password"] = $row["password"];
				$_SESSION["logged_in"] = 'yes';
				$_SESSION['LAST_ACTIVITY'] = time();
				header("location: home.php");
			}
			else
			{
				$_SESSION["error"] = "Käyttäjätunnus tai salasana väärin!";
			}		
		}
		}	
	}
if (empty($_SESSION["error"]))
{
	?>
	<style type="text/css">
	.boxerr{ display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.boxerr{ display:inline; }
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
<img src="drlogo.png" class="c">
</div>
<div class="menu"
<ul class="menu">
    <li><a href="login.php"><span class="active">> Kirjaudu sisään</span></a></li>
	<li><a href="register.php">> Rekisteröidy</a></li>
</ul>
</div>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Syötä käyttäjätunnus ja salasana. Jos sinulla ei ole tunnuksia, voit rekisteröityä 'Rekisteröidy' linkistä.</span></a>
<div class="boxerr err">
<span>Virhe: </span><?php echo $_SESSION["error"]; unset($_SESSION["error"]); ?>
</div>
<h1>Sisäänkirjautuminen</h1>
<div class="cc">
<form action="#" method="post" class="minimal">
	<label for="username"> Käyttäjätunnus:
		<input type="text" name="username" placeholder="Kirjoita käyttäjätunnuksesi" required/>
	</label>
	<label for="password"> Salasana:
		<input type="password" name="password" placeholder="Kirjoita salasanasi" required/>
	</label>
	<button type="submit" name="submit" class="button-minimal">Kirjaudu</button>
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</form>
	<br><p>Unohtuiko salasana? <a href="forgot.php">Paina tästä saadaksesi uuden.</a></p>
</div>
</div>
<div class="menu"
<ul class="menu">
    <li><a href="about2.php">> Tietoa meistä</a></li>
	<li><a href="contact2.php">> Ota yhteyttä</a></li>
</ul>
</div>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>