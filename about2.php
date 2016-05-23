<?php
session_start();
$title = "Tietoa meistä";
include_once 'header1.php';
?>
<div class="data">
<h1>onlinedoc -sovellus</h1><br>
<p class="center">
Olemme kolme mediaseksikästä ja retroseksuaalista hyvinvointiteknologian opiskelijaa. Kiitos.<br><br>
</p>
<div class="bc">
<button type="button" class="button-minimal" onclick="history.go(-1);return true;"><i class="fa fa-history" aria-hidden="true"></i> Takaisin</button>
</div>
</div>
<?php
include_once 'footer1.php';
?>