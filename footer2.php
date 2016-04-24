<nav>
<ul class="menu">
<?php 
	if($title == 'Ota yhteyttä')
	{
?>		
	<li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php"><span class="active">>Ota yhteyttä</span></a></li>
<?php }
	elseif($title == 'Tietoa meistä') 
	{
?>
	<li><a href="about.php"><span class="active">> Tietoa meistä</span></a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
<?php }
	else {
?>			
	<li><a href="about.php">> Tietoa meistä</a></li>
	<li><a href="contact.php">> Ota yhteyttä</a></li>
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