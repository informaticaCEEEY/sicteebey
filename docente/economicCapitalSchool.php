<?php
require ('../checkSession.php');

error_reporting(E_ALL);
ini_set('display_errors', False);
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

$contextController = new ContextController();
$join = 'INNER JOIN economic_capital_context on economic_capital_context.student = e.student';
$where = 'economic_capital_context.cct = :cct AND economic_capital_context.answered = :answered AND e.year = 2015';
$whereFields = array('cct' => $school -> getCct(), 'answered' => 1);
$contextList = $contextController -> displayByAction($where, $whereFields, $join);

$contextArray = array();

foreach ($contextList as $context) {
	switch($context->getGrade()) {
		case 3 :
			$contextArray[3][$context -> getSchoolGroup()] += 1;
			break;
		case 4 :
			$contextArray[4][$context -> getSchoolGroup()] += 1;
			break;
		case 5 :
			$contextArray[5][$context -> getSchoolGroup()] += 1;
			break;
		case 6 :
			$contextArray[6][$context -> getSchoolGroup()] += 1;
			break;
	}
}

ksort($contextArray[3]);
ksort($contextArray[4]);
ksort($contextArray[5]);
ksort($contextArray[6]);

$totalContext[3] = array_sum($contextArray[3]);
$totalContext[4] = array_sum($contextArray[4]);
$totalContext[5] = array_sum($contextArray[5]);
$totalContext[6] = array_sum($contextArray[6]);
$totalContext['total'] = $totalContext[3] + $totalContext[4] + $totalContext[5] + $totalContext[6];

$idaepyController = new IdaepyController();
$where = 'type = :type AND cct  = :cct AND year = 2015';
$whereFields = array('type' => 1, 'cct' => $school -> getCct());
$idaepyList = $idaepyController -> displayByAction($where, $whereFields);

$idaepyArray = array();

foreach ($idaepyList as $idaepy) {
	switch($idaepy->getGrade()) {
		case 3 :
			$idaepyArray[3][$idaepy -> getSchoolGroup()] = $idaepy -> getTotal();
			break;
		case 4 :
			$idaepyArray[4][$idaepy -> getSchoolGroup()] = $idaepy -> getTotal();
			break;
		case 5 :
			$idaepyArray[5][$idaepy -> getSchoolGroup()] = $idaepy -> getTotal();
			break;
		case 6 :
			$idaepyArray[6][$idaepy -> getSchoolGroup()] = $idaepy -> getTotal();
			break;
	}
}

$totalIdaepy[3] = array_sum($idaepyArray[3]);
$totalIdaepy[4] = array_sum($idaepyArray[4]);
$totalIdaepy[5] = array_sum($idaepyArray[5]);
$totalIdaepy[6] = array_sum($idaepyArray[6]);
$totalIdaepy['total'] = $totalIdaepy[3] + $totalIdaepy[4] + $totalIdaepy[5] + $totalIdaepy[6];

$idaepyController = new IdaepyController();
$where = 'type = :type AND cct  = :cct AND year = 2015';
$whereFields = array('type' => 2, 'cct' => $school -> getCct());
$idaepyProgList = $idaepyController -> displayByAction($where, $whereFields);

$idaepyProgArray = array();

foreach ($idaepyProgList as $idaepyProg) {
	switch($idaepyProg->getGrade()) {
		case 3 :
			$idaepyProgArray[3][$idaepyProg -> getSchoolGroup()] = $idaepyProg -> getTotal();
			break;
		case 4 :
			$idaepyProgArray[4][$idaepyProg -> getSchoolGroup()] = $idaepyProg -> getTotal();
			break;
		case 5 :
			$idaepyProgArray[5][$idaepyProg -> getSchoolGroup()] = $idaepyProg -> getTotal();
			break;
		case 6 :
			$idaepyProgArray[6][$idaepyProg -> getSchoolGroup()] = $idaepyProg -> getTotal();
			break;
	}
}

