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
	$sql = "SELECT email, password, firstname, lastname FROM person WHERE username = '$user'";
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
<?php
include_once 'footer1.php';
?>