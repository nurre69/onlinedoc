<?php
session_start();
	$title = "Muuta henkilötietojasi";
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
		
		$sql1 = "UPDATE users
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
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Täytä kaikki kentät ja paina 'Päivitä tiedot'!</span></a>
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
			<input type="text" name="firstname" id="firstname" pattern="[A-Öa-ö -]+" value="<?php echo $_SESSION['fn']; ?>" required/><span class="req">Etunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="lastname">Sukunimi:</label>
			<input type="text" name="lastname" id="lastname" pattern="[A-Öa-ö -]+" value="<?php echo $_SESSION['ln']; ?>" required/><span class="req">Sukunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="address">Osoite:</label>
			<input type="text" name="address" id="address" pattern="([A-Öa-ö -]+)([0-9]{1,3}) ([A-Z]) ([0-9]{1,3})|([A-Öa-ö -]+)([0-9]{1,3})" value="<?php echo $_SESSION['address']; ?>" required/><span class="req">Virheellinen osoite.</span>
		</li>
		<li>
			<label for="email">Sähköpostiosoite:</label>
			<input type="email" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" required/><span class="req">Virheellinen sähköpostiosoite.</span>
		</li>
		<li>
			<label for="username">Käyttäjätunnus:</label>
			<input type="text" name="username" id="username" pattern="[A-Öa-ö]{5,10}" value="<?php echo $_SESSION['user']; ?>" required/><span class="req">Käyttäjätunnuksen täytyy olla 5-10 merkkiä pitkä ja sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="password">Salasana:</label>
			<input type="text" name="password" id="password" pattern="[A-Öa-ö]{5,20}[0-9]{1,20}|[0-9]{1,20}[A-Öa-ö]{5,20}" value="<?php echo $_SESSION['password']; ?>" required/><span class="req">Salasanassa täytyy olla vähintään 5 kirjainta ja yksi numero.</span>
		</li>
	</ul><br>
	<div class="bc">
	<button type="submit" class="button-minimal"><i class="fa fa-floppy-o" aria-hidden="true"></i> Tallenna tiedot</button>
	<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
	</div>
</form>
</div>
</div>
<?php
include_once 'footer2.php';
?>