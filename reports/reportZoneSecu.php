<?php
require ('../checkSession.php');
/*error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);*/
$userController = new UsersController();


if (!isset($_POST['cohorte']) && !isset($_POST['schoolZone'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
}else{
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new CohorteController();
	$cohorte = $controller->getEntityAction($cohorte);
}

if(!$cohorte){
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
}

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND cohorte.cct LIKE :cct AND e.cct LIKE :cct2";

// $schoolRegionZoneController = new SchoolRegionZoneController();
// $schoolRegionZone = $schoolRegionZoneController->getEntityAction($schoolZone);

$cohorteName = $schoolPeriod[0]->getCohorteObject()->getName();

$schoolLevelController = new SchoolLevelController();
$schoolLevelObject = $schoolLevelController->getEntityAction($schoolLevel);

$schoolModeController = new SchoolModeController();
$schoolModeObject = $schoolModeController->getEntityAction($schoolMode);

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
	<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
	<div class='text-center'><h2 class='form-signin-heading'>Reporte por zona de trayectorias escolares</h2></div><br />
	<div class="col-xs-12 col-md-12">
		<div><h4 class='form-signin-heading col-md-3 text-left'>Nivel: <?php echo($schoolLevelObject->getName()); ?></h4></div>
		<div><h4 class='form-signin-heading col-md-3'>Regi&oacute;n: <?php echo("Pendiente"); ?> </h4></div>
		<div><h4 class='form-signin-heading col-md-3'>Modalidad: <?php echo($schoolModeObject->getName()); ?> </h4></div>
		<div><h4 class='form-signin-heading col-md-3'>Zona Escolar: <?php echo(str_pad($schoolZone,  3, "0", STR_PAD_LEFT)); ?> </h4></div>
	</div>
	<div class="col-xs-12 col-md-12"><hr /></div>
	<div class="table-responsive col-xs-12 col-md-12">
	<table class="table table-bordered table-striped table-hover table-condensed">
		<thead>
			<tr>
				<th colspan="6"> Flujo de los alumnos en educaci&oacute;n b&aacute;sica </th>
			</tr>
			<tr>
				<th colspan="6"> Cohorte <?php echo $cohorteName ?> </th>
			</tr>
			<tr>
				<th colspan="3">Alumnos</th>
				<th colspan="3"> Secundaria</th>
			</tr>
			<tr>
				<th>Ciclo Escolar</th>
				<th>Inscritos</th>
				<th>Grado Ideal</th>
				<th>1&deg;</th>
				<th>2&deg;</th>
				<th>3&deg;</th>
			</tr>
		</thead>
		<tbody>

<?php

$supervisorSchoolRegionController = new SupervisorSchoolRegionController();
$supervisorSchoolRegion = $supervisorSchoolRegionController->getEntityByAction('user', $user->getId());

$schoolController = new  SchoolController();
$whereS = 'e.level = :schoolLevel AND e.mode = :schoolMode AND e.zone = :schoolZone';
$whereFieldsS = $array = array('schoolLevel' => $schoolLevel, 'schoolMode' => $schoolMode, 'schoolZone' => $schoolZone);
$schoolList = $schoolController->displayByAction($whereS, $whereFieldsS);
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND ((";
$where1 = "(";
$where2 = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate AND (";
$whereFields = array('grade' => 7, 'reprobate' => 0);
$numSchool = 1;
$totalSchool = count($schoolList);
foreach($schoolList as $school){
	if($numSchool == $totalSchool){
		//$where .= ' cohorte.cct LIKE :cct'.$numSchool.' OR e.cct LIKE :cct'.$numSchool.' ';
		$where .= ' cohorte.cct LIKE :cct'.$numSchool.') AND ';
		$where1 .= ' e.cct LIKE :cct'.$numSchool.")";
	}else{
		$where .= ' cohorte.cct LIKE :cct'.$numSchool.' OR  ';
		$where1 .= ' e.cct LIKE :cct'.$numSchool.' OR  ';
	}
	$whereFields['cct'.$numSchool] = $school->getId();
	$numSchool = $numSchool + 1;
}

$where1 .= ')';
$where = $where.$where1;

//foreach($schoolPeriod as $period){
$totalIdealList = array();
$totalCicloList = array();
$rezagoLigList = array();
$rezagoGraList = array();
$aprobList = array();
$reprobList = array();
$reprobXList = array();
$reprobZList = array();
$cicloList1 = array();
$cicloList2 = array();
$cicloList3 = array();
$nameCicloList = array();
$studentCicloList = array();

array_push ($totalCicloList, 0);
array_push ($rezagoLigList, 0);
array_push ($rezagoGraList, 0);
array_push ($aprobList, 0);
array_push ($reprobList, 0);
array_push ($reprobXList, 0);
array_push ($reprobZList, 0);
array_push ($cicloList1, 0);
array_push ($cicloList2, 0);
array_push ($cicloList3, 0);

//for($ciclo=0; $ciclo<$numCiclo; ++$ciclo){
$ciclo = 0 ;
if($numCiclo > 3){
	$numCiclo = 3;
}
while($ciclo < $numCiclo){

	/* Variables grade almacenan el numero de alumnos inscritos  por grado */
	$grade1 = 0;
	$grade2 = 0;
	$grade3 = 0;
	$nController = ucwords($schoolPeriod[$ciclo]->getSchoolPeriodObject()->getTablePeriod()).'Controller';
	$studentList = array();
	$controller = new $nController();
	$joinC= 'INNER JOIN ' . $cohorte->getTableCohorte() . ' AS cohorte ON e.idStudent = cohorte.idStudent';
	$showFields = 'e.id, e.idStudent, e.grade, e.status';
	$students = $controller->displayBy2Action($where, $whereFields, $joinC, $showFields);

	$totalCiclo = count($students);

	array_push ($totalCicloList, $totalCiclo);
	array_push ($nameCicloList, $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName());

	// se recorre el arreglo $totalCiclo para asignar a cada estudiante en su grado correspondiente
	for($numStudent=0; $numStudent<$totalCiclo; ++$numStudent){


		array_push ($studentList, $students[$numStudent]['idStudent']);


		$stdGrade =  $students[$numStudent]['grade'];

		/*if($stdGrade == 1){
			++$grade1;
		}elseif($stdGrade == 2){
			++$grade2;
		}
		elseif($stdGrade == 3){
			++$grade3;
		}
		elseif($stdGrade == 4){
			++$grade4;
		}
		elseif($stdGrade == 5){
			++$grade5;
		}
		elseif($stdGrade == 6){
			++$grade6;
		}
		elseif($stdGrade == 7){
			++$grade7;
		}
		elseif($stdGrade == 8){
			++$grade8;
		}
		elseif($stdGrade == 9){
			++$grade9;
		}*/

		switch($stdGrade){
			case 7:
				++$grade1;
				break;
			case 8:
				++$grade2;
				break;
			case 9:
				++$grade3;
				break;
		}

		switch($ciclo+1){
			case 1:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 7){
					++$aprobList[1];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 7){
					++$reprobXList[1];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 7){
					++$reprobZList[1];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 7){
					++$reprobList[1];
				}
				break;
			case 2:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 8){
					++$aprobList[2];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 8){
					++$reprobXList[2];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 8){
					++$reprobZList[2];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 8){
					++$reprobList[2];
				}
				break;
			case 3:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 9){
					++$aprobList[3];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 9){
					++$reprobXList[3];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 9){
					++$reprobZList[3];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 9){
					++$reprobList[3];
				}
				break;
		}

	}

	$totalIdealList[0] = 0;

	array_push ($studentCicloList, $studentList);
	unset($studentList);

	array_push ($cicloList1, $grade1);
	array_push ($cicloList2, $grade2);
	array_push ($cicloList3, $grade3);

	//Se guarda el numero de inscritos en el grado ideal en un array
	switch($ciclo+1){
			case 1:
				$totalIdealList[1] = $grade1;
				break;
			case 2:
				$totalIdealList[2] = $grade2;
				break;
			case 3:
				$totalIdealList[3] = $grade3;
				break;
		}

		//Se guarda el numero de inscritos en el grado anterior al grado ideal (rezago ligero) en un array
		switch($ciclo+1){
			case 1:
				$rezagoLigList[1] = 0;
				break;
			case 2:
				$rezagoLigList[2] = $grade1;
				break;
			case 3:
				$rezagoLigList[3] = $grade2;
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
				$rezagoGraList[3] = $grade1;
				break;
		}


	echo '
			<tr>
				<td>' . $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName() . '</td>
				<td>' . $totalCiclo . '</td>
				<td>' . $schoolPeriod[$ciclo]->getGrade() . '&deg;</td>';
		  if($ciclo == 0){
		  	echo'<td class="success">' . $grade1 . '</td>';
		  }elseif($ciclo > 1){
		  	echo'<td class="warning">' . $grade1 . '</td>';
		  }else{
		  	echo'<td>' . $grade1 . '</td>';
		  }
		  if($ciclo == 1){
		  	echo'<td class="success">' . $grade2 . '</td>';
		  }elseif($ciclo > 2){
		  	echo'<td class="warning">' . $grade2 . '</td>';
		  }else{
		  	echo'<td>' . $grade2 . '</td>';
		  }
		  if($ciclo == 2){
		  	echo'<td class="success">' . $grade3 . '</td>';
		  }elseif($ciclo > 3){
		  	echo'<td class="warning">' . $grade3 . '</td>';
		  }else{
		  	echo'<td>' . $grade3 . '</td>';
		  }
	echo	'</tr>
		';

		++$ciclo;

}
	echo'</tbody>
	</table>';

	$datos = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
	 for($i=1; $i<count($totalCicloList); $i++){
	 	$datos .= "['".$nameCicloList[$i-1]."',".$totalCicloList[$i].",".$totalIdealList[$i]."],";
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

		for($i=1; $i<$totIdeal; ++$i){

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

	//$idealInsc =  $idealList;
	//unset($idealInsc[0]);
 	//$namePeriod =  $nameCicloList;

	 $datos2 = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
	 for($i=1; $i<count($totalCicloList); $i++){

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

		for($i=1; $i<$totIdeal; ++$i){

			$eficIntergrado = round(($aprobList[$i]/$totalIdealList[$i]*100), 1);
			$eficIntragrado = round(($totalIdealList[$i+1]/$aprobList[$i]*100), 1);
			$eficCohorte = round(($aprobList[$i]/$totalCicloList[1]*100), 1);

				echo '
					<tr>
						<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' . '</td>
						<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
						<td>' . $totalIdealList[$i] . '</td>
						<td>' . $aprobList[$i] . '</td>
						<td>' . $reprobList[$i] . '</td>
						<td>' . $reprobXList[$i] . '</td>
						<td>' . $reprobZList[$i] . '</td>
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
    				<th colspan="10">Estatus de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
    			</tr>
    			<tr>
    				<th colspan="10"> Cohorte <?php echo $cohorteName ?></th>
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
    				<th>Inscritos (3&deg;)</th>
    				<th>Ligero</th>
    				<th>Grave</th>
    				<th>Ciclo escolar</th>
    				<th>Hace 2 ciclos escolares</th>
    				<th>Egresados</th>
    			</tr>
    		</thead>
    		<tbody>

<?php

		$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[2], $studentCicloList[1]);

		echo '
				<tr>
					<td>' . $cohorteName . '</td>
					<td>' . $totalCicloList[1] . '</td>
					<td>' . $nameCicloList[2] . '</td>
					<td>' . $totalCicloList[3] . '</td>
					<td>' . $totalIdealList[3] . '</td>
					<td>' . $rezagoLigList[3] . '</td>
					<td>' . $rezagoGraList[3] . '</td>
					<td>' . ($totalCicloList[1] - $totalCicloList[3]). '</td>
					<td>' . count($noReg3Period) . '</td>
					<td>' . $aprobList[3] . '</td>
				</tr>';
?>
    	   </tbody>
    	</table>
	</div>

	<div class="table-responsive col-xs-12 col-md-12">
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="10">Porcentaje de los alumnos al cursar tres a&ntilde;os en educaci&oacute;n secundaria</th>
                </tr>
                <tr>
                    <th colspan="10"> Cohorte <?php echo $cohorteName ?></th>
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
                    <th>Inscritos (3&deg;)</th>
                    <th>Ligero</th>
                    <th>Grave</th>
                    <th>Ciclo escolar</th>
                    <th>Hace 2 ciclos escolares</th>
                    <th>Egresados</th>
                </tr>
            </thead>
            <tbody>

<?php



        $inscPorc = round($totalCicloList[3]/$totalCicloList[1]*100, 1);
        $inscIdealPorc = round($totalIdealList[3]/$totalCicloList[1]*100, 1);
        $slightLagPorc = round($rezagoLigList[3]/$totalCicloList[1]*100, 1);
        $seriousLagPorc = round($rezagoGraList[3]/$totalCicloList[1]*100, 1);
        $noInsc = ($totalCicloList[1] - $totalCicloList[3]);
        $noInscPorc = round($noInsc/$totalCicloList[1]*100, 1);
        //$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);
        $noReg3Period = array_diff($studentCicloList[0], $studentCicloList[2], $studentCicloList[1]);
        $noReg3Insc = count($noReg3Period);
        $noReg3InscPorc = round($noReg3Insc/$totalCicloList[1]*100, 1);
        $aprovPorc = round($aprobList[3]/$totalCicloList[1]*100, 1);

        echo '
                <tr>
                    <td>' . $cohorteName . '</td>
                    <td>' . $totalCicloList[1] . '</td>
                    <td>' . $nameCicloList[2] . '</td>
                    <td>' . $inscPorc . '</td>
                    <td>' . $inscIdealPorc . '</td>
                    <td>' . $slightLagPorc . '</td>
                    <td>' . $seriousLagPorc . '</td>
                    <td>' . $noInscPorc . '</td>
                    <td>' . $noReg3InscPorc . '</td>
                    <td>' . $aprovPorc . '</td>
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
			        			titleTextStyle: {color: 'black', fontSize: 14, bold: true, italic: false}
			        },
			        series: {
				        			0: {type: 'bars',
				        				color: '#A8FDCC',
				        				dataOpacity: 0.7
			        			},
			        			1: {
			        					type: 'steppedArea',
			        					color: '#ECB8B7'
			        			}
			        },
			        animation: { startup: true, duration: 2500, easing: 'linear'},
			        chartArea:{left:150,top:50}
		        };

		      var chart = new google.visualization.ComboChart(document.getElementById("column_chart_div"));
      		  chart.draw(data, options);

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
		 <?php include('../footer.php'); ?>
    </body>
</html>
