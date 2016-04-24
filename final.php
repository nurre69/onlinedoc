<!DOCTYPE html>
<?php
session_start();
	$title = "Kiitos vastauksestasi";
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
<script type="text/javascript">
(function(){
   setTimeout(function(){
     window.location="http://users.metropolia.fi/~niikan/home.php";
   },5000); /* 1000 = 1 second*/
})();
</script>
<div class="data">
<h2>Kiitos vastauksestasi, sinut ohjataan hetken kuluttua etusivulle.</h2>
</div>
<?php
include_once 'footer2.php';
?>