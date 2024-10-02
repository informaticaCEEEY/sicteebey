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
			
			$studyTechniquesController = new StudyTechniquesContextController();
			$studyTechniquesList = $studyTechniquesController->displayAction();
			$studyTechniquesTotal = count($studyTechniquesList);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

			$studyTechniquesArray1 = array();
			$studyTechniquesArray2 = array();
			$studyTechniquesArray3 = array();
			$studyTechniquesArray4 = array();
			$studyTechniquesArray5 = array();
			$studyTechniquesArray6 = array();
			
			$studyTechniquesName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($studyTechniquesList as $studyTechniquesEntry) {
				
				switch($studyTechniquesEntry->getP7O1()) {
					case 0 :
						++$studyTechniquesArray1[0];
						break;
					case 1 :
						++$studyTechniquesArray1[1];
						break;
					case 2 :
						++$studyTechniquesArray1[2];
						break;
					case 3 :
						++$studyTechniquesArray1[3];
						break;
					case 999 :
						++$studyTechniquesArray1[4];
						break;
				}
				
				switch($studyTechniquesEntry->getP7O2()) {
					case 0 :
						++$studyTechniquesArray2[0];
						break;
					case 1 :
						++$studyTechniquesArray2[1];
						break;
					case 2 :
						++$studyTechniquesArray2[2];
						break;
					case 3 :
						++$studyTechniquesArray2[3];
						break;
					case 999 :
						++$studyTechniquesArray2[4];
						break;
				}
				
				switch($studyTechniquesEntry->getP7O3()) {
					case 0 :
						++$studyTechniquesArray3[0];
						break;
					case 1 :
						++$studyTechniquesArray3[1];
						break;
					case 2 :
						++$studyTechniquesArray3[2];
						break;
					case 3 :
						++$studyTechniquesArray3[3];
						break;
					case 999 :
						++$studyTechniquesArray3[4];
						break;
				}
				
				switch($studyTechniquesEntry->getP7O4()) {
					case 0 :
						++$studyTechniquesArray4[0];
						break;
					case 1 :
						++$studyTechniquesArray4[1];
						break;
					case 2 :
						++$studyTechniquesArray4[2];
						break;
					case 3 :
						++$studyTechniquesArray4[3];
						break;
					case 999 :
						++$studyTechniquesArray4[4];
						break;
				}
				
				
				
				switch($studyTechniquesEntry->getP7O5()) {
					case 0 :
						++$studyTechniquesArray5[0];
						break;
					case 1 :
						++$studyTechniquesArray5[1];
						break;
					case 2 :
						++$studyTechniquesArray5[2];
						break;
					case 3 :
						++$studyTechniquesArray5[3];
						break;
					case 999 :
						++$studyTechniquesArray5[4];
						break;
				}
				
				switch($studyTechniquesEntry->getP7O7()) {
					case 0 :
						++$studyTechniquesArray6[0];
						break;
					case 1 :
						++$studyTechniquesArray6[1];
						break;
					case 2 :
						++$studyTechniquesArray6[2];
						break;
					case 3 :
						++$studyTechniquesArray6[3];
						break;
					case 999 :
						++$studyTechniquesArray6[4];
						break;
				}
				
				
			}

			$data1 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent1 = round(($studyTechniquesArray1[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray1[$i] . "')";
				$data1 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent1 . ",'" . $studyTechniquesPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";				
			}
			$data1 .= ']';
			

			$data2 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent2 = round(($studyTechniquesArray2[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray2[$i] . "')";
				$data2 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent2 . ",'" . $studyTechniquesPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent3 = round(($studyTechniquesArray3[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray3[$i] . "')";
				$data3 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent3 . ",'" . $studyTechniquesPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent4 = round(($studyTechniquesArray4[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray4[$i] . "')";
				$data4 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent4 . ",'" . $studyTechniquesPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';
			
			$data5 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent5 = round(($studyTechniquesArray5[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray5[$i] . "')";
				$data5 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent5 . ",'" . $studyTechniquesPercent5 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data5 .= ']';

			$data6 = "[";
			for ($i = 0; $i < count($studyTechniquesName1); $i++) {
				$studyTechniquesPercent6 = round(($studyTechniquesArray6[$i] / $studyTechniquesTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$studyTechniquesName1[$i]."', 'Frecuencia', '" . $studyTechniquesArray6[$i] . "')";
				$data6 .= "['" . $studyTechniquesName1[$i] . "'," . $studyTechniquesPercent6 . ",'" . $studyTechniquesPercent6 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data6 .= ']';
			
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
						Este factor, conformado por siete &iacute;tems, refiere a acciones que realiza el estudiante para estudiar como leer apuntes, 
						memorizar, repetir ejercicios y hacer esquemas. Los valores bajos del &iacute;ndice se&ntilde;alan poco uso de t&eacute;cnicas de 
						estudio; por el contrario, valores altos indican mayor uso. El promedio del Estado es 0.5, y la distribuci&oacute;n del 
						&iacute;ndice se inclina hacia valores altos.
					</p>
					<p>
						Se encontr&oacute; que poner atenci&oacute;n a las lecciones durante las clases es la acci&oacute;n m&aacute;s recurrente que 
						cualquier otra para estudiar; despu&eacute;s recurren a leer sus apuntes o el libro de texto; luego a realizar ejercicios 
						diferentes a los del libro de texto seguido de memorizar sus apuntes o el libro de texto. Y las t&eacute;cnicas de estudio 
						que menos realizan los estudiantes son las que implican desarrollar esquemas, res&uacute;menes o gu&iacute;as; y repetir los 
						ejercicios del cuaderno o del libro de texto.
					</p>			
				</div>
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart1_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart2_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart5_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart6_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart4_studyTechniques" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>		
		<a class="go-top" href="#">Subir</a>
		<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				//alert(screen.width);
				
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var data5 = <?php echo $data5; ?>;
				var data6 = <?php echo $data6; ?>;
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
						title : 'Pongo atenci\u00F3n en las clases',
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
					
					new google.visualization.ComboChart(document.getElementById('chart1_studyTechniques')).draw(data, options);
			
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
						title : 'Leo mis apuntes o el libro de texto',
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
			
					new google.visualization.ComboChart(document.getElementById('chart2_studyTechniques')).draw(data, options);
			
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
						title : 'Memorizo mis apuntes o el libro de texto',
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
			
					new google.visualization.ComboChart(document.getElementById('chart3_studyTechniques')).draw(data, options);
			
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
						title : 'Repito los ejercicios del cuaderno o del libro de texto',
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
			
					new google.visualization.ComboChart(document.getElementById('chart4_studyTechniques')).draw(data, options);
			
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
						title : 'Hago ejercicios diferentes a los del libro de texto',
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
			
					new google.visualization.ComboChart(document.getElementById('chart5_studyTechniques')).draw(data, options);
			
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
						title : 'Hago esquemas, res\u00FAmenes o gu\u00EDas',
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
			
					new google.visualization.ComboChart(document.getElementById('chart6_studyTechniques')).draw(data, options);
			
				}
				
				function drawChartRegion() {
					var data = google.visualization.arrayToDataTable(dataRegion);
			
					var options = {						
						height : 600,
						width: 1200,
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