<?php

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate";

$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

// Variables
$gender = array();
$gender[1] = 'Hombres';
$gender[2] = 'Mujeres';
$totalCicloList = array();
$nameCicloList = array();
$nameCicloList[0] = '';
/* Arreglos que almacenaran el numero de alumnos inscritos por ciclo y genero */
$genderList = array();
$genderStatusList = array();
$ciclo = 1 ;

$controller = new AprovGenderController();
$where = 'e.cohorte = :cohorte';
$whereFields = array('cohorte' => $cohorte->getId());
$showFields = 'e.*';
$studentsCicloList = $controller->displayBy2Action($where, $whereFields, '', $showFields);

foreach($studentsCicloList as $studentsCiclo){
  $cicloX = 1 ;
  while($cicloX <= $numCiclo){
    if($cicloX == $studentsCiclo['school_period']){
      $genderList1[$cicloX][1][$studentsCiclo['grade']] = $studentsCiclo['total_men'];
      $genderList1[$cicloX][2][$studentsCiclo['grade']] = $studentsCiclo['total_women'];
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
	<link rel="stylesheet" href="../css/ie10-viewport-bug-workaround.css">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="../../css/tablePDF.css">
	<link rel="stylesheet" href="../../css/factorTablePDF.css">
	<link rel="stylesheet" href="../../css/chart.css">
</head>
<body>';

$headerPDF = '
<div id="header" style="width:253mm; height:100px;">
  <div style="width:60mm; height:80px; float:left;">
    <img src="../../img/Logo_segey.png" width="150"/>
  </div>
  <div style="width:121mm; height:80px; float:left;" class="text-right"></div>
  <div style="width:72mm; height:80px; float:left;" class="text-right">
  <h4>Centro de Evaluación Educativa del Estado de Yucatán</h4>
  </div>
</div>';

$table1 .= $headerPDF;
//$table .= '<div style="white-space:normal; border-style: solid;"></div>';
$table1 .= '
<h2 class="text-center">Trayectorias Escolares por sexo</h2><br />';

$table1 .= '
<table class="table">
  <thead>
    <tr>
      <th colspan="12"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica (Hombres)</th>
    </tr>
    <tr>
      <th colspan="12"> Cohorte ' . $cohorteName . '</th>
    </tr>
    <tr>
      <th colspan="3">Alumnos</th>
      <th colspan="6">Primaria</th>
      <th colspan="3">Secundaria</th>
    </tr>
    <tr>
      <th>Ciclo Escolar</th>
      <th>Total Inscritos</th>
      <th>Grado Ideal</th>
      <!-- Primaria -->
      <th>1&deg;</th>
      <th>2&deg;</th>
      <th>3&deg;</th>
      <th>4&deg;</th>
      <th>5&deg;</th>
      <th>6&deg;</th>
      <!-- Secundaria -->
      <th>1&deg;</th>
      <th>2&deg;</th>
      <th>3&deg;</th>
    </tr>
  </thead>
  <tbody>';

  for ($ciclo = 1; $ciclo <= $numCiclo; $ciclo++) {

    array_push($nameCicloList, $schoolPeriod[$ciclo-1] -> getSchoolPeriodObject() -> getName());
    $totalCicloF[$ciclo][1] = array_sum($genderList1[$ciclo][1]);

    for($x=1; $x<10; $x++){
      if(!isset($genderList1[$ciclo][1][$x])){
        $genderList1[$ciclo][1][$x] = 0;
      }
      //$rezagoGraList[$ciclo][1] = $totalCicloF[$ciclo][1] - $genderList1[$ciclo][1][$ciclo] - $genderList1[$ciclo][1][$ciclo-1];
      //$rezagoGraList[$ciclo][2] = $totalCicloF[$ciclo][2] - $genderList1[$ciclo][2][$ciclo] - $genderList1[$ciclo][2][$ciclo-1];
    }

    /* Se guarda el numero de alumnos con rezago grave por ciclo y modalidad */
    switch($ciclo){
      case 1:
      $rezagoGraList[$ciclo][1] = 0;
      break;
      case 2:
      $rezagoGraList[$ciclo][1] = 0;
      break;
      case 3:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1];
      break;
      case 4:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2];
      break;
      case 5:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3];
      break;
      case 6:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4];
      break;
      case 7:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5];
      break;
      case 8:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5] + $genderList1[$ciclo][1][6];
      break;
      case 9:
      $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5] + $genderList1[$ciclo][1][6] + $genderList1[$ciclo][1][7];
      break;
    }

    /* $totalCicloF - Array que almacena el total de alumnos por ciclo y modalida.
    * $cicloList - Array que almacena el numero de alumnos por grado, Sexo y ciclo escolar
    * $modeContenT - Array que almacena la Sexo de acuerdo al ciclo escolar
    * $rowspan - Variable que almacena el numero de Sexoes por ciclo escolar */

$rowspan = count($gender);
$modeContenT = $gender;

$table1 .= '<tr>
    <td>' . $nameCicloList[$ciclo] . '</td>
    <td>' . number_format($totalCicloF[$ciclo][1], 0, '', ',') . '</td>
    <td>' . $schoolPeriod[$ciclo-1]->getGrade() . '</td>';

  for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
    if($ciclo == $nCiclo){
      $table1 .= '<td class="success">' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
    }elseif($ciclo > $nCiclo + 1){
      $table1 .= '<td class="warning">' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
    }else{
      $table1 .= '<td>' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
    }
  }
$table1 .= '</tr>';

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

$table1 .= '
<table class="table">
  <thead>
    <tr>
      <th colspan="12"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica (Mujeres)</th>
    </tr>
    <tr>
      <th colspan="12"> Cohorte ' . $cohorteName . '</th>
    </tr>
    <tr>
      <th colspan="3">Alumnos</th>
      <th colspan="6">Primaria</th>
      <th colspan="3">Secundaria</th>
    </tr>
    <tr>
      <th>Ciclo Escolar</th>
      <th>Total Inscritos</th>
      <th>Grado Ideal</th>
      <!-- Primaria -->
      <th>1&deg;</th>
      <th>2&deg;</th>
      <th>3&deg;</th>
      <th>4&deg;</th>
      <th>5&deg;</th>
      <th>6&deg;</th>
      <!-- Secundaria -->
      <th>1&deg;</th>
      <th>2&deg;</th>
      <th>3&deg;</th>
    </tr>
  </thead>
  <tbody>';

  for ($ciclo = 1; $ciclo <= $numCiclo; $ciclo++) {

    array_push($nameCicloList, $schoolPeriod[$ciclo-1] -> getSchoolPeriodObject() -> getName());
    $totalCicloF[$ciclo][2] = array_sum($genderList1[$ciclo][2]);

    for($x=1; $x<10; $x++){
      if(!isset($genderList1[$ciclo][2][$x])){
        $genderList1[$ciclo][2][$x] = 0;
      }
      //$rezagoGraList[$ciclo][1] = $totalCicloF[$ciclo][1] - $genderList1[$ciclo][1][$ciclo] - $genderList1[$ciclo][1][$ciclo-1];
      //$rezagoGraList[$ciclo][2] = $totalCicloF[$ciclo][2] - $genderList1[$ciclo][2][$ciclo] - $genderList1[$ciclo][2][$ciclo-1];
    }

    /* Se guarda el numero de alumnos con rezago grave por ciclo y modalidad */
    switch($ciclo){
      case 1:
      $rezagoGraList[$ciclo][2] = 0;
      break;
      case 2:
      $rezagoGraList[$ciclo][2] = 0;
      break;
      case 3:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1];
      break;
      case 4:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2];
      break;
      case 5:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3];
      break;
      case 6:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4];
      break;
      case 7:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5];
      break;
      case 8:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5] + $genderList1[$ciclo][2][6];
      break;
      case 9:
      $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5] + $genderList1[$ciclo][2][6] + $genderList1[$ciclo][2][7];
      break;
    }

    /* $totalCicloF - Array que almacena el total de alumnos por ciclo y modalida.
    * $cicloList - Array que almacena el numero de alumnos por grado, Sexo y ciclo escolar
    * $modeContenT - Array que almacena la Sexo de acuerdo al ciclo escolar
    * $rowspan - Variable que almacena el numero de Sexoes por ciclo escolar */

$rowspan = count($gender);
$modeContenT = $gender;

$table1 .= '<tr>
    <td>' . $nameCicloList[$ciclo] . '</td>
    <td>' . number_format($totalCicloF[$ciclo][2], 0, '', ',') . '</td>
    <td>' . $schoolPeriod[$ciclo-1]->getGrade() . '&deg;</td>';

  for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
    if($ciclo == $nCiclo){
      $table1 .= '<td class="success">' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
    }elseif($ciclo > $nCiclo + 1){
      $table1 .= '<td class="warning">' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
    }else{
      $table1 .= '<td>' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
    }
  }
$table1 .= '</tr>';

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
        <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
      </tr>
      <tr>
        <th colspan="8">Hombres</th>
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

$controllerStatus = new AprovGenderStatusController();
$whereStatus = 'e.cohorte = :cohorte';
$whereFieldsStatus = array('cohorte' => $cohorte->getId());
$showFieldsStatus = 'e.*';
$totalStatus = array();
$genderStatusList1 = $controllerStatus->displayBy2Action($whereStatus, $whereFieldsStatus, '', $showFieldsStatus);

if($numCiclo > 6){
  $countCiclo = 6;
}else{
  $countCiclo = $numCiclo;
}

for($cicloAct=1; $cicloAct<=$numCiclo; $cicloAct++){

  $inscritPorcent = round(($totalCicloF[$cicloAct][1]/$totalCicloF[1][1]*100), 1);
  $gradoIdealPorcent = round(($genderList1[$cicloAct][1][$cicloAct]/$genderList1[1][1][1]*100), 1);
  $rezagoLigPorcent = round(($genderList1[$cicloAct][1][$cicloAct-1]/$totalCicloF[1][1]*100), 1);
  $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][1]/$totalCicloF[1][1]*100), 1);
  $noInsc = $totalCicloF[1][1]-$totalCicloF[$cicloAct][1];
  $noInscPorcent = round(($noInsc/$totalCicloF[1][1]*100), 1);
  if($genderStatusList1[2*($cicloAct-1)]['gender'] == 1){
    $noReg3PeriodPorcent = round(($genderStatusList1[2*($cicloAct-1)]['unregistered_three']/$totalCicloF[1][1]*100), 1);
  }
  $table2 .=  '
  <tr>
    <td>' . $nameCicloList[$cicloAct]. '</td>
    <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;</td>
    <td>' . $inscritPorcent . '</td>
    <td>' . $gradoIdealPorcent . '</td>
    <td>' . $rezagoLigPorcent . '</td>
    <td>' . $rezagoGraPorcent . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
  </tr>';
}
  $table2 .= '</tbody>
  </table>
</div>';

$table2 .= '<div style="page-break-after:always;"></div>';

$table2 .= $headerPDF;

$table2 .= '
<div style="float:none;">
  <table class="table">
    <thead>
      <tr>
        <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
      </tr>
      <tr>
        <th colspan="8">Mujeres</th>
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

$controllerStatus = new AprovGenderStatusController();
$whereStatus = 'e.cohorte = :cohorte';
$whereFieldsStatus = array('cohorte' => $cohorte->getId());
$showFieldsStatus = 'e.*';
$totalStatus = array();
$genderStatusList1 = $controllerStatus->displayBy2Action($whereStatus, $whereFieldsStatus, '', $showFieldsStatus);

if($numCiclo > 6){
  $countCiclo = 6;
}else{
  $countCiclo = $numCiclo;
}

for($cicloAct=1; $cicloAct<=$numCiclo; $cicloAct++){

  $inscritPorcent = round(($totalCicloF[$cicloAct][2]/$totalCicloF[1][2]*100), 1);
  $gradoIdealPorcent = round(($genderList1[$cicloAct][2][$cicloAct]/$genderList1[1][2][1]*100), 1);
  $rezagoLigPorcent = round(($genderList1[$cicloAct][2][$cicloAct-1]/$totalCicloF[1][2]*100), 1);
  $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][2]/$totalCicloF[1][2]*100), 1);
  $noInsc = $totalCicloF[1][2]-$totalCicloF[$cicloAct][2];
  $noInscPorcent = round(($noInsc/$totalCicloF[1][2]*100), 1);
  if($genderStatusList1[2*($cicloAct-1)+1]['gender'] == 2){
    $noReg3PeriodPorcent = round(($genderStatusList1[2*($cicloAct-1)+1]['unregistered_three']/$totalCicloF[1][2]*100), 1);
  }

  $table2 .=  '
  <tr>
    <td>' . $nameCicloList[$cicloAct]. '</td>
    <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;</td>
    <td>' . $inscritPorcent . '</td>
    <td>' . $gradoIdealPorcent . '</td>
    <td>' . $rezagoLigPorcent . '</td>
    <td>' . $rezagoGraPorcent . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
  </tr>';
}
  $table2 .= '</tbody>
  </table>
</div>';

$table2 .= '<div style="page-break-after:always;"></div>';

$table2 .= $headerPDF;

$table2a = '<div style="page-break-after:always;"></div>';

$table2a .= $headerPDF;

$table3 = '<div style="page-break-after:always;"></div>';

$table3 .= $headerPDF;

$table3 .= '
<table class="table" style="table-layout: fixed">
  <thead>
  <tr>
    <th colspan="10"> Trayectoria ideal (Hombres)</th>
  </tr>
  <tr>
    <th colspan="10">  Cohorte ' . $cohorteName . '</th>
  </tr>
  <tr>
    <th rowspan="2">Grado Ideal</th>
    <th rowspan="2">Ciclo Escolar</th>
    <th colspan="5">Alumnos</th>
    <th colspan="3">Eficiencias</th>
  </tr>
  <tr>
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
  </thead>
  <tbody>';

  for($cicloAct=1; $cicloAct<=$numCiclo; $cicloAct++){

    $eficIntergrado = round(($genderStatusList1[2*($cicloAct-1)]['statusA']/$genderList1[$cicloAct][1][$cicloAct]*100), 1);
    $eficIntragrado = round(($genderList1[$cicloAct+1][1][$cicloAct+1]/$genderStatusList1[2*($cicloAct-1)]['statusA']*100), 1);
    $eficCohorte = round(($genderStatusList1[2*($cicloAct-1)]['statusA']/$totalCicloF[1][1]*100), 1);

    if($genderStatusList1[2*($cicloAct-1)]['statusA'] == ''){
      $eficIntragrado ='-';
      $eficIntergrado ='-';
      $eficCohorte ='-';
    }else{
      $eficIntragrado = $eficIntragrado."%";
      $eficIntergrado = $eficIntergrado."%";
      $eficCohorte = $eficCohorte."%";
    }

$table3 .=  '
  <tr>
    <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
    <td>' . $nameCicloList[$cicloAct]. '</td>
    <td>' . number_format($genderList1[$cicloAct][1][$cicloAct], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusA'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusR'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusX'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusZ'], 0, '', ',') . '</td>
    <td>' . $eficIntergrado . '</td>
    <td>' . $eficIntragrado . '</td>
    <td>' . $eficCohorte . '</td>
  </tr>';

}
  $table3 .= '</tbody>
</table>';

$table3 .= '<div style="page-break-after:always;"></div>';

$table3 .= $headerPDF;

$table3 .= '
<table class="table" style="table-layout: fixed">
  <thead>
  <tr>
    <th colspan="10"> Trayectoria ideal (Mujeres)</th>
  </tr>
  <tr>
    <th colspan="10"> Cohorte <?php echo $cohorteName ?> </th>
  </tr>
  <tr>
    <th rowspan="2">Grado Ideal</th>
    <th rowspan="2">Ciclo Escolar</th>
    <th colspan="5">Alumnos</th>
    <th colspan="3">Eficiencias</th>
  </tr>
  <tr>
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
  </thead>
  <tbody>';

  for($cicloAct=1; $cicloAct<=$numCiclo; $cicloAct++){

  $eficIntergrado = round(($genderStatusList1[2*($cicloAct-1)+1]['statusA']/$genderList1[$cicloAct][2][$cicloAct]*100), 1);
  $eficIntragrado = round(($genderList1[$cicloAct+1][2][$cicloAct+1]/$genderStatusList1[2*($cicloAct-1)+1]['statusA']*100), 1);
  $eficCohorte = round(($genderStatusList1[2*($cicloAct-1)+1]['statusA']/$totalCicloF[1][2]*100), 1);

  if($genderStatusList1[2*($cicloAct-1)+1]['statusA'] == ''){
    $eficIntragrado ='-';
    $eficIntergrado ='-';
    $eficCohorte ='-';
  }else{
    $eficIntragrado = $eficIntragrado."%";
    $eficIntergrado = $eficIntergrado."%";
    $eficCohorte = $eficCohorte."%";
  }

$table3 .=  '
  <tr>
    <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
    <td>' . $nameCicloList[$cicloAct]. '</td>
    <td>' . number_format($genderList1[$cicloAct][2][$cicloAct], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)+1]['statusA'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)+1]['statusR'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)+1]['statusX'], 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[2*($cicloAct-1)+1]['statusZ'], 0, '', ',') . '</td>
    <td>' . $eficIntergrado . '</td>
    <td>' . $eficIntragrado . '</td>
    <td>' . $eficCohorte . '</td>
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
      <th colspan="12">Estatus de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
    </tr>
    <tr>
      <th colspan="12"> Cohorte <?php echo $cohorteName ?> </th>
    </tr>
    <tr>
      <th colspan="6">Al iniciar el ciclo</th>
      <th colspan="2">Rezago</th>
      <th colspan="2">Sin registro</th>
      <th colspan="2">Al finalizar el ciclo</th>
    </tr>
    <tr>
      <th>Cohorte Escolar</th>
      <th>Sexo</th>
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

$noInsc = $totalCicloF[1][1]-$totalCicloF[6][1];
if($genderStatusList1[10]['gender'] == 1){
  $noReg3Period = $genderStatusList1[10]['unregistered_three'];
}

$table3 .= '
  <tr>
    <td rowspan="' . $rowspan . '" class="theadR">' . $cohorteName . '</td>
    <td>' . $modeContenT[1] . '</td>
    <td>' . number_format($totalCicloF[1][1], 0, '', ',') . '</td>
    <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[6] . '</td>
    <td>' . number_format($totalCicloF[6][1], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[6][1][6], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[6][1][5], 0, '', ',') . '</td>
    <td>' . number_format($rezagoGraList[6][1], 0, '', ',') . '</td>
    <td>' . number_format($noInsc, 0, '', ',') . '</td>
    <td>' . number_format($noReg3Period, 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[10]['statusA'], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[7][1][7], 0, '', ',') . '</td>
  </tr>';

$noInsc = $totalCicloF[1][2]-$totalCicloF[6][2];
if($genderStatusList1[11]['gender'] == 2){
  $noReg3Period = $genderStatusList1[11]['unregistered_three'];
}

$table3 .= '
  <tr>
    <td>' . $modeContenT[2] . '</td>
    <td>' . number_format($totalCicloF[1][2], 0, '', ',') . '</td>
    <td>' . number_format($totalCicloF[6][2], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[6][2][6], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[6][2][5], 0, '', ',') . '</td>
    <td>' . number_format($rezagoGraList[6][2], 0, '', ',') . '</td>
    <td>' . number_format($noInsc, 0, '', ',') . '</td>
    <td>' . number_format($noReg3Period, 0, '', ',') . '</td>
    <td>' . number_format($genderStatusList1[11]['statusA'], 0, '', ',') . '</td>
    <td>' . number_format($genderList1[7][2][7], 0, '', ',') . '</td>
  </tr>';

$table3 .= '
  </tbody>
</table>';

$table3 .= '
<table class="table">
  <thead>
    <tr>
      <th colspan="12">Porcentaje de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
    </tr>
    <tr>
      <th colspan="12"> Cohorte <?php echo $cohorteName ?> </th>
    </tr>
    <tr>
      <th colspan="6">Al iniciar el ciclo</th>
      <th colspan="2">Rezago</th>
      <th colspan="2">Sin registro</th>
      <th colspan="2">Al finalizar el ciclo</th>
    </tr>
    <tr>
      <th>Cohorte Escolar</th>
      <th>Sexo</th>
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
  $noInsc = $totalCicloF[1][1]-$totalCicloF[6][1];
  $noInscPorcent = round(($noInsc/$totalCicloF[1][1]*100), 1);
  if($genderStatusList1[10]['gender'] == 1){
  $noReg3PeriodPorcent = round(($genderStatusList1[10]['unregistered_three']/$totalCicloF[1][1]*100), 1);
  }

$table3 .= '
  <tr>
    <td rowspan="' . $rowspan . '" class="theadR">' . $cohorteName . '</td>
    <td>' . $modeContenT[1] . '</td>
    <td>' . number_format($totalCicloF[1][1], 0, '', ',') . '</td>
    <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[6] . '</td>
    <td>' . round($totalCicloF[6][1]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($genderList1[6][1][6]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($genderList1[6][1][5]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($rezagoGraList[6][1]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
    <td>' . round($genderStatusList1[10]['statusA']/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($genderList1[7][1][7]/$totalCicloF[1][1]*100,1) . '</td>
  </tr>';


  //$noInsc3Period = array_diff($studentList[1][2], $studentList[5][2], $studentList[4][2], $studentList[3][2]);
  //$noInsc = $genderList1[1][2][1] - $totalCicloF[6][2];
$noInsc = $totalCicloF[1][2]-$totalCicloF[6][2];
$noInscPorcent = round(($noInsc/$totalCicloF[1][2]*100), 1);
if($genderStatusList1[11]['gender'] == 2){
  $noReg3PeriodPorcent = round(($genderStatusList1[11]['unregistered_three']/$totalCicloF[1][2]*100), 1);
}

$table3 .= '
  <tr>
    <td>' . $modeContenT[2] . '</td>
    <td>' . number_format($totalCicloF[1][2], 0, '', ',') . '</td>
    <td>' . round($totalCicloF[6][2]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($genderList1[6][2][6]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($genderList1[6][2][5]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($rezagoGraList[6][2]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
    <td>' . round($genderStatusList1[11]['statusA']/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($genderList1[7][2][7]/$totalCicloF[1][2]*100,1) . '</td>
  </tr>';

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
        <th colspan="11">Estatus de los alumnos al cursar educaci&oacute;n b&aacute;sica</th>
      </tr>
      <tr>
        <th colspan="11"> Cohorte <?php echo $cohorteName ?> </th>
      </tr>
      <tr>
        <th colspan="6">Al iniciar el ciclo</th>
        <th colspan="2">Rezago</th>
        <th colspan="2">Sin registro</th>
        <th>Al finalizar el ciclo</th>
      </tr>
      <tr>
        <th>Cohorte Escolar</th>
        <th>Sexo</th>
        <th>Total de alumnos</th>
        <th>Ciclo escolar</th>
        <th>Inscritos en el sistema</th>
        <th>Inscritos (3&deg; secundaria)</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Hace 3 ciclos escolares</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>';

  $noInsc = $totalCicloF[1][1]-$totalCicloF[9][1];
  if($genderStatusList1[16]['gender'] == 1){
    $noReg3Period = $genderStatusList1[16]['unregistered_three'];
  }

  $table3 .= '
    <tr>
      <td rowspan="' . $rowspan . '" class="theadR">' . $cohorteName . '</td>
      <td>' . $modeContenT[1] . '</td>
      <td>' . number_format($totalCicloF[1][1], 0, '', ',') . '</td>
      <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[9] . '</td>
      <td>' . number_format($totalCicloF[9][1], 0, '', ',') . '</td>
      <td>' . number_format($genderList1[9][1][9], 0, '', ',') . '</td>
      <td>' . number_format($genderList1[9][1][8], 0, '', ',') . '</td>
      <td>' . number_format($rezagoGraList[9][1], 0, '', ',') . '</td>
      <td>' . number_format($noInsc, 0, '', ',') . '</td>
      <td>' . number_format($noReg3Period, 0, '', ',') . '</td>
      <td>' . number_format($genderStatusList1[16]['statusA'], 0, '', ',') . '</td>
    </tr>';

  $noInsc = $totalCicloF[1][2]-$totalCicloF[9][2];
  if($genderStatusList1[17]['gender'] == 2){
    $noReg3Period = $genderStatusList1[17]['unregistered_three'];
  }

  $table3 .= '
    <tr>
      <td>' . $modeContenT[2] . '</td>
      <td>' . number_format($totalCicloF[1][2], 0, '', ',') . '</td>
      <td>' . number_format($totalCicloF[9][2], 0, '', ',') . '</td>
      <td>' . number_format($genderList1[9][2][9], 0, '', ',') . '</td>
      <td>' . number_format($genderList1[9][2][8], 0, '', ',') . '</td>
      <td>' . number_format($rezagoGraList[9][2], 0, '', ',') . '</td>
      <td>' . number_format($noInsc, 0, '', ',') . '</td>
      <td>' . number_format($noReg3Period, 0, '', ',') . '</td>
      <td>' . number_format($genderStatusList1[17]['statusA'], 0, '', ',') . '</td>
    </tr>';

  $table3 .= '
    </tbody>
  </table>';

  $table3 .= '
  <table class="table">
    <thead>
      <tr>
        <th colspan="11">Porcentaje de los alumnos al cursar educaci&oacute;n b&aacute;sica</th>
      </tr>
      <tr>
        <th colspan="11"> Cohorte <?php echo $cohorteName ?> </th>
      </tr>
      <tr>
        <th colspan="6">Al iniciar el ciclo</th>
        <th colspan="2">Rezago</th>
        <th colspan="2">Sin registro</th>
        <th>Al finalizar el ciclo</th>
      </tr>
      <tr>
        <th>Cohorte Escolar</th>
        <th>Sexo</th>
        <th>Total de alumnos</th>
        <th>Ciclo escolar</th>
        <th>Inscritos en el sistema</th>
        <th>Inscritos (3&deg; secundaria)</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Hace 3 ciclos escolares</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>';

  $noInsc = $totalCicloF[1][1]-$totalCicloF[9][1];
  $noInscPorcent = round(($noInsc/$totalCicloF[1][1]*100), 1);
  if($genderStatusList1[16]['gender'] == 1){
    $noReg3PeriodPorcent = round(($genderStatusList1[16]['unregistered_three']/$totalCicloF[1][1]*100), 1);
  }

  $table3 .= '
    <tr>
    <td rowspan="' . $rowspan . '" class="theadR">' . $cohorteName . '</td>
    <td>' . $modeContenT[1] . '</td>
    <td>' . number_format($totalCicloF[1][1], 0, '', ',') . '</td>
    <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[9] . '</td>
    <td>' . round($totalCicloF[9][1]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($genderList1[9][1][9]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($genderList1[9][1][8]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . round($rezagoGraList[9][1]/$totalCicloF[1][1]*100,1) . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
    <td>' . round($genderStatusList1[16]['statusA']/$totalCicloF[1][1]*100,1) . '</td>
    </tr>';

  $noInsc = $totalCicloF[1][2]-$totalCicloF[9][2];
  $noInscPorcent = round(($noInsc/$totalCicloF[1][2]*100), 1);
  if($genderStatusList1[17]['gender'] == 2){
    $noReg3PeriodPorcent = round(($genderStatusList1[17]['unregistered_three']/$totalCicloF[1][2]*100), 1);
  }

  $table3 .= '<tr>
    <td>' . $modeContenT[2] . '</td>
    <td>' . number_format($totalCicloF[1][2], 0, '', ',') . '</td>
    <td>' . round($totalCicloF[9][2]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($genderList1[9][2][9]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($genderList1[9][2][8]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . round($rezagoGraList[9][2]/$totalCicloF[1][2]*100,1) . '</td>
    <td>' . $noInscPorcent . '</td>
    <td>' . $noReg3PeriodPorcent . '</td>
    <td>' . round($genderStatusList1[17]['statusA']/$totalCicloF[1][2]*100,1) . '</td>
    </tr>';

  $table3 .= '
    </tbody>
  </table>';
  }
}

$table3 .= '
	</body>
</html>';

?>
