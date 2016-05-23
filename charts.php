<?php
session_start();
$title = "Hae mittauksia";
include_once 'header2.php';
// Pitää lisätä scriptit ja linkit header2.php:n alusta
// ja pari pikku muotoilua,
// tsekkaa tyyli.css lopusta 
// 

?>
<div class="data">
<a class="tooltip" href="#"><img src="question.png" alt="Ohje!"><span>Valitse mittaustyyppi ja näet siihen liittyvät kuvaajan, jossa näkyvät mitatut arvot pitkällä aikavälillä!</span></a>
<?php			if(isset($_POST['submit']) && $_POST["mittari"]) 
				{?><div id="chartdiv">
					</div>
<?php			} ?>
<div class="cc">
				<form action="#" method="post" class="basic2">
				    <div class="bc">
				        <label for="mittari">Mittauksen tyyppi:</label>
					    <select name="mittari" size="1" tabindex="1" id="mittari" tabindex="1">
				    		<option value="1" 
				    			<?php if(isset($_POST['submit']) && $_POST['mittari'] == 1) echo "selected='selected'"; ?>>
         		    		Verensokeri</option>
				    		<option value="2" 
				    			<?php if(isset($_POST['submit']) && $_POST['mittari'] == 2) echo "selected='selected'"; ?>>
			    				Verenpaine</option>
			    			<option value="3" <?php if(isset($_POST['submit']) && $_POST['mittari'] == 3) echo "selected='selected'"; ?>>
			    				Ruumiinlämpö</option>
			    			<option value="4" <?php if(isset($_POST['submit']) && $_POST['mittari'] == 4) echo "selected='selected'"; ?>>
			    				Paino</option>		
				    	</select><br>
						<label for="raja">Tulosten lukumäärä:</label>
						<input type="range" name="raja" min="1" max="15" step="1" onchange="show_range.value=this.value" 
										tabindex="2" value="1" id="raja"/>
						<output name="show_range" for="range">1</output><br>
					</div>
					<div class="bc">
						<button type="submit" name="submit" class="button-minimal" tabindex="3">Hae tiedot</button>
					</div>
<?php

	include 'connection.php';
	
	$typeid = $_POST["mittari"];
	$ssn = $_SESSION["ssn"];
	$limit = $_POST["raja"];

if($_SERVER['REQUEST_METHOD'] == 'POST') 
{	
if (isset($_POST['submit'])){				
		$sql = "select value from measurements 
					where ssn = '$ssn' and typeid = '$typeid' limit 1";
	
		$result = $conn->query($sql);
		
		while($row = $result->fetch_assoc()) 
		{
			if(!$_SESSION["height"]) { $_SESSION["height"] = $row["value"]/100; }
		}
			
		$sql = "select m.*, m_t.measurement_unit from measurements m 
			inner join measurement_type m_t on m_t.typeid = m.typeid
			where m.ssn = '$ssn' and m.typeid = $typeid order by timestamp desc limit $limit";
	
		$result = $conn->query($sql);
		
		if($result->num_rows > 0) 
		{
		?><table id="tulos">
				<tr>
					<td colspan="3"><?php
						if($typeid == 1) 
						{ 
							echo "Verensokeri"; 
							$mittaus = "Verensokeri";
							$min = 4;
							$max = 6;	
						}
						elseif($typeid == 2) 
						{ 
							echo "Verenpaine"; 
							$mittaus = "Verenpaine";
							
							$minAla = 70;
							$minYla = 100;
							$maxAla = 90;
							$maxYla = 140;
						}
						elseif($typeid == 3) 
						{
							echo "Lämpötila"; 
							$mittaus = "Lämpötila";	
							$min = 35.8;
							$max = 37.2;
						}					
						elseif($typeid == 4) 
						{ 
							echo "Paino"; 
							$mittaus = "Paino";
							echo $_SESSION["height"];
							$min = $_SESSION["height"]*100 - 110;
							$max = $_SESSION["height"]*100 - 90;
						}	
				?></td>
				</tr>
			
				<tr>
					<th>#</th>
					<th>Mittausaika</th>
					<th>Mitattu arvo</th>
				</tr>		
		<?php
			$i = 1;
			
			while($row = $result->fetch_assoc()) 
			{
				$arvo = str_replace(',', '.', $row["value"]);
				
				$aika = $row["timestamp"];
				$aika = date("d.m.Y H.i.s", strtotime($aika));
						
				$aika = explode(" ", $aika);
				
			?>	<tr>
					<td>
						<?php echo $i; ?>
					</td>
					<td>
						<?php echo $aika[0]." klo ".$aika[1]?>
					</td>
					<td>
						<?php 
						if($typeid == 3) { 
												echo $arvo." °".$row["measurement_unit"] ;
												$unit = "°" . $row["measurement_unit"]; 
												}else { 
							  					echo $arvo." ".$row["measurement_unit"]; 
							  					$unit = $row["measurement_unit"]; 
												}
						if($typeid != 2){	?>
							 &nbsp;
							 <?php
							 if($arvo <= $min || $arvo >= $max) { ?>
								<i class="fa fa-times-circle fa-lg" style="color: red;" aria-hidden="true"></i>
							<?php } else { ?>
								<i class="fa fa-check-circle fa-lg" style="color: green;" aria-hidden="true"></i>
							<?php }
						} else {
										$arvo = explode("/", $row["value"]); ?>
										&nbsp;
										<?php if($arvo[0] >= $minYla && $arvo[1] >= $minAla && $arvo[0] <= $maxYla && $arvo[1] <= $maxAla) { ?>
										<i class="fa fa-check-circle fa-lg" style="color: green;" aria-hidden="true"></i> 
										<?php } else { ?> 
										<i class="fa fa-times-circle fa-lg" style="color: red;" aria-hidden="true"></i> 
										<?php }
									}
							$i++;
						} ?>
					</td>
				</tr>
				<?php
			} ?>
			</table>					
<?php
	}
	else
	{	?><img id="shokki" src="doc_1.jpg" alt="I don't know what happened!"><br>
		<p id="yksi">
			<table id="tulos" style="width: 71%">
				<tr>
					<td>
						<?php echo "Valitse mittaus ja tulosten lukumäärä!"; ?>
					</td>
				</tr>
			</table>
		</p>	
<?php	}			
}	?>

