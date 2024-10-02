<?php
require ('../checkSession.php');

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
$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

$gender = array();
$gender[1] = 'Hombres';
$gender[2] = 'Mujeres';
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
  <title>Reporte por Sexo - Trayectorias Escolares</title>
  <!--link href="css/screen.css" rel="stylesheet" type="text/css" /-->
  <!--link rel="stylesheet" href="css/jquery-ui-1.8.4.custom.css" type="text/css"/-->
  <link rel="icon" href="../img/favicon_.png">
  <!--link href="css/jquery-confirm.css" rel="stylesheet" type="text/css"  /-->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/bootstrap/bootstrap.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/buttonTop.css" rel="stylesheet">
  <link href="../css/header.css" rel="stylesheet">
  <link href="../css/footer.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/chart.css">
  <link rel="stylesheet" href="../css/table.css">
  <link rel="stylesheet" href="../css/factorTable.css">
</head>
<body>
  <?php include('header.php');  ?>

  <div class="container">
    <form name="report" id="report" action="../<?php echo $user->getAbbreviation() ?>/gender.php" method="post" accept-charset="UTF-8"></form>
    <button type="button" id="buttonBack" class="buttonBack" onclick="document.forms.report.submit()"><span>Regresar</span></button>
    <div class='text-center'><h2 class='form-signin-heading'>Reporte por sexo de trayectorias escolares</h2></div><hr /><br />
    <div class="table-responsive col-xs-12 col-md-12">
      <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th colspan="13"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica </th>
          </tr>
          <tr>
            <th colspan="13"> Cohorte <?php echo $cohorteName ?> </th>
          </tr>
          <tr>
            <th colspan="4">Alumnos</th>
            <th colspan="6">Primaria</th>
            <th colspan="3">Secundaria</th>
          </tr>
          <tr>
            <th>Ciclo Escolar</th>
            <th>Sexo</th>
            <th>Total Inscritos</th>
            <th>Grado Ideal</th>
            <!-- Primaria -->
            <th>Inscritos 1&deg;</th>
            <th>Inscritos 2&deg;</th>
            <th>Inscritos 3&deg;</th>
            <th>Inscritos 4&deg;</th>
            <th>Inscritos 5&deg;</th>
            <th>Inscritos 6&deg;</th>
            <!-- Secundaria -->
            <th>Inscritos 1&deg;</th>
            <th>Inscritos 2&deg;</th>
            <th>Inscritos 3&deg;</th>
          </tr>
        </thead>
        <tbody>

          <?php
          $totalCicloList = array();
          $nameCicloList = array();
          $nameCicloList[0] = '';
          /* Arreglos que almacenaran el numero de alumnos inscritos por ciclo y genero */
          $genderList = array();
          $genderStatusList = array();

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
          for ($ciclo = 1; $ciclo <= $numCiclo; $ciclo++) {


            array_push($nameCicloList, $schoolPeriod[$ciclo-1] -> getSchoolPeriodObject() -> getName());
            $totalCicloF[$ciclo][1] = array_sum($genderList1[$ciclo][1]);
            $totalCicloF[$ciclo][2] = array_sum($genderList1[$ciclo][2]);

            for($x=1; $x<10; $x++){
              if(!isset($genderList1[$ciclo][1][$x])){
                $genderList1[$ciclo][1][$x] = 0;
              }
              if(!isset($genderList1[$ciclo][2][$x])){
                $genderList1[$ciclo][2][$x] = 0;
              }
              //$rezagoGraList[$ciclo][1] = $totalCicloF[$ciclo][1] - $genderList1[$ciclo][1][$ciclo] - $genderList1[$ciclo][1][$ciclo-1];
              //$rezagoGraList[$ciclo][2] = $totalCicloF[$ciclo][2] - $genderList1[$ciclo][2][$ciclo] - $genderList1[$ciclo][2][$ciclo-1];
            }

            /* Se guarda el numero de alumnos con rezago grave por ciclo y modalidad */
            switch($ciclo){
              case 1:
              $rezagoGraList[$ciclo][1] = 0;
              $rezagoGraList[$ciclo][2] = 0;
              break;
              case 2:
              $rezagoGraList[$ciclo][1] = 0;
              $rezagoGraList[$ciclo][2] = 0;
              break;
              case 3:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1];
              break;
              case 4:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2];
              break;
              case 5:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3];
              break;
              case 6:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4];
              break;
              case 7:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5];
              break;
              case 8:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5] + $genderList1[$ciclo][1][6];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5] + $genderList1[$ciclo][2][6];
              break;
              case 9:
              $rezagoGraList[$ciclo][1] = $genderList1[$ciclo][1][1] + $genderList1[$ciclo][1][2] + $genderList1[$ciclo][1][3] + $genderList1[$ciclo][1][4] + $genderList1[$ciclo][1][5] + $genderList1[$ciclo][1][6] + $genderList1[$ciclo][1][7];
              $rezagoGraList[$ciclo][2] = $genderList1[$ciclo][2][1] + $genderList1[$ciclo][2][2] + $genderList1[$ciclo][2][3] + $genderList1[$ciclo][2][4] + $genderList1[$ciclo][2][5] + $genderList1[$ciclo][2][6] + $genderList1[$ciclo][2][7];
              break;
            }

            /* $totalCicloF - Array que almacena el total de alumnos por ciclo y modalida.
            * $cicloList - Array que almacena el numero de alumnos por grado, Sexo y ciclo escolar
            * $modeContenT - Array que almacena la Sexo de acuerdo al ciclo escolar
            * $rowspan - Variable que almacena el numero de Sexoes por ciclo escolar */

            $rowspan = count($gender);
            $modeContenT = $gender;

            //$cicloList[$ciclo][1] = $genderList1[$ciclo][1];
            //$cicloList[$ciclo][2] = $genderList1[$ciclo][2];


            echo '<tr>
                <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[$ciclo] . '</td>
                <td>' . $modeContenT[1] . '</td>
                <td>' . number_format($totalCicloF[$ciclo][1], 0, '', ',') . '</td>
                <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[$ciclo-1]->getGrade() . '&deg;</td>';

              for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
                if($ciclo == $nCiclo){
                  echo'<td class="success">' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
                }elseif($ciclo > $nCiclo + 1){
                  echo'<td class="warning">' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
                }else{
                  echo '<td>' . number_format($genderList1[$ciclo][1][$nCiclo], 0, '', ',') . '</td>';
                }
              }
            echo '</tr>';
            echo '<tr>
                <td>' . $modeContenT[2] . '</td>
                <td>' . number_format($totalCicloF[$ciclo][2], 0, '', ',') . '</td>';

              for ($nCiclo = 1; $nCiclo <= 9; $nCiclo++) {
                if($ciclo == $nCiclo){
                  echo'<td class="success">' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
                }elseif($ciclo > $nCiclo + 1){
                  echo'<td class="warning">' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
                }else{
                  echo '<td>' . number_format($genderList1[$ciclo][2][$nCiclo], 0, '', ',') . '</td>';
                }
              }
            echo '</tr>';
          }
          echo '</tbody>
          </table>';

          $datos = "[['Ciclo escolar', 'Hombres inscritos', 'Mujeres inscritas', 'Hombres grado ideal', 'Mujeres grado ideal'],";
          for($i=1; $i<=$numCiclo; $i++){
            $datos .= "['".$nameCicloList[$i]."',".$totalCicloF[$i][1].",".$totalCicloF[$i][2].",".$genderList1[$i][1][$i].",".$genderList1[$i][2][$i]."],";
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Flujo de los alumnos en educaci&oacute;n b&aacute;sica</h4>
              </div>
              <div class="modal-body">
                <div id="column_chart_div"></div>
              </div>
              <div class="modal-footer">
                <h4 class="modal-title" id="myModalLabel">Cohorte <?php echo $cohorteName ?></h4>
              </div>
            </div>
          </div>
        </div>

        <div id='chart1_img_div'></div>

        <br />
        <br />
        <br />
        <div class="table-responsive col-xs-12 col-md-12">
          <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
              <tr>
                <th colspan="9"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
              </tr>
              <tr>
                <th colspan="9"> Cohorte <?php echo $cohorteName ?> </th>
              </tr>
              <tr>
                <th>Ciclo Escolar</th>
                <th>Sexo</th>
                <th>Grado Ideal</th>
                <th>Inscritos en el sistema</th>
                <th>Inscritos grado ideal</th>
                <th>Rezago ligero</th>
                <th>Rezago grave</th>
                <th>Sin registro</th>
                <th>Sin registro (Hace 3 ciclos escolares)</th>
              </tr>
            </thead>
            <tbody>
              <?php

      $controllerStatus = new AprovGenderStatusController();
      $whereStatus = 'e.cohorte = :cohorte';
      $whereFieldsStatus = array('cohorte' => $cohorte->getId());
      $showFieldsStatus = 'e.*';
      $totalStatus = array();
      $genderStatusList1 = $controllerStatus->displayBy2Action($whereStatus, $whereFieldsStatus, '', $showFieldsStatus);

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
        echo '<tr>
        <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
        <td>' . $modeContenT[1] . '</td>
        <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '</td>
        <td>' . $inscritPorcent . '</td>
        <td>' . $gradoIdealPorcent . '</td>
        <td>' . $rezagoLigPorcent . '</td>
        <td>' . $rezagoGraPorcent . '</td>
        <td>' . $noInscPorcent . '</td>
        <td>' . $noReg3PeriodPorcent . '</td>
        </tr>';

        $inscritPorcent = round(($totalCicloF[$cicloAct][2]/$totalCicloF[1][2]*100), 1);
        $gradoIdealPorcent = round(($genderList1[$cicloAct][2][$cicloAct]/$genderList1[1][2][1]*100), 1);
        $rezagoLigPorcent = round(($genderList1[$cicloAct][2][$cicloAct-1]/$totalCicloF[1][2]*100), 1);
        $rezagoGraPorcent = round(($rezagoGraList[$cicloAct][2]/$totalCicloF[1][2]*100), 1);
        $noInsc = $totalCicloF[1][2]-$totalCicloF[$cicloAct][2];
        $noInscPorcent = round(($noInsc/$totalCicloF[1][2]*100), 1);
        if($genderStatusList1[2*($cicloAct-1)+1]['gender'] == 2){
          $noReg3PeriodPorcent = round(($genderStatusList1[2*($cicloAct-1)+1]['unregistered_three']/$totalCicloF[1][2]*100), 1);
        }

        echo '<tr>
        <td>' . $modeContenT[2] . '</td>
        <td>' . $inscritPorcent . '</td>
        <td>' . $gradoIdealPorcent . '</td>
        <td>' . $rezagoLigPorcent . '</td>
        <td>' . $rezagoGraPorcent . '</td>
        <td>' . $noInscPorcent . '</td>
        <td>' . $noReg3PeriodPorcent . '</td>
        </tr>';
      }

      echo '</tbody>
      </table>';

      $datos2H = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
      for($i=1; $i<=$numCiclo; $i++){

        $noInsc = $totalCicloF[1][1] - $totalCicloF[$i][1];

        $datos2H .= "['".$nameCicloList[$i]."',".$genderList1[$i][1][$i].",".$genderList1[$i][1][$i-1].",".$rezagoGraList[$i][1].",".$noInsc."],";
      }
      $datos2H .= ']';

      $datos2M = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
      for($i=1; $i<=$numCiclo; $i++){

        $noInsc = $totalCicloF[1][2] - $totalCicloF[$i][2];

        $datos2M .= "['".$nameCicloList[$i]."',".$genderList1[$i][2][$i].",".$genderList1[$i][2][$i-1].",".$rezagoGraList[$i][2].",".$noInsc."],";
      }
      $datos2M .= ']';

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
            <h3>Hombres</h3>
            <div id="bar_chart_div"></div>
            <h3>Mujeres</h3>
            <div id="bar_chart_div2"></div>
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
  <br />
  <br />
  <br />

