<?php
session_start();
$title = "onlinedoc -lääkäripalvelu";
include_once 'header1.php';
?>
<div class="data">
<h1>Tervetuloa onlinedoc -lääkäripalveluun</h1><br>
<div class="cc">
<p>
Onlinedoc on palvelu, johon voit tallentaa henkilökohtaisia terveystietoja.<br><br>
Palveluun voit tallentaa: <br></p>
<ul class="lista">
<li>Veren glukoosiarvon</li>
<li>Verenpaineen</li>
<li>Ruumiinlämmön</li>
<li>Painon</li>
<li>Pituuden</li>
</ul>
<p>
Voit halutessasi myös tutkia tallentamiasi arvoja. Arvojen seuraamisessa auttavat kuvaajat, joiden avulla on helppo nähdä arvojen muutokset.<br><br>

Onlinedoc-palvelu antaa arvion tallentamiesi arvojen pysymisestä viitearvojen sisällä. Lisäksi saat omahoito-ohjeita terveiden elämäntapojen ylläpitämiseksi.<br><br>

Tulokset on mahdollista lähettää sähköpostilla eteenpäin. Palvelun avulla voit myös ottaa yhteyden lääkäriin.<br>

</p>
<h3>Joka sivulta löydät ohjeet kysymysmerkistä: </h3>
    <img class="c" alt="Ohje!" src="question.png">
</div>
</div>
<?php
include_once 'footer1.php';
?>