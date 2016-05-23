<?php
session_start();
$title = "Kirjaudu sisään";
include_once 'header1.php';
include('connection.php');
function test_input($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
	$user = $_POST["username"];
	$pw = $_POST["password"];
	
	$sql = "SELECT * FROM users WHERE typeid = 0";
	
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
?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" class="ohje" alt="Tästä kysymysmerkistä saat ohjeita"><span>Syötä käyttäjätunnus ja salasana. Jos sinulla ei ole tunnuksia, voit rekisteröityä 'Rekisteröidy' linkistä.</span></a>
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
<h1>Sisäänkirjautuminen</h1>
<div class="cc">
<form action="#" method="post" class="minimal">
	<label for="username"> Käyttäjätunnus:</label>
		<input type="text" name="username"  id="username" placeholder="Kirjoita käyttäjätunnuksesi" required tabindex="1"/>
	<label for="password"> Salasana:</label>
		<input type="password" name="password" id="password" placeholder="Kirjoita salasanasi" required  tabindex="2"/>
	<div class="bc">
	<button type="submit" name="submit" class="button-minimal"  tabindex="3"><i class="fa fa-sign-in" aria-hidden="true"></i> Kirjaudu</button>
	<button type="button" class="button-minimal" onclick="location.href='index.php'"  tabindex="4"><i class="fa fa-home" aria-hidden="true"></i> Etusivulle</button>
	</div>
</form>
</div>
	<br><a href="forgot.php" tabindex="5"><p style="text-align:center;">Unohtuiko salasana?</p></a>
</div>
<?php
include_once 'footer1.php';
?>
