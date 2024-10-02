<?php

require ('../checkSession.php');
$userController = new UsersController();

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
$totalSecu = count($modSecu);
$modeList = $modPrim + $modSecu;
$studentStatusList = array();
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
    <link rel="icon" href="../img/favicon_.png">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/buttonTop.css" rel="stylesheet">
    <link href="../css/footer.css" rel="stylesheet">
    <link href="../css/chart.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
    <link href="../css/tabs.css" rel="stylesheet">
    <link href="../css/factorTable.css" rel="stylesheet">
    <!--link href="css/jquery-confirm.css" rel="stylesheet" type="text/css"  /-->
    <script src="../lib/jquery/jquery.min.js"></script>
    <script src="../lib/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  </head>
  <body>
    <?php include('header.php'); ?>
    <div class="container">
      <form name="report" id="report" action="../<?php echo $user->getAbbreviation() ?>/mode.php" method="post" accept-charset="UTF-8"></form>
      <button type="button" id="buttonBack" class="buttonBack" onclick="document.forms.report.submit()"><span>Regresar</span></button>
      <div class='text-center'><h2 class='form-signin-heading'>Reporte por modalidad de trayectorias escolares</h2></div><hr /><br />
      <?php
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
      ?>
        <div class="col-xs-12 col-md-12 text-center">
          <h3>Primaria</h3>
        </div>
        <ul class="nav nav-pills nav-justified">
          <li class="active"><a href="#table1" data-toggle="pill">Especial</a></li>
          <li><a href="#table5" data-toggle="pill">Indigena</a></li>
          <li><a href="#table9" data-toggle="pill">Particular</a></li>
          <li><a href="#table4" data-toggle="pill">General</a></li>
        </ul>
        <div class="tab-content"><br />
      <?php
        //for($mode= 0; $mode<$totalPrim; $mode++){
        foreach($modPrim as $mode => $modeName){
          if($mode == 1){
            echo('<div id="table'.$mode.'" class="tab-pane fade active in">');
          }else{
            echo('<div id="table'.$mode.'" class="tab-pane fade">');
          }
?>

        <div class="table-responsive col-xs-12 col-md-12">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th colspan="9"> Flujo de los alumnos en primaria de la modalidad <?php echo($modPrim[$mode]); ?></th>
            </tr>
            <tr>
              <th colspan="9"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
            </tr>
            <tr>
              <th colspan="3">Alumnos</th>
              <th colspan="6">Primaria</th>
            </tr>
            <tr>
              <th>Ciclo Escolar</th>
              <th>Total Inscritos</th>
              <th>Grado Ideal</th>
              <!-- Primaria -->
              <th>Inscritos 1&deg;</th>
              <th>Inscritos 2&deg;</th>
              <th>Inscritos 3&deg;</th>
              <th>Inscritos 4&deg;</th>
              <th>Inscritos 5&deg;</th>
              <th>Inscritos 6&deg;</th>
            </tr>
          </thead>
          <tbody>
          <?php

          for($cicloAct=1; $cicloAct<=$totPrim; $cicloAct++){
            for($x=1; $x<7; $x++){
              if(!isset($cicloList[$cicloAct][$mode][$x])){
                $cicloList[$cicloAct][$mode][$x] = 0;
              }
            }

          $totalCicloF[$cicloAct][$mode] = array_sum($cicloList[$cicloAct][$mode]);

          switch($cicloAct){
            case 1:
              $rezagoGraList[$cicloAct][$mode] = 0;
              break;
            case 2:
              $rezagoGraList[$cicloAct][$mode] = 0;
              break;
            case 3:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1];
              break;
            case 4:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2];
              break;
            case 5:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2] + $cicloList[$cicloAct][$mode][3];
              break;
            case 6:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2] + $cicloList[$cicloAct][$mode][3] + $cicloList[$cicloAct][$mode][4];
              break;
            case 7:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2] + $cicloList[$cicloAct][$mode][3] + $cicloList[$cicloAct][$mode][4] + $cicloList[$cicloAct][$mode][5];
              $rezagoGraList[$cicloAct][4] = 0;
              $rezagoGraList[$cicloAct][5] = 0;
              $rezagoGraList[$cicloAct][6] = 0;
              $rezagoGraList[$cicloAct][7] = 0;
              $rezagoGraList[$cicloAct][8] = 0;
              break;
            case 8:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2] + $cicloList[$cicloAct][$mode][3] + $cicloList[$cicloAct][$mode][4] + $cicloList[$cicloAct][$mode][5] + $cicloList[$cicloAct][$mode][6];
              $rezagoGraList[$cicloAct][4] = 0;
              $rezagoGraList[$cicloAct][5] = 0;
              $rezagoGraList[$cicloAct][6] = 0;
              $rezagoGraList[$cicloAct][7] = 0;
              $rezagoGraList[$cicloAct][8] = 0;
              break;
            case 9:
              $rezagoGraList[$cicloAct][$mode] = $cicloList[$cicloAct][$mode][1] + $cicloList[$cicloAct][$mode][2] + $cicloList[$cicloAct][$mode][3] + $cicloList[$cicloAct][$mode][4] + $cicloList[$cicloAct][$mode][5] + $cicloList[$cicloAct][$mode][6] + $cicloList[$cicloAct][$mode][7];
              break;

          }

          echo '
          <tr>
            <td>' . $nameCicloList[$cicloAct] . '</td>
            <td>' . $totalCicloF[$cicloAct][$mode] . '</td>
            <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;  ' . $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>';
            for ($nCiclo = 1; $nCiclo <= 6; $nCiclo++) {
              if($cicloAct == $nCiclo){
                echo '<td class="success">' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }elseif($cicloAct > $nCiclo + 1){
                echo '<td class="warning">' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }else{
                echo '<td>' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }
            }
            /*if($cicloAct == 1){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][1] . '</td>';
            }elseif($cicloAct > 2){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][1] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][1] . '</td>';
            }
            if($cicloAct == 2){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][2] . '</td>';
            }elseif($cicloAct > 3){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][2] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][2] . '</td>';
            }
            if($cicloAct == 3){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][3] . '</td>';
            }elseif($cicloAct > 4){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][3] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][3] . '</td>';
            }
            if($cicloAct == 4){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][4] . '</td>';
            }elseif($cicloAct > 5){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][4] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][4] . '</td>';
            }
            if($cicloAct == 5){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][5] . '</td>';
            }elseif($cicloAct > 6){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][5] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][5] . '</td>';
            }
            if($cicloAct == 6){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][6] . '</td>';
            }elseif($cicloAct > 7){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][6] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][6] . '</td>';
            }*/
           echo'
            </tr>';
        }

        $data[$mode] = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
        for($i=1; $i<=$totPrim; $i++){
          $data[$mode] .= "['".$nameCicloList[$i]."',".$totalCicloF[$i][$mode].",".$cicloList[$i][$mode][$i]."],";
        }
        $data[$mode] .= ']';

        echo '</tbody>
        </table>
        </div>
        <div class="col-xs-12 col-md-12 text-center">
          <div class="col-xs-12 col-md-3 text-left graphSchool">
            <table class="table">
              <button class="btn btn-primary" onclick="drawChart('.$data[$mode].', '.$mode.')" data-toggle="modal" data-target="#modal_column_chart" data-backdrop="static" data-keyboard="false">
                Ver grafica
              </button>
            </table>
          </div>
          <div class="col-xs-6 col-md-3">
            <table class="table table-bordered ">
              <tr>
                <td class="success"></td>
                <td>Trayectoria ideal</td>
              </tr>
            </table>
          </div>
          <div class="col-xs-6 col-md-3">
            <table class="table table-bordered ">
              <tr>
                <td class="warning"></td>
                <td>Rezago grave</td>
              </tr>
            </table>
          </div>
          <div class="col-md-3">
          </div>
        </div>
        <br />
        <br />';
