<?php
require ('../checkSession.php');

$userController = new UsersController();
if (!isset($_POST['cohorte']) && !isset($_POST['schoolRegion'])) {
	echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
}else{
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new CohorteController();
	$cohorte = $controller->getEntityAction($cohorte);
}

if(!$cohorte){
	echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
}

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct AND e.cct LIKE :cct2";

$schoolRegionController = new SchoolRegionController();
$schoolRegionObject = $schoolRegionController->getEntityAction($schoolRegion);
$schoolLevelController = new SchoolLevelController();
$schoolLevelObject = $schoolLevelController->getEntityAction(2);

$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

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
		<title>Trayectorias Escolares</title>
		<!--link href="css/screen.css" rel="stylesheet" type="text/css" /-->
    <!--link rel="stylesheet" href="css/jquery-ui-1.8.4.custom.css" type="text/css"/-->
    <link rel="icon" href="../img/logog.ico">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/buttonTop.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
    <!--link href="css/jquery-confirm.css" rel="stylesheet" type="text/css"  /-->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" href="../css/chart.css">
		<link rel="stylesheet" href="../css/table.css">
		<link rel="stylesheet" href="../css/factorTable.css">
  </head>
  <body>
    <?php include('header.php'); ?>

	<div class="container">
	<form name="report" id="report" action="../<?php echo $user->getAbbreviation() ?>/generalRegion.php" method="post" accept-charset="UTF-8"></form>
	<button type="button" id="buttonBack" class="buttonBack" onclick="document.forms.report.submit()"><span>Regresar</span></button>
	<div class='text-center'><h2 class='form-signin-heading'><br />Reporte por región de trayectorias escolares</h2></div><br />
	<div class="col-xs-12 col-md-12">
		<div><h4 class='form-signin-heading col-md-3 text-left'>Nivel: <?php echo($schoolLevelObject->getName()); ?></h4></div>
		<div><h4 class='form-signin-heading col-md-3'>Regi&oacute;n: <?php echo($schoolRegionObject->getName()); ?> </h4></div>
	</div>
	<div class="col-xs-12 col-md-12"><hr /><br /></div>
	<div class="table-responsive col-xs-12 col-md-12">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th colspan="12"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica </th>
			</tr>
			<tr>
				<th colspan="12"> Cohorte <?php echo $cohorteName ?> </th>
			</tr>
			<tr>
				<th colspan="3">Alumnos</th>
				<th colspan="6">Primaria</th>
				<th colspan="3">Secundaria</th>
			</tr>
			<tr>
				<th>Ciclo Escolar</th>
				<th>Inscritos</th>
				<th>Grado Ideal</th>
				<th>1&deg;</th>
				<th>2&deg;</th>
				<th>3&deg;</th>
				<th>4&deg;</th>
				<th>5&deg;</th>
				<th>6&deg;</th>
				<th>1&deg;</th>
				<th>2&deg;</th>
				<th>3&deg;</th>
			</tr>
		</thead>
		<tbody>

<?php

//foreach($schoolPeriod as $period){
$totalIdealList = array();
$totalCicloList = array();
$rezagoLigList = array();
$rezagoGraList = array();
$nameCicloList = array();
$studentCicloGrad = array();
$studentCicloList = array();
$studentsList = array();
$studentCicloGrade = array();
$studentCicloStatus = array();

array_push ($totalCicloList, 0);
array_push ($rezagoLigList, 0);
array_push ($rezagoGraList, 0);

//for($ciclo=0; $ciclo<$numCiclo; ++$ciclo){
$ciclo = 0 ;

if($numCiclo > 6){
	$studentsSecundOK = TRUE;
	$newNumCiclo = 6;
}else{
	$studentsSecundOK = FALSE;
	$newNumCiclo = $numCiclo;
}

