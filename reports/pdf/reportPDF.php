<?php

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate";

$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

// Variables
$totalIdealList = array();
$totalCicloList = array();
$totalRezagoGrave = array();
$totalRezagoGrave[1]= 0;
$totalRezagoGrave[2]= 0;
$nameCicloList = array();
$totalGrade = array();
array_push ($totalCicloList, 0);
$ciclo = 1 ;

$controller = new AprovController();
$where = 'e.cohorte = :cohorte';
$whereFields = array('cohorte' => $cohorte->getId());
$showFields = 'e.id, e.cohorte, e.school_period, e.grade, e.total';
$studentsCicloList = $controller->displayBy2Action($where, $whereFields, '', $showFields);

foreach($studentsCicloList as $studentsCiclo){
    $cicloX = 1 ;
    while($cicloX <= $numCiclo){
        if($cicloX == $studentsCiclo['school_period']){
            $totalGrade[$cicloX][$studentsCiclo['grade']] = $studentsCiclo['total'];
        }
        $cicloX = $cicloX + 1;
    }
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
<h2 class="text-center">Trayectorias Escolares del Estado de Yucatán</h2><br />';

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

while($ciclo <= $numCiclo){

	$totalCicloList[$ciclo] = array_sum($totalGrade[$ciclo]);
	$totalIdealList[$ciclo] = $totalGrade[$ciclo][$ciclo];
	array_push ($nameCicloList, $schoolPeriod[$ciclo-1]->getSchoolPeriodObject()->getName());

for($x=1; $x<10; $x++){
	if(!isset($totalGrade[$ciclo][$x])){
		$totalGrade[$ciclo][$x] = 0;
	}
}

switch($ciclo){
	case 1:
	$totalRezagoGrave[1] = 0;
	break;
	case 2:
	$totalRezagoGrave[2] = 0;
	break;
	case 3:
	$totalRezagoGrave[3] = $totalGrade[$ciclo][1];
	break;
	case 4:
	$totalRezagoGrave[4] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2];
	break;
	case 5:
	$totalRezagoGrave[5] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2] + $totalGrade[$ciclo][3];
	break;
	case 6:
	$totalRezagoGrave[6] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2] + $totalGrade[$ciclo][3] + $totalGrade[$ciclo][4];
	break;
	case 7:
	$totalRezagoGrave[7] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2] + $totalGrade[$ciclo][3] + $totalGrade[$ciclo][4] +
	$totalRezagoGrave[5];
	break;
	case 8:
	$totalRezagoGrave[8] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2] + $totalGrade[$ciclo][3] + $totalGrade[$ciclo][4] +
	$totalGrade[$ciclo][5] + $totalGrade[$ciclo][6];
	break;
	case 9:
	$totalRezagoGrave[9] = $totalGrade[$ciclo][1] + $totalGrade[$ciclo][2] + $totalGrade[$ciclo][3] + $totalGrade[$ciclo][4] +
	$totalGrade[$ciclo][5] + $totalGrade[$ciclo][6] + $totalGrade[$ciclo][7];
	break;
}
$table1 .= '
<tr>
<td>' . $schoolPeriod[$ciclo-1]->getSchoolPeriodObject()->getName() . '</td>
<td>' . number_format($totalCicloList[$ciclo], 0, '', ',') . '</td>';
$table1 .= '<td>' . $schoolPeriod[$ciclo-1]->getGrade() . '</td>';

for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
  if($ciclo == $nCiclo){
    $table1 .='<td class="success">' . number_format($totalGrade[$ciclo][$nCiclo], 0, '', ',') . '</td>';
  }elseif($ciclo > $nCiclo + 1){
    $table1 .='<td class="warning">' . number_format($totalGrade[$ciclo][$nCiclo], 0, '', ',') . '</td>';
  }else{
    $table1 .='<td>' . number_format($totalGrade[$ciclo][$nCiclo], 0, '', ',') . '</td>';
  }
}

