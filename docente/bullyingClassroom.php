<?php
require ('../checkSession.php');

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
$school = $schoolController -> getEntityAction($idSchool);

if (!$school) {
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
$join = 'INNER JOIN bullying_context on bullying_context.student = e.student ';
$join .= 'INNER JOIN idaepy_students on idaepy_students.student = bullying_context.student ';
$where = 'bullying_context.answered = :answered AND idaepy_students.cct = :cct AND idaepy_students.grade = :grade 
		  AND idaepy_students.school_group = :schoolGroup AND e.year = 2015 AND idaepy_students.year = :year';
$whereFields = array('cct' => $school -> getCct(), 'answered' => 1, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$contextList = $contextController -> displayByAction($where, $whereFields, $join);
$totalContext = count($contextList);

$bullyingController = new BullyingContextController();
$join = 'INNER JOIN idaepy_students on idaepy_students.student = e.student ';
$where = "idaepy_students.cct LIKE :cct AND idaepy_students.grade = :grade AND idaepy_students.school_group = :schoolGroup
    AND idaepy_students.year = :year";
$whereFields = array('cct' => $school -> getCct(), 'grade' => $idaepyScheduled->getGrade(), 
    'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$bullyingList = $bullyingController -> displayByAction($where, $whereFields, $join);
$bullyingTotal = count($bullyingList);

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
				<div><h4 class='form-signin-heading'>CCT: <?php echo($school -> getCct()); ?></h4></div>
				<div><h4 class='form-signin-heading'>Escuela: <?php echo($school -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Nivel: <?php echo($school -> getSchoolLevelObject() -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Modalidad: <?php echo($school -> getSchoolModeObject() -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Marginación: <?php echo($school->getSchoolMarginalizationObject()->getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($school -> getSchoolRegionObject() -> getName()); ?> </h4></div>
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
			$factorSchoolList = $factorSchoolController -> displayByAction($whereCCT, array('cct' => $school -> getCct(), 'factor' => 1));
			
			$factorClassroomController = new FactorClassroomController();
			$whereCCT = "cct LIKE :cct AND factor = :factor AND grade = :grade AND school_group = :schoolGroup AND year = :year";
            $whereFields = array('cct' => $school -> getCct(), 'factor' => $factor, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
			$factorClassroom = $factorClassroomController -> displayByAction($whereCCT, $whereFields);

			$factorRegionController = new FactorRegionController();
			$whereRegion = "region LIKE :region AND factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('region' => $school -> getRegionZone(), 'factor' => 1));

			$factorStateController = new FactorStateController();
			$whereRegion = "factor LIKE :factor";
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => 1));
            
            $factorZoneController = new FactorZoneController();
            $whereZone = "zone LIKE :zone AND factor = :factor";
            $whereFieldsZone = array('zone' => $school->getSchoolRegionZoneObject()->getZone(), 'factor' => $factor);
            $factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

			$bullyingArray1 = array();
			$bullyingArray2 = array();
			$bullyingArray3 = array();
			$bullyingArray4 = array();
			$bullyingName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $school -> getSchoolRegionObject() -> getName(), 
                 2 =>"Zona " . str_pad($school->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT), 
                 3 => $school -> getCct(), 4 => 'Aula');
			$colorGraphic = array("0" => "#3AC777", "1" => "#BFFEE6", "2" => "#E9F26D", "3" => "#F04747", "4" => "#B0B0B0");

			foreach ($bullyingList as $bullyingEntry) {
				switch($bullyingEntry->getP9O1()) {
					case 0 :
						++$bullyingArray1[0];
						break;
					case 1 :
						++$bullyingArray1[1];
						break;
					case 2 :
						++$bullyingArray1[2];
						break;
					case 3 :
						++$bullyingArray1[3];
						break;
					case 999 :
						++$bullyingArray1[4];
						break;
					}

				switch($bullyingEntry->getP9O2()) {
					case 0 :
						++$bullyingArray2[0];
						break;
					case 1 :
						++$bullyingArray2[1];
						break;
					case 2 :
						++$bullyingArray2[2];
						break;
					case 3 :
						++$bullyingArray2[3];
						break;
					case 999 :
						++$bullyingArray2[4];
						break;
				}

				switch($bullyingEntry->getP9O3()) {
					case 0 :
						++$bullyingArray3[0];
						break;
					case 1 :
						++$bullyingArray3[1];
						break;
					case 2 :
					++$bullyingArray3[2];
						break;
					case 3 :
						++$bullyingArray3[3];
						break;
					case 999 :
						++$bullyingArray3[4];
						break;
				}

				switch($bullyingEntry->getP9O4()) {
					case 0 :
						++$bullyingArray4[0];
						break;
					case 1 :
						++$bullyingArray4[1];
						break;
					case 2 :
						++$bullyingArray4[2];
						break;
					case 3 :
						++$bullyingArray4[3];
						break;
					case 999 :
						++$bullyingArray4[4];
						break;
				}
			}

			$data1 = "[";
				for ($i = 0; $i < count($bullyingName1); $i++) {
					$bullyingPercent1 = round(($bullyingArray1[$i] / $bullyingTotal * 100), 2);
					$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray1[$i] . "')";
					$data1 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent1 . ",'" . $bullyingPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
				}
			$data1 .= ']';
			
			$data2 = "[";
				for ($i = 0; $i < count($bullyingName1); $i++) {
					$bullyingPercent2 = round(($bullyingArray2[$i] / $bullyingTotal * 100), 2);
					$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray2[$i] . "')";
					$data2 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent2 . ",'" . $bullyingPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
				}
			$data2 .= ']';
			
			$data3 = "[";
				for ($i = 0; $i < count($bullyingName1); $i++) {
					$bullyingPercent3 = round(($bullyingArray3[$i] / $bullyingTotal * 100), 2);
					$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray3[$i] . "')";
					$data3 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent3 . ",'" . $bullyingPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
				}
			$data3 .= ']';
				
			$data4 = "[";
				for ($i = 0; $i < count($bullyingName1); $i++) {
					$bullyingPercent4 = round(($bullyingArray4[$i] / $bullyingTotal * 100), 2);
					$funtionTooltip = "createCustomHTMLContent('" .$bullyingName1[$i]."', 'Frecuencia', '" . $bullyingArray4[$i] . "')";
					$data4 .= "['" . $bullyingName1[$i] . "'," . $bullyingPercent4 . ",'" . $bullyingPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
				}
			$data4 .= ']';
			
			$dataReportGeneral = "[['Valor', 'Indicador', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}
			if($factorRegionList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}
			if($factorZoneList[0]->getMedia() > 0){
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#E9F26D'],";
            }else{
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#3AC777'],";
            }
            if(!empty($factorSchoolList) && $factorSchoolList[0]->getFactorCount() != 0){
                if($factorSchoolList[0]->getMedia() > 0){
                    $dataReportGeneral .= "['" . $reportNameGeneral[3] . "'," . round($factorSchoolList[0] -> getMedia(), 2) . ",'" . round($factorSchoolList[0] -> getMedia(), 2) . "', '#E9F26D'],";
                }else{
                    $dataReportGeneral .= "['" . $reportNameGeneral[3] . "'," . round($factorSchoolList[0] -> getMedia(), 2) . ",'" . round($factorSchoolList[0] -> getMedia(), 2) . "', '#3AC777'],";
                }   
            }else{
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "', '','" . $messageMediaNull . "', '']";
            }           
            if(!empty($factorClassroom) && $factorClassroom[0]->getMedia() != 999){
                if($factorClassroom[0]->getMedia() > 0){
                    $dataReportGeneral .= "['" . $reportNameGeneral[4] . "'," . round($factorClassroom[0] -> getMedia(), 2) . ",'" . round($factorClassroom[0] -> getMedia(), 2) . "', '#E9F26D']"; 
                }else{
                    $dataReportGeneral .= "['" . $reportNameGeneral[4] . "'," . round($factorClassroom[0] -> getMedia(), 2) . ",'" . round($factorClassroom[0] -> getMedia(), 2) . "', '#3AC777']";
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
					<div class='col-xs-12 col-md-12 description' align="center">
					<p>El factor de acoso escolar contiene cuatro &iacute;tems que se enfocan a la percepci&oacute;n de la frecuencia en que los 
						compa&ntilde;eros de aula realizan ciertas conductas durante las clases, que por su uso reiterativo pueden convertirse en 
						hostigamiento  (Mar&iacute;n-Mart&iacute;nez &amp; Reidl-Mart&iacute;nez, 2013). Se seleccionaron &iacute;tems que involucran 
						conductas de agresiones f&iacute;sicas y burlas entre compa&ntilde;eros y hacia el profesor. 
					</p>
					<p>	
						Siendo las peleas o empujones las conductas m&aacute;s comunes o frecuentes en las aulas, y la menos com&uacute;n o muy pocas 
						veces se realizan burlas hacia los maestros. Los valores bajos indican menor intensidad de acoso escolar; por el contrario, 
						valores altos indican mayor intensidad. El &iacute;ndice tiene valores entre -3.95 a 3.72, y una distribuci&oacute;n de 
						puntuaciones hacia valores bajos.
					</p>
				</div>
				</div>
				<div id="reportGeneral" class="col-xs-12 col-md-12">
					<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>			
				</div>
				<div id="chart3_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart2_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart4_bullying" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>
			
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChart4);
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
						title : 'Agresiones f\u00EDsicas como peleas o empujones',
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
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart1_bullying')).draw(data, options);
			
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
						title : 'Amenazas entre compa\u00F1eros',
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
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart2_bullying')).draw(data, options);
			
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
						title : 'Burlas entre compa\u00F1eros',
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
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart3_bullying')).draw(data, options);
			
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
						title : 'Burlas de tus compa\u00F1eros a los maestros',
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
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart4_bullying')).draw(data, options);
			
				}

				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
					var options = {
						height : 500,
						width : 1000,
						title : 'Acoso Escolar',
						bar : {
							groupWidth : '85%'
						},
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [-4, -3, -2, -1, 0, 1, 2, 3, 4]
						},
						vAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [0, 1, 2, 3, 4, 5]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations : {
									textStyle : {
										fontSize : 12,
										color : 'black'
									}
								}
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
						},
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
		<?php
			include ('../footer.php');
 ?>
	</body>
</html>