<div id='chart2_img_div'></div>
<div id='chart3_img_div'></div>

<div class="table-responsive col-xs-12 col-md-12">
<table class="table table-bordered table-striped table-hover table-condensed">
  <thead>
  <tr>
    <th colspan="11"> Trayectoria ideal</th>
  </tr>
  <tr>
    <th colspan="11"> Cohorte <?php echo $cohorteName ?> </th>
  </tr>
  <tr>
    <th rowspan="2">Grado Ideal</th>
    <th rowspan="2">Ciclo Escolar</th>
    <th rowspan="2">Sexo</th>
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
  <tbody>

<?php

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

echo '<tr>
  <td rowspan="' . $rowspan . '" class="theadR">' . $schoolPeriod[$cicloAct-1]->getGrade() . '&deg; ' .  $schoolPeriod[$cicloAct-1]->getSchoolLevelObject()->getName() . '</td>
  <td rowspan="' . $rowspan . '" class="theadR">' . $nameCicloList[$cicloAct]. '</td>
  <td>' . $modeContenT[1] . '</td>
  <td>' . number_format($genderList1[$cicloAct][1][$cicloAct], 0, '', ',') . '</td>
  <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusA'], 0, '', ',') . '</td>
  <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusR'], 0, '', ',') . '</td>
  <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusX'], 0, '', ',') . '</td>
  <td>' . number_format($genderStatusList1[2*($cicloAct-1)]['statusZ'], 0, '', ',') . '</td>
  <td>' . $eficIntergrado . '</td>
  <td>' . $eficIntragrado . '</td>
  <td>' . $eficCohorte . '</td>