function merge_arrays_obj(){
  $func_info = debug_backtrace();
  $func_args = $func_info[0]['args'];
  $return_array_data = array();
  foreach($func_args as $args_index=>$args_data){
    if(is_array($args_data) || is_object($args_data)){
    $return_array_data = array_merge($return_array_data,$args_data);
    }
  }
  return $return_array_data;
}

while($ciclo < $numCiclo){

	/* Variables grade almacenan el numero de alumnos inscritos  por grado */
	$studentGrade = array();
	$nController = ucwords($schoolPeriod[$ciclo]->getSchoolPeriodObject()->getTablePeriod()).'Controller';
	$studentList = array();
	$controller = new $nController();
	$showFields = 'e.id, e.idStudent, e.grade, e.status, e.cct';
	if($ciclo < 6){
		$joinC = 'INNER JOIN ' . $cohorte->getTableCohorte() . ' AS cohorte ON e.idStudent = cohorte.idStudent
			INNER JOIN school AS s1 ON s1.id = cohorte.cct
			INNER JOIN school_region_zone AS srz1 ON srz1.id = s1.school_region_zone
			INNER JOIN school AS s2 ON s2.id = e.cct
			INNER JOIN school_region_zone AS srz2 ON srz2.id = s2.school_region_zone';
		$where = 'cohorte.grade = 1 AND cohorte.reprobate = 0 AND srz1.school_region = :schoolRegion AND srz2.school_region = :schoolRegion';
		$whereFields = array('schoolRegion' => $schoolRegion);
		$students = $controller->displayBy2Action($where, $whereFields, $joinC, $showFields);
	}else{
		//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct AND e.cct LIKE :cct2";
		//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct";
		$joinC = 'INNER JOIN ' . $cohorte->getTableCohorte() . ' AS cohorte ON e.idStudent = cohorte.idStudent
			INNER JOIN school AS s ON s.id = cohorte.cct
			INNER JOIN school_region_zone AS srz ON srz.id = s.school_region_zone';
		$where = 'cohorte.grade = 1 AND cohorte.reprobate = 0 AND srz.school_region = :schoolRegion';
		$whereFields = array('schoolRegion' => $schoolRegion);
		$students = $controller->displayBy2Action($where, $whereFields, $joinC, $showFields);
	}

	$totalCiclo = count($students);
	//exit;

	array_push ($totalCicloList, $totalCiclo);
	array_push ($nameCicloList, $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName());

	// se recorre el arreglo $totalCiclo para asignar a cada estudiante en su grado correspondiente
	for($numStudent=0; $numStudent<$totalCiclo; ++$numStudent){

		$idStudent = $students[$numStudent]['idStudent'];
		$stdGrade =  $students[$numStudent]['grade'];
		$stdStatus = $students[$numStudent]['status'];
		array_push ($studentList, $idStudent);
		$studentCicloGrade[$ciclo+1][$stdGrade][] = $idStudent;
		$studentCicloStatus[$ciclo+1][$stdGrade][$stdStatus][] = $idStudent;
	}

	array_push ($studentCicloList, $studentList);
	unset($studentList);

	//Se guarda el numero de inscritos en el grado ideal en un array
	switch($ciclo+1){
			case 1:
				$totalIdealList[1] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
			case 2:
				$totalIdealList[2] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
			case 3:
				$totalIdealList[3] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
			case 4:
				$totalIdealList[4] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
			case 5:
				$totalIdealList[5] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
			case 6:
				$totalIdealList[6] = count($studentCicloGrade[$ciclo+1][$ciclo+1]);
				break;
		}

		//Se guarda el numero de inscritos en el grado anterior al grado ideal (rezago ligero) en un array
		switch($ciclo+1){
			case 1:
				$rezagoLigList[1] = 0;
				break;
			case 2:
				$rezagoLigList[2] = count($studentCicloGrade[$ciclo+1][$ciclo]);
				break;
			case 3:
				$rezagoLigList[3] = count($studentCicloGrade[$ciclo+1][$ciclo]);
				break;
			case 4:
				$rezagoLigList[4] = count($studentCicloGrade[$ciclo+1][$ciclo]);
				break;
			case 5:
				$rezagoLigList[5] = count($studentCicloGrade[$ciclo+1][$ciclo]);
				break;
			case 6:
				$rezagoLigList[6] = count($studentCicloGrade[$ciclo+1][$ciclo]);
				break;
		}

		//Se guarda el numero de inscritos dos grados anteriores o mas al grado ideal (rezago grave) en un array
		switch($ciclo+1){
			case 1:
				$rezagoGraList[1] = 0;
				break;
			case 2:
				$rezagoGraList[2] = 0;
				break;
			case 3:
				$rezagoGraList[3] = count($studentCicloGrade[$ciclo+1][1]);
				break;
			case 4:
				$rezagoGraList[4] = count($studentCicloGrade[$ciclo+1][1]) + count($studentCicloGrade[$ciclo+1][2]);
				break;
			case 5:
				$rezagoGraList[5] = count($studentCicloGrade[$ciclo+1][1]) + count($studentCicloGrade[$ciclo+1][2]) + count($studentCicloGrade[$ciclo+1][3]);
				break;
			case 6:
				$rezagoGraList[6] = count($studentCicloGrade[$ciclo+1][1]) + count($studentCicloGrade[$ciclo+1][2]) + count($studentCicloGrade[$ciclo+1][3]) + count($studentCicloGrade[$ciclo+1][4]);
				break;
		}

	  /*
	   * $studentCicloGrad: lista de alumnos aprobados en sexto grado por ciclo escolar
	   * $studentSecRez: lista de alumnos en sexto grado
	   *
	   * */

		 if(($ciclo+1) == 7){
 			$testx1 = array_intersect($studentCicloGrade[7][7], $studentCicloGrade[6][6]);
 			$testx2 = array_intersect($studentCicloGrade[7][8], $studentCicloGrade[6][6]);
 			$testx3 = array_intersect($studentCicloGrade[7][9], $studentCicloGrade[6][6]);
 			unset($studentCicloGrade[7][7]);
 			unset($studentCicloGrade[7][8]);
 			unset($studentCicloGrade[7][9]);
 			$studentCicloGrade[7][7] = $testx1;
 			$studentCicloGrade[7][8] = $testx2;
 			$studentCicloGrade[7][9] = $testx3;
 			$totalCiclo = count($studentCicloGrade[7] ,COUNT_RECURSIVE)-count($studentCicloGrade[7]);
 		}
 		if(($ciclo+1) == 8){
 			$testx1a = array_intersect($studentCicloGrade[8][7], $studentCicloGrade[7][6]);
 			$testx1b = array_intersect($studentCicloGrade[8][7], $studentCicloGrade[7][7]);
 			$testx2a = array_intersect($studentCicloGrade[8][8], $studentCicloGrade[7][6]);
 			$testx2b = array_intersect($studentCicloGrade[8][8], $studentCicloGrade[7][7]);
 			$testx3a = array_intersect($studentCicloGrade[8][9], $studentCicloGrade[7][6]);
 			$testx3b = array_intersect($studentCicloGrade[8][9], $studentCicloGrade[7][7]);
 			/*$testx1a = array_intersect($studentCicloGrade[8][7], $studentCicloGrade[6][6]);
 			$testx1b = array_intersect($studentCicloGrade[8][7], $studentCicloGrade[7][6]);
 			$testx2a = array_intersect($studentCicloGrade[8][8], $studentCicloGrade[6][6]);
 			$testx2b = array_intersect($studentCicloGrade[8][8], $studentCicloGrade[7][6]);
 			$testx3a = array_intersect($studentCicloGrade[8][9], $studentCicloGrade[6][6]);
 			$testx3b = array_intersect($studentCicloGrade[8][9], $studentCicloGrade[7][6]);*/
 			unset($studentCicloGrade[8][7]);
 			unset($studentCicloGrade[8][8]);
 			unset($studentCicloGrade[8][9]);
 			$studentCicloGrade[8][7] = merge_arrays_obj($testx1a, $testx1b);
 			$studentCicloGrade[8][8] = merge_arrays_obj($testx2a, $testx2b);
 			$studentCicloGrade[8][9] = $testx3a;
 			$totalCiclo = count($studentCicloGrade[8] ,COUNT_RECURSIVE)-count($studentCicloGrade[8]);
 		}
 		if(($ciclo+1) == 9){
 			$testx1a = array_intersect($studentCicloGrade[9][7], $studentCicloGrade[8][7]);
 			$testx1b = array_intersect($studentCicloGrade[9][7], $studentCicloGrade[8][6]);
 			$testx2a = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[8][8]);
 			$testx2b = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[8][7]);
 			$testx2c = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[8][6]);
 			$testx3a = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[8][8]);
 			$testx3b = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[8][7]);
 			$testx3c = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[8][6]);
 			/*$testx1a = array_intersect($studentCicloGrade[9][7], $studentCicloGrade[6][6]);
 			$testx1b = array_intersect($studentCicloGrade[9][7], $studentCicloGrade[7][6]);
 			$testx1c = array_intersect($studentCicloGrade[9][7], $studentCicloGrade[8][6]);
 			$testx2a = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[6][6]);
 			$testx2b = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[7][6]);
 			$testx2c = array_intersect($studentCicloGrade[9][8], $studentCicloGrade[8][6]);
 			$testx3a = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[6][6]);
 			$testx3b = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[7][6]);
 			$testx3c = array_intersect($studentCicloGrade[9][9], $studentCicloGrade[8][6]);*/
 			unset($studentCicloGrade[9][7]);
 			unset($studentCicloGrade[9][8]);
 			unset($studentCicloGrade[9][9]);
 			$studentCicloGrade[9][7] = merge_arrays_obj($testx1a, $testx1b);
 			$studentCicloGrade[9][8] = merge_arrays_obj($testx2a, $testx2b, $testx2c);
 			$studentCicloGrade[9][9] = merge_arrays_obj($testx3a, $testx3b, $testx3c);
 			$totalCiclo = count($studentCicloGrade[9] ,COUNT_RECURSIVE)-count($studentCicloGrade[9]);
 		}

	echo '
			<tr>
				<td>' . $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName() . '</td>
				<td>' . number_format($totalCiclo, 0, '', ',') . '</td>
				<td>' . $schoolPeriod[$ciclo]->getGrade() . '&deg;</td>';

			for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
				if($ciclo+1 == $nCiclo){
					echo'<td class="success">' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
				}elseif($ciclo+1 > $nCiclo + 1){
					echo'<td class="warning">' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
				}else{
					echo'<td>' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
				}
			}
     	   echo'
			</tr>';

		++$ciclo;

}
	echo'</tbody>
	</table>';

	$datos = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
	 for($i=1; $i<=$newNumCiclo; $i++){
	 	$datos .= "['".$nameCicloList[$i-1]."',".$totalCicloList[$i].",". count($studentCicloGrade[$i][$i])."],";
	 }
	$datos .= ']';

	?>
	</div>

		<div class="col-xs-12 col-md-12 text-center">
			<div class="col-xs-12 col-md-3 text-left graphSchool">
				<table class="table">
					<button class="btn btn-primary" onclick="drawChart()" data-toggle="modal" data-target="#modal_column_chart" data-backdrop="static" data-keyboard="false">
						Ver grafica
					</button>
				</table>
			</div>
			<div class="col-xs-6 col-md-3 graphSchool">
				<table class="table table-bordered">
					<tr>
						<td class="success"></td>
						<td>Trayectoria ideal</td>
					</tr>
				</table>
			</div>
			<div class="col-xs-6 col-md-3 graphSchool">
				<table class="table table-bordered">
					<tr>
						<td class="warning"></td>
						<td>Rezago grave</td>
					</tr>
				</table>
			</div>
			<div class="col-md-3">
			</div>
		</div>
		<div class="modal fade" id="modal_column_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Flujo de los alumnos en educaci&oacute;n b&aacute;sica</h4>
					</div>
					<div class="modal-body">
						<div id="column_chart_div"></div>
					</div>
					<div class="modal-footer">
						<h4 class="modal-title" id="myModalLabel">Cohorte <?php echo $cohorteName ?></h4>
						<!--button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button-->
					</div>
				</div>
			</div>
		</div>

		<div id='chart1_img_div'></div>
		<div id='chart2_img_div'></div>

	<br />
	<br />
	<div class="table-responsive col-xs-12 col-md-12">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th colspan="7"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
			</tr>
			<tr>
				<th colspan="7"> Cohorte <?php echo $cohorteName ?> </th>
			</tr>
			<tr>
				<th>Ciclo Escolar</th>
				<th>Grado Ideal</th>
				<th>Inscritos en el sistema</th>
				<th>Inscritos grado ideal</th>
				<th>Rezago ligero</th>
				<th>Rezago grave</th>
				<th>Sin registro</th>
			</tr>
		</thead>
		<tbody>

		<?php

		$totIdeal = count($totalIdealList);
		for($i=1; $i<=$totIdeal; ++$i){

				$inscritPorcent = round(($totalCicloList[$i]/$totalCicloList[1]*100), 1);
				$gradoIdealPorcent = round(($totalIdealList[$i]/$totalIdealList[1]*100), 1);
				$rezagoLigPorcent = round(($rezagoLigList[$i]/$totalCicloList[1]*100), 1);
				$rezagoGraPorcent = round(($rezagoGraList[$i]/$totalCicloList[1]*100), 1);

				echo '
					<tr>
						<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
						<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' .  '</td>
						<td>' . $inscritPorcent . ' %</td>
						<td>' . $gradoIdealPorcent . ' %</td>
						<td>' . $rezagoLigPorcent . ' %</td>
						<td>' . $rezagoGraPorcent . ' %</td>
						<td>' . round((100 - $inscritPorcent), 1) . ' %</td>
					</tr>';
		}
		echo'</tbody>
	</table>';

	 $datos2 = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
	 for($i=1; $i<=$newNumCiclo; $i++){

		$noInsc = $totalCicloList[1] - $totalCicloList[$i];

	 	$datos2 .= "['".$nameCicloList[$i-1]."',".$totalIdealList[$i].",".$rezagoLigList[$i].",".$rezagoGraList[$i].",".$noInsc."],";
	 }
	 $datos2 .= ']';

	?>
	</div>

		<div class="col-xs-12 col-md-12 text-center">
			<div class="col-xs-12 col-md-3 text-left graphSchool">
				<table class="table">
					<button class="btn btn-primary" onclick="drawStacked()" data-toggle="modal" data-target="#modal_bar_chart" data-backdrop="static" data-keyboard="false">
						Ver grafica
					</button>
				</table>
			</div>
		</div>
		<div class="modal" id="modal_bar_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</h4>
					</div>
					<div class="modal-body">
						<div id="bar_chart_div"></div>
					</div>
					<div class="modal-footer">
						<h4 class="modal-title" id="myModalLabel">Cohorte <?php echo $cohorteName ?></h4>
						<!--button type="button" class="btn btn-default" data-dismiss="modal">
							Close
						</button-->
					</div>
				</div>
			</div>
		</div>
	<br>
	<br>
	<div class="table-responsive col-xs-12 col-md-12">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th colspan="10"> Trayectoria ideal</th>
			</tr>
			<tr>
				<th colspan="10"> Cohorte <?php echo $cohorteName ?> </th>
			</tr>
			<tr>
				<th colspan="2"></th>
				<th colspan="5">Alumnos</th>
				<th colspan="3">Eficiencias</th>
			</tr>
			<tr>
				<th>Grado Ideal</th>
				<th>Ciclo Escolar</th>
				<th>Inscritos</th>
				<th>Aprobados</th>
				<th>Reprobados</th>
				<th>Adeudan 1 o 2 asignaturas</th>
				<th>Adeudan 3, 4 o 5 asignaturas</th>
				<th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que aprueban el grado escolar del total
            	de alumnos inscritos en el mismo grado (g)." data-placement="bottom">Intragrado</a></th>
        <th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que se inscriben al siguiente grado (g+1) escolar del total de alumnos aprobados
              del grado escolar (g)" data-placement="bottom">Intergrado</a></th>
        <th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que aprueban el grado escolar ideal (g) respecto al total de alumnos de la cohorte
              inicial (c)" data-placement="bottom">De la cohorte</a></th>
			</tr>
		</thead>
		<tbody>

	<?php

		if($studentsSecundOK == TRUE){
			//print_r($studentSecRez[6]);
			$studentsSecunBySchool = array_intersect($studentCicloGrade[7][7], $studentCicloStatus[6][6]['A']);
			$studentsSecunBySchool = count($studentsSecunBySchool);
		}else{
			$studentsSecunBySchool = 0;
		}

		for($i=1; $i<=$totIdeal; ++$i){

			$eficIntergrado = round((count($studentCicloStatus[$i][$i]['A'])/$totalIdealList[$i]*100), 1);
			$eficIntragrado = round(($totalIdealList[$i+1]/count($studentCicloStatus[$i][$i]['A'])*100), 1);
			$eficCohorte = round((count($studentCicloStatus[$i][$i]['A'])/$totalCicloList[1]*100), 1);

			if($i == 6){
				$eficIntragrado = round(($studentsSecunBySchool/count($studentCicloStatus[$i][$i]['A'])*100), 1);
			}

				echo '
					<tr>
						<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' . '</td>
						<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
						<td>' . number_format($totalIdealList[$i], 0, '', ',') . '</td>
						<td>' . number_format(count($studentCicloStatus[$i][$i]['A']), 0, '', ',') . '</td>
						<td>' . number_format(count($studentCicloStatus[$i][$i]['R']), 0, '', ',') . '</td>
						<td>' . number_format(count($studentCicloStatus[$i][$i]['X']), 0, '', ',') . '</td>
						<td>' . number_format(count($studentCicloStatus[$i][$i]['Z']), 0, '', ',') . '</td>
						<td>' . $eficIntergrado . '%</td>
						<td>' . $eficIntragrado . '%</td>
						<td>' . $eficCohorte . '%</td>
					</tr>';
		}
		echo'</tbody>
	</table>';

	?>
	</div>

	<div class="table-responsive col-xs-12 col-md-12">
    	<table class="table table-bordered table-striped table-hover table-condensed">
    		<thead>
    			<tr>
    				<th colspan="11">Estatus de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
    			</tr>
    			<tr>
    				<th colspan="11"> Cohorte <?php echo $cohorteName ?></th>
    			</tr>
    			<tr>
    				<th colspan="5">Al iniciar el ciclo</th>
    				<th colspan="2">Rezago</th>
    				<th colspan="2">Sin registro</th>
    				<th colspan="2">Al finalizar el ciclo</th>
    			</tr>
    			<tr>
    				<th>Cohorte Escolar</th>
    				<th>Total de alumnos</th>
    				<th>Ciclo escolar</th>
    				<th>Inscritos en el sistema</th>
    				<th>Inscritos (6&deg;)</th>
    				<th>Ligero</th>
    				<th>Grave</th>
    				<th>Ciclo escolar</th>
    				<th>Hace 3 ciclos escolares</th>
    				<th>Egresados</th>
    				<th>Absorcion (1&deg; secundaria)</th>
    			</tr>
    		</thead>
    		<tbody>