$table1 .='
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
/*
if($numCiclo >= 6 && $numCiclo < 9){
  $table .= '<p class="reportPDF">La Cohorte ' . $cohorteName . ' inicio con ' . number_format($totalGrade[1][1], 0, '', ',') . '
  alumnos en primer grado de primaria. Despues de 6 años continuaban inscritos ' . number_format($totalCicloList[6], 0, '', ',') . '
  alumnos, de los cuales ' . number_format($totalGrade[6][6], 0, '', ',') . ' se encontraban inscritos en el grado ideal(6° de primaria).</p>';
}elseif($numCiclo = 9){
  $table .= '<p class="reportPDF">La Cohorte ' . $cohorteName . ' inicio con ' . number_format($totalGrade[1][1], 0, '', ',') . '
  alumnos en primer grado de primaria. Despues de 6 años continuaban inscritos ' . number_format($totalCicloList[6], 0, '', ',') . '
  alumnos, de los cuales ' . number_format($totalGrade[6][6], 0, '', ',') . ' se encontraban inscritos en el grado ideal(6° de primaria)
  y despues de 9 años ' . number_format($totalCicloList[9], 0, '', ',') . ' estaban inscritos en el sistema con ' . number_format($totalGrade[9][9], 0, '', ',') . ' alumnos inscritos en el grado ideal(3° de secundaria)</p>';
}*/

$table1 .= '<div style="page-break-after:always;"></div>';

$table1 .= $headerPDF;


$table2 = '<div style="page-break-after:always;"></div>';

$table2 .= $headerPDF;

$table2 .= '
<div style="float:none;">
  <table class="table">
  	<thead>
  		<tr>
  			<th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
  		</tr>
  		<tr>
  			<th colspan="8"> Cohorte ' . $cohorteName . '</th>
  		</tr>
  		<tr>
  			<th>Ciclo Escolar</th>
  			<th>Grado Ideal</th>
  			<th>Inscritos en el sistema</th>
  			<th>Inscritos grado ideal</th>
  			<th>Rezago ligero</th>
  			<th>Rezago grave</th>
  			<th>Sin registro</th>
  			<th>Sin registro (Hace 3 ciclos escolares)</th>
  		</tr>
  	</thead>
  	<tbody>';

$totIdeal = count($totalIdealList);
$controllerStatus = new AprovStatusController();
$whereStatus = 'e.cohorte = :cohorte';
$whereFieldsStatus = array('cohorte' => $cohorte->getId());
$showFieldsStatus = 'e.*';
$totalStatus = array();
$totalStatus = $controllerStatus->displayBy2Action($whereStatus, $whereFieldsStatus, '', $showFieldsStatus);
for($i=1; $i<=$totIdeal; ++$i){

	$inscritPorcent = round(($totalCicloList[$i]/$totalCicloList[1]*100), 1);
	$gradoIdealPorcent = round(($totalGrade[$i][$i]/$totalCicloList[1]*100), 1);
	$rezagoLigPorcent = round(($totalGrade[$i][$i-1]/$totalCicloList[1]*100), 1);
	$rezagoGraPorcent = round(($totalRezagoGrave[$i]/$totalCicloList[1]*100), 1);
	$noReg3PeriodPorcent = round(($totalStatus[$i-1]['unregistered_three']/$totalCicloList[1]*100), 1);

	$table2 .= '
  	<tr>
  		<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
  		<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' .  $schoolPeriod[$i-1]->getSchoolLevelObject()->getName() . '</td>
  		<td>' . $inscritPorcent . '</td>
  		<td>' . $gradoIdealPorcent . '</td>
  		<td>' . $rezagoLigPorcent . '</td>
  		<td>' . $rezagoGraPorcent . '</td>
  		<td>' . round((100 - $inscritPorcent), 1) . '</td>
  		<td>' . $noReg3PeriodPorcent . '</td>
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

for($i=1; $i<=$totIdeal; ++$i){

  $eficIntergrado = round(($totalStatus[$i-1]['statusA']/$totalIdealList[$i]*100), 1);
  $eficIntragrado = round(($totalIdealList[$i+1]/$totalStatus[$i-1]['statusA']*100), 1);
  $eficCohorte = round(($totalStatus[$i-1]['statusA']/$totalCicloList[1]*100), 1);

  $table3 .=  '
    <tr>
      <td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' .  $schoolPeriod[$i-1]->getSchoolLevelObject()->getName() . '</td>
      <td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
      <td>' . number_format($totalIdealList[$i], 0, '', ',') . '</td>
      <td>' . number_format($totalStatus[$i-1]['statusA'], 0, '', ',') . '</td>
      <td>' . number_format($totalStatus[$i-1]['statusR'], 0, '', ',') . '</td>
      <td>' . number_format($totalStatus[$i-1]['statusX'], 0, '', ',') . '</td>
      <td>' . number_format($totalStatus[$i-1]['statusZ'], 0, '', ',') . '</td>
      <td>' . $eficIntergrado . '%</td>
      <td>' . $eficIntragrado . '%</td>
      <td>' . $eficCohorte . '%</td>
    </tr>';
}
  $table3 .= '</tbody>
</table>';

$table3 .= '<div style="page-break-after:always;"></div>';

$table3 .= $headerPDF;

if($numCiclo >= 6){
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

$cohorteReportController = new CohorteReportController();
$cohorteReportList = $cohorteReportController->displayAction();
$totalCohorteReport = count($cohorteReportList);

foreach($cohorteReportList as $cohorteReport){
  if($cohorte->getId() == $cohorteReport->getCohorte()){
    $table3 .= '
      <tr class="info">
        <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
        <td>' . number_format($cohorteReport->getTotalStudents(), 0, '', ',') . '</td>
        <td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
        <td>' . number_format($cohorteReport->getEnrolledStudents(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getTotalIdealDegree(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getSlightLag(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getSeriousLag(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getUnregistered(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getUnregisteredThree(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getGraduates(), 0, '', ',') . '</td>
        <td>' . number_format($cohorteReport->getEnrolledNextGrade(), 0, '', ',') . '</td>
      </tr>';
  }else{
    $table3 .=  '
      <tr>
      <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
      <td>' . number_format($cohorteReport->getTotalStudents(), 0, '', ',') . '</td>
      <td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
      <td>' . number_format($cohorteReport->getEnrolledStudents(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getTotalIdealDegree(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getSlightLag(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getSeriousLag(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getUnregistered(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getUnregisteredThree(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getGraduates(), 0, '', ',') . '</td>
      <td>' . number_format($cohorteReport->getEnrolledNextGrade(), 0, '', ',') . '</td>
      </tr>';
  }
}
$table3 .= '
  </tbody>
</table>';

$table3 .= '<div style="page-break-after:always;"></div>';

$table3 .= $headerPDF;

$table3 .= '
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

foreach($cohorteReportList as $cohorteReport){

  $totalSystem = round($cohorteReport->getEnrolledStudents()/$cohorteReport->getTotalStudents()*100,1);
  $totalIdealDegree = round($cohorteReport->getTotalIdealDegree()/$cohorteReport->getTotalStudents()*100,1);
  $totalSlightLag = round($cohorteReport->getSlightLag()/$cohorteReport->getTotalStudents()*100,1);
  $totalSeriousLag = round($cohorteReport->getSeriousLag()/$cohorteReport->getTotalStudents()*100,1);
  $totalUnregistered = round($cohorteReport->getUnregistered()/$cohorteReport->getTotalStudents()*100,1);
  $totalUnregisteredThree = round($cohorteReport->getUnregisteredThree()/$cohorteReport->getTotalStudents()*100,1);
  $totalGraduates = round($cohorteReport->getGraduates()/$cohorteReport->getTotalStudents()*100,1);
  $totalEnrolledNextGrade = round($cohorteReport->getEnrolledNextGrade()/$cohorteReport->getTotalStudents()*100,1);

  if($cohorte->getId() == $cohorteReport->getCohorte()){
    $table3 .=  '
    <tr class="info">
    <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
    <td>' . number_format($cohorteReport->getTotalStudents(), 0, '', ',') . '</td>
    <td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
    <td>' . $totalSystem . '</td>
    <td>' . $totalIdealDegree . '</td>
    <td>' . $totalSlightLag . '</td>
    <td>' . $totalSeriousLag . '</td>
    <td>' . $totalUnregistered . '</td>
    <td>' . $totalUnregisteredThree . '</td>
    <td>' . $totalGraduates . '</td>
    <td>' . $totalEnrolledNextGrade . '</td>
    </tr>';
  }else{
    $table3 .=  '
    <tr>
    <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
    <td>' . number_format($cohorteReport->getTotalStudents(), 0, '', ',') . '</td>
    <td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
    <td>' . $totalSystem . '</td>
    <td>' . $totalIdealDegree . '</td>
    <td>' . $totalSlightLag . '</td>
    <td>' . $totalSeriousLag . '</td>
    <td>' . $totalUnregistered . '</td>
    <td>' . $totalUnregisteredThree . '</td>
    <td>' . $totalGraduates . '</td>
    <td>' . $totalEnrolledNextGrade . '</td>
    </tr>';
  }
}
$table3 .= '
  </tbody>
</table>';

  if($numCiclo >= 9){

  $table3 .= '<div style="page-break-after:always;"></div>';

  $table3 .= $headerPDF;

  $table3 .= '
  <table class="table">
    <thead>
      <tr>
        <th colspan="10">Estatus de los alumnos al cursar educaci&oacute;n basica</th>
      </tr>
      <tr>
        <th colspan="5">Al iniciar el ciclo</th>
        <th colspan="2">Rezago</th>
        <th colspan="2">Sin registro</th>
        <th colspan="1">Al finalizar el ciclo</th>
      </tr>
      <tr>
        <th>Cohorte Escolar</th>
        <th>Total de alumnos</th>
        <th>Ciclo escolar</th>
        <th>Inscritos en el sistema</th>
        <th>Inscritos (3&deg; Secundaria)</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Hace 3 ciclos escolares</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>';

  $noReg3Period = $totalStatus[8]['unregistered_three'];
  $table3 .= '
      <tr>
        <td>' . $cohorteName . '</td>
        <td>' . number_format($totalCicloList[1], 0, '', ',') . '</td>
        <td>' . $nameCicloList[8] . '</td>
        <td>' . number_format($totalCicloList[9], 0, '', ',') . '</td>
        <td>' . number_format($totalIdealList[9], 0, '', ',') . '</td>
        <td>' . number_format($totalGrade[9][8], 0, '', ',') . '</td>
        <td>' . number_format($totalRezagoGrave[9], 0, '', ',') . '</td>
        <td>' . number_format(($totalCicloList[1] - $totalCicloList[9]), 0, '', ','). '</td>
        <td>' . number_format($noReg3Period, 0, '', ',') . '</td>
        <td>' . number_format($totalStatus[8]['statusA'], 0, '', ',') . '</td>
      </tr>';

  $table3 .= '
    </tbody>
  </table>';

  $table3 .= '
  <table class="table">
    <thead>
      <tr>
        <th colspan="10">Porcentaje de los alumnos al cursar educaci&oacute;n basica</th>
      </tr>
      <tr>
        <th colspan="5">Al iniciar el ciclo</th>
        <th colspan="2">Rezago</th>
        <th colspan="2">Sin registro</th>
        <th colspan="1">Al finalizar el ciclo</th>
      </tr>
      <tr>
        <th>Cohorte Escolar</th>
        <th>Total de alumnos</th>
        <th>Ciclo escolar</th>
        <th>Inscritos en el sistema</th>
        <th>Inscritos (3&deg; Secundaria)</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Hace 3 ciclos escolares</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>';

  $noReg3PeriodPorcent = round(($noReg3Period/$totalCicloList[1]*100), 1);
  $table3 .= '
      <tr>
        <td>' . $cohorteName . '</td>
        <td>' . number_format($totalCicloList[1], 0, '', ',') . '</td>
        <td>' . $nameCicloList[8] . '</td>
        <td>' . round($totalCicloList[9]/$totalCicloList[1]*100,1) . '</td>
        <td>' . round($totalIdealList[9]/$totalCicloList[1]*100,1) . '</td>
        <td>' . round($totalGrade[9][8]/$totalCicloList[1]*100,1) . '</td>
        <td>' . round($totalRezagoGrave[9]/$totalCicloList[1]*100,1) . '</td>
        <td>' . round(($totalCicloList[1] - $totalCicloList[9])/$totalCicloList[1]*100,1). '</td>
        <td>' . $noReg3PeriodPorcent . '</td>
        <td>' . round($totalStatus[8]['statusA']/$totalCicloList[1]*100,1) . '</td>
      </tr>';

  $table3 .= '
    </tbody>
  </table>';
  }
}

$table3 .= '
	</body>
</html>';

//echo $table;

?>