?>
    <div id='chart1_img_div'></div>
    <div id='chart5_img_div'></div>
    <div id='chart9_img_div'></div>
    <div id='chart4_img_div'></div>
    <div id='chart2_img_div'></div>
    <div id='chart10_img_div'></div>
    <div id='chart11_img_div'></div>
    <div id='chart14_img_div'></div>
    <div id='chart15_img_div'></div>
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="12"> Número de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar de primaria de la modalidad <?php echo($modPrim[$mode]); ?></th>
          </tr>
          <tr>
            <th colspan="12"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
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
        <tbody>
<?php

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
      $data2[$mode] = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
      for($i=1; $i<count($totalCicloList); $i++){
        $noInsc = $totalCicloF[1][$mode] - $totalCicloF[$i][$mode];
        $data2[$mode] .= "['".$nameCicloList[$i]."',".$totalIdealMod.",".$cicloList[$i][$mode][$i-1].",".$rezagoGraList[$i][$mode].",".$noInsc."],";
      }
      $data2[$mode] .= ']';

      echo '
      <tr>
        <td>' . $nameCicloList[$cicloAct]. '</td>
        <td class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['total'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['new_students'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['students_leaving'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['total_ideal'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['new_students_ideal'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['students_ideal_leaving'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['slight_lag'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['serious_lag'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['unregistered'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['unregistered_three'], 0, '', ',') . '</td>';
      echo '
      </tr>';

    }
?>
        </tbody>
      </table>
      </div>
      <br />
      <br />

      <div class="table-responsive col-xs-12 col-md-12">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th colspan="8"> Trayectoria ideal en primaria para la modalidad <?php echo($modPrim[$mode]); ?></th>
            </tr>
            <tr>
              <th colspan="8"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
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
          <tbody>

    <?php

          if($numCiclo > 6){
            $numCicloX = 6;
          }else{
            $numCicloX = $numCiclo;
          }

          for($cicloAct=1; $cicloAct<=$numCicloX; $cicloAct++){
            $totalIdealMod = $modeDataList[$mode][$cicloAct]['total_ideal'];
            $totalIdealMod1 = $modeDataList[$mode][$cicloAct+1]['total_ideal'];
            $eficIntragrado = round(($modeStatusList[$mode][$cicloAct]['statusA']/$totalIdealMod*100), 1).'%';
            $eficIntergrado = round(($totalIdealMod1/$modeStatusList[$mode][$cicloAct]['statusA']*100), 1).'%';
            $eficCohorte = round(($modeStatusList[$mode][$cicloAct]['statusA']/$modeDataList[$mode][1]['total_ideal']*100), 1).'%';

            if($eficIntergrado == 0){
              $eficIntergrado = '-';
            }

            echo '
            <tr>
              <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
              <td class="theadR">' . $nameCicloList[$cicloAct]. '</td>
              <td class="theadR">' . number_format($totalIdealMod, 0, '', ',') . '</td>
              <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusA'], 0, '', ',') . '</td>
              <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusR'], 0, '', ',') . '</td>
              <td class="theadR">' . $eficIntragrado . '</td>
              <td class="theadR">' . $eficIntergrado . '</td>
              <td class="theadR">' . $eficCohorte . '</td>
            </tr>';
          }
    ?>
          </tbody>
        </table>
      </div>
      <br />
      <br />
    </div>
    <?php
    }
    echo "</div>";

    if($numCiclo > 6){
?>
      <div class="col-xs-12 col-md-12 text-center">
        <h3>Secundaria</h3>
      </div>
      <ul class="nav nav-pills nav-justified">
        <li class="active"><a href="#table2" data-toggle="pill">Estatal</a></li>
        <li><a href="#table10" data-toggle="pill">Tecnica</a></li>
        <li><a href="#table11" data-toggle="pill">Telesecundaria</a></li>
        <li><a href="#table14" data-toggle="pill">General</a></li>
        <li><a href="#table15" data-toggle="pill">Particular</a></li>
      </ul>
      <div class="tab-content"><br />
<?php
      foreach($modSecu as $mode => $modeName){
        if($mode == 2){
          echo('<div id="table'.$mode.'" class="tab-pane fade active in">');
        }else{
          echo('<div id="table'.$mode.'" class="tab-pane fade">');
        }
?>
        <div class="table-responsive col-xs-12 col-md-12">
        <table class="table table-bordered table-striped table-hover table-condensed">
          <thead>
            <tr>
              <th colspan="6"> Flujo de los alumnos en secundaria de la modalidad <?php echo($modSecu[$mode]); ?></th>
            </tr>
            <tr>
              <th colspan="6"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName(); ?> </th>
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
          <tbody>

          <?php
          for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
            for($x=7; $x<10; $x++){
              if(!isset($cicloList[$cicloAct][$mode][$x])){
                $cicloList[$cicloAct][$mode][$x] = 0;
              }
            }

            $totalCicloF[$cicloAct][$mode] = array_sum($cicloList[$cicloAct][$mode]);
            echo '
            <tr>
              <td>' . $nameCicloList[$cicloAct] . '</td>
              <td>' . $totalCicloF[$cicloAct][$mode] . '</td>
              <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg;</td>';
            for ($nCiclo = 7; $nCiclo <= 9; $nCiclo++) {
              if($cicloAct == $nCiclo){
                echo '<td class="success">' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }elseif($cicloAct > $nCiclo + 1){
                echo '<td class="warning">' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }else{
                echo '<td>' . number_format($cicloList[$cicloAct][$mode][$nCiclo], 0, '', ',') . '</td>';
              }
            }
            /*if($cicloAct == 7){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][7] . '</td>';
            }elseif($cicloAct > 8){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][7] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][7] . '</td>';
            }
            if($cicloAct == 8){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][8] . '</td>';
            }elseif($cicloAct > 9){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][8] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][8] . '</td>';
            }
            if($cicloAct == 9){
              echo'<td class="success">' . $cicloList[$cicloAct][$mode][9] . '</td>';
            }elseif($cicloAct > 10){
              echo'<td class="warning">' . $cicloList[$cicloAct][$mode][9] . '</td>';
            }else{
              echo'<td>' . $cicloList[$cicloAct][$mode][9] . '</td>';
            }*/
            echo '
            </tr>';
          }

          $data[$mode] = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
          for($i=7; $i<=$numCiclo; $i++){
            $data[$mode] .= "['".$nameCicloList[$i]."',".$totalCicloF[$i][$mode].",".$cicloList[$i][$mode][$i]."],";
          }
          $data[$mode] .= ']';

          echo '</tbody>
            </table>
            </div>
            <div class="col-xs-12 text-center">
              <div class="col-xs-12 col-md-3 text-left graphSchool">
                <table class="table">
                  <button class="btn btn-primary" onclick="drawChart('.$data[$mode].','.$mode.')" data-toggle="modal" data-target="#modal_column_chart" data-backdrop="static" data-keyboard="false">
                    Ver grafica
                  </button>
                </table>
              </div>
              <div class="col-xs-6 col-md-3">
                <table class="table table-bordered ">
                  <tr>
                    <td class="success"></td>
                    <td>Trayectoria ideal</td>
                  </tr>
                </table>
              </div>
              <div class="col-xs-6 col-md-3">
                <table class="table table-bordered ">
                  <tr>
                    <td class="warning"></td>
                    <td>Rezago grave</td>
                  </tr>
                </table>
              </div>
              <div class="col-md-3">
              </div>
            </div>
            <br />
            <br />';
?>

    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="12"> Número de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar de secundaria de la modalidad <?php echo($modSecu[$mode]); ?></th>
          </tr>
          <tr>
            <th colspan="12"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
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
        <tbody>

<?php

    for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
      echo '
      <tr>
        <td>' . $nameCicloList[$cicloAct]. '</td>
        <td class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['total'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['new_students'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['students_leaving'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['total_ideal'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['new_students_ideal'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['students_ideal_leaving'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['slight_lag'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['serious_lag'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['unregistered'], 0, '', ',') . '</td>
        <td class="theadR">' . number_format($modeDataList[$mode][$cicloAct]['unregistered_three'], 0, '', ',') . '</td>';
      echo '
      </tr>';
    }
?>
        </tbody>
      </table>
    </div>
    <br />
    <br />
<?php
    if($numCiclo > 6){
?>
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="10"> Trayectoria ideal en secundaria para la modalidad <?php echo($modSecu[$mode]); ?></th>
          </tr>
          <tr>
            <th colspan="10"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
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
        <tbody>

    <?php

      for($cicloAct=7; $cicloAct<=$numCiclo; $cicloAct++){
        $totalIdealMod = $modeDataList[$mode][$cicloAct]['total_ideal'];
        $totalIdealMod1 = $modeDataList[$mode][$cicloAct+1]['total_ideal'];
        $eficIntragrado = round(($modeStatusList[$mode][$cicloAct]['statusA']/$totalIdealMod*100), 1).'%';
        $eficIntergrado = round(($totalIdealMod1/$modeStatusList[$mode][$cicloAct]['statusA']*100), 1).'%';
        $eficCohorte = round(($modeStatusList[$mode][$cicloAct]['statusA']/$modeDataList[$mode][7]['total_ideal']*100), 1).'%';
        if($eficIntergrado == 0){
          $eficIntergrado = '-';
        }

        echo '
        <tr>
          <td>' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
          <td class="theadR">' . $nameCicloList[$cicloAct]. '</td>
          <td class="theadR">' . number_format($totalIdealMod, 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusA'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusR'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusX'], 0, '', ',') . '</td>
          <td class="theadR">' . number_format($modeStatusList[$mode][$cicloAct]['statusZ'], 0, '', ',') . '</td>
          <td class="theadR">' . $eficIntragrado . '</td>
          <td class="theadR">' . $eficIntergrado . '</td>
          <td class="theadR">' . $eficCohorte . '</td>
        </tr>';
      }
    ?>

          </tbody>
      </table>
    </div>
    <br />
    <br />


<?php
    }
    echo'</div>';
  }
  echo "</div>";
    }

?>

    <div class="modal fade" id="modal_column_chart" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title" id="myModalLabel"><div id="ejemplo">Flujo de los alumnos en primaria de la modalidad Especial</div></h4>
                </div>
                <div class="modal-body">
                    <div id="column_chart_div"></div>
                </div>
                <div class="modal-footer">
                    <h4 class="modal-title" id="myModalLabel">Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?></h4>
                    <!--button type="button" class="btn btn-default" data-dismiss="modal">
                        Close
                    </button-->
                </div>
            </div>
        </div>
    </div>

    <br />
    <br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
          </tr>
          <tr>
            <th colspan="8"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
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
        <tbody>
<?php
    for($cicloAct=1; $cicloAct<=$numCiclo; $cicloAct++){
      $totalCiclo[$cicloAct] = array_sum($aprovTotaList[$cicloAct]);
      if($cicloAct < 7){
        foreach($modPrim as $mode => $modeName){
          $totalMod = $modeDataList[$mode][$cicloAct]['total'] + $modeDataList[$mode][$cicloAct]['new_students'];
          $idealMod = $modeDataList[$mode][$cicloAct]['total_ideal'] + $modeDataList[$mode][$cicloAct]['new_students_ideal'];
          $inscritPorcent = round(($totalMod/$totalCiclo[1]*100), 2);
          $gradoIdealPorcent = round(($idealMod/$totalCiclo[1]*100), 2);
          $rezagoLigPorcent = round(($cicloList[$cicloAct][$mode][$cicloAct-1]/$totalCiclo[1]*100), 2);
          $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][$mode]/$totalCiclo[1]*100), 2);
          $noInscPorcent = round(($modeDataList[$mode][$cicloAct]['unregistered']/$totalCiclo[1]*100), 2);

          if($mode == 1){
            echo '
            <tr>
              <td rowspan="' . $totalPrim . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
              <td>' . $modPrim[$mode] . '</td>
              <td rowspan="' . $totalPrim . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            echo '
            </tr>';
          }else{
            echo '
            <tr>
              <td>' . $modPrim[$mode] . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            echo '
            </tr>';
          }
        }
      }else{
        foreach($modSecu as $mode => $modeName){
          $totalMod = $modeDataList[$mode][$cicloAct]['total'] + $modeDataList[$mode][$cicloAct]['new_students'];
          $idealMod = $modeDataList[$mode][$cicloAct]['total_ideal'] + $modeDataList[$mode][$cicloAct]['new_students_ideal'];
          $inscritPorcent = round(($totalMod/$totalCiclo[1]*100), 2);
          $gradoIdealPorcent = round(($idealMod/$totalCiclo[1]*100), 2);
          $rezagoLigPorcent = round(($cicloList[$cicloAct][$mode][$cicloAct-1]/$totalCiclo[1]*100), 2);
          $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][$mode]/$totalCiclo[1]*100), 2);
          $noInscPorcent = round(($modeDataList[$mode][$cicloAct]['unregistered']/$totalCiclo[1]*100), 2);

          if($mode == 2){
            echo '
            <tr>
              <td rowspan="' . $totalSecu . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
              <td>' . $modSecu[$mode] . '</td>
              <td rowspan="' . $totalSecu . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            echo '
            </tr>';
          }else{
            echo '
            <tr>
              <td>' . $modSecu[$mode] . '</td>
              <td>' . $inscritPorcent . '</td>
              <td>' . $gradoIdealPorcent . '</td>
              <td>' . $rezagoLigPorcent . '</td>
              <td>' . $rezagoGraPorcent . '</td>
              <td>' . $noInscPorcent . '</td>';
            echo '
            </tr>';
          }
        }
      }
    }
    echo '</tbody>
    </table>
    </div>';

  if($numCiclo >= 6){
    ?>

    <br />
    <br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="13">Estatus de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
          </tr>
          <tr>
            <th colspan="13"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
          </tr>
          <tr>
            <th colspan="7">Al iniciar el ciclo</th>
            <th colspan="2">Rezago</th>
            <th colspan="2">Sin registro</th>
            <th colspan="2">Al finalizar el ciclo</th>
          </tr>
          <tr>
            <th>Cohorte Escolar</th>
            <th>Modalidad</th>
            <th>Total de alumnos</th>
            <th>Ciclo escolar</th>
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
        <tbody>

<?php

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
          echo '
          <tr>
            <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[0]->getCohorteObject()->getName() . '</td>
            <td>' . $modPrim[$mode] . '</td>
            <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
            <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[6] . '</td>
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
          echo '
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
?>

        </tbody>
      </table>
    </div>
    <br />
    <br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="13">Porcentaje de los alumnos al cursar seis a&ntilde;os en educaci&oacute;n primaria</th>
          </tr>
          <tr>
            <th colspan="13"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
          </tr>
          <tr>
            <th colspan="7">Al iniciar el ciclo</th>
            <th colspan="2">Rezago</th>
            <th colspan="2">Sin registro</th>
            <th colspan="2">Al finalizar el ciclo</th>
          </tr>
          <tr>
            <th>Cohorte Escolar</th>
            <th>Modalidad</th>
            <th>Total de alumnos</th>
            <th>Ciclo escolar</th>
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
        <tbody>

<?php

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
            echo '
            <tr>
              <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[0]->getCohorteObject()->getName() . '</td>
              <td>' . $modPrim[$mode] . '</td>
              <td>' . number_format($modeDataList[$mode][1]['total'], 0, '', ',') . '</td>
              <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[6] . '</td>
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
            echo '
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
?>

      </tbody>
    </table>
  </div>
<?php
  }

  if($numCiclo >= 9){
?>
    <br />
    <br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="13">Estatus de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
          </tr>
          <tr>
            <th colspan="13"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
          </tr>
          <tr>
            <th colspan="7">Al iniciar el ciclo</th>
            <th colspan="2">Rezago</th>
            <th colspan="2">Sin registro</th>
            <th colspan="2">Al finalizar el ciclo</th>
          </tr>
          <tr>
            <th>Cohorte Escolar</th>
            <th>Modalidad</th>
            <th>Total de alumnos</th>
            <th>Ciclo escolar</th>
            <th>Inscritos en el sistema</th>
            <th>Inscritos (3&deg;)</th>
            <th>Inscritos otra modalidad</th>
            <th>Ligero</th>
            <th>Grave</th>
            <th>Ciclo escolar</th>
            <th>Ciclo escolar anterior</th>
            <th>Egresados</th>
            <!--th>Absorcion (1&deg; secundaria)</th-->
          </tr>
        </thead>
        <tbody>
      <?php
    $rowspan = count($modSecu);
    $modeContenT = $modSecu;
    foreach($modSecu as $mode => $modeName){
      if($mode == 2){
				echo'
				<tr>
					<td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[0]->getCohorteObject()->getName() . '</td>
					<td>' . $modSecu[$mode] . '</td>
					<td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
					<td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[9] . '</td>
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
        echo'
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
?>
        </tbody>
      </table>
    </div>

    <br />
    <br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="13">Porcentaje de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
          </tr>
          <tr>
            <th colspan="13"> Cohorte <?php echo $schoolPeriod[0]->getCohorteObject()->getName() ?> </th>
          </tr>
          <tr>
            <th colspan="7">Al iniciar el ciclo</th>
            <th colspan="2">Rezago</th>
            <th colspan="2">Sin registro</th>
            <th colspan="2">Al finalizar el ciclo</th>
          </tr>
          <tr>
            <th>Cohorte Escolar</th>
            <th>Modalidad</th>
            <th>Total de alumnos</th>
            <th>Ciclo escolar</th>
            <th>Inscritos en el sistema</th>
            <th>Inscritos (3&deg;)</th>
            <th>Inscritos otra modalidad</th>
            <th>Ligero</th>
            <th>Grave</th>
            <th>Ciclo escolar</th>
            <th>Ciclo escolar anterior</th>
            <th>Egresados</th>
            <!--th>Absorcion (1&deg; secundaria)</th-->
          </tr>
        </thead>
        <tbody>

<?php

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
          echo'
          <tr>
            <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[0]->getCohorteObject()->getName() . '</td>
            <td>' . $modSecu[$mode] . '</td>
            <td>' . number_format($modeDataList[$mode][7]['total'], 0, '', ',') . '</td>
            <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[9] . '</td>
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
            echo'
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
?>
        </tbody>
      </table>
    </div>

<?php
    }
    if($numCiclo < 7){
      if($numCiclo > 3){
        $nCiclo = 3;
      }
      foreach($modSecu as $keySecu => $valueSecu){
        $data[$keySecu] = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
        for($i=1; $i<=$nCiclo; $i++){
            $data[$keySecu] .= "['".$nameCicloList[$i]."',0,0],";
        }
        $data[$keySecu] .= ']';
      }
    }
?>
        <a class="go-top" href="#">Subir</a>
        <script src="../imports/js/buttonTop.js"></script>
        <script language="javascript" type="text/javascript">

        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
            //drawChart();
        });

        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        var numCiclo=<?php echo $numCiclo; ?>;
        var datos1=<?php echo $data[1]; ?>;
        var datos5=<?php echo $data[5]; ?>;
        var datos9=<?php echo $data[9]; ?>;
        var datos4=<?php echo $data[4]; ?>;
        if(numCiclo > 6){
          var datos2=<?php echo $data[2]; ?>;
          var datos10=<?php echo $data[10]; ?>;
          var datos11=<?php echo $data[11]; ?>;
          var datos14=<?php echo $data[14]; ?>;
          var datos15=<?php echo $data[15]; ?>;
        }

        function drawChart(datos, idMode) {
            switch(idMode) {
                case 1:
                    modeTitle = 'Flujo de los alumnos en primaria de la modalidad Especial';
                    break;
                case 5:
                    modeTitle = 'Flujo de los alumnos en primaria de la modalidad Indigena';
                    break;
                case 9:
                    modeTitle = 'Flujo de los alumnos en primaria de la modalidad Particular';
                    break;
                case 4:
                    modeTitle = 'Flujo de los alumnos en primaria de la modalidad General';
                    break;
                case 2:
                    modeTitle = 'Flujo de los alumnos en secundaria de la modalidad Estatal';
                    break;
                case 10:
                    modeTitle = 'Flujo de los alumnos en secundaria de la modalidad Tecnica';
                    break;
                case 11:
                    modeTitle = 'Flujo de los alumnos en secundaria de la modalidad Telesecundaria';
                    break;
                case 14:
                    modeTitle = 'Flujo de los alumnos en secundaria de la modalidad General';
                    break;
                case 15:
                    modeTitle = 'Flujo de los alumnos en secundaria de la modalidad Particular';
                    break;
                default:
                    modeTitle =  '';
            }

            javascript:document.getElementById('ejemplo').innerHTML = modeTitle;

            if(idMode > 0){
              var data = google.visualization.arrayToDataTable(datos);
            }
            var data1 = google.visualization.arrayToDataTable(datos1);
            var data5 = google.visualization.arrayToDataTable(datos5);
            var data9 = google.visualization.arrayToDataTable(datos9);
            var data4 = google.visualization.arrayToDataTable(datos4);
            if(numCiclo > 6){
              var data2 = google.visualization.arrayToDataTable(datos2);
              var data10 = google.visualization.arrayToDataTable(datos10);
              var data11 = google.visualization.arrayToDataTable(datos11);
              var data14 = google.visualization.arrayToDataTable(datos14);
              var data15 = google.visualization.arrayToDataTable(datos15);
            }

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
          var chartImg1Combo = new google.visualization.ComboChart(chart1_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg1Combo, 'ready', function () {
            chart1_img_div.innerHTML = '<img src="' + chartImg1Combo.getImageURI() + '">';
            console.log(chart1_img_div.innerHTML);
          });
          chartImg1Combo.draw(data1, options);

          var chart5_img_div = document.getElementById('chart5_img_div');
          var chartImg5Combo = new google.visualization.ComboChart(chart5_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg5Combo, 'ready', function () {
            chart5_img_div.innerHTML = '<img src="' + chartImg5Combo.getImageURI() + '">';
            console.log(chart5_img_div.innerHTML);
          });
          chartImg5Combo.draw(data5, options);

          var chart9_img_div = document.getElementById('chart9_img_div');
          var chartImg9Combo = new google.visualization.ComboChart(chart9_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg9Combo, 'ready', function () {
            chart9_img_div.innerHTML = '<img src="' + chartImg9Combo.getImageURI() + '">';
            console.log(chart9_img_div.innerHTML);
          });
          chartImg9Combo.draw(data9, options);

          var chart4_img_div = document.getElementById('chart4_img_div');
          var chartImg4Combo = new google.visualization.ComboChart(chart4_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg4Combo, 'ready', function () {
            chart4_img_div.innerHTML = '<img src="' + chartImg4Combo.getImageURI() + '">';
            console.log(chart4_img_div.innerHTML);
          });
          chartImg4Combo.draw(data4, options);

          var chart2_img_div = document.getElementById('chart2_img_div');
          var chartImg2Combo = new google.visualization.ComboChart(chart2_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg2Combo, 'ready', function () {
            chart2_img_div.innerHTML = '<img src="' + chartImg2Combo.getImageURI() + '">';
            console.log(chart2_img_div.innerHTML);
          });
          chartImg2Combo.draw(data2, options);

          var chart10_img_div = document.getElementById('chart10_img_div');
          var chartImg10Combo = new google.visualization.ComboChart(chart10_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg10Combo, 'ready', function () {
            chart10_img_div.innerHTML = '<img src="' + chartImg10Combo.getImageURI() + '">';
            console.log(chart10_img_div.innerHTML);
          });
          chartImg10Combo.draw(data10, options);

          var chart11_img_div = document.getElementById('chart11_img_div');
          var chartImg11Combo = new google.visualization.ComboChart(chart11_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg11Combo, 'ready', function () {
            chart11_img_div.innerHTML = '<img src="' + chartImg11Combo.getImageURI() + '">';
            console.log(chart11_img_div.innerHTML);
          });
          chartImg11Combo.draw(data11, options);

          var chart14_img_div = document.getElementById('chart14_img_div');
          var chartImg14Combo = new google.visualization.ComboChart(chart14_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg14Combo, 'ready', function () {
            chart14_img_div.innerHTML = '<img src="' + chartImg14Combo.getImageURI() + '">';
            console.log(chart14_img_div.innerHTML);
          });
          chartImg14Combo.draw(data14, options);

          var chart15_img_div = document.getElementById('chart15_img_div');
          var chartImg15Combo = new google.visualization.ComboChart(chart15_img_div);
          // Wait for the chart to finish drawing before calling the getImageURI() method.
          google.visualization.events.addListener(chartImg15Combo, 'ready', function () {
            chart15_img_div.innerHTML = '<img src="' + chartImg15Combo.getImageURI() + '">';
            console.log(chart15_img_div.innerHTML);
          });
          chartImg15Combo.draw(data15, options);

        }

        </script>

        <script language="javascript" type="text/javascript">

        $(document).ready(function(){
          $('#chart1_img_div').hide(); //oculto mediante id
          $('#chart5_img_div').hide(); //oculto mediante id
          $('#chart9_img_div').hide(); //oculto mediante id
          $('#chart4_img_div').hide(); //oculto mediante id
          $('#chart2_img_div').hide(); //oculto mediante id
          $('#chart10_img_div').hide(); //oculto mediante id
          $('#chart11_img_div').hide(); //oculto mediante id
          $('#chart14_img_div').hide(); //oculto mediante id
          $('#chart15_img_div').hide(); //oculto mediante id
          jQuery("#downloadBtn").on("click", function() {
            var htmlContent1 = jQuery("#chart1_img_div").html();
            var htmlContent5 = jQuery("#chart5_img_div").html();
            var htmlContent9 = jQuery("#chart9_img_div").html();
            var htmlContent4 = jQuery("#chart4_img_div").html();
            var htmlContent2 = jQuery("#chart2_img_div").html();
            var htmlContent10 = jQuery("#chart10_img_div").html();
            var htmlContent11 = jQuery("#chart11_img_div").html();
            var htmlContent14 = jQuery("#chart14_img_div").html();
            var htmlContent15 = jQuery("#chart15_img_div").html();
            jQuery("#htmlContentHidden1").val(htmlContent1);
            jQuery("#htmlContentHidden5").val(htmlContent5);
            jQuery("#htmlContentHidden9").val(htmlContent9);
            jQuery("#htmlContentHidden4").val(htmlContent4);
            jQuery("#htmlContentHidden2").val(htmlContent2);
            jQuery("#htmlContentHidden10").val(htmlContent10);
            jQuery("#htmlContentHidden11").val(htmlContent11);
            jQuery("#htmlContentHidden14").val(htmlContent14);
            jQuery("#htmlContentHidden15").val(htmlContent15);
            // submit the form
            jQuery('#savePDFForm').submit();
          });
        });

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
