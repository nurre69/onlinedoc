<nav>
<ul class="menu">
<?php
	if($title == 'Tietoa meistä') 
	{
?>
	<li class="active"><a href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i> Tietoa meistä</a></li>
	<li style="float:right;"><a href="profile.php"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo "Kirjautuneena: " . $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></a></li>
<?php }
	else {
?>			
	<li><a href="about.php"><i class="fa fa-info-circle" aria-hidden="true"></i> Tietoa meistä</a></li>
	<li style="float:right;"><a href="profile.php"><i class="fa fa-check-circle-o" aria-hidden="true"></i> <?php echo "Kirjautuneena: " . $_SESSION["fn"] . " " . $_SESSION["ln"]; ?></a></li>
<?php
	}
?>
</ul>
</nav>
<footer>
Page created by Metropolia Hyte Ryhmä 6: Nurmimaa, Kuutti, Pakkala. © 2016 
</footer>
</div>
</body>
</html>