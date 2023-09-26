<?php
require ('../checkSession.php');

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
	<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
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
$aprobList = array();
$reprobList = array();
$reprobXList = array();
$reprobZList = array();
$cicloList1 = array();
$cicloList2 = array();
$cicloList3 = array();
$cicloList4 = array();
$cicloList5 = array();
$cicloList6 = array();
$cicloList7 = array();
$cicloList8 = array();
$cicloList9 = array();
$nameCicloList = array();
$studentCicloGrad = array();
$studentCicloSecun1 = array();
$studentCicloSecun2 = array();
$studentCicloSecun3 = array();
$studentCicloList = array();
$studentSecRez = array();
$studentsList = array();

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
array_push ($cicloList4, 0);
array_push ($cicloList5, 0);
array_push ($cicloList6, 0);
array_push ($cicloList7, 0);
array_push ($cicloList8, 0);
array_push ($cicloList9, 0);

//for($ciclo=0; $ciclo<$numCiclo; ++$ciclo){
$ciclo = 0 ;

if($numCiclo > 6){
	$studentsSecundOK = TRUE;
	$newNumCiclo = 6;
}else{
	$studentsSecundOK = FALSE;
	$newNumCiclo = $numCiclo;
}

while($ciclo < $numCiclo){

	/* Variables grade almacenan el numero de alumnos inscritos  por grado */
	$grade1 = 0;
	$grade2 = 0;
	$grade3 = 0;
	$grade4 = 0;
	$grade5 = 0;
	$grade6 = 0;
	$grade7 = 0;
	$grade8 = 0;
	$grade9 = 0;
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

		array_push ($studentList, $students[$numStudent]['idStudent']);
		$stdGrade =  $students[$numStudent]['grade'];

		switch($stdGrade){
			case 1:
				++$grade1;
				break;
			case 2:
				++$grade2;
				break;
			case 3:
				++$grade3;
				break;
			case 4:
				++$grade4;
				break;
			case 5:
				++$grade5;
				break;
			case 6:
				++$grade6;
				$studentSecRez[$ciclo+1][] = $students[$numStudent]['idStudent'];
				break;
			case 7:
				++$grade7;
				break;
			case 8:
				++$grade8;
				break;
			case 9:
				++$grade9;
				break;
		}

		switch($ciclo+1){
			case 1:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 1){
					++$aprobList[1];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 1){
					++$reprobXList[1];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 1){
					++$reprobZList[1];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 1){
					++$reprobList[1];
				}
				break;
			case 2:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 2){
					++$aprobList[2];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 2){
					++$reprobXList[2];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 2){
					++$reprobZList[2];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 2){
					++$reprobList[2];
				}
				break;
			case 3:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 3){
					++$aprobList[3];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 3){
					++$reprobXList[3];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 3){
					++$reprobZList[3];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 3){
					++$reprobList[3];
				}
				break;
			case 4:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 4){
					++$aprobList[4];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 4){
					++$reprobXList[4];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 4){
					++$reprobZList[4];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 4){
					++$reprobList[4];
				}
				break;
			case 5:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 5){
					++$aprobList[5];
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 5){
					++$reprobXList[5];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 5){
					++$reprobZList[5];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 5){
					++$reprobList[5];
				}
				break;
			case 6:
				if($students[$numStudent]['status'] == 'A' && $students[$numStudent]['grade'] == 6){
					++$aprobList[6];
					array_push ($studentCicloGrad, $students[$numStudent]['idStudent']);
				}
				if($students[$numStudent]['status'] == 'X' && $students[$numStudent]['grade'] == 6){
					++$reprobXList[6];
				}
				if($students[$numStudent]['status'] == 'Z' && $students[$numStudent]['grade'] == 6){
					++$reprobZList[6];
				}
				if($students[$numStudent]['status'] == 'R' && $students[$numStudent]['grade'] == 6){
					++$reprobList[6];
				}
				break;
			case 7:
				if($students[$numStudent]['grade'] == 7){
					$studentCicloSecun1[1][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 8){
					$studentCicloSecun1[2][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 9){
					$studentCicloSecun1[3][] = $students[$numStudent]['idStudent'];
				}
				break;
			case 8:
				if($students[$numStudent]['grade'] == 7){
					$studentCicloSecun2[1][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 8){
					$studentCicloSecun2[2][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 9){
					$studentCicloSecun2[3][] = $students[$numStudent]['idStudent'];
				}
				break;
			case 9:
				if($students[$numStudent]['grade'] == 7){
					$studentCicloSecun3[1][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 8){
					$studentCicloSecun3[2][] = $students[$numStudent]['idStudent'];
				}
				if($students[$numStudent]['grade'] == 9){
					$studentCicloSecun3[3][] = $students[$numStudent]['idStudent'];
				}
				break;
		}

	}

    /*$errr = array_count_values($qwerty);
    print_r($errr);
    exit;*/
	array_push ($studentCicloList, $studentList);
	unset($studentList);

	array_push ($cicloList1, $grade1);
	array_push ($cicloList2, $grade2);
	array_push ($cicloList3, $grade3);
	array_push ($cicloList4, $grade4);
	array_push ($cicloList5, $grade5);
	array_push ($cicloList6, $grade6);

    /*print_r($studentSecRez);
    echo "<br><br>";
    */

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
			case 4:
				$totalIdealList[4] = $grade4;
				break;
			case 5:
				$totalIdealList[5] = $grade5;
				break;
			case 6:
				$totalIdealList[6] = $grade6;
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
			case 4:
				$rezagoLigList[4] = $grade3;
				break;
			case 5:
				$rezagoLigList[5] = $grade4;
				break;
			case 6:
				$rezagoLigList[6] = $grade5;
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
			case 4:
				$rezagoGraList[4] = $grade1 + $grade2;
				break;
			case 5:
				$rezagoGraList[5] = $grade1 + $grade2 + $grade3;
				break;
			case 6:
				$rezagoGraList[6] = $grade1 + $grade2 + $grade3 + $grade4;
				break;
		}
		$testx1 = array();
		$testx2 = array();
		$testx3 = array();
		$testx0 = array();

        /*
         * $studentCicloGrad: lista de alumnos aprobados en sexto grado por ciclo escolar
         * $studentSecRez: lista de alumnos en sexto grado
         *
         * */

		if(($ciclo+1) == 7){
			$testx1 = array_intersect($studentCicloGrad, $studentCicloSecun1[1]);
			$testx2 = array_intersect($studentCicloGrad, $studentCicloSecun1[2]);
			$testx3 = array_intersect($studentCicloGrad, $studentCicloSecun1[3]);
			$grade7 = count($testx1);
			$grade8 = count($testx2);
			$grade9 = count($testx3);
			$totalCiclo = $grade1 + $grade2 + $grade3 + $grade4 + $grade5 + $grade6 + $grade7 + $grade8 + $grade9;

		}
		if(($ciclo+1) == 8){
			$testx0 = array_intersect($studentSecRez[7], $studentCicloSecun2[1]);
			$testx1 = array_intersect($studentCicloGrad, $studentCicloSecun2[1]);
			$testx2 = array_intersect($studentCicloGrad, $studentCicloSecun2[2]);
			$testx3 = array_intersect($studentCicloGrad, $studentCicloSecun2[3]);
			$grade7 = count($testx1) + count($testx0);
			$grade8 = count($testx2);
			$grade9 = count($testx3);
			$totalCiclo = $grade1 + $grade2 + $grade3 + $grade4 + $grade5 + $grade6 + $grade7 + $grade8 + $grade9;
		}
		if(($ciclo+1) == 9){
		    $testx0a = array_intersect($studentSecRez[7], $studentCicloSecun3[1]);
            $testx0b = array_intersect($studentSecRez[8], $studentCicloSecun3[1]);
			$testx0 = array_intersect($studentSecRez[7], $studentCicloSecun3[2]);
			$testx1 = array_intersect($studentCicloGrad, $studentCicloSecun3[1]);
			$testx2 = array_intersect($studentCicloGrad, $studentCicloSecun3[2]);
			$testx3 = array_intersect($studentCicloGrad, $studentCicloSecun3[3]);
			$grade7 = count($testx1) + count($testx0a) + count($testx0b);
            $grade8 = count($testx2) + count($testx0);
			$grade9 = count($testx3);
			$totalCiclo = $grade1 + $grade2 + $grade3 + $grade4 + $grade5 + $grade6 + $grade7 + $grade8 + $grade9;
		}

	echo '
			<tr>
				<td>' . $schoolPeriod[$ciclo]->getSchoolPeriodObject()->getName() . '</td>
				<td>' . $totalCiclo . '</td>
				<td>' . $schoolPeriod[$ciclo]->getGrade() . '</td>';

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
		  if($ciclo == 3){
		  	echo'<td class="success">' . $grade4 . '</td>';
		  }elseif($ciclo > 4){
		  	echo'<td class="warning">' . $grade4 . '</td>';
		  }else{
		  	echo'<td>' . $grade4 . '</td>';
		  }
		  if($ciclo == 4){
		  	echo'<td class="success">' . $grade5 . '</td>';
		  }elseif($ciclo > 5){
		  	echo'<td class="warning">' . $grade5 . '</td>';
		  }else{
		  	echo'<td>' . $grade5 . '</td>';
		  }
		  if($ciclo == 5){
		  	echo'<td class="success">' . $grade6 . '</td>';
		  }elseif($ciclo > 6){
		  	echo'<td class="warning">' . $grade6 . '</td>';
		  }else{
		  	echo'<td>' . $grade6 . '</td>';
		  }
		  if($ciclo == 6){
		  	echo'<td class="success">' . $grade7 . '</td>';
		  }elseif($ciclo > 7){
		  	echo'<td class="warning">' . $grade7 . '</td>';
		  }else{
		  	echo'<td>' . $grade7 . '</td>';
		  }
		  if($ciclo == 7){
		  	echo'<td class="success">' . $grade8 . '</td>';
		  }elseif($ciclo > 8){
		  	echo'<td class="warning">' . $grade8 . '</td>';
		  }else{
		  	echo'<td>' . $grade8 . '</td>';
		  }
		  if($ciclo == 8){
		  	echo'<td class="success">' . $grade9 . '</td>';
		  }elseif($ciclo > 9){
		  	echo'<td class="warning">' . $grade9 . '</td>';
		  }else{
		  	echo'<td>' . $grade9 . '</td>';
		  }
     	   echo'
			</tr>';

		++$ciclo;

}
	echo'</tbody>
	</table>';

	$datos = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
	 for($i=1; $i<=$newNumCiclo; $i++){
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
			$studentsSecunBySchool = array_intersect($studentCicloGrad, $studentCicloSecun1[1]);
			$studentsSecunBySchool = count($studentsSecunBySchool);
		}else{
			$studentsSecunBySchool = 0;
		}

		for($i=1; $i<=$totIdeal; ++$i){

			$eficIntergrado = round(($aprobList[$i]/$totalIdealList[$i]*100), 1);
			$eficIntragrado = round(($totalIdealList[$i+1]/$aprobList[$i]*100), 1);
			$eficCohorte = round(($aprobList[$i]/$totalCicloList[1]*100), 1);

			if($i == 6){
				$eficIntragrado = round(($studentsSecunBySchool/$aprobList[$i]*100), 1);
			}

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

		/*for($i=1; $i<$totIdeal; ++$i){

			$eficIntergrado = round(($aprobList[$i]/$totalIdealList[$i]*100), 1);
			$eficIntragrado = round(($totalIdealList[$i+1]/$aprobList[$i]*100), 1);
			$eficCohorte = round(($aprobList[$i]/$totalCicloList[1]*100), 1);

		}	*/

		$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);

		echo '
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
					<td>' . $aprobList[6] . '</td>
					<td>' . $studentsSecunBySchool . '</td>
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

        /*for($i=1; $i<$totIdeal; ++$i){

            $eficIntergrado = round(($aprobList[$i]/$totalIdealList[$i]*100), 1);
            $eficIntragrado = round(($totalIdealList[$i+1]/$aprobList[$i]*100), 1);
            $eficCohorte = round(($aprobList[$i]/$totalCicloList[1]*100), 1);

        }*/

        $inscPorc = round($totalCicloList[6]/$totalCicloList[1]*100, 1);
        $inscIdealPorc = round($totalIdealList[6]/$totalCicloList[1]*100, 1);
        $slightLagPorc = round($rezagoLigList[6]/$totalCicloList[1]*100, 1);
        $seriousLagPorc = round($rezagoGraList[6]/$totalCicloList[1]*100, 1);
        $noInsc = ($totalCicloList[1] - $totalCicloList[6]);
        $noInscPorc = round($noInsc/$totalCicloList[1]*100, 1);
        $noReg3Period = array_diff($studentCicloList[0], $studentCicloList[5], $studentCicloList[4], $studentCicloList[3]);
        $noReg3Insc = count($noReg3Period);
        $noReg3InscPorc = round($noReg3Insc/$totalCicloList[1]*100, 1);
        $aprovPorc = round($aprobList[6]/$totalCicloList[1]*100, 1);
        $inscSecuPorc = round($studentsSecunBySchool/$totalCicloList[1]*100, 1);

        echo '
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
