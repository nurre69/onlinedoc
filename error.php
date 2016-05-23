<?php session_start();
	$title = "Ota yhteyttä";
	include_once 'header1.php';
?>
<div class="data">
<a class="tooltip" href="#"><img alt="Ohje!" src="question.png"><span>Jouduit tälle sivulle, koska et ole kirjautunut sisään tai järjestelmä kirjautui automaattisesti ulos viiden minuutin toimettomuuden takia.</span></a>
<h1>Sinun täytyy kirjautua sisään päästäksesi tälle sivulle!</h1><br>
<p class="center">
Istuntosi ehti vanhentua tai et ole kirjautunut sisään. Voit kirjautua sisään <a href="login.php">tästä</a>.
</p>
</div>
<?php
include_once 'footer1.php';
?>