$totalIdaepyProg[3] = array_sum($idaepyProgArray[3]);
$totalIdaepyProg[4] = array_sum($idaepyProgArray[4]);
$totalIdaepyProg[5] = array_sum($idaepyProgArray[5]);
$totalIdaepyProg[6] = array_sum($idaepyProgArray[6]);
$totalIdaepyProg['total'] = $totalIdaepyProg[3] + $totalIdaepyProg[4] + $totalIdaepyProg[5] + $totalIdaepyProg[6];

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
		<link rel="stylesheet" href="../css/table.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>

		<div class="container-fluid">
			<form role="form" name="schoolFactor" id="schoolFactor" action="factorSchool.php" method="post" accept-charset="UTF-8">
				<input type="hidden" id="cct" name="cct" value="<?php echo($school -> getCct()); ?>"/>				
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
							<th>Programados IDAEPY</th>
							<th>Evaluados IDAEPY</th>
							<th>Evaluados Contexto</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					
					$count3 = 1;
					$count4 = 1;
					$count5 = 1;
					$count6 = 1;
					foreach($idaepyProgArray[3] as $key => $value){
						// Tercero
						echo('<tr>');
						if($count3 == 1){
							echo('<td rowspan="'.count($idaepyProgArray[3]).'" class="theadR">3&deg;</td>');
						}
						echo('<td>'.$key.'</td>');
						echo('<td>'.$idaepyProgArray[3][$key].'</td>');
						echo('<td>'.$idaepyArray[3][$key].'</td>');
						if($contextArray[3][$key] != ''){
							echo('<td>'.$contextArray[3][$key].'</td>');
						}else{
							echo('<td>0</td>');
						}
						echo('</tr>');
						$count3 += 1;
					}
					foreach($idaepyProgArray[4] as $key => $value){
						// Cuarto
						echo('<tr>');
						if($count4 == 1){
							echo('<td rowspan="'.count($idaepyProgArray[4]).'" class="theadR">4&deg;</td>');
						}
						echo('<td>'.$key.'</td>');
						echo('<td>'.$idaepyProgArray[4][$key].'</td>');
						echo('<td>'.$idaepyArray[4][$key].'</td>');
						if($contextArray[4][$key] != ''){
							echo('<td>'.$contextArray[4][$key].'</td>');
						}else{
							echo('<td>0</td>');
						}
						echo('</tr>');
						$count4 += 1;
					}
					foreach($idaepyProgArray[5] as $key => $value){
						// Quinto
						echo('<tr>');
						if($count5 == 1){
							echo('<td rowspan="'.count($idaepyProgArray[5]).'" class="theadR">5&deg;</td>');
						}
						echo('<td>'.$key.'</td>');
						echo('<td>'.$idaepyProgArray[5][$key].'</td>');
						echo('<td>'.$idaepyArray[5][$key].'</td>');
						if($contextArray[5][$key] != ''){
							echo('<td>'.$contextArray[5][$key].'</td>');
						}else{
							echo('<td>0</td>');
						}
						echo('</tr>');
						$count5 += 1;
					}
					foreach($idaepyProgArray[6] as $key => $value){
						// Sexto						
						echo('<tr>');
						if($count6 == 1){
							echo('<td rowspan="'.count($idaepyProgArray[6]).'" class="theadR">6&deg;</td>');
						}
						echo('<td>'.$key.'</td>');
						echo('<td>'.$idaepyProgArray[6][$key].'</td>');
						echo('<td>'.$idaepyArray[6][$key].'</td>');
						if($contextArray[6][$key] != ''){
							echo('<td>'.$contextArray[6][$key].'</td>');
						}else{
							echo('<td>0</td>');							
						}
						$count6 += 1;											
					}	
						echo('</tr>');
						echo('<tr>');
						echo('<td colspan="2">Total</td>');
						echo('<td>'.$totalIdaepyProg['total'].'</td>');
						echo('<td>'.$totalIdaepy['total'].'</td>');
						echo('<td>'.$totalContext['total'].'</td>');
						echo('</tr>');
					 ?>
					</tbody>
				</table>
			</div>
			<div class="col-xs-12 col-md-12">
				<hr />	
			</div>
			
			<?php 
			
			$economicCapitalSchoolController = new EconomicCapitalContextController();
			$where = "cct LIKE :cct";
			$economicCapitalList = $economicCapitalSchoolController -> displayByAction($where, array('cct' => $school->getCct()));
			$economicCapitalTotal = count($economicCapitalList);
			
			$factorSchoolController = new FactorCctController();
			$whereCCT = "cct LIKE :cct AND factor = :factor";
			$factorSchoolList = $factorSchoolController -> displayByAction($whereCCT, array('cct' => $school->getCct(), 'factor' => 3));
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "region LIKE :region AND factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('region' => $school->getRegionZone(), 'factor' => 3));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => 3));
            
            $factorZoneController = new FactorZoneController();
            $whereZone = "zone LIKE :zone AND factor = :factor";
            $whereFieldsZone = array('zone' => $school->getSchoolRegionZoneObject()->getZone(), 'factor' => $factor);
            $factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

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
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $school -> getSchoolRegionObject() -> getName(), 
                2 =>"Zona " . str_pad($school->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT), 
                3 => $school -> getCct());
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
			for ($i = 0; $i < count($economicCapitalName2); $i++) {
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
			$dataReportGeneral .= ']';
						
			
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
				<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart2_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_economicCapital" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
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
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>;

	
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
			
					new google.visualization.ComboChart(document.getElementById('chart8_economicCapital')).draw(data, options);
			
				}
				
				
				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'Estatus socioecon\u00F3mico',
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