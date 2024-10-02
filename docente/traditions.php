<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

if (!isset($_POST['factor'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
} else {
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new FactorController();
	$factorObject = $controller -> getEntityAction($factor);
}

if (!$factorObject) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}
?>
<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- html5.js for IE less than 9 -->
		<!--[if lt IE 9]>
		<script
		src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>Reporte Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/favicon_.png">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" href="../css/chart.css">
		<link rel="stylesheet" href="../css/factorTable.css">
		<link rel="stylesheet" href="../css/description.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>

		<div class="container-fluid">
			<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<hr />
			
			<?php 
			
			$traditionsController = new TraditionsContextController();
			$traditionsList = $traditionsController->displayAction();
			$traditionsTotal = count($traditionsList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$traditionsArray1 = array();
			$traditionsArray2 = array();
			$traditionsArray3 = array();

			
			$traditionsName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			
			
			foreach ($traditionsList as $traditionsEntry) {

				switch($traditionsEntry->getP11O2()) {
					case 0 :
						++$traditionsArray1[0];
						break;
					case 1 :
						++$traditionsArray1[1];
						break;
					case 2 :
						++$traditionsArray1[2];
						break;
					case 3 :
						++$traditionsArray1[3];
						break;
					case 999 :
						++$traditionsArray1[4];
						break;
				}
				
				switch($traditionsEntry->getP11O3()) {
					case 0 :
						++$traditionsArray2[0];
						break;
					case 1 :
						++$traditionsArray2[1];
						break;
					case 2 :
						++$traditionsArray2[2];
						break;
					case 3 :
						++$traditionsArray2[3];
						break;
					case 999 :
						++$traditionsArray2[4];
						break;
				}
				
				switch($traditionsEntry->getP11O4()) {
					case 0 :
						++$traditionsArray3[0];
						break;
					case 1 :
						++$traditionsArray3[1];
						break;
					case 2 :
						++$traditionsArray3[2];
						break;
					case 3 :
						++$traditionsArray3[3];
						break;
					case 999 :
						++$traditionsArray3[4];
						break;
				}
				
				
				
			}

			$data1 = "[['Valor', 'Frecuencia', { role: 'annotation' }],";
			for ($i = 0; $i < count($traditionsArray1); $i++) {
				$traditionsPercent1 = round(($traditionsArray1[$i] / $traditionsTotal * 100), 2);
				$data1 .= "['" . $traditionsName1[$i] . "'," . $traditionsArray1[$i] . ",'" . $traditionsPercent1 . "%'],";
			}
			$data1 .= ']';
			

			$data2 = "[['Valor', 'Frecuencia', { role: 'annotation' }],";
			for ($i = 0; $i < count($traditionsArray2); $i++) {
				$traditionsPercent2 = round(($traditionsArray2[$i] / $traditionsTotal * 100), 2);
				$data2 .= "['" . $traditionsName1[$i] . "'," . $traditionsArray2[$i] . ",'" . $traditionsPercent2 . "%'],";
			}
			$data2 .= ']';

			$data3 = "[['Valor', 'Frecuencia', { role: 'annotation' }],";
			for ($i = 0; $i < count($traditionsArray3); $i++) {
				$traditionsPercent3 = round(($traditionsArray3[$i] / $traditionsTotal * 100), 2);
				$data3 .= "['" . $traditionsName1[$i] . "'," . $traditionsArray3[$i] . ",'" . $traditionsPercent3 . "%'],";
			}
			$data3 .= ']';

			$dataRegion = "[['Valor', 'Media', { role: 'annotation' }],";
			$dataRegion .= "['Estado'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "'],";
			for ($i = 0; $i < count($factorRegionList); $i++) {				
				$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "%'],";
			}
			$dataRegion .= ']';

			?>
			
			<div class="row">
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>Si el factor, que contiene acciones sobre festividades y tradiciones yucatecas en la escuela, nos indica que se realizan con una mayor frecuencia las situaciones contenidas, 
						sugiere que a&uacute;n se pretende mantener la cultura yucateca en esos centros escolares. En este factor se consideran las siguientes acciones:
					</p>
					
					<div class="text-justify" id="instructions">
						<ul class="custom-bullet">
							<li>En la escuela se comparan las tradiciones de Yucat&aacute;n con las de otros estados.</li>
							<li>Los estudiantes representan tradiciones como el hanal pixan, ch&#39;a&#39;ch&aacute;ak, j&eacute;ets m&eacute;ek&#39;.</li>
							<li>En los festivales escolares se incluye algo alusivo a Yucat&aacute;n como poes&iacute;as en maya, jarana y vaquer&iacute;a.</li>
						</ul>
					</div>		
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>La frecuencia con la que se presentan estas situaciones var&iacute;an en las escuelas, pero existe cierta preferencia por la primera acci&oacute;n que se menciona a continuaci&oacute;n.</p>
					
					<div class="text-justify" id="instructions">
						<ul class="custom-bullet">
							<li>Las escuelas que pretenden mantener la cultura maya y sus festividades, tienden a recurrir primero a que sus <b>estudiantes representen tradiciones como el hanal pixan, ch&#39;a&#39;ch&aacute;ak, j&eacute;ets m&eacute;ek&#39;.</b></li>
							<li>Si bien  es m&aacute;s com&uacute;n que se representen las tradiciones yucatecas mencionadas anteriormente, aquella escuela que en los <b>festivales escolares incluyen algo alusivo a Yucat&aacute;n como poes&iacute;as en maya, jarana y vaquer&iacute;a</b>, significa que muestran a&uacute;n m&aacute;s inter&eacute;s por mantener la cultura maya.</li>
							<li>Si en <b>la escuela se comparan las tradiciones de Yucat&aacute;n con las de otros estados</b>, indicar&aacute; que para este centro es importante mantener las festividades y tradiciones yucatecas.</li>
						</ul>
					</div>		
				</div>	
						
				<div id="chart2_traditions" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_traditions" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_traditions" class="col-xs-12 col-md-6 factorGraph" align="center"></div>				
			</div>

			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChartRegion);
			
				function drawChart1() {
					var data = google.visualization.arrayToDataTable(data1);
			
					var options = {
						height : 400,
						width : 700,
						title : 'En la escuela se comparan las tradiciones de Yucat\u00E1n con las de otros estados',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : 'Valores',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Frecuencia',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [0,10000, 20000, 30000, 40000,50000,60000,70000]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					var chart = new google.visualization.ComboChart(document.getElementById("chart1_traditions"));
					chart.draw(data, options);
			
				}
			
				function drawChart2() {
					var data = google.visualization.arrayToDataTable(data2);
			
					var options = {
						height : 400,
						width : 700,
						title : 'En la escuela los estudiantes representan tradiciones como el janal pixan, chach\u00E1ak , j\u00E9ets m\u00E9ek',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : 'Valores',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Frecuencia',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
								ticks : [0,10000, 20000, 30000, 40000,50000,60000,70000]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					var chart = new google.visualization.ComboChart(document.getElementById("chart2_traditions"));
					chart.draw(data, options);
			
				}
			
				function drawChart3() {
					var data = google.visualization.arrayToDataTable(data3);
			
					var options = {
						height : 400,
						width : 700,
						title : 'En los festivales escolares se incluye algo alusivo a Yucat\u00E1n como poes\u00EDas en maya, jarana y vaquer\u00EDa',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : 'Valores',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Frecuencia',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
								ticks : [0,10000, 20000, 30000, 40000,50000,60000,70000]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					var chart = new google.visualization.ComboChart(document.getElementById("chart3_traditions"));
					chart.draw(data, options);
			
				}
			
				function drawChartRegion() {
					var data = google.visualization.arrayToDataTable(dataRegion);
			
					var options = {
						width : 1000,
						height : 600,
						orientation: 'vertical',
						title : 'Media por estado y regi\u00F3n',	
						 bar: { groupWidth: '85%' },					
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : 'Valores',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [-3, -2, -1, 0, 1, 2, 3]
						},
						vAxis : {
							title : '',
							textPosition: 'out',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [0, 1, 2, 3, 4]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},						
						chartArea : {
							left : 100,
							top : 50,
							width: '85%', 
							height: '80%'
						},						
					};
			
					var chart = new google.visualization.BarChart(document.getElementById("chartRegion"));
					chart.draw(data, options);
			
				}

			</script>
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>