</tr>';

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

echo '<tr>
  <td>' . $modeContenT[2] . '</td>
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
echo'</tbody>
</table>
</div>';

if($ciclo >= 6){
?>
<div class="table-responsive col-xs-12 col-md-12">
  <table class="table table-bordered table-striped table-hover table-condensed">
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
  <tbody>

<?php

//$noInsc3Period = array_diff($studentList[1][1], $studentList[6][1], $studentList[5][1], $studentList[4][1]);
//$noInsc = $genderList1[1][1][1] - $totalCicloF[6][1];
$noInsc = $totalCicloF[1][1]-$totalCicloF[6][1];
if($genderStatusList1[10]['gender'] == 1){
  $noReg3Period = $genderStatusList1[10]['unregistered_three'];
}

echo '
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


//$noInsc3Period = array_diff($studentList[1][2], $studentList[6][2], $studentList[5][2], $studentList[4][2]);
//$noInsc = $genderList1[1][2][1] - $totalCicloF[6][2];
$noInsc = $totalCicloF[1][2]-$totalCicloF[6][2];
if($genderStatusList1[11]['gender'] == 2){
  $noReg3Period = $genderStatusList1[11]['unregistered_three'];
}

echo '<tr>
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

echo'</tbody>
  </table>
</div>';
?>
<div class="table-responsive col-xs-12 col-md-12">
  <table class="table table-bordered table-striped table-hover table-condensed">
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
    <tbody>
<?php
//$noInsc3Period = array_diff($studentList[1][1], $studentList[5][1], $studentList[4][1], $studentList[3][1]);
//$noInsc = $genderList1[1][1][1] - $totalCicloF[6][1];
$noInsc = $totalCicloF[1][1]-$totalCicloF[6][1];
$noInscPorcent = round(($noInsc/$totalCicloF[1][1]*100), 1);
if($genderStatusList1[10]['gender'] == 1){
$noReg3PeriodPorcent = round(($genderStatusList1[10]['unregistered_three']/$totalCicloF[1][1]*100), 1);
}

echo '
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

echo '<tr>
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

echo'</tbody>
</table>
</div>';
}

