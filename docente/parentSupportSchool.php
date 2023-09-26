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
$join = 'INNER JOIN parent_support_context on parent_support_context.student = e.student';
$where = 'parent_support_context.cct = :cct AND parent_support_context.answered = :answered AND e.year = 2015';
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
			
			$parentSupportSchoolController = new ParentSupportContextController();
			$where = "cct LIKE :cct";
			$parentSupportList = $parentSupportSchoolController -> displayByAction($where, array('cct' => $school->getCct()));
			$parentSupportTotal = count($parentSupportList);
			
			$factorSchoolController = new FactorCctController();
			$whereCCT = "cct LIKE :cct AND factor = :factor";
			$factorSchoolList = $factorSchoolController -> displayByAction($whereCCT, array('cct' => $school->getCct(), 'factor' => 2));
			
			$factorRegionController = new FactorRegionController();
			$whereRegion = "region LIKE :region AND factor = :factor";
			$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('region' => $school->getRegionZone(), 'factor' => 2));
			
			$factorStateController = new FactorStateController();	
			$whereRegion = "factor LIKE :factor";		
			$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => 2));

			$factorZoneController = new FactorZoneController();
            $whereZone = "zone LIKE :zone AND factor = :factor";
            $whereFieldsZone = array('zone' => $school->getSchoolRegionZoneObject()->getZone(), 'factor' => $factor);
            $factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

			$parentSupportArray1 = array();
			$parentSupportArray2 = array();
			$parentSupportArray3 = array();
			$parentSupportArray4 = array();
			$parentSupportArray5 = array();
			$parentSupportArray6 = array();
			$parentSupportArray7 = array();
			$parentSupportArray8 = array();
			
			$parentSupportName1 = array("0" => "Nunca", "1" => "Algunas veces", "2" => "Casi siempre", "3" => "Siempre", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $school -> getSchoolRegionObject() -> getName(), 
                2 =>"Zona " . str_pad($school->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT), 
                3 => $school -> getCct());
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($parentSupportList as $parentSupportEntry) {
				switch($parentSupportEntry->getP4O1()) {
					case 0 :
						++$parentSupportArray1[0];
						break;
					case 1 :
						++$parentSupportArray1[1];
						break;
					case 2 :
						++$parentSupportArray1[2];
						break;
					case 3 :
						++$parentSupportArray1[3];
						break;
					case 999 :
						++$parentSupportArray1[4];
						break;
				}

				switch($parentSupportEntry->getP4O2()) {
					case 0 :
						++$parentSupportArray2[0];
						break;
					case 1 :
						++$parentSupportArray2[1];
						break;
					case 2 :
						++$parentSupportArray2[2];
						break;
					case 3 :
						++$parentSupportArray2[3];
						break;
					case 999 :
						++$parentSupportArray2[4];
						break;
				}

				switch($parentSupportEntry->getP4O3()) {
					case 0 :
						++$parentSupportArray3[0];
						break;
					case 1 :
						++$parentSupportArray3[1];
						break;
					case 2 :
						++$parentSupportArray3[2];
						break;
					case 3 :
						++$parentSupportArray3[3];
						break;
					case 999 :
						++$parentSupportArray3[4];
						break;
				}

				switch($parentSupportEntry->getP4O4()) {
					case 0 :
						++$parentSupportArray4[0];
						break;
					case 1 :
						++$parentSupportArray4[1];
						break;
					case 2 :
						++$parentSupportArray4[2];
						break;
					case 3 :
						++$parentSupportArray4[3];
						break;
					case 999 :
						++$parentSupportArray4[4];
						break;
				}
				
				switch($parentSupportEntry->getP4O5()) {
					case 0 :
						++$parentSupportArray5[0];
						break;
					case 1 :
						++$parentSupportArray5[1];
						break;
					case 2 :
						++$parentSupportArray5[2];
						break;
					case 3 :
						++$parentSupportArray5[3];
						break;
					case 999 :
						++$parentSupportArray5[4];
						break;
				}
				
				switch($parentSupportEntry->getP4O6()) {
					case 0 :
						++$parentSupportArray6[0];
						break;
					case 1 :
						++$parentSupportArray6[1];
						break;
					case 2 :
						++$parentSupportArray6[2];
						break;
					case 3 :
						++$parentSupportArray6[3];
						break;
					case 999 :
						++$parentSupportArray6[4];
						break;
				}
				
				switch($parentSupportEntry->getP4O7()) {
					case 0 :
						++$parentSupportArray7[0];
						break;
					case 1 :
						++$parentSupportArray7[1];
						break;
					case 2 :
						++$parentSupportArray7[2];
						break;
					case 3 :
						++$parentSupportArray7[3];
						break;
					case 999 :
						++$parentSupportArray7[4];
						break;
				}
				
				switch($parentSupportEntry->getP4O8()) {
					case 0 :
						++$parentSupportArray8[0];
						break;
					case 1 :
						++$parentSupportArray8[1];
						break;
					case 2 :
						++$parentSupportArray8[2];
						break;
					case 3 :
						++$parentSupportArray8[3];
						break;
					case 999 :
						++$parentSupportArray8[4];
						break;
				}
			}
										
			$data1 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent1 = round(($parentSupportArray1[$i] / $parentSupportTotal* 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray1[$i] . "')";
				//$data1 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent1 . ",'" . $parentSupportPercent1 . "%', '<div class=&#39;tooltip&#39;><b>" .$parentSupportName1[$i] . "<br /></b>Frecuencia: <b>" . $parentSupportArray1[$i] . "<b></div>'],";
				$data1 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent1 . ",'" . $parentSupportPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';

			$data2 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent2 = round(($parentSupportArray2[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray2[$i] . "')";
				$data2 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent2 . ",'" . $parentSupportPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent3 = round(($parentSupportArray3[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray3[$i] . "')";
				$data3 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent3 . ",'" . $parentSupportPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent4 = round(($parentSupportArray4[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray4[$i] . "')";
				$data4 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent4 . ",'" . $parentSupportPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';
			
			$data5 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent5 = round(($parentSupportArray5[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray5[$i] . "')";
				$data5 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent5 . ",'" . $parentSupportPercent5 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data5 .= ']';

			$data6 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent6 = round(($parentSupportArray6[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray6[$i] . "')";
				$data6 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent6 . ",'" . $parentSupportPercent6 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data6 .= ']';

			$data7 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent7 = round(($parentSupportArray7[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray7[$i] . "')";
				$data7 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent7 . ",'" . $parentSupportPercent7 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data7 .= ']';

			$data8 = "[";
			for ($i = 0; $i < count($parentSupportName1); $i++) {
				$parentSupportPercent8 = round(($parentSupportArray8[$i] / $parentSupportTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$parentSupportName1[$i]."', 'Frecuencia', '" . $parentSupportArray8[$i] . "')";
				$data8 .= "['" . $parentSupportName1[$i] . "'," . $parentSupportPercent8 . ",'" . $parentSupportPercent8 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
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
						Este factor se relaciona con el apoyo y supervisi&oacute;n de padres o tutores que involucran tanto actitudes de 
						compresi&oacute;n, cari&ntilde;o y aceptaci&oacute;n con los hijos; como el monitoreo y control de cuestiones de 
						disciplina escolar como las calificaciones, asistencia a la escuela y el repaso de tareas escolares (Hoeve, y otros, 2009). 
						El listado &iacute;tems que conforman este factor se enlistan a continuaci&oacute;n:
					</p>
					<div class="text-justify" id="instructions">
						<ul class="custom-bullet">
							<li>Est&aacute; pendiente de tus calificaciones.</li>						
							<li>Est&aacute; pendiente de tu asistencia a la escuela.</li>
							<li>Te expresa su afecto.</li>	
							<li>Te apoya para que cumplas con las tareas o trabajos escolares.</li>
							<li>Te explica lo que no entiendes en clase.</li>
							<li>Te platica sobre tus dudas e inquietudes de temas que son de tu inter&eacute;s.</li>
							<li>Te pone a repasar lo que viste en la escuela.</li>
							<li>Te platica de temas familiares.</li>
						</ul>
					</div>
					<p>
						Siendo las actitudes control de las calificaciones y asistencia de los dos primeros &iacute;tems  las que se perciben con 
						mayor frecuencia. Es un poco menos frecuente que alguno de los padres o tutor exprese su afecto, y la acci&oacute;n que es 
						menos com&uacute;n que realicen los padres o tutores es platicar de temas familiares con el estudiante.
					</p>
					<p>
						En este factor el &iacute;ndice tiene valores entre -2.00 a 3.8; donde los valores bajos significan menos intensidad de la percepci&oacute;n de 
						apoyo y supervisi&oacute;n de los padres; por el contrario, valores altos indican mayor intensidad del constructo evaluado. El promedio del Estado 
						es de 0.85, con una distribuci&oacute;n hacia puntajes altos.
					</p>
				</div>
				<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart7_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart8_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart3_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart1_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart5_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>	
				<div id="chart4_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
				<div id="chart6_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>					
				<div id="chart2_parentSupport" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			</div>
			<style>
				
			</style>
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
				google.charts.setOnLoadCallback(drawChart7);
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
					//var data = google.visualization.arrayToDataTable(data1);					
					var options = {
						height : 400,
						width : 700,
						focusTarget: 'datum' ,
						title : 'Te apoya para que cumplas con las tareas o trabajos escolares',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};					
					//new google.visualization.ComboChart(document.getElementById("chart1_parentSupport")).draw(data, options);
					new google.visualization.ComboChart(document.getElementById('chart1_parentSupport')).draw(data, options);
			
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
						title : 'Te platica de temas familiares',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart2_parentSupport')).draw(data, options);
			
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
						title : 'Te expresa su afecto',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart3_parentSupport')).draw(data, options);
			
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
						title : 'Te platica sobre tus dudas e inquietudes de temas que son de tu inter\u00E9s',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart4_parentSupport')).draw(data, options);
			
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
						title : 'Te explica lo que no entiendes en clase',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart5_parentSupport')).draw(data, options);
			
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
						title : 'Te pone a repasar lo que viste en la escuela',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart6_parentSupport')).draw(data, options);
			
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
						title : 'Est\u00E1 pendiente de tus calificaciones',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart7_parentSupport')).draw(data, options);
			
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
						title : 'Est\u00E1 pendiente de tu asistencia a la escuela',
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
							left : 80,
							top : 50,
							width: '70%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart8_parentSupport')).draw(data, options);
			
				}
				
				
				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'Apoyo y supervisi\u00F3n parental',
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