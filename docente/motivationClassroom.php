<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

if (!isset($_POST['factor']) || !isset($_POST['idSchool']) || !isset($_POST['groupSchool'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
} else {
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new FactorController();
	$factorObject = $controller -> getEntityAction($factor);
}

if (!$factor) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}

$schoolController = new SchoolController();
$school = $schoolController->getEntityAction($idSchool);
			
if(!$school){
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}

$idaepyController = new IdaepyController();
$idaepyScheduled = $idaepyController -> getEntityAction($groupSchool);

if(!$idaepyScheduled){
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}

$contextController = new ContextController();
$join = 'INNER JOIN motivation_context on motivation_context.student = e.student ';
$join .= 'INNER JOIN idaepy_students on idaepy_students.student = motivation_context.student ';
$where = 'motivation_context.answered = :answered AND idaepy_students.cct = :cct AND idaepy_students.grade = :grade 
		  AND idaepy_students.school_group = :schoolGroup AND e.year = 2015 AND idaepy_students.year = :year';
$whereFields = array('cct' => $school -> getCct(), 'answered' => 1, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$contextList = $contextController -> displayByAction($where, $whereFields, $join);
$totalContext = count($contextList);

$motivationSchoolController = new MotivationContextController();
$join = 'INNER JOIN idaepy_students on idaepy_students.student = e.student ';
    $where = "idaepy_students.cct LIKE :cct AND idaepy_students.grade = :grade AND idaepy_students.school_group = :schoolGroup
AND idaepy_students.year = :year";
$whereFields = array('cct' => $school -> getCct(), 'grade' => $idaepyScheduled->getGrade(), 
    'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$motivationList = $motivationSchoolController -> displayByAction($where, $whereFields, $join);
$motivationTotal = count($motivationList);

if($year == '2016'){
    $title = "2015-2016";
    
}else{
    $title = "2016-2017";
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
		<meta name="Author" content="">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<title>Cuestionarios de Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/logog.ico">
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
		<link rel="stylesheet" href="../css/table.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>

		<div class="container-fluid">
			<form role="form" name="schoolFactor" id="schoolFactor" action="factorSchoolGroup.php" method="post" accept-charset="UTF-8">
				<input type="hidden" id="cct" name="cct" value="<?php echo($school -> getCct()); ?>"/>				
				<input type="hidden" id="schoolGroup" name="schoolGroup" value="<?php echo($groupSchool); ?>"/>
				<input type="hidden" id="year" name="year" value="<?php echo($year); ?>"/>
			</form>
			<button class="buttonBack" type="button" onclick="document.forms.schoolFactor.submit()"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<br />
			<div class="col-xs-12 col-md-5">
				<div><h4 class='form-signin-heading'>CCT: <?php echo($school->getCct()); ?></h4></div>
				<div><h4 class='form-signin-heading'>Escuela: <?php echo($school->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Nivel: <?php echo($school->getSchoolLevelObject()->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Modalidad: <?php echo($school->getSchoolModeObject()->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Marginación: <?php echo($school->getSchoolMarginalizationObject()->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($school->getSchoolRegionObject()->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($school->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
			</div>
			<div class="col-xs-12 col-md-7">
				<table class="table table-condensed">
					<thead>
						<tr>
							<th>Grado</th>
							<th>Grupo</th>
							<th>Total Alumnos</th>
							<th>Evaluados</th>
						</tr>
					</thead>
					<tbody>
					<?php
						echo('<tr>');
						echo('<td>'.$idaepyScheduled->getGrade().'</td>');
						echo('<td>'.$idaepyScheduled->getSchoolGroup().'</td>');
                        echo('<td>'.$idaepyScheduled->getTotal().'</td>');
						echo('<td>'.$totalContext.'</td>');
						echo('</tr>');
					 ?>
					</tbody>
				</table>
				<p><b>Nota: Los grupos se escuentran conformados de acuerdo al ciclo escolar <?php echo(($groupby-1).'-'.$groupby); ?></b></p>
			</div>
			<div class="col-xs-12 col-md-12">
				<hr />	
			</div>
			
			<?php									
			
			$factorSchoolController = new FactorCctController();
			$whereCCT = "cct LIKE :cct AND factor = :factor";
			$factorSchoolList = $factorSchoolController -> displayByAction($whereCCT, array('cct' => $school->getCct(), 'factor' => 6));
			
			$factorClassroomController = new FactorClassroomController();
			$whereCCT = "cct LIKE :cct AND factor = :factor AND grade = :grade AND school_group = :schoolGroup AND year = :year";
            $whereFields = array('cct' => $school -> getCct(), 'factor' => $factor, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
			$factorClassroom = $factorClassroomController -> displayByAction($whereCCT, $whereFields);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "region LIKE :region AND factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('region' => $school->getRegionZone(), 'factor' => 6));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => 6));
            
            $factorZoneController = new FactorZoneController();
            $whereZone = "zone LIKE :zone AND factor = :factor";
            $whereFieldsZone = array('zone' => $school->getSchoolRegionZoneObject()->getZone(), 'factor' => $factor);
            $factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

			$motivationArray1 = array();
			$motivationArray2 = array();
			$motivationArray3 = array();
			
			$motivationName1 = array("0" => "No me describe", "1" => "Me describe poco", "2" => "Me describe", "3" => "Me describe mucho", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $school -> getSchoolRegionObject() -> getName(), 
                 2 =>"Zona " . str_pad($school->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT), 
                 3 => $school -> getCct(), 4 => 'Aula');
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($motivationList as $motivationEntry) {
				switch($motivationEntry->getP6O1()) {
					case 0 :
						++$motivationArray1[0];
						break;
					case 1 :
						++$motivationArray1[1];
						break;
					case 2 :
						++$motivationArray1[2];
						break;
					case 3 :
						++$motivationArray1[3];
						break;
					case 999 :
						++$motivationArray1[4];
						break;
				}
				
				switch($motivationEntry->getP6O2()) {
					case 0 :
						++$motivationArray2[0];
						break;
					case 1 :
						++$motivationArray2[1];
						break;
					case 2 :
						++$motivationArray2[2];
						break;
					case 3 :
						++$motivationArray2[3];
						break;
					case 999 :
						++$motivationArray2[4];
						break;
				}
				
				switch($motivationEntry->getP6O3()) {
					case 0 :
						++$motivationArray3[0];
						break;
					case 1 :
						++$motivationArray3[1];
						break;
					case 2 :
						++$motivationArray3[2];
						break;
					case 3 :
						++$motivationArray3[3];
						break;
					case 999 :
						++$motivationArray3[4];
						break;
				}
			}

			$data1 = "[";
			for ($i = 0; $i < count($motivationName1); $i++) {
				$motivationPercent1 = round(($motivationArray1[$i] / $motivationTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$motivationName1[$i]."', 'Frecuencia', '" . $motivationArray1[$i] . "')";
				$data1 .= "['" . $motivationName1[$i] . "'," . $motivationPercent1 . ",'" . $motivationPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';
			

			$data2 = "[";
			for ($i = 0; $i < count($motivationName1); $i++) {
				$motivationPercent2 = round(($motivationArray2[$i] / $motivationTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$motivationName1[$i]."', 'Frecuencia', '" . $motivationArray2[$i] . "')";
				$data2 .= "['" . $motivationName1[$i] . "'," . $motivationPercent2 . ",'" . $motivationPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($motivationName1); $i++) {
				$motivationPercent3 = round(($motivationArray3[$i] / $motivationTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$motivationName1[$i]."', 'Frecuencia', '" . $motivationArray3[$i] . "')";
				$data3 .= "['" . $motivationName1[$i] . "'," . $motivationPercent3 . ",'" . $motivationPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$dataReportGeneral = "[['Valor', 'Indicador', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}
			if($factorRegionList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}
			if($factorZoneList[0]->getMedia() > 0){
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#3AC777'],";
            }else{
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#E9F26D'],";
            }
            if(!empty($factorSchoolList) && $factorSchoolList[0]->getFactorCount() != 0){
                if($factorSchoolList[0]->getMedia() > 0){
                    $dataReportGeneral .= "['" . $reportNameGeneral[3] . "'," . round($factorSchoolList[0] -> getMedia(), 2) . ",'" . round($factorSchoolList[0] -> getMedia(), 2) . "', '#3AC777'],";
                }else{
                    $dataReportGeneral .= "['" . $reportNameGeneral[3] . "'," . round($factorSchoolList[0] -> getMedia(), 2) . ",'" . round($factorSchoolList[0] -> getMedia(), 2) . "', '#E9F26D'],";
                }   
            }else{
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $reportNameGeneral[3] . "', '','" . $messageMediaNull . "', '']";
            }           
            if(!empty($factorClassroom) && $factorClassroom[0]->getMedia() != 999){
                if($factorClassroom[0]->getMedia() > 0){
                    $dataReportGeneral .= "['" . $reportNameGeneral[4] . "'," . round($factorClassroom[0] -> getMedia(), 2) . ",'" . round($factorClassroom[0] -> getMedia(), 2) . "', '#3AC777']"; 
                }else{
                    $dataReportGeneral .= "['" . $reportNameGeneral[4] . "'," . round($factorClassroom[0] -> getMedia(), 2) . ",'" . round($factorClassroom[0] -> getMedia(), 2) . "', '#E9F26D']";
                }
            }else{              
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $reportNameGeneral[4] . "', '','" . $messageMediaNull . "', '']";
                //$dataReportGeneral .= "['" . $reportNameGeneral[3] . "'," . round($factorClassroom[0] -> getMedia(), 2) . ",'" . round($factorClassroom[0] -> getMedia(), 2) . "', '#E9F26D']";
            }
			$dataReportGeneral .= ']';
	

			?>
			
			<div class="row">
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>
						Este factor conformado por tres &iacute;tems explora la determinaci&oacute;n del estudiante para lograr ciertas metas escolares 
						(Deci &amp; Ryan, 2008; Flores-Mac&iacute;as & G&oacute;mez-Bastida, 2010). Los resultados muestran que los estudiantes se perciben como 
						personas que terminan lo que empiezan, aunque se perciben con menor esmero. Puntajes altos de su &iacute;ndice se&ntilde;alan que el 
						estudiante se encuentra altamente motivado, por el contrario puntajes bajo se&ntilde;alan poco motivaci&oacute;n de logro. El promedio 
						del estado es 1.0 y la distribuci&oacute;n de las puntaciones se inclina hacia valores altos.
					</p>
				</div>
				<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>	
				<div id="chart2_motivation" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_motivation" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_motivation" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChartReportGeneral);
			
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
						title : 'Soy una persona que se esmera',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 14
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
			
					new google.visualization.ComboChart(document.getElementById('chart1_motivation')).draw(data, options);
			
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
						title : 'Termino todo lo que empiezo',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 14
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
			
					new google.visualization.ComboChart(document.getElementById('chart2_motivation')).draw(data, options);
			
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
						title : 'Soy una persona que trabaja duro',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 14
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
			
					new google.visualization.ComboChart(document.getElementById('chart3_motivation')).draw(data, options);
			
				}
			
				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'Motivaci\u00F3n',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 14
							}
						},
						hAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [-4, -3, -2, -1, 0, 1, 2, 3, 4]
						},
						vAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
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
							top : 50,
							width : '75%',
							height : '80%'
						}
					};
			
					var chart = new google.visualization.BarChart(document.getElementById("chartReportGeneral"));
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