if($ciclo >= 9){

?>
<div class="table-responsive col-xs-12 col-md-12">
<table class="table table-bordered table-striped table-hover table-condensed">
  <thead>
    <tr>
      <th colspan="12">Estatus de los alumnos al cursar educaci&oacute;n b&aacute;sica</th>
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
      <th>Inscritos (3&deg; secundaria)</th>
      <th>Ligero</th>
      <th>Grave</th>
      <th>Ciclo escolar</th>
      <th>Hace 3 ciclos escolares</th>
      <th>Egresados</th>
    </tr>
  </thead>
  <tbody>

    <?php

    //$noInsc3Period = array_diff($studentList[1][1], $studentList[8][1], $studentList[7][1], $studentList[6][1]);
    //$noInsc = array_diff($studentList[1][1], $studentList[9][1]);
    $noInsc = $totalCicloF[1][1]-$totalCicloF[9][1];
    if($genderStatusList1[16]['gender'] == 1){
      $noReg3Period = $genderStatusList1[16]['unregistered_three'];
    }

    echo '
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


    //$noInsc3Period = array_diff($studentList[1][2], $studentList[8][2], $studentList[7][2], $studentList[6][2]);
    //$noInsc = array_diff($studentList[1][2], $studentList[9][2]);
    $noInsc = $totalCicloF[1][2]-$totalCicloF[9][2];
    if($genderStatusList1[17]['gender'] == 2){
      $noReg3Period = $genderStatusList1[17]['unregistered_three'];
    }

    echo '
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

    echo'</tbody>
    </table>
    </div>';

    ?>
<div class="table-responsive col-xs-12 col-md-12">
  <table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th colspan="12">Porcentaje de los alumnos al cursar educaci&oacute;n b&aacute;sica</th>
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
        <th>Inscritos (3&deg; secundaria)</th>
        <th>Ligero</th>
        <th>Grave</th>
        <th>Ciclo escolar</th>
        <th>Hace 3 ciclos escolares</th>
        <th>Egresados</th>
      </tr>
    </thead>
    <tbody>

      <?php

      //$noInsc3Period = array_diff($studentList[1][1], $studentList[8][1], $studentList[7][1], $studentList[6][1]);
      //$noInsc = array_diff($studentList[1][1], $studentList[9][1]);
      $noInsc = $totalCicloF[1][1]-$totalCicloF[9][1];
      $noInscPorcent = round(($noInsc/$totalCicloF[1][1]*100), 1);
      if($genderStatusList1[16]['gender'] == 1){
        $noReg3PeriodPorcent = round(($genderStatusList1[16]['unregistered_three']/$totalCicloF[1][1]*100), 1);
      }

      echo '
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


      //$noInsc3Period = array_diff($studentList[1][2], $studentList[8][2], $studentList[7][2], $studentList[6][2]);
      //$noInsc = array_diff($studentList[1][2], $studentList[9][2]);
      $noInsc = $totalCicloF[1][2]-$totalCicloF[9][2];
      $noInscPorcent = round(($noInsc/$totalCicloF[1][2]*100), 1);
      if($genderStatusList1[17]['gender'] == 2){
        $noReg3PeriodPorcent = round(($genderStatusList1[17]['unregistered_three']/$totalCicloF[1][2]*100), 1);
      }

      echo '<tr>
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

      echo'</tbody>
      </table>
      </div>';

    }

    ?>
  </div>
  <a class="go-top" href="#">Subir</a>
  <script src="../imports/js/buttonTop.js"></script>
  <script>

  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
  });

  var datos=<?php echo $datos; ?>;
  var datos2H=<?php echo $datos2H; ?>;
  var datos2M=<?php echo $datos2M; ?>;

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
        ticks: [5000,10000,15000,20000,25000]
      },
      series: {
        0: {
          type: 'bars',
          color: '#CDE8FF',
          dataOpacity: 0.7
        },
        1: {
          type: 'bars',
          color: '#ECB8B7',
          dataOpacity: 0.7
        },
        2: {
          type: 'linear',
          color: '#5ca6d2'
        },
        3: {
          type: 'linear',
          color: '#f05249'
        }
      },
      animation: { startup: true, duration: 2500, easing: 'linear'},
      chartArea:{left:150,top:50}
    };

    var chart = new google.visualization.ComboChart(document.getElementById("column_chart_div"));
    chart.draw(data, options);

    var chart1_img_div = document.getElementById('chart1_img_div');
    var chartImgCombo = new google.visualization.ComboChart(chart1_img_div);

    // Wait for the chart to finish drawing before calling the getImageURI() method.
    google.visualization.events.addListener(chartImgCombo, 'ready', function () {
      chart1_img_div.innerHTML = '<img src="' + chartImgCombo.getImageURI() + '">';
      console.log(chart1_img_div.innerHTML);
    });

    chartImgCombo.draw(data, options);

  }

  function drawStacked() {
    var dataH = google.visualization.arrayToDataTable(datos2H);
    var dataM = google.visualization.arrayToDataTable(datos2M);

    var options = {
      width:1000,
      height:400,
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
    chart.draw(dataH, options);
    var chart2 = new google.visualization.BarChart(document.getElementById('bar_chart_div2'));
    chart2.draw(dataM, options);

    var chart2_img_div = document.getElementById('chart2_img_div');
    var chartImgBar1 = new google.visualization.BarChart(chart2_img_div);
    var chart3_img_div = document.getElementById('chart3_img_div');
    var chartImgBar2 = new google.visualization.BarChart(chart3_img_div);

    // Wait for the chart to finish drawing before calling the getImageURI() method.
    google.visualization.events.addListener(chartImgBar1, 'ready', function () {
      chart2_img_div.innerHTML = '<img src="' + chartImgBar1.getImageURI() + '">';
      console.log(chart2_img_div.innerHTML);
    });

    chartImgBar1.draw(dataH, options);

    google.visualization.events.addListener(chartImgBar2, 'ready', function () {
      chart3_img_div.innerHTML = '<img src="' + chartImgBar2.getImageURI() + '">';
      console.log(chart3_img_div.innerHTML);
    });

    chartImgBar2.draw(dataM, options);

  }
  </script>
  <script>
  jQuery(document).ready(function() {
    $('#chart1_img_div').hide(); //oculto mediante id
    $('#chart2_img_div').hide(); //oculto mediante id
    $('#chart3_img_div').hide(); //oculto mediante id
    jQuery("#downloadBtn").on("click", function() {
      var htmlContent1 = jQuery("#chart1_img_div").html();
      var htmlContent2 = jQuery("#chart2_img_div").html();
      var htmlContent3 = jQuery("#chart3_img_div").html();
      jQuery("#htmlContentHidden1").val(htmlContent1);
      jQuery("#htmlContentHidden2").val(htmlContent2);
      jQuery("#htmlContentHidden3").val(htmlContent3);
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
  <?php include('../footer.php'); ?>
</body>
</html>
