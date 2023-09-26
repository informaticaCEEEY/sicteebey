<?php

if (!isset($_POST['cohorte'])) {
    echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
} else {
    // Obtiene el objeto cohorte
    extract($_POST);
    $controller = new CohorteController();
    $cohorte = $controller -> getEntityAction($cohorte);
}

if (!$cohorte) {
    echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
}

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller -> getByAction('cohorte', $cohorte -> getId());
$numCiclo = count($schoolPeriod);
$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate";

$modPrim = array();
$modPrim[1] = 'Especial';
$modPrim[5] = 'Indigena';
$modPrim[9] = 'Particular';
$modPrim[4] = 'General';

$totalPrim = count($modPrim);

if($numCiclo > 6){
    $totPrim = 6;
}else{
    $totPrim = $numCiclo;
}

$modSecu = array();
$modSecu[2]  = 'Estatal';
$modSecu[10] = 'Tecnica';
$modSecu[11] = 'Telesecundaria';
$modSecu[14] = 'General';
$modSecu[15] = 'Particular';

$modeList = $modPrim + $modSecu;

$totalSecu = count($modSecu);

$studentStatusList = array();

$totalCicloList = array();

$nameCicloList = array();
$nameCicloList[0] = '';

/* Arreglos que almacenaran el numero de alumnos inscritos por ciclo y modalidad */
$aprovController = new AprovController();
$whereAprov = 'e.cohorte = :cohorte';
$whereFields = array('cohorte' => $cohorte->getId());
$showFields = 'e.*';
$aprovList = $aprovController->displayBy2Action($whereAprov, $whereFields, '', $showFields);

foreach($aprovList as $aprovL){
  $cicloY = 1 ;
  while($cicloY <= $numCiclo){
    //foreach($schoolPeriod as $cicloAct){
    if($cicloY == $aprovL['school_period']){
      $aprovTotaList[$cicloY][] = $aprovL['total'];
    }
    $cicloY = $cicloY + 1;
  }
}

$controller = new AprovModeController();
$wherePrim = 'e.cohorte = :cohorte AND (e.mode = 1 OR e.mode = 4 OR e.mode = 5 or e.mode = 9)';
$whereSecu = 'e.cohorte = :cohorte AND (e.mode = 2 OR e.mode = 10 OR e.mode = 11 or e.mode = 14 OR e.mode = 15)';
$whereFields = array('cohorte' => $cohorte->getId());
$showFields = 'e.*';
$studentsCicloPrimList = $controller->displayBy2Action($wherePrim, $whereFields, '', $showFields);
$studentsCicloSecuList = $controller->displayBy2Action($whereSecu, $whereFields, '', $showFields);

foreach($studentsCicloPrimList as $studentsPrimCiclo){
  $cicloX = 1 ;
  while($cicloX <= $numCiclo){
    if($cicloX == $studentsPrimCiclo['school_period']){
        $cicloList[$cicloX][$studentsPrimCiclo['mode']][$studentsPrimCiclo['grade']] = $studentsPrimCiclo['total'];
    }
    $cicloX = $cicloX + 1;
  }
}
foreach($studentsCicloSecuList as $studentsSecuCiclo){
  $cicloX = 1 ;
  while($cicloX <= $numCiclo){
    if($cicloX == $studentsSecuCiclo['school_period']){
      $cicloList[$cicloX][$studentsSecuCiclo['mode']][$studentsSecuCiclo['grade']] = $studentsSecuCiclo['total'];
    }
    $cicloX = $cicloX + 1;
  }
}

