<?php

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate";

$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

$schoolRegionZoneController = new SchoolRegionZoneController();
$schoolRegionZone = $schoolRegionZoneController->getEntityAction($schoolZone);

// Variables
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

$ciclo = 0;
if($numCiclo > 6){
	$studentsSecundOK = TRUE;
	$newNumCiclo = 6;
}else{
	$studentsSecundOK = FALSE;
	$newNumCiclo = $numCiclo;
}

$table1 = '
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Trayectorias Escolares</title>
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link rel="stylesheet" href="../../css/ie10-viewport-bug-workaround.css">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="../../css/tablePDF.css">
	<link rel="stylesheet" href="../../css/factorTablePDF.css">
	<link rel="stylesheet" href="../../css/chart.css">
</head>
<body>';

$headerPDF = '
<div style="width:279mm; height:100px;">
  <div style="width:60mm; height:100px; float:left;">
    <img src="../../img/Logo_segey.png" width="150"/>
  </div>
  <div style="width:121mm; height:100px; float:left;" class="text-right"></div>
  <div style="width:72mm; height:100px; float:left;" class="text-right">
  <h4>Centro de Evaluación Educativa del Estado de Yucatán</h4>
  </div>
</div>';

$table1 .= $headerPDF;
//$table .= '<div style="white-space:normal; border-style: solid;"></div>';
$table1 .= '
<h2 class="text-center">Trayectorias Escolares por Zona</h2><br />
<table class="table2">
	<tr>
		<td width="200" class="tableInfo"><b>Nivel:</b> ' . $schoolRegionZone->getSchoolLevelObject()->getName() . '</td>
		<td width="200" class="tableInfo"><b>Regi&oacute;n:</b> ' . $schoolRegionZone->getSchoolRegionObject()->getName() . '</td>
		<td width="200" class="tableInfo"><b>Modalidad:</b> ' . $schoolRegionZone->getSchoolModeObject()->getName() . '</td>
		<td width="200" class="tableInfo"><b>Zona Escolar:</b> ' . str_pad($schoolRegionZone->getZone(),  3, "0", STR_PAD_LEFT) . '</td>
	</tr>
</table>';

$table1 .= '
<table class="table">
	<thead>
		<tr>
			<th colspan="12"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica </th>
		</tr>
		<tr>
			<th colspan="12"> Cohorte ' . $cohorteName . '</th>
		</tr>
		<tr>
			<th colspan="3">Alumnos</th>
			<th colspan="6"> Primaria</th>
			<th colspan="3"> Secundaria</th>
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
	<tbody>';

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
		INNER JOIN school AS s2 ON s2.id = e.cct';
		$where = 'cohorte.grade = 1 AND cohorte.reprobate = 0 AND
		s1.school_region_zone = :schoolRegionZone AND s2.school_region_zone = :schoolRegionZone';
		$whereFields = array('schoolRegionZone' => $schoolRegionZone->getId());
		$students = $controller->displayBy2Action($where, $whereFields, $joinC, $showFields);
	}else{
		//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct AND e.cct LIKE :cct2";
		//$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct";
		$joinC = 'INNER JOIN ' . $cohorte->getTableCohorte() . ' AS cohorte ON e.idStudent = cohorte.idStudent
		INNER JOIN school AS s ON s.id = cohorte.cct';
		$where = 'cohorte.grade = 1 AND cohorte.reprobate = 0 AND s.school_region_zone = :schoolRegionZone';
		$whereFields = array('schoolRegionZone' => $schoolRegionZone->getId());
		$students = $controller->displayBy2Action($where, $whereFields, $joinC, $showFields);
	}

	$totalCiclo = count($students);

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
 			unset($studentCicloGrade[9][7]);
 			unset($studentCicloGrade[9][8]);
 			unset($studentCicloGrade[9][9]);
 			$studentCicloGrade[9][7] = merge_arrays_obj($testx1a, $testx1b);
 			$studentCicloGrade[9][8] = merge_arrays_obj($testx2a, $testx2b, $testx2c);
 			$studentCicloGrade[9][9] = merge_arrays_obj($testx3a, $testx3b, $testx3c);
 			$totalCiclo = count($studentCicloGrade[9] ,COUNT_RECURSIVE)-count($studentCicloGrade[9]);
 		}

	 	$table1 .= '
				<tr>
					<td>' . $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName() . '</td>
					<td>' . $totalCiclo . '</td>
					<td>' . $schoolPeriod[$ciclo]->getGrade() . '&deg;</td>';

				for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
					if($ciclo+1 == $nCiclo){
						$table1 .= '<td class="success">' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
					}elseif($ciclo+1 > $nCiclo + 1){
						$table1 .= '<td class="warning">' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
					}else{
						$table1 .= '<td>' . number_format(count($studentCicloGrade[$ciclo+1][$nCiclo]), 0, '', ',') . '</td>';
					}
				}
					 $table1 .= '
				</tr>';

			++$ciclo;
}

