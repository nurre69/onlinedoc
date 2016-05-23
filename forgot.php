<?php
session_start();
$title = "Unohtunut salasana";
include_once 'header1.php';
include 'connection.php';
	
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$user = $_POST["username"];
	$comment = "";
	$admin = "admin@onlinedoc.com";
	$subject = "Unohtunut salasana";
	$sql = "SELECT email, password, firstname, lastname FROM users WHERE username = '$user'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) 
			{
			$email = $row["email"];
			$name = $row["firstname"] . " " . $row[lastname];
			$comment = "Hei ". $name . ",\r\n\r\n" . "Salasanasi onlinedoc -palveluun on: " . $row["password"].".\r\n\r\n"."Terveisin, onlinedoc -palvelu.";
			mail($email,$subject,$comment, $admin);
			$_SESSION["msg"] = "Salasana on lähetetty sähköpostiisi.";
			}
	}
	else {
		$_SESSION["error"] = "Virhe: Käyttäjätunnusta ei löydy.";
	}
}
?>
<div class="data">
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
<h3>Kirjoita käyttäjätunnuksesi niin lähetämme sinulle salasanasi sähköpostiin: </h3>
<div class="cc">
<form method="post" action="#" class="minimal">
<input type="text" name="username">
<div class="bc">
<button type="submit" class="button-minimal"><i class="fa fa-reply" aria-hidden="true"></i> Lähetä uusi salasana</button>
<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
</div>
</form>
</div>
</div>
<?php
include_once 'footer1.php';
?>