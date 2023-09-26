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
$join = 'INNER JOIN study_techniques_context on study_techniques_context.student = e.student ';
$join .= 'INNER JOIN idaepy_students on idaepy_students.student = study_techniques_context.student ';
$where = 'study_techniques_context.answered = :answered AND idaepy_students.cct = :cct AND idaepy_students.grade = :grade 
		  AND idaepy_students.school_group = :schoolGroup AND e.year = 2015 AND idaepy_students.year = :year';
$whereFields = array('cct' => $school -> getCct(), 'answered' => 1, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$contextList = $contextController -> displayByAction($where, $whereFields, $join);
$totalContext = count($contextList);

$studyTechniquesController = new StudyTechniquesContextController();
$join = 'INNER JOIN idaepy_students on idaepy_students.student = e.student ';
$where = "idaepy_students.cct LIKE :cct AND idaepy_students.grade = :grade AND idaepy_students.school_group = :schoolGroup
    AND idaepy_students.year = :year";
$whereFields = array('cct' => $school -> getCct(), 'grade' => $idaepyScheduled->getGrade(), 
    'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
$studyTechniquesList = $studyTechniquesController -> displayByAction($where, $whereFields, $join);
$studyTechniquesTotal = count($studyTechniquesList);

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
		<link href="../css/header.css" rel="stylesheet">
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
			$factorSchoolList = $factorSchoolController -> displayByAction($whereCCT, array('cct' => $school->getCct(), 'factor' => 7));
			
			$factorClassroomController = new FactorClassroomController();
			$whereCCT = "cct LIKE :cct AND factor = :factor AND grade = :grade AND school_group = :schoolGroup AND year = :year";
            $whereFields = array('cct' => $school -> getCct(), 'factor' => $factor, 'grade' => $idaepyScheduled->getGrade(), 
                'schoolGroup' => $idaepyScheduled->getSchoolGroup(), 'year' => $year);
			$factorClassroom = $factorClassroomController -> displayByAction($whereCCT, $whereFields);
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "region LIKE :region AND factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('region' => $school->getRegionZone(), 'factor' => 7));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => 7));
            
            $factorZoneController = new FactorZoneController();
            $whereZone = "zone LIKE :zone AND factor = :factor";
            $whereFieldsZone = array('zone' => $school->getSchoolRegionZoneObject()->getZone(), 'factor' => $factor);
            $factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

			$studyTechniquesArray1 = array();
			$studyTechniquesArray2 = array();
			$studyTechniquesArray3 = array();
			$studyTechniquesArray4 = array();
			$studyTechniquesArray5 = array();
			$studyTechniquesArray6 = array();
			
			$studyTechniquesName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $school -> getSchoolRegionObject() -> getName(), 
                 2 =>"Zona " . str_pad($school->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT), 
                 3 => $school -> getCct(), 4 => 'Aula');
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
				<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
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
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var data5 = <?php echo $data5; ?>;
				var data6 = <?php echo $data6; ?>;
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>; //Agregar

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChart4);
				google.charts.setOnLoadCallback(drawChart5);
				google.charts.setOnLoadCallback(drawChart6);
				google.charts.setOnLoadCallback(drawChartReportGeneral); //AGREGAR
			
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
				
				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'T\u00E9cnicas para el estudio',
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
		<?php include ('../footer.php'); ?>
	</body>
</html>