<!DOCTYPE html>
<?php
	session_start();
	include 'connection.php';
	$last = $_POST["lastname"];
	$first = $_POST["firstname"];
	$ssn = $_POST["ssn"];
	$addr = $_POST["address"];
	$email = $_POST["email"];
	$dob = $_POST["date_of_birth"];
	$user = $_POST["username"];
	$pw = $_POST["password"];
	$length = $_POST["length"];
	$sex = $_POST["sex"];
	
	if(isset($_POST['submit'])) 
	{		
		if($sex == 1)
		{ $sex = 'Male'; }
		elseif($sex == 2)
		{ $sex = 'Female'; }
		elseif($sex == 3)
		{ $sex = 'Other'; }
			
		$sql1 = "INSERT INTO measurements (value, typeid, ssn)
			VALUES ('$length', '6', '$ssn')";
			
		$result1 = $conn->query($sql1);
		
		if(!$result1)
		{
			$_SESSION["msg"] = "Pieleen meni!";
		}
		
		$sql = "INSERT INTO person
				VALUES ('$ssn', '$first', '$last', '$sex', '$user', '$pw', '$dob', '$addr', '$email', 0)";
	
		$result = $conn->query($sql);
	
		if(!$result)
		{
			$_SESSION["msg"] = "Pieleen meni!";
		} else 	
		{
			$_SESSION["ssn"] = $ssn;
			$_SESSION["fn"] = $first;
			$_SESSION["ln"] = $last;
			$_SESSION["addr"] = $addr;
			$_SESSION["email"] = $email;
			$_SESSION["user"] = $user;
			$_SESSION["password"] = $pw;
			$_SESSION["logged_in"] == 'yes';
			
			$_SESSION["msg"] = "Tietojen syöttäminen onnistui. Siirryt kohta sisäänkirjautumiseen.";
			header("refresh:3; url=login.php");
		}
	}
if (empty($_SESSION["msg"]))
{
	?>
	<style type="text/css">
	.boxsuc{ display:none; }
	</style>
	<?php
} else 
{
	?>
	<style type="text/css">
	.boxsuc{ display:inline; }
	</style>
	<?php
}
?>
<html lang="en">
	<head>
		<title>onlinedoc -lääkäripalvelu</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" media="screen" href="tyyli.css" />
		<link href='https://fonts.googleapis.com/css?family=Arimo' rel='stylesheet' type='text/css'>
	</head>
<body>
<div class="bg">
<img class="c" src="drlogo.png">
<nav>
<ul class="menu">
    <li><a href="login.php">> Kirjaudu sisään</a></li>
	<li><a href="register.php"><span class="active">> Rekisteröidy</span></a></li>
</ul>
</nav>
<div class="data">
<a class="tooltip" href="#"><img src="question.png"><span>Täytä kaikki kentät ja paina 'Lähetä tiedot'!</span></a>
<div class="boxsuc suc">
<span><?php echo $_SESSION["msg"]; unset($_SESSION["msg"]); ?></span>
</div>
<h2>Rekisteröidy palveluun</h2>
<div class="cc">
<form class="register" method="post" action="#" name="register">
	<ul>
		<li>
			<label for="firstname">Etunimi:</label>
			<input type="text" name="firstname" pattern="[A-Öa-ö -]+" value="<?php echo $first; ?>" required /><span class="req">Etunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="lastname">Sukunimi:</label>
			<input type="text" name="lastname" pattern="[A-Öa-ö -]+" value="<?php echo $last; ?>" required /><span class="req">Sukunimi saa sisältää vain kirjaimia.</span>		
		</li>
		<li>
			<label for="date_of_birth">Syntymäaika:</label>
			<input type="date" name="date_of_birth" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01]).(0[1-9]|1[012]).[0-9]{4}" value="<?php echo $dob; ?>" required /><span class="req">Syntymäaika on muotoa pp.kk.vvvv.</span>
		</li>
		<li>
			<label for="address">Osoite:</label>
			<input type="text" name="address" pattern="([A-Öa-ö -]+)([0-9]{1,3}) ([A-Ö]) ([0-9]{1,3})|([A-Öa-ö -]+)([0-9]{1,3})" value="<?php echo $addr; ?>" required /><span class="req">Osoite on muotoa Esimerkkitie 1 A 2.</span>
		</li>
		<li>
			<label for="email">Sähköposti:</label>
			<input type="email" name="email" value="<?php echo $email; ?>" required /><span class="req">Sähköpostiosoite on muotoa erkki@posti.fi.</span>
		</li>
		<li>
			<label for="ssn">Henkilötunnus:</label>
			<input type="text" name="ssn" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])(0[1-9]|1[012])[0-9]{2}-([0-9]{3}[A-Ö])" value="<?php echo $ssn; ?>" required /><span class="req">Henkilötunnus on muotoa 123456-123A.</span>
		</li>
		<li>
			<label for="username">Käyttäjätunnus:</label>
			<input type="text" name="username" pattern="[A-Öa-ö]{5,10}" value="<?php echo $user; ?>" required /><span class="req">Käyttäjätunnuksen täytyy olla 5-10 merkkiä pitkä ja sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="password">Salasana:</label>
			<input type="text" name="password" pattern="[A-Öa-ö]{5,20}[0-9]{1,20}|[0-9]{1,20}[A-Öa-ö]{5,20}" value="<?php echo $pw; ?>" required /><span class="req">Salasanassa täytyy olla vähintään 5 kirjainta ja yksi numero.</span>
		</li>
		<li>
			<label for="pituus">Pituus:</label>
			<input type="number" name="length" min="100" max="230" pattern="([0-9]{2,3},[0-9]{1})|([0-9]{2,3})" value="<?php echo $length; ?>" required /><span class="req">Pituus senttimetreissä muodossa xxx, tämän voi syöttää myös myöhemmin palvelussa.</span>
		</li>
		<li>
			<label for="sex">Sukupuoli:</label><input type="radio" name="sex" value="1" checked>Mies <input type="radio" name="sex"value="2">Nainen
		</li>
</form>
<div class="bc">
		<button type="submit" name="submit" class="button-minimal">Lähetä tiedot</button>
		<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</div>
</div>
</div>
<nav>
<ul class="menu">
    <li><a href="about2.php">> Tietoa meistä</a></li>
	<li><a href="contact2.php">> Ota yhteyttä</a></li>
</ul>
</nav>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>