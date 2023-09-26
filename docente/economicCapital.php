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
		<title>Cuestionarios de Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/logog.ico">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
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
			
			$economicCapitalController = new EconomicCapitalContextController();
			$economicCapitalList = $economicCapitalController->displayAction();
			$economicCapitalTotal = count($economicCapitalList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$economicCapitalArray1 = array();
			$economicCapitalArray2 = array();
			$economicCapitalArray3 = array();
			$economicCapitalArray4 = array();
			$economicCapitalArray5 = array();
			$economicCapitalArray6 = array();
			$economicCapitalArray7 = array();
			$economicCapitalArray8 = array();
			
			$economicCapitalName1 = array("0" => "No estudi\u00F3", "1" => "Primaria", "2" => "Secundaria", "3" => "Bachillerato",
										"4" => "Carrera T\u00E9cnica", "5" => "Licenciatura", "6" => "Posgrado", "7" => "Sin respuesta");
			$economicCapitalName2 = array("0" => "Ninguno", "1" => "1", "2" => "2", "3" => "3",
										"4" => "4", "5" => "5", "6" => "6 o  m\u00E1s", "7" => "Sin respuesta");
										
			$economicCapitalName3 = array("0" => "No", "1" => "S\u00ED", "2" => "Sin respuesta");
			
			$colorGraphic = array("0" => "#E9F26D", "1" => "#3AC777", "2" => "#3AC777", "3" => "#3AC777", "4" => "#3AC777", "5" => "#3AC777", 
									"6" => "#3AC777", "7" => "#B0B0B0");

			foreach ($economicCapitalList as $economicCapitalEntry) {
				switch($economicCapitalEntry->getP1O1()) {
					case 0 :
						++$economicCapitalArray1[0];
						break;
					case 1 :
						++$economicCapitalArray1[1];
						break;
					case 2 :
						++$economicCapitalArray1[2];
						break;
					case 3 :
						++$economicCapitalArray1[3];
						break;
					case 4 :
						++$economicCapitalArray1[4];
						break;
					case 5 :
						++$economicCapitalArray1[5];
						break;
					case 6 :
						++$economicCapitalArray1[6];
						break;
					case 999 :
						++$economicCapitalArray1[7];
						break;
				}

				switch($economicCapitalEntry->getP1O2()) {
					case 0 :
						++$economicCapitalArray2[0];
						break;
					case 1 :
						++$economicCapitalArray2[1];
						break;
					case 2 :
						++$economicCapitalArray2[2];
						break;
					case 3 :
						++$economicCapitalArray2[3];
						break;
					case 4 :
						++$economicCapitalArray2[4];
						break;
					case 5 :
						++$economicCapitalArray2[5];
						break;
					case 6 :
						++$economicCapitalArray2[6];
						break;
					case 999 :
						++$economicCapitalArray2[7];
						break;
				}

				switch($economicCapitalEntry->getP2O1()) {
					case 0 :
						++$economicCapitalArray3[0];
						break;
					case 1 :
						++$economicCapitalArray3[1];
						break;
					case 2 :
						++$economicCapitalArray3[2];
						break;
					case 3 :
						++$economicCapitalArray3[3];
						break;
					case 4 :
						++$economicCapitalArray3[4];
						break;
					case 5 :
						++$economicCapitalArray3[5];
						break;
					case 6 :
						++$economicCapitalArray3[6];
						break;
					case 999 :
						++$economicCapitalArray3[7];
						break;
				}

				switch($economicCapitalEntry->getP2O2()) {
					case 0 :
						++$economicCapitalArray4[0];
						break;
					case 1 :
						++$economicCapitalArray4[1];
						break;
					case 2 :
						++$economicCapitalArray4[2];
						break;
					case 3 :
						++$economicCapitalArray4[3];
						break;
					case 4 :
						++$economicCapitalArray4[4];
						break;
					case 5 :
						++$economicCapitalArray4[5];
						break;
					case 6 :
						++$economicCapitalArray4[6];
						break;
					case 999 :
						++$economicCapitalArray4[7];
						break;
				}
				
				switch($economicCapitalEntry->getP2O3()) {
					case 0 :
						++$economicCapitalArray5[0];
						break;
					case 1 :
						++$economicCapitalArray5[1];
						break;
					case 2 :
						++$economicCapitalArray5[2];
						break;
					case 3 :
						++$economicCapitalArray5[3];
						break;
					case 4 :
						++$economicCapitalArray5[4];
						break;
					case 5 :
						++$economicCapitalArray5[5];
						break;
					case 6 :
						++$economicCapitalArray5[6];
						break;
					case 999 :
						++$economicCapitalArray5[7];
						break;
				}
				
				switch($economicCapitalEntry->getP2O4()) {
					case 0 :
						++$economicCapitalArray6[0];
						break;
					case 1 :
						++$economicCapitalArray6[1];
						break;
					case 2 :
						++$economicCapitalArray6[2];
						break;
					case 3 :
						++$economicCapitalArray6[3];
						break;
					case 4 :
						++$economicCapitalArray6[4];
						break;
					case 5 :
						++$economicCapitalArray6[5];
						break;
					case 6 :
						++$economicCapitalArray6[6];
						break;
					case 999 :
						++$economicCapitalArray6[7];
						break;
				}
				
				switch($economicCapitalEntry->getP2O5()) {
					case 0 :
						++$economicCapitalArray7[0];
						break;
					case 1 :
						++$economicCapitalArray7[1];
						break;
					case 999 :
						++$economicCapitalArray7[2];
						break;
				}
				
				switch($economicCapitalEntry->getP2O6()) {
					case 0 :
						++$economicCapitalArray8[0];
						break;
					case 1 :
						++$economicCapitalArray8[1];
						break;
					case 2 :
						++$economicCapitalArray8[2];
						break;
					case 3 :
						++$economicCapitalArray8[3];
						break;
					case 4 :
						++$economicCapitalArray8[4];
						break;
					case 5 :
						++$economicCapitalArray8[5];
						break;
					case 6 :
						++$economicCapitalArray8[6];
						break;
					case 999 :
						++$economicCapitalArray8[7];
						break;
				}
			}

			$data1 = "[";
			for ($i = 0; $i < count($economicCapitalName1); $i++) {
				$economicCapitalPercent1 = round(($economicCapitalArray1[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName1[$i]."', 'Frecuencia', '" . $economicCapitalArray1[$i] . "')";
				$data1 .= "['" . $economicCapitalName1[$i] . "'," . $economicCapitalPercent1 . ",'" . $economicCapitalPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';

			$data2 = "[";
			for ($i = 0; $i < count($economicCapitalName1); $i++) {
				$economicCapitalPercent2 = round(($economicCapitalArray2[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName1[$i]."', 'Frecuencia', '" . $economicCapitalArray2[$i] . "')";
				$data2 .= "['" . $economicCapitalName1[$i] . "'," . $economicCapitalPercent2 . ",'" . $economicCapitalPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($economicCapitalName1); $i++) {
				$economicCapitalPercent3 = round(($economicCapitalArray3[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName2[$i]."', 'Frecuencia', '" . $economicCapitalArray3[$i] . "')";
				$data3 .= "['" . $economicCapitalName2[$i] . "'," . $economicCapitalPercent3 . ",'" . $economicCapitalPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 0; $i < count($economicCapitalName2); $i++) {
				$economicCapitalPercent4 = round(($economicCapitalArray4[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName2[$i]."', 'Frecuencia', '" . $economicCapitalArray4[$i] . "')";
				$data4 .= "['" . $economicCapitalName2[$i] . "'," . $economicCapitalPercent4 . ",'" . $economicCapitalPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';
			
			$data5 = "[";
			for ($i = 0; $i < count($economicCapitalName2); $i++) {
				$economicCapitalPercent5 = round(($economicCapitalArray5[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName2[$i]."', 'Frecuencia', '" . $economicCapitalArray5[$i] . "')";
				$data5 .= "['" . $economicCapitalName2[$i] . "'," . $economicCapitalPercent5 . ",'" . $economicCapitalPercent5 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data5 .= ']';

			$data6 = "[";
			for ($i = 0; $i < count($economicCapitalName2); $i++) {
				$economicCapitalPercent6 = round(($economicCapitalArray6[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName2[$i]."', 'Frecuencia', '" . $economicCapitalArray6[$i] . "')";
				$data6 .= "['" . $economicCapitalName2[$i] . "'," . $economicCapitalPercent6 . ",'" . $economicCapitalPercent6 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data6 .= ']';

			$data7 = "[";
			for ($i = 0; $i < count($economicCapitalName3); $i++) {
				$economicCapitalPercent7 = round(($economicCapitalArray7[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName3[$i]."', 'Frecuencia', '" . $economicCapitalArray7[$i] . "')";
				$data7 .= "['" . $economicCapitalName3[$i] . "'," . $economicCapitalPercent7 . ",'" . $economicCapitalPercent7 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data7 .= ']';

			$data8 = "[";
			for ($i = 0; $i < count($economicCapitalName2); $i++) {
				$economicCapitalPercent8 = round(($economicCapitalArray8[$i] / $economicCapitalTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$economicCapitalName2[$i]."', 'Frecuencia', '" . $economicCapitalArray8[$i] . "')";
				$data8 .= "['" . $economicCapitalName2[$i] . "'," . $economicCapitalPercent8 . ",'" . $economicCapitalPercent8 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data8 .= ']';
			
			$dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
			}
			for ($i = 0; $i < count($factorRegionList); $i++) {
				if($factorRegionList[$i]->getMedia() > 0){
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#3AC777'],";	
				}else{
					$dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#E9F26D'],";
				}				
			}
			$dataRegion .= ']';
			?>
			
			<div class="row">
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>
						Este factor est&aacute; conformado por siete &iacute;tems, que en conjunto miden aspectos relacionados con el nivel educativo 
						de los padres y el ingreso econ&oacute;mico de la familia medido a trav&eacute;s de los bienes con los que cuentan los 
						estudiantes en sus casas; este factor est&aacute; relacionado con las oportunidades que puede tener el sujeto en su 
						educaci&oacute;n (Gil-Flores, 2013). Entre los bienes que considera el factor son el tener televisor, computadora 
						(para tareas escolares), autom&oacute;vil, ba&ntilde;o completo y horno de microondas; adem&aacute;s, se pregunta el nivel 
						m&aacute;ximo nivel de estudios alcanzado por la madre y el padre.
					</p>
					<p>
						De acuerdo con los resultados, algunos bienes o caracter&iacute;sticas son m&aacute;s dif&iacute;ciles de obtener y 
						est&aacute;n asociadas con mayor nivel socioecon&oacute;mico, as&iacute; se observ&oacute; que a mayor nivel estudios 
						del padre y la madre los estudiantes reportan un incremento en la cantidad de las siguientes caracter&iacute;sticas o 
						bienes en el hogar: ba&ntilde;o completo, autom&oacute;vil, computadora para hacer tareas escolares, y el horno de 
						microondas que es el bien menos com&uacute;n.
					</p>
					<p>
						Los valores bajos del &iacute;ndice indican menor ingreso econ&oacute;mico en la familia del estudiante; por el contrario, 
						valores altos indican mayor ingreso econ&oacute;mico. La media del Estado es -0.9, y la distribuci&oacute;n del &iacute;ndice 
						se inclina hacia valores bajos.
					</p>
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart2_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>				
				<div id="chart6_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart5_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart4_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<!--div id="chart7_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div-->
				<div id="chart8_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>		
			</div>
			
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var data5 = <?php echo $data5; ?>;
				var data6 = <?php echo $data6; ?>;
				var data7 = <?php echo $data7; ?>;
				var data8 = <?php echo $data8; ?>;
				var dataRegion = <?php echo $dataRegion; ?>;
	
				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChart4);
				google.charts.setOnLoadCallback(drawChart5);
				google.charts.setOnLoadCallback(drawChart6);
				//google.charts.setOnLoadCallback(drawChart7);
				google.charts.setOnLoadCallback(drawChart8);
				google.charts.setOnLoadCallback(drawChartRegion);
			
				function drawChart1() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data1);
			
					var options = {
						height : 400,
						width : 700,
						title : '\u00BFCu\u00E1l es el m\u00E1ximo nivel de estudios alcanzado por tu madre?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
					
					new google.visualization.ComboChart(document.getElementById('chart1_economicCapital')).draw(data, options);
			
				}
			
				function drawChart2() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data2);
			
					var options = {
						height : 400,
						width : 700,
						title : '\u00BFCu\u00E1l es el m\u00E1ximo nivel de estudios alcanzado por tu padre?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart2_economicCapital')).draw(data, options);
			
				}
			
				function drawChart3() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data3);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Televisor',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart3_economicCapital')).draw(data, options);
			
				}
			
				function drawChart4() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data4);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Computadora (para tareas escolares)',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart4_economicCapital')).draw(data, options);
			
				}
				
				function drawChart5() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data5);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Autom\u00F3vil',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart5_economicCapital')).draw(data, options);
			
				}
				
				function drawChart6() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data6);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Ba\u00F1o Completo',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart6_economicCapital')).draw(data, options);
			
				}
				
				function drawChart7() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data7);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Internet',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart7_economicCapital')).draw(data, options);
			
				}
				
				function drawChart8() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data8);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Horno de microondas',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
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
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart8_economicCapital')).draw(data, options);
			
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
				
				function createCustomHTMLContent($category1, title1, frecuency1) {
					return '<div><span cclass="tooltiptext"><b>' + $category1 + '</b></span><br />'
						 +	  '<p>' + title1 + ': <b>' + frecuency1 + '</b></p>'			  		
						 + '</div>';
				}	
			</script>
			<script>
				var onResize = function() {
				  // apply dynamic padding at the top of the body according to the fixed navbar height
				  $("body").css("padding-top", $(".navbar-fixed-top").height());
				};
				
				// attach the function to the window resize event
				$(window).resize(onResize);
				
				// call it also when the page is ready after load or reload
				$(function() {
				  onResize();
				});
			</script>
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>