$table1 .= '
</tbody>
</table>';

$table1 .= '
<table class="table">
	<tr>
		<td colspan="2"></td>
		<td class="success"></td>
		<td>Trayectoria ideal</td>
		<td></td>
		<td class="warning"></td>
		<td>Rezago grave</td>
		<td></td>
	</tr>
</table>';

$table1 .= '<div style="page-break-after:always;"></div>';

$table1 .= $headerPDF;


$table2 = '<div style="page-break-after:always;"></div>';

$table2 .= $headerPDF;

$table2 .= '
<div style="float:none;">
  <table class="table">
  	<thead>
  		<tr>
  			<th colspan="7"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
  		</tr>
  		<tr>
  			<th colspan="7"> Cohorte ' . $cohorteName . '</th>
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
  	<tbody>';

	$totIdeal = count($totalIdealList);
	for($i=1; $i<=$totIdeal; ++$i){

			$inscritPorcent = round(($totalCicloList[$i]/$totalCicloList[1]*100), 1);
			$gradoIdealPorcent = round(($totalIdealList[$i]/$totalIdealList[1]*100), 1);
			$rezagoLigPorcent = round(($rezagoLigList[$i]/$totalCicloList[1]*100), 1);
			$rezagoGraPorcent = round(($rezagoGraList[$i]/$totalCicloList[1]*100), 1);

			$table2 .=  '
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
  $table2 .= '</tbody>
  </table>
</div>';

$table2 .= '<div style="page-break-after:always;"></div>';

$table2 .= $headerPDF;

$table3 = '<div style="page-break-after:always;"></div>';

$table3 .= $headerPDF;

$table3 .= '
<table class="table" style="table-layout: fixed">
  <thead>
    <tr>
      <th colspan="10"> Trayectoria ideal</th>
    </tr>
    <tr>
      <th colspan="10"> Cohorte ' . $cohorteName . '</th>
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
  <tbody>';

	if($studentsSecundOK == TRUE){
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

			$table3 .=  '
				<tr>
					<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' . '</td>
					<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
					<td>' . $totalIdealList[$i] . '</td>
					<td>' . count($studentCicloStatus[$i][$i]['A']) . '</td>
					<td>' . count($studentCicloStatus[$i][$i]['R']) . '</td>
					<td>' . count($studentCicloStatus[$i][$i]['X']) . '</td>
					<td>' . count($studentCicloStatus[$i][$i]['Z']) . '</td>
					<td>' . $eficIntergrado . '%</td>
					<td>' . $eficIntragrado . '%</td>
					<td>' . $eficCohorte . '%</td>
				</tr>';
	}
  $table3 .= '</tbody>
</table>';

if($numCiclo >= 6){

  $table3 .= '<div style="page-break-after:always;"></div>';
  $table3 .= $headerPDF;

  $table3 .= '
  <table class="table">
    <thead>
      <tr>
        <th colspan="11">Estatus de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
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
    <tbody>';

	$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);
	$table3 .= '
			<tr>
				<td>' . $cohorteName . '</td>
				<td>' . $totalCicloList[1] . '</td>
				<td>' . $nameCicloList[5] . '</td>
				<td>' . $totalCicloList[6] . '</td>
				<td>' . $totalIdealList[6] . '</td>
				<td>' . $rezagoLigList[6] . '</td>
				<td>' . $rezagoGraList[6] . '</td>
				<td>' . ($totalCicloList[1] - $totalCicloList[6]). '</td>
				<td>' . count($noReg3Period) . '</td>
				<td>' . count($studentCicloStatus[6][6]['A']) . '</td>
				<td>' . $studentsSecunBySchool . '</td>
			</tr>';

  $table3 .= '
    </tbody>
  </table>

  <table class="table">
    <thead>
      <tr>
        <th colspan="11">Porcentaje de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
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
    <tbody>';

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

	$table3 .= '
				<tr>
					<td>' . $cohorteName . '</td>
					<td>' . $totalCicloList[1] . '</td>
					<td>' . $nameCicloList[5] . '</td>
					<td>' . $inscPorc . '</td>
					<td>' . $inscIdealPorc . '</td>
					<td>' . $slightLagPorc . '</td>
					<td>' . $seriousLagPorc . '</td>
					<td>' . $noInscPorc . '</td>
					<td>' . $noReg3InscPorc . '</td>
					<td>' . $aprovPorc . '</td>
					<td>' . $inscSecuPorc . '</td>
			</tr>
    </tbody>
  </table>';
}

$table3 .= '
	</body>
</html>';

?>