<?php

		$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);
		echo '
				<tr>
					<td>' . $cohorteName . '</td>
					<td>' . number_format($totalCicloList[1], 0, '', ',') . '</td>
					<td>' . $nameCicloList[5] . '</td>
					<td>' . number_format($totalCicloList[6], 0, '', ',') . '</td>
					<td>' . number_format($totalIdealList[6], 0, '', ',') . '</td>
					<td>' . number_format($rezagoLigList[6], 0, '', ',') . '</td>
					<td>' . number_format($rezagoGraList[6], 0, '', ',') . '</td>
					<td>' . number_format(($totalCicloList[1] - $totalCicloList[6]), 0, '', ',') . '</td>
					<td>' . number_format(count($noReg3Period), 0, '', ',') . '</td>
					<td>' . number_format(count($studentCicloStatus[6][6]['A']), 0, '', ',') . '</td>
					<td>' . number_format($studentsSecunBySchool, 0, '', ',') . '</td>
				</tr>';
?>
            </tbody>
        </table>
	</div>

	<div class="table-responsive col-xs-12 col-md-12">
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
        	<th colspan="11">Porcentaje de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
        </tr>
        <tr>
          <th colspan="11"> Cohorte <?php echo $cohorteName ?></th>
        </tr>
        <tr>
          <th colspan="5">Al iniciar el ciclo</th>
          <th colspan="2">Rezago</th>
          <th colspan="2">Sin registro</th>
          <th colspan="2">Al finalizar el ciclo</th>
        </tr>
        <tr>
          <th>Cohorte Escolar</th>
          <th>Total de alumnos</th>
          <th>Ciclo escolar</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos (6&deg;)</th>
          <th>Ligero</th>
          <th>Grave</th>
          <th>Ciclo escolar</th>
          <th>Hace 3 ciclos escolares</th>
          <th>Egresados</th>
          <th>Absorcion (1&deg; secundaria)</th>
        </tr>
      </thead>
    	<tbody>

<?php

    $inscPorc = round($totalCicloList[6]/$totalCicloList[1]*100, 1);
    $inscIdealPorc = round($totalIdealList[6]/$totalCicloList[1]*100, 1);
    $slightLagPorc = round($rezagoLigList[6]/$totalCicloList[1]*100, 1);
    $seriousLagPorc = round($rezagoGraList[6]/$totalCicloList[1]*100, 1);
    $noInsc = ($totalCicloList[1] - $totalCicloList[6]);
    $noInscPorc = round($noInsc/$totalCicloList[1]*100, 1);
    $noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);
    $noReg3Insc = count($noReg3Period);
    $noReg3InscPorc = round($noReg3Insc/$totalCicloList[1]*100, 1);
    $aprovPorc = round(count($studentCicloStatus[6][6]['A'])/$totalCicloList[1]*100, 1);
    $inscSecuPorc = round($studentsSecunBySchool/$totalCicloList[1]*100, 1);

    echo '
		    	<tr>
		        <td>' . $cohorteName . '</td>
		        <td>' . number_format($totalCicloList[1], 0, '', ',') . '</td>
		        <td>' . $nameCicloList[5] . '</td>
		        <td>' . $inscPorc . '</td>
		        <td>' . $inscIdealPorc . '</td>
		        <td>' . $slightLagPorc . '</td>
		        <td>' . $seriousLagPorc . '</td>
		        <td>' . $noInscPorc . '</td>
		        <td>' . $noReg3InscPorc . '</td>
		        <td>' . $aprovPorc . '</td>
		        <td>' . $inscSecuPorc . '</td>
		    </tr>';
