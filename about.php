<!DOCTYPE html>
<?php
session_start();
	$title = "Tietoa meistä";
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
?>
<div class="data">
<h1>onlinedoc -sovellus</h1><br>
<p class="center">
Olemme kolme mediaseksikästä ja retroseksuaalista hyvinvointiteknologian opiskelijaa. Kiitos.<br><br>
</p>
<div class="bc">
<button type="button" class="button-minimal" onclick="history.go(-1);return true;">Takaisin</button>
</div>
</div>
<?php
include_once 'footer2.php';
?>