<script type="text/javascript">
var legend = new AmCharts.AmLegend();
var chart = AmCharts.makeChart("chartdiv", {
	 "legend": {
        "enabled": true,
        "useGraphSettings": true,
        "labelPosition": "top",
        "switchable": false
    },
	 "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled": true,
    "dataDateFormat": "DD.MM.YYYY JJ:mm:ss",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "unit": " <?php echo $unit; ?>",
        "unitPosition": "right" 
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0,
       
    },
    "graphs": [{
        "id": "g1",
        "balloon": {
          "drop": true,	
          "adjustBorderColor": false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 3,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "lineColor": "#1F00EB",
<?php if ($typeid == 2) { ?>
			"title": "Systolinen paine",	
<?php }
else { ?>
			"title": "<?php echo $mittaus; ?>",
<?php } ?>
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:15px;'>[[value]]</span>"
    }
<?php
	if ($typeid == 2) {
?>
	,{
        "id": "g2",
        "balloon": {
          "drop": true,
          "adjustBorderColor": false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#00FF00",
        "bulletSize": 3,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "lineColor": "#EB000A",
        "title": "Diastolinen paine",
        "useLineColorForBulletBorder": true,
        "valueField": "value2",
        "balloonText": "<span style='font-size:15px;'>[[value2]]</span>"
    }	
<?php		
	}
?>    
    ],
    "chartScrollbar": {
    	  "enabled": false,
        "graph": "g1",
        "oppositeAxis": false,
        "offset": 30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount": true,
        "color": "#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": false,
        "valueLineBalloonEnabled": true,
        "cursorAlpha": 1,
        "cursorColor":"#258cbb",
        "limitToGraph": "g1",
        "valueLineAlpha": 0.2,
        "categoryBalloonDateFormat": "JJ.mm.ss"
    },
    "valueScrollbar": {
    	"enabled": false,
      "oppositeAxis": false,
      "offset": 50,
      "scrollbarHeight": 10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": false,
        "dashLength": 1,
        "minorGridEnabled": true,
        "minPeriod": "ss",
        "groupToPeriods" : ["DD", "WW","MM"],
        "axisAlpha": 0,
        "labelRotation": 45
    },
    "export": {
        "enabled": true
    },
    "dataProvider": [
    		<?php $sql = "SELECT m.*, replace(m.value, ',', '.') as arvo, m_t.measurement_unit as yks FROM measurements m
	    					INNER JOIN measurement_type m_t on m.typeid = m_t.typeid
	    					WHERE m.ssn = '$ssn' AND m.typeid = $typeid
	    					ORDER BY m.timestamp";
	    					
	   	$result = $conn->query($sql); 
	    
	  		if($result->num_rows > 0) 
			{
				while ($row = $result->fetch_assoc()) 
				{
					$aika = date("d.m.Y H:i:s", strtotime($row["timestamp"]));
					
					if($typeid == 2) 
					{
						$arvo = explode("/", $row["value"]);
						echo "{\n\"date\": \"" . $aika . "\",\n\"value\": " . $arvo[0] . ",\n" .
								"\"value2\": " . $arvo[1] . "\n},\n";
					}
					else 
					{
						echo "{\n\"date\": \"" . $aika . "\",\n\"value\": " . $row['arvo'] . "\n},\n";							
					}

	
  				}
  			} ?>
						],
			"guides": 
    		[{
      		"fillAlpha": 0.10,
      		"fillColor": "#0AFF00",
      		"value": <?php if ($typeid == 1) { echo "4";	} 
									elseif ($typeid == 2) { echo "80"; }
									elseif ($typeid == 3) { echo "35.5"; } 
									elseif ($typeid == 4) { 
										$height2 = pow($_SESSION['height'], 2);
										$weightMin = $height2 * 17;
										echo $weightMin; } ?>
      		,
      		"toValue": <?php if ($typeid == 1) { echo "6";	} 
									elseif ($typeid == 2) { echo "120"; }
									elseif ($typeid == 3) { echo "37.5"; }
									elseif ($typeid == 4) { 
										$height2 = pow($_SESSION['height'], 2);
										$weightMax = $height2 * 30;
										echo $weightMax; }  ?>
    		}]
 });
chart.addTitle("<?php echo $mittaus; ?>");
chart.addListener("rendered", zoomChart);
chart.addLegend(legend);
zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}

</script>
				
  			</form>
			</div>
  			</div>
<?php include_once 'footer2.php';