?>
      </tbody>
    </table>
	</div>

	<a class="go-top" href="#">Subir</a>
	<script src="../imports/js/buttonTop.js"></script>
	<script>

	       $(document).ready(function(){
                $('[data-toggle="tooltip"]').tooltip();
            });

			var datos=<?php echo $datos; ?>;
			var datos2=<?php echo $datos2; ?>;

			google.charts.load("current", {packages:['corechart']});
    		google.charts.setOnLoadCallback(drawChart);
    		google.charts.setOnLoadCallback(drawStacked);

    		function drawChart() {
    			var data = google.visualization.arrayToDataTable(datos);

    			var options = {
    				height: 450,
    				width: 1000,
	        		legend: { position: 'right', alignment: 'left', textStyle: {fontSize: 12} },
	        		hAxis: {
			        			title: 'Ciclo escolar',
			        			titleTextStyle: {color: 'black', fontSize: 14, bold: true, italic: false}
			        },
			        vAxis: {
			        			title: 'N\u00famero de estudiantes',
			        			titleTextStyle: {color: 'black', fontSize: 14, bold: true, italic: false},
			        			format: 'decimal'
			        },
			        series: {
				        			0: {type: 'bars',
				        				color: '#A8FDCC',
				        				dataOpacity: 0.7
			        			},
			        			1: {
			        					type: 'linear',
			        					color: '#ECB8B7'
			        			}
			        },
			        animation: { startup: true, duration: 2500, easing: 'linear'},
			        chartArea:{left:150,top:50}
		        };

		      var chart = new google.visualization.ComboChart(document.getElementById("column_chart_div"));
      		chart.draw(data, options);

					var chart1_img_div = document.getElementById('chart1_img_div');
			    var chart1ImgCombo = new google.visualization.ComboChart(chart1_img_div);

			    // Wait for the chart to finish drawing before calling the getImageURI() method.
			    google.visualization.events.addListener(chart1ImgCombo, 'ready', function () {
			      chart1_img_div.innerHTML = '<img src="' + chart1ImgCombo.getImageURI() + '">';
			      console.log(chart1_img_div.innerHTML);
			    });

			    chart1ImgCombo.draw(data, options);

		  	}

		  	function drawStacked() {
				var data = google.visualization.arrayToDataTable(datos2);

				var options = {
						width:1000,
						height:450,
						legend: { position: 'right', alignment: 'left', textStyle: {fontSize: 12} },
				        bar: { groupWidth: '70%' },
				        isStacked: 'percent',
				        series: [
								  {color: '#A8FDCB'},
								  {color: '#FCD5B5'},
								  {color: '#ECB8B7'},
								  {color: '#DFDFDF'}
								],
						titleTextStyle: {fontSize: 12},
						animation: { easing: 'linear', startup: true, duration: 3500},
						chartArea:{left:150,top:50}
			      };

				var chart = new google.visualization.BarChart(document.getElementById('bar_chart_div'));
				chart.draw(data, options);

				var chart2_img_div = document.getElementById('chart2_img_div');
		    var chart2ImgBar = new google.visualization.BarChart(chart2_img_div);

				google.visualization.events.addListener(chart2ImgBar, 'ready', function () {
		      chart2_img_div.innerHTML = '<img src="' + chart2ImgBar.getImageURI() + '">';
		      console.log(chart2_img_div.innerHTML);
		    });

		    chart2ImgBar.draw(data, options);
			}
		</script>
		<script>
	  jQuery(document).ready(function() {
	    $('#chart1_img_div').hide(); //oculto mediante id
	    $('#chart2_img_div').hide(); //oculto mediante id
	    jQuery("#downloadBtn").on("click", function() {
	      var htmlContent1 = jQuery("#chart1_img_div").html();
	      var htmlContent2 = jQuery("#chart2_img_div").html();
	      jQuery("#htmlContentHidden1").val(htmlContent1);
	      jQuery("#htmlContentHidden2").val(htmlContent2);
	      // submit the form
	      jQuery('#savePDFForm').submit();
	    });
	  });
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
		 <?php include('../footer.php'); ?>
    </body>
</html>
