<?php
session_start();
$title = "Rekisteröityminen";
include_once 'header1.php';
include('connection.php');
	
	$last = $_POST["lastname"];
	$first = $_POST["firstname"];
	$ssn = $_POST["ssn"];
	$addr = $_POST["address"];
	$email = $_POST["email"];
	$user = $_POST["username"];
	$pw = $_POST["password"];
	$length = $_POST["length"];
	$weight = $_POST["weight"];
	$sex = $_POST["sex"];
	function born($ssn) {

	$vuosisadat = array('+' => '18', '-' => '19', 'A' => '20');//eri vuosisatojen välimerkit
	
	$vuosisata = $vuosisadat[substr($ssn,6,1)]; 

	$kk = substr($ssn,2,2);	
	$pv = substr($ssn,0,2);
	$vuosi = $vuosisata . substr($ssn,4,2);
	
	$dob = $vuosi."-".$kk."-".$pv;
	
	return $dob;
	
}
born($ssn);
	
	if(isset($_POST['submit'])) {		
		if($sex == 1)
		{ $sex = 'Male'; }
		elseif($sex == 2)
		{ $sex = 'Female'; }
	
		$_SESSION["dateofbirth"] = born($ssn);
		$dob = $_SESSION["dateofbirth"];
		
			$sql = "SELECT ssn FROM users WHERE ssn = '$ssn'";			
			$result = $conn->query($sql);
			
			if($result->num_rows < 1){
			} else {
				$_SESSION["error"] = "Henkilötunnus on jo käytössä!";
			}
			
				$sql = "SELECT username FROM users WHERE username = '$user'";
				$result = $conn->query($sql);
				if($result->num_rows < 1){
				} else {
					$_SESSION["error"] = "Käyttäjätunnus on jo käytössä!";
				}

				$sql = "SELECT email FROM users WHERE email = '$email'";
				$result = $conn->query($sql);
				if($result->num_rows < 1){
				} else {
					$_SESSION["error"] = "Sähköpostiosoite on jo käytössä!";
				}
			if (empty($_SESSION["error"])){
				$sql = "INSERT INTO users
					VALUES ('$ssn', '$first', '$last', '$sex', '$user', '$pw', '$dob', '$addr', '$email', 0)";

					$result = $conn->query($sql);
	
					if(!$result)
					{
						$_SESSION["error"] = "Rekisteröityminen ei onnistu. Ota yhteyttä ylläpitoon!";
					} else {
						$_SESSION["ssn"] = $ssn;
						$_SESSION["fn"] = $first;
						$_SESSION["ln"] = $last;
						$_SESSION["addr"] = $addr;
						$_SESSION["email"] = $email;
						$_SESSION["user"] = $user;
						$_SESSION["password"] = $pw;
						$_SESSION["logged_in"] == 'yes';
						
						if(!empty($_POST["length"])){
					$sql = "INSERT INTO measurements (value, typeid, ssn)
					VALUES ('$length', '5', '$ssn')";
			
					$result = $conn->query($sql);
		
					if(!$result)
					{
						$_SESSION["error"] = "Painoa ei saatu syötettyä!";
					}
				}
			
				if(!empty($_POST["weight"])){
					$sql = "INSERT INTO measurements (value, typeid, ssn)
					VALUES ('$weight', '4', '$ssn')";
			
					$result = $conn->query($sql);
		
					if(!$result)
					{
						$_SESSION["error"] = "Painoa ei saatu syötettyä!";
					}
				}
					
						$_SESSION["msg"] = "Tietojen syöttäminen onnistui. Siirryt kohta sisäänkirjautumiseen.";
						header("refresh:3; url=login.php");
					}
				}
			}
?>
<div class="data">
<a class="tooltip" href="#"><img alt="Ohje!" src="question.png"><span>Täytä kaikki kentät ja paina 'Lähetä tiedot'!</span></a>
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
<h1>Rekisteröidy palveluun</h1>
<div class="cc">
<form class="register" method="post" name="register">
	<ul>
		<li>
			<label for="firstname">Etunimi:</label>
			<input type="text" name="firstname" id="firstname" pattern="[A-Öa-ö -]+" value="<?php echo $first; ?>" required /><span class="req">Etunimi saa sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="lastname">Sukunimi:</label>
			<input type="text" name="lastname" id="lastname" pattern="[A-Öa-ö -]+" value="<?php echo $last; ?>" required /><span class="req">Sukunimi saa sisältää vain kirjaimia.</span>		
		</li>
		<li>
			<label for="address">Osoite:</label>
			<input type="text" name="address" id="address" pattern="([A-Öa-ö -]+)([0-9]{1,3}) ([A-Ö]) ([0-9]{1,3})|([A-Öa-ö -]+)([0-9]{1,3})" value="<?php echo $addr; ?>" required /><span class="req">Osoite on muotoa Esimerkkitie 1 A 2.</span>
		</li>
		<li>
			<label for="email">Sähköposti:</label>
			<input type="email" name="email" id="email" value="<?php echo $email; ?>" required /><span class="req">Sähköpostiosoite on muotoa erkki@posti.fi.</span>
		</li>
		<li>
			<label for="ssn">Henkilötunnus:</label>
			<input type="text" name="ssn" id="ssn" pattern="(0[1-9]|1[0-9]|2[0-9]|3[01])(0[1-9]|1[012])[0-9]{2}-([0-9]{3}[A-Ö])|(0[1-9]|1[0-9]|2[0-9]|3[01])(0[1-9]|1[012])[0-9]{2}-([0-9]{4})" value="<?php echo $ssn; ?>" required /><span class="req">Henkilötunnus on muotoa 123456-123A.</span>
		</li>
		<li>
			<label for="username">Käyttäjätunnus:</label>
			<input type="text" name="username" id="username" pattern="[A-Öa-ö]{5,10}" value="<?php echo $user; ?>" required /><span class="req">Käyttäjätunnuksen täytyy olla 5-10 merkkiä pitkä ja sisältää vain kirjaimia.</span>
		</li>
		<li>
			<label for="password">Salasana:</label>
			<input type="text" name="password" id="password" pattern="[A-Öa-ö]{5,20}[0-9]{1,20}|[0-9]{1,20}[A-Öa-ö]{5,20}" value="<?php echo $pw; ?>" required /><span class="req">Salasanassa täytyy olla vähintään 5 kirjainta ja yksi numero.</span>
		</li>
		<li>
			<label for="length">Pituus:</label>
			<input type="number" name="length" id="length" min="100" max="230" value="<?php echo $length; ?>"/><span class="req">Pituus senttimetreissä muodossa xxx, tämän voi syöttää myös myöhemmin palvelussa.</span>
		</li>
		<li>
			<label for="weight">Paino:</label>
			<input type="number" name="weight" id="weight" min="30" max="200" value="<?php echo $weight; ?>"/><span class="req">Paino kilogrammoina muodossa xxx, tämän voi syöttää myös myöhemmin palvelussa.</span>
		</li>
		<li>
			Sukupuoli:
			<label for="mies"><input type="radio" id="mies" name="sex" value="1" checked>Mies</label>
			<label for="nainen"><input type="radio" id="nainen" name="sex" value="2">Nainen</label>
		</li>
	</ul>
<div class="bc">
		<button type="submit" name="submit" class="button-minimal"><i class="fa fa-user-plus" aria-hidden="true"></i> Rekisteröidy</button>
		<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
</div>
</form>
</div>
</div>
<?php
include_once 'footer1.php';
?>