for ($ciclo = 1; $ciclo <= $numCiclo; $ciclo++) {
  array_push($nameCicloList, $schoolPeriod[$ciclo-1] -> getSchoolPeriodObject() -> getName());
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
<h2 class="text-center">Trayectorias Escolares por modalidad</h2><br />';

$table1 .= '
<h3 class="text-center">Primaria</h3><br />';

foreach ($modPrim as $modeKey => $modeName) {

  $table1 .= '
  <table class="table">
    <thead>
      <tr>
        <th colspan="9"> Flujo de los alumnos en primaria de la modalidad '.$modeName.'</th>
      </tr>
      <tr>
        <th colspan="9"> Cohorte ' . $cohorteName . '</th>
      </tr>
      <tr>
        <th colspan="3">Alumnos</th>
        <th colspan="6">Primaria</th>
      </tr>
      <tr>
        <th>Ciclo Escolar</th>
        <th>Total Inscritos</th>
        <th>Grado Ideal</th>
        <th>1&deg;</th>
        <th>2&deg;</th>
        <th>3&deg;</th>
        <th>4&deg;</th>
        <th>5&deg;</th>
        <th>6&deg;</th>
      </tr>
    </thead>
    <tbody>';

    for($cicloAct=1; $cicloAct<=$totPrim; $cicloAct++){
      for($x=1; $x<7; $x++){
        if(!isset($cicloList[$cicloAct][$modeKey][$x])){
          $cicloList[$cicloAct][$modeKey][$x] = 0;
        }
      }

      $totalCicloF[$cicloAct][$modeKey] = array_sum($cicloList[$cicloAct][$modeKey]);

      switch($cicloAct){
        case 1:
          $rezagoGraList[$cicloAct][$modeKey] = 0;
          break;
        case 2:
          $rezagoGraList[$cicloAct][$modeKey] = 0;
          break;
        case 3:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1];
          break;
        case 4:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2];
          break;
        case 5:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2] + $cicloList[$cicloAct][$modeKey][3];
          break;
        case 6:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2] + $cicloList[$cicloAct][$modeKey][3] + $cicloList[$cicloAct][$modeKey][4];
          break;
        case 7:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2] + $cicloList[$cicloAct][$modeKey][3] + $cicloList[$cicloAct][$modeKey][4] + $cicloList[$cicloAct][$modeKey][5];
          $rezagoGraList[$cicloAct][4] = 0;
          $rezagoGraList[$cicloAct][5] = 0;
          $rezagoGraList[$cicloAct][6] = 0;
          $rezagoGraList[$cicloAct][7] = 0;
          $rezagoGraList[$cicloAct][8] = 0;
          break;
        case 8:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2] + $cicloList[$cicloAct][$modeKey][3] + $cicloList[$cicloAct][$modeKey][4] + $cicloList[$cicloAct][$modeKey][5] + $cicloList[$cicloAct][$modeKey][6];
          $rezagoGraList[$cicloAct][4] = 0;
          $rezagoGraList[$cicloAct][5] = 0;
          $rezagoGraList[$cicloAct][6] = 0;
          $rezagoGraList[$cicloAct][7] = 0;
          $rezagoGraList[$cicloAct][8] = 0;
          break;
        case 9:
          $rezagoGraList[$cicloAct][$modeKey] = $cicloList[$cicloAct][$modeKey][1] + $cicloList[$cicloAct][$modeKey][2] + $cicloList[$cicloAct][$modeKey][3] + $cicloList[$cicloAct][$modeKey][4] + $cicloList[$cicloAct][$modeKey][5] + $cicloList[$cicloAct][$modeKey][6] + $cicloList[$cicloAct][$modeKey][7];
          break;

      }

      $table1 .= '<tr>
              <td>' . $nameCicloList[$cicloAct] . '</td>
              <td>' . $totalCicloF[$cicloAct][$modeKey] . '</td>
              <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;  ' . $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>';

      for ($nCiclo = 1; $nCiclo <= 6; $nCiclo++) {
        if($cicloAct == $nCiclo){
          $table1 .= '<td class="success">' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
        }elseif($cicloAct > $nCiclo + 1){
          $table1 .= '<td class="warning">' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
        }else{
          $table1 .= '<td>' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
        }
      }
      $table1 .='
      </tr>';
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
    <div>
      <h4 class="modal-title" id="myModalLabel"><b>Flujo de los alumnos en primaria para la modalidad '.$modeName.'</b></h4>'
      . $_POST["htmlContent$modeKey"] . '
    </div>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="12"> Número de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar de primaria de la modalidad '.$modeName.'</th>
        </tr>
        <tr>
          <th colspan="12"> Cohorte ' . $cohorteName . '</th>
        </tr>
        <tr>
          <th>Ciclo Escolar</th>
          <th>Grado Ideal</th>
          <th>Inscritos en el sistema</th>
          <th>Alumnos nuevos</th>
          <th>Alumnos que se van</th>
          <th>Inscritos grado ideal</th>
          <th>Alumnos nuevos en el grado ideal</th>
          <th>Alumnos en el grado ideal que se van</th>
          <th>Rezago ligero</th>
          <th>Rezago grave</th>
          <th>Sin registro</th>
          <th>Sin registro (Hace 3 ciclos escolares)</th>
        </tr>
      </thead>
      <tbody>';

      $controller = new AprovModeDataController();
      $wherePrim = 'e.cohorte = :cohorte AND (e.mode = 1 OR e.mode = 4 OR e.mode = 5 or e.mode = 9)';
      $whereSecu = 'e.cohorte = :cohorte AND (e.mode = 2 OR e.mode = 10 OR e.mode = 11 or e.mode = 14 OR e.mode = 15)';
      $whereFields = array('cohorte' => $cohorte->getId());
      $showFields = 'e.*';
      $aprovModePrimList = $controller->displayBy2Action($wherePrim, $whereFields, '', $showFields);
      $aprovModeSecuList = $controller->displayBy2Action($whereSecu, $whereFields, '', $showFields);

      $controllerStatus = new AprovModeStatusController();
      $whereFieldsStatus = array('cohorte' => $cohorte->getId());
      $showFieldsStatus = 'e.*';
      $totalStatus = array();
      $aprovModeStatusPrimList = $controllerStatus->displayBy2Action($wherePrim, $whereFieldsStatus, '', $showFieldsStatus);
      $aprovModeStatusSecuList = $controllerStatus->displayBy2Action($whereSecu, $whereFieldsStatus, '', $showFieldsStatus);

      foreach($aprovModePrimList as $aprovModePrim){
        $cicloX = 1 ;
        //while($cicloX <= $numCiclo){
        foreach($schoolPeriod as $cicloAct){
          if($cicloAct->getSchoolPeriod() == $aprovModePrim['school_period']){
            $modeDataList[$aprovModePrim['mode']][$cicloX] = $aprovModePrim;
            $totalMode[$cicloX][$aprovModePrim['mode']] = $aprovModePrim['total'] + $aprovModePrim['new_students'];
          }
          $cicloX = $cicloX + 1;
        }
      }

      foreach($aprovModeSecuList as $aprovModeSecu){
        $cicloX = 1 ;
        foreach($schoolPeriod as $cicloAct){
          //while($cicloX <= $numCiclo){
          //if($cicloX == $aprovModeSecu['school_period']){
          if($cicloAct->getSchoolPeriod() == $aprovModeSecu['school_period']){
            $modeDataList[$aprovModeSecu['mode']][$cicloX] = $aprovModeSecu;
            $totalMode[$cicloX][$aprovModeSecu['mode']] = $aprovModeSecu['total'] + $aprovModeSecu['new_students'];
          }
          $cicloX = $cicloX + 1;
        }
      }

      foreach($aprovModeStatusPrimList as $aprovModeStatusPrim){
        $cicloX = 1 ;
        foreach($schoolPeriod as $cicloAct){
          if($cicloAct->getSchoolPeriod() == $aprovModeStatusPrim['school_period']){
            $modeStatusList[$aprovModeStatusPrim['mode']][$cicloX] = $aprovModeStatusPrim;
          }
          $cicloX = $cicloX + 1;
        }
      }

      foreach($aprovModeStatusSecuList as $aprovModeStatusSecu){
        $cicloX = 1 ;
        foreach($schoolPeriod as $cicloAct){
          if($cicloAct->getSchoolPeriod() == $aprovModeStatusSecu['school_period']){
            $modeStatusList[$aprovModeStatusSecu['mode']][$cicloX] = $aprovModeStatusSecu;
          }
          $cicloX = $cicloX + 1;
        }
      }

      for($cicloAct=1; $cicloAct<=$totPrim; $cicloAct++){
        $data2[$modeKey] = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
        for($i=1; $i<count($totalCicloList); $i++){
          $noInsc = $totalCicloF[1][$modeKey] - $totalCicloF[$i][$modeKey];
          $data2[$modeKey] .= "['".$nameCicloList[$i]."',".$totalIdealMod.",".$cicloList[$i][$modeKey][$i-1].",".$rezagoGraList[$i][$modeKey].",".$noInsc."],";
        }
        $data2[$modeKey] .= ']';

        $table1 .= '
        <tr>
          <td>' . $nameCicloList[$cicloAct]. '</td>
          <td class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['total'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['new_students'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['students_leaving'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['total_ideal'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['new_students_ideal'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['students_ideal_leaving'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['slight_lag'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['serious_lag'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['unregistered'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['unregistered_three'], 0, '', ',') . '</td>';
        $table1 .= '
        </tr>';
      }

    $table1 .= '
      </tbody>
    </table>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="8"> Trayectoria ideal en primaria para la modalidad '.$modeName.'</th>
        </tr>
        <tr>
          <th colspan="8"> Cohorte ' . $cohorteName . '</th>
        </tr>
        <tr>
          <th rowspan="2">Grado Ideal</th>
          <th rowspan="2">Ciclo Escolar</th>
          <th colspan="3">Alumnos</th>
          <th colspan="3">Eficiencias</th>
        </tr>
        <tr>
          <th>Inscritos</th>
          <th>Aprobados</th>
          <th>Reprobados</th>
          <th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que aprueban el grado escolar del total
            de alumnos inscritos en el mismo grado (g)." data-placement="bottom">Intragrado</a></th>
          <th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que se inscriben al siguiente grado (g+1) escolar del total de alumnos aprobados
            del grado escolar (g)" data-placement="bottom">Intergrado</a></th>
          <th><a href="#" style="text-decoration: none; color: #000000" data-toggle="tooltip" title="Representa el porcentaje de alumnos que aprueban el grado escolar ideal (g) respecto al total de alumnos de la cohorte
            inicial (c)" data-placement="bottom">De la cohorte</a></th>
        </tr>
      </thead>
      <tbody>';

      if($numCiclo > 6){
        $numCicloX = 6;
      }else{
        $numCicloX = $numCiclo;
      }

      for($cicloAct=1; $cicloAct<=$numCicloX; $cicloAct++){

        $totalIdealMod = $modeDataList[$modeKey][$cicloAct]['total_ideal'];
        $totalIdealMod1 = $modeDataList[$modeKey][$cicloAct+1]['total_ideal'];
        $eficIntragrado = round(($modeStatusList[$modeKey][$cicloAct]['statusA']/$totalIdealMod*100), 1).'%';
        $eficIntergrado = round(($totalIdealMod1/$modeStatusList[$modeKey][$cicloAct]['statusA']*100), 1).'%';
        $eficCohorte = round(($modeStatusList[$modeKey][$cicloAct]['statusA']/$modeDataList[$modeKey][1]['total_ideal']*100), 1).'%';

        if($eficIntergrado == 0){
          $eficIntergrado = '-';
        }

        $table1 .= '
        <tr>
          <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
          <td class="theadR">' . $nameCicloList[$cicloAct]. '</td>
          <td class="theadR">' . number_format($totalIdealMod, 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusA'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusR'], 0, '', ',') . '</td>
          <td class="theadR">' . $eficIntragrado . '</td>
          <td class="theadR">' . $eficIntergrado . '</td>
          <td class="theadR">' . $eficCohorte . '</td>
        </tr>';
      }

    $table1 .= '
      </tbody>
    </table>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;
}

if($numCiclo > 6){

  $table1 .= '
  <h3 class="text-center">Secundaria</h3><br />';

  foreach ($modSecu as $modeKey => $modeName) {

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="6"> Flujo de los alumnos en secundaria de la modalidad ' . $modeName .'</th>
        </tr>
        <tr>
          <th colspan="6"> Cohorte ' . $cohorteName . '</th>
        </tr>
        <tr>
          <th colspan="3">Alumnos</th>
          <th colspan="3">Secundaria</th>
        </tr>
        <tr>
          <th>Ciclo Escolar</th>
          <th>Total Inscritos</th>
          <th>Grado Ideal</th>
          <!-- Secundaria -->
          <th>Inscritos 1&deg;</th>
          <th>Inscritos 2&deg;</th>
          <th>Inscritos 3&deg;</th>
          </tr>
      </thead>
      <tbody>';

      for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
        for($x=7; $x<10; $x++){
          if(!isset($cicloList[$cicloAct][$modeKey][$x])){
            $cicloList[$cicloAct][$modeKey][$x] = 0;
          }
        }

        $totalCicloF[$cicloAct][$modeKey] = array_sum($cicloList[$cicloAct][$modeKey]);
        $table1 .= '
        <tr>
          <td>' . $nameCicloList[$cicloAct] . '</td>
          <td>' . $totalCicloF[$cicloAct][$modeKey] . '</td>
          <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;</td>';
          for ($nCiclo = 7; $nCiclo <= 9; $nCiclo++) {
            if($cicloAct == $nCiclo){
              $table1 .= '<td class="success">' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
            }elseif($cicloAct > $nCiclo + 1){
              $table1 .= '<td class="warning">' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
            }else{
              $table1 .= '<td>' . number_format($cicloList[$cicloAct][$modeKey][$nCiclo], 0, '', ',') . '</td>';
            }
          }
        $table1 .= '
        </tr>';
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
    <div>
      <h4 class="modal-title" id="myModalLabel"><b>Flujo de los alumnos en secundaria para la modalidad '.$modeName.'</b></h4>'
      . $_POST["htmlContent$modeKey"] . '
    </div>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="12"> Número de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar de secundaria de la modalidad ' . $modeName . '</th>
        </tr>
        <tr>
          <th colspan="12"> Cohorte ' . $cohorteName . '</th>
        </tr>
        <tr>
          <th>Ciclo Escolar</th>
          <th>Grado Ideal</th>
          <th>Inscritos en el sistema</th>
          <th>Alumnos nuevos</th>
          <th>Alumnos que se van</th>
          <th>Inscritos grado ideal</th>
          <th>Alumnos nuevos en el grado ideal</th>
          <th>Alumnos en el grado ideal que se van</th>
          <th>Rezago ligero</th>
          <th>Rezago grave</th>
          <th>Sin registro</th>
          <th>Sin registro (Hace 2 ciclos escolares)</th>
        </tr>
      </thead>
      <tbody>';

      for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
        $table1 .= '
        <tr>
          <td>' . $nameCicloList[$cicloAct]. '</td>
          <td class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['total'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['new_students'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['students_leaving'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['total_ideal'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['new_students_ideal'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['students_ideal_leaving'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['slight_lag'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['serious_lag'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['unregistered'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeDataList[$modeKey][$cicloAct]['unregistered_three'], 0, '', ',') . '</td>';
        $table1 .= '
        </tr>';
      }

    $table1 .= '
      </tbody>
    </table>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="10"> Trayectoria ideal en secundaria para la modalidad ' . $modeName . '</th>
        </tr>
        <tr>
          <th colspan="10"> Cohorte ' . $cohorteName . '</th>
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
        </tr>
      </thead>
      <tbody>';

      for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
        $totalIdealMod = $modeDataList[$modeKey][$cicloAct]['total_ideal'];
        $totalIdealMod1 = $modeDataList[$modeKey][$cicloAct+1]['total_ideal'];
        $eficIntragrado = round(($modeStatusList[$modeKey][$cicloAct]['statusA']/$totalIdealMod*100), 1).'%';
        $eficIntergrado = round(($totalIdealMod1/$modeStatusList[$modeKey][$cicloAct]['statusA']*100), 1).'%';
        $eficCohorte = round(($modeStatusList[$modeKey][$cicloAct]['statusA']/$modeDataList[$modeKey][7]['total_ideal']*100), 1).'%';
        if($eficIntergrado == 0){
          $eficIntergrado = '-';
        }

        $table1 .= '
        <tr>
          <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
          <td class="theadR">' . $nameCicloList[$cicloAct]. '</td>
          <td class="theadR">' . number_format($totalIdealMod, 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusA'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusR'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusX'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$modeKey][$cicloAct]['statusZ'], 0, '', ',') . '</td>
          <td class="theadR">' . $eficIntragrado . '</td>
          <td class="theadR">' . $eficIntergrado . '</td>
          <td class="theadR">' . $eficCohorte . '</td>
        </tr>';
      }

    $table1 .= '
      </tbody>
    </table>';

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

  }

}

$table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
    </tr>
    <tr>
      <th colspan="8"> Cohorte ' . $cohorteName . ' </th>
    </tr>
    <tr>
      <th>Ciclo Escolar</th>
      <th>Modalidad</th>
      <th>Grado Ideal</th>
      <th>Inscritos en el sistema</th>
      <th>Inscritos grado ideal</th>
      <th>Rezago ligero</th>
      <th>Rezago grave</th>
      <th>Sin registro</th>
    </tr>
  </thead>
  <tbody>';

  if($numCiclo > 3){
    $cicloF = 3;
  }else {
    $cicloF = $numCiclo;
  }

  for($cicloAct=1; $cicloAct<=$cicloF; $cicloAct++){
    $totalCiclo[$cicloAct] = array_sum($aprovTotaList[$cicloAct]);
    foreach($modPrim as $modeKey => $modeName){
      $totalMod = $modeDataList[$modeKey][$cicloAct]['total'] + $modeDataList[$modeKey][$cicloAct]['new_students'];
      $idealMod = $modeDataList[$modeKey][$cicloAct]['total_ideal'] + $modeDataList[$modeKey][$cicloAct]['new_students_ideal'];
      $inscritPorcent = round(($totalMod/$totalCiclo[1]*100), 2);
      $gradoIdealPorcent = round(($idealMod/$totalCiclo[1]*100), 2);
      $rezagoLigPorcent = round(($cicloList[$cicloAct][$modeKey][$cicloAct-1]/$totalCiclo[1]*100), 2);
      $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][$modeKey]/$totalCiclo[1]*100), 2);
      $noInscPorcent = round(($modeDataList[$modeKey][$cicloAct]['unregistered']/$totalCiclo[1]*100), 2);

      if($modeKey == 1){
        $table1 .= '
        <tr>
          <td rowspan="' . $totalPrim . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
          <td>' . $modPrim[$modeKey] . '</td>
          <td rowspan="' . $totalPrim . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
          <td>' . $inscritPorcent . '</td>
          <td>' . $gradoIdealPorcent . '</td>
          <td>' . $rezagoLigPorcent . '</td>
          <td>' . $rezagoGraPorcent . '</td>
          <td>' . $noInscPorcent . '</td>';
        $table1 .= '
        </tr>';
      }else{
        $table1 .= '
        <tr>
          <td>' . $modPrim[$modeKey] . '</td>
          <td>' . $inscritPorcent . '</td>
          <td>' . $gradoIdealPorcent . '</td>
          <td>' . $rezagoLigPorcent . '</td>
          <td>' . $rezagoGraPorcent . '</td>
          <td>' . $noInscPorcent . '</td>';
        $table1 .= '
        </tr>';
      }
    }
  }
  $table1 .= '</tbody>
  </table>
  </div>';

  if($numCiclo > 3){

    if($numCiclo > 6){
      $cicloF = 6;
    }else{
      $cicloF = $numCiclo;
    }

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
        </tr>
        <tr>
          <th colspan="8"> Cohorte ' . $cohorteName . ' </th>
        </tr>
        <tr>
          <th>Ciclo Escolar</th>
          <th>Modalidad</th>
          <th>Grado Ideal</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos grado ideal</th>
          <th>Rezago ligero</th>
          <th>Rezago grave</th>
          <th>Sin registro</th>
        </tr>
      </thead>
      <tbody>';

      for($cicloAct=4; $cicloAct<=$cicloF; $cicloAct++){
        $totalCiclo[$cicloAct] = array_sum($aprovTotaList[$cicloAct]);
        foreach($modPrim as $modeKey => $modeName){
          $totalMod = $modeDataList[$modeKey][$cicloAct]['total'] + $modeDataList[$modeKey][$cicloAct]['new_students'];
          $idealMod = $modeDataList[$modeKey][$cicloAct]['total_ideal'] + $modeDataList[$modeKey][$cicloAct]['new_students_ideal'];
          $inscritPorcent = round(($totalMod/$totalCiclo[1]*100), 2);
          $gradoIdealPorcent = round(($idealMod/$totalCiclo[1]*100), 2);
          $rezagoLigPorcent = round(($cicloList[$cicloAct][$modeKey][$cicloAct-1]/$totalCiclo[1]*100), 2);
          $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][$modeKey]/$totalCiclo[1]*100), 2);
          $noInscPorcent = round(($modeDataList[$modeKey][$cicloAct]['unregistered']/$totalCiclo[1]*100), 2);

          if($modeKey == 1){
            $table1 .= '
            <tr>
              <td rowspan="' . $totalPrim . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
              <td>' . $modPrim[$modeKey] . '</td>
              <td rowspan="' . $totalPrim . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            $table1 .= '
            </tr>';
          }else{
            $table1 .= '
            <tr>
              <td>' . $modPrim[$modeKey] . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            $table1 .= '
            </tr>';
          }
        }
      }
      $table1 .= '</tbody>
      </table>
      </div>';
  }

  if($numCiclo > 6){

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
        </tr>
        <tr>
          <th colspan="8"> Cohorte ' . $cohorteName . ' </th>
        </tr>
        <tr>
          <th>Ciclo Escolar</th>
          <th>Modalidad</th>
          <th>Grado Ideal</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos grado ideal</th>
          <th>Rezago ligero</th>
          <th>Rezago grave</th>
          <th>Sin registro</th>
        </tr>
      </thead>
      <tbody>';

      for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
        $totalCiclo[$cicloAct] = array_sum($aprovTotaList[$cicloAct]);
        foreach($modSecu as $modeKey => $modeName){
          $totalMod = $modeDataList[$modeKey][$cicloAct]['total'] + $modeDataList[$modeKey][$cicloAct]['new_students'];
          $idealMod = $modeDataList[$modeKey][$cicloAct]['total_ideal'] + $modeDataList[$modeKey][$cicloAct]['new_students_ideal'];
          $inscritPorcent = round(($totalMod/$totalCiclo[1]*100), 2);
          $gradoIdealPorcent = round(($idealMod/$totalCiclo[1]*100), 2);
          $rezagoLigPorcent = round(($cicloList[$cicloAct][$modeKey][$cicloAct-1]/$totalCiclo[1]*100), 2);
          $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][$modeKey]/$totalCiclo[1]*100), 2);
          $noInscPorcent = round(($modeDataList[$modeKey][$cicloAct]['unregistered']/$totalCiclo[1]*100), 2);

          if($modeKey == 2){
            $table1 .= '
            <tr>
              <td rowspan="' . $totalSecu . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
              <td>' . $modSecu[$modeKey] . '</td>
              <td rowspan="' . $totalSecu . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            $table1 .= '
            </tr>';
          }else{
            $table1 .= '
            <tr>
              <td>' . $modSecu[$modeKey] . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            $table1 .= '
            </tr>';
          }
        }
      }
      $table1 .= '</tbody>
      </table>
      </div>';
  }

  if($numCiclo >= 6 ){

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="11">Estatus de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
        </tr>
        <tr>
          <th colspan="11"> Cohorte ' . $cohorteName . ' </th>
        </tr>
        <tr>
          <th colspan="2">Ciclo ' . $schoolPeriod[0]->getCohorteObject()->getName() . '</th>
          <th colspan="3">Ciclo ' . $nameCicloList[6] . '</th>
          <th colspan="2">Rezago</th>
          <th colspan="2">Sin registro</th>
          <th colspan="2">Al finalizar el ciclo</th>
        </tr>
        <tr>
          <th>Modalidad</th>
          <th>Total de alumnos</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos (6&deg;)</th>
          <th>Inscritos otra modalidad</th>
          <th>Ligero</th>
          <th>Grave</th>
          <th>Ciclo escolar</th>
          <th>Hace 3 ciclos escolares</th>
          <th>Egresados</th>
          <th>Absorcion (1&deg; secundaria)</th>
        </tr>
      </thead>
      <tbody>';

      $rowspan = count($modPrim);
      $modeContenT = $modPrim;
      $aprovModeSecuController = new AprovModeSecuController();
      $where = 'e.cohorte = :idCohorte';
      $whereFields = array('idCohorte' => $cohorte->getId());
      $aprovModeSecuList = $aprovModeSecuController->displayBy2Action($where, $whereFields);
      foreach($aprovModeSecuList as $aprovModeSecu){
        $aprovModeSecuArray[$aprovModeSecu['mode']] = $aprovModeSecu;
      }
      foreach($modPrim as $mode => $modeName){
        if($mode == 1){
        $table1 .= '
        <tr>
          <td>' . $modPrim[$mode] . '</td>
          <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['total_ideal'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['students_leaving'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['slight_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['serious_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['unregistered'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['unregistered_three'], 0, '', ',')  . '</td>
          <td>' . number_format($modeStatusList[$mode][6]['statusA'], 0, '', ',') . '</td>
          <td>' . number_format($aprovModeSecuArray[$mode]['total'], 0, '', ',') . '</td>
        </tr>';
      }else{
        $table1 .= '
        <tr>
          <td>' . $modPrim[$mode] . '</td>
          <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['total_ideal'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['students_leaving'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['slight_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['serious_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['unregistered'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][6]['unregistered_three'], 0, '', ',')  . '</td>
          <td>' . number_format($modeStatusList[$mode][6]['statusA'], 0, '', ',') . '</td>
          <td>' . number_format($aprovModeSecuArray[$mode]['total'], 0, '', ',') . '</td>
        </tr>';
      }
    }
    $table1 .= '
      </tbody>
    </table>';

    $table1 .= '<table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="11">Porcentaje de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
        </tr>
        <tr>
          <th colspan="11"> Cohorte ' . $cohorteName . ' </th>
        </tr>
        <tr>
          <th colspan="2">Ciclo ' . $schoolPeriod[0]->getCohorteObject()->getName() . '</th>
          <th colspan="3">Ciclo ' . $nameCicloList[6] . '</th>
          <th colspan="2">Rezago</th>
          <th colspan="2">Sin registro</th>
          <th colspan="2">Al finalizar el ciclo</th>
        </tr>
        <tr>
          <th>Modalidad</th>
          <th>Total de alumnos</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos (6&deg;)</th>
          <th>Inscritos otra modalidad</th>
          <th>Ligero</th>
          <th>Grave</th>
          <th>Ciclo escolar</th>
          <th>Hace 3 ciclos escolares</th>
          <th>Egresados</th>
          <th>Absorcion (1&deg; secundaria)</th>
        </tr>
      </thead>
      <tbody>';

      $rowspan = count($modPrim);
      $modeContenT = $modPrim;
      $aprovModeSecuController = new AprovModeSecuController();
      $where = 'e.cohorte = :idCohorte';
      $whereFields = array('idCohorte' => $cohorte->getId());
      $aprovModeSecuList = $aprovModeSecuController->displayBy2Action($where, $whereFields);
      foreach($aprovModeSecuList as $aprovModeSecu){
        $aprovModeSecuArray[$aprovModeSecu['mode']] = $aprovModeSecu;
      }
      foreach($modPrim as $mode => $modeName){
        $inscPorc = round($modeDataList[$mode][6]['total']/$modeDataList[$mode][1]['total']*100,1);
        $inscIdealPorc = round($modeDataList[$mode][6]['total_ideal']/$modeDataList[$mode][1]['total']*100,1);
        $inscOtherModPorc = round($modeDataList[$mode][6]['students_leaving']/$modeDataList[$mode][1]['total']*100,1);
        $inscSlightLagPorc = round($modeDataList[$mode][6]['slight_lag']/$modeDataList[$mode][1]['total']*100,1);
        $inscSeriousLagPorc = round($modeDataList[$mode][6]['serious_lag']/$modeDataList[$mode][1]['total']*100,1);
        $unregisteredPorc = round($modeDataList[$mode][6]['unregistered']/$modeDataList[$mode][1]['total']*100,1);
        $unregisteredThreePorc = round($modeDataList[$mode][6]['unregistered_three']/$modeDataList[$mode][1]['total']*100,1);
        $aprovPorc = round($modeStatusList[$mode][6]['statusA']/$modeDataList[$mode][1]['total']*100,1);
        $inscNextPorc = round($aprovModeSecuArray[$mode]['total']/$modeDataList[$mode][1]['total']*100,1);
        if($mode == 1){
          $table1 .= '
          <tr>
            <td>' . $modPrim[$mode] . '</td>
            <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
            <td>' . $inscPorc . '</td>
            <td>' . $inscIdealPorc . '</td>
            <td>' . $inscOtherModPorc . '</td>
            <td>' . $inscSlightLagPorc . '</td>
            <td>' . $inscSeriousLagPorc . '</td>
            <td>' . $unregisteredPorc . '</td>
            <td>' . $unregisteredThreePorc  . '</td>
            <td>' . $aprovPorc . '</td>
            <td>' . $inscNextPorc . '</td>
          </tr>';
        }else{
          $table1 .= '
          <tr>
            <td>' . $modPrim[$mode] . '</td>
            <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
            <td>' . $inscPorc . '</td>
            <td>' . $inscIdealPorc . '</td>
            <td>' . $inscOtherModPorc . '</td>
            <td>' . $inscSlightLagPorc . '</td>
            <td>' . $inscSeriousLagPorc . '</td>
            <td>' . $unregisteredPorc . '</td>
            <td>' . $unregisteredThreePorc  . '</td>
            <td>' . $aprovPorc . '</td>
            <td>' . $inscNextPorc . '</td>
          </tr>';
        }
      }
      $table1 .= '
      </tbody>
    </table>';

  }

  if($numCiclo >= 9){

    $table1 .= '<div style="page-break-after:always;"></div>';
    $table1 .= $headerPDF;

    $table1 .= '
    <table class="table table-bordered table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th colspan="10">Estatus de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
        </tr>
        <tr>
          <th colspan="10"> Cohorte ' . $cohorteName . ' </th>
        </tr>
        <tr>
          <th colspan="2">Ciclo ' . $schoolPeriod[0]->getCohorteObject()->getName() . '</th>
          <th colspan="3">Ciclo ' . $nameCicloList[9] . '</th>
          <th colspan="2">Rezago</th>
          <th colspan="2">Sin registro</th>
          <th>Al finalizar el ciclo</th>
        </tr>
        <tr>
          <th>Modalidad</th>
          <th>Total de alumnos</th>
          <th>Inscritos en el sistema</th>
          <th>Inscritos (3&deg;)</th>
          <th>Inscritos otra modalidad</th>
          <th>Ligero</th>
          <th>Grave</th>
          <th>Ciclo escolar</th>
          <th>Ciclo escolar anterior</th>
          <th>Egresados</th>
        </tr>
      </thead>
      <tbody>';

    $rowspan = count($modSecu);
    $modeContenT = $modSecu;
    foreach($modSecu as $mode => $modeName){
      if($mode == 2){
				$table1 .='
				<tr>
					<td>' . $modSecu[$mode] . '</td>
					<td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
					<td>' . number_format($modeDataList[$mode][9]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['total_ideal'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['students_leaving'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['slight_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['serious_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['unregistered'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['unregistered_three'], 0, '', ',')  . '</td>
          <td>' . number_format($modeStatusList[$mode][9]['statusA'], 0, '', ',') . '</td>
				</tr>';

      }else{
        $table1 .='
				<tr>
					<td>' . $modSecu[$mode] . '</td>
					<td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
					<td>' . number_format($modeDataList[$mode][9]['total'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['total_ideal'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['students_leaving'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['slight_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['serious_lag'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['unregistered'], 0, '', ',') . '</td>
          <td>' . number_format($modeDataList[$mode][9]['unregistered_three'], 0, '', ',')  . '</td>
          <td>' . number_format($modeStatusList[$mode][9]['statusA'], 0, '', ',') . '</td>
				</tr>';
			}
    }
    $table1 .= '
    </tbody>
  </table>';

  $table1 .= '<div style="page-break-after:always;"></div>';
  $table1 .= $headerPDF;

  $table1 .= '
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th colspan="10">Porcentaje de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
      </tr>
      <tr>
        <th colspan="10"> Cohorte '.  $cohorteName . '</th>
      </tr>
      <tr>
        <th colspan="2">Ciclo ' . $schoolPeriod[0]->getCohorteObject()->getName() . '</th>
        <th colspan="3">Ciclo ' . $nameCicloList[9] . '</th>
        <th colspan="2">Rezago</th>
        <th colspan="2">Sin registro</th>
        <th>Al finalizar el ciclo</th>
      </tr>
      <tr>
        <th>Modalidad</th>
        <th>Total de alumnos</th>
        <th>Inscritos en el sistema</th>
        <th>Inscritos (3&deg;)</th>
        <th>Inscritos otra modalidad</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Ciclo escolar anterior</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>';

    $rowspan = count($modSecu);
    $modeContenT = $modSecu;
    foreach($modSecu as $mode => $modeName){
      $inscPorc = round($modeDataList[$mode][9]['total']/$modeDataList[$mode][7]['total']*100,1);
      $inscIdealPorc = round($modeDataList[$mode][9]['total_ideal']/$modeDataList[$mode][7]['total']*100,1);
      $inscOtherModPorc = round($modeDataList[$mode][9]['students_leaving']/$modeDataList[$mode][7]['total']*100,1);
      $inscSlightLagPorc = round($modeDataList[$mode][9]['slight_lag']/$modeDataList[$mode][7]['total']*100,1);
      $inscSeriousLagPorc = round($modeDataList[$mode][9]['serious_lag']/$modeDataList[$mode][7]['total']*100,1);
      $unregisteredPorc = round($modeDataList[$mode][9]['unregistered']/$modeDataList[$mode][7]['total']*100,1);
      $unregisteredThreePorc = round($modeDataList[$mode][9]['unregistered_three']/$modeDataList[$mode][7]['total']*100,1);
      $aprovPorc = round($modeStatusList[$mode][9]['statusA']/$modeDataList[$mode][7]['total']*100,1);
      if($mode == 2){
        $table1 .='
        <tr>
          <td>' . $modSecu[$mode] . '</td>
          <td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
          <td>' . $inscPorc . '</td>
          <td>' . $inscIdealPorc . '</td>
          <td>' . $inscOtherModPorc . '</td>
          <td>' . $inscSlightLagPorc . '</td>
          <td>' . $inscSeriousLagPorc . '</td>
          <td>' . $unregisteredPorc . '</td>
          <td>' . $unregisteredThreePorc  . '</td>
          <td>' . $aprovPorc . '</td>
        </tr>';

      }else{
        $table1 .='
        <tr>
          <td>' . $modSecu[$mode] . '</td>
          <td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
          <td>' . $inscPorc . '</td>
          <td>' . $inscIdealPorc . '</td>
          <td>' . $inscOtherModPorc . '</td>
          <td>' . $inscSlightLagPorc . '</td>
          <td>' . $inscSeriousLagPorc . '</td>
          <td>' . $unregisteredPorc . '</td>
          <td>' . $unregisteredThreePorc  . '</td>
          <td>' . $aprovPorc . '</td>
        </tr>';
      }
    }
    $table1 .= '
    </tbody>
  </table>';


  }

?>
