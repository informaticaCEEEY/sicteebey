<?php
require ('../checkSession.php');

if (!isset($_POST['cohorte'])) {	
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}else{		
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new CohorteController();
	$cohorte = $controller->getEntityAction($cohorte);
}

if(!$cohorte){
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');	
}

// obtiene los ciclos escolares correspondientes a la cohorte
$controller = new SchoolPeriodCohorteController();
$schoolPeriod = $controller->getByAction('cohorte', $cohorte->getId());
$numCiclo = count($schoolPeriod);
//$where = "cohorte.grade = 1 AND cohorte.reprobate = 0 AND cohorte.cct = '31DML2004I'";
$where = "cohorte.grade = :grade AND cohorte.reprobate = :reprobate";

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
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
        <!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
        <link rel="icon" href="../img/favicon_.png">
       		<!-- Bootstrap core ../css -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->
        <link href="../css/buttonTop.css" rel="stylesheet">
        <link href="../css/footer.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">   
		<link rel="stylesheet" href="../css/table.css">
		<link rel="stylesheet" href="../css/factorTable.css">
		<link rel="stylesheet" href="../css/chart.css">	
		<script src="../lib/jquery/jquery.min.js"></script>        
        <!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
    </head>
    <body>
    <?php include('header.php'); ?>

	<div class="container">	
		<button class="buttonBack" onclick="javascript:history.go(-1);"><span>Regresar</span></button>
		<div class='text-center'><h2 class='form-signin-heading'>Reporte general de trayectorias escolares</h2></div><hr /><br />
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
			<tbody>

<?php

//foreach($schoolPeriod as $period){
$totalIdealList = array();
$totalCicloList = array();
$totalRezagoGrave = array();
$totalRezagoGrave[1]= 0;
$totalRezagoGrave[2]= 0;
$nameCicloList = array();
$studentCicloList = array();
$totalGrade = array();

array_push ($totalCicloList, 0);

//for($ciclo=0; $ciclo<$numCiclo; ++$ciclo){
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

while($ciclo <= $numCiclo){
    /* Variables grade almacenan el numero de alumnos inscritos  por grado */  
    //$studentGrade = array();
    //$studentStatus = array();    
    //$nController = ucwords($schoolPeriod[$ciclo-1]->getSchoolPeriodObject()->getTablePeriod()).'Controller';
    //$studentList = array(); 

    

    $totalCicloList[$ciclo] = array_sum($totalGrade[$ciclo]);
    //$totalStatus[$ciclo] = array_count_values($studentStatus);
    //$totalCicloList[$ciclo] = $totalCiclo;
    $totalIdealList[$ciclo] = $totalGrade[$ciclo][$ciclo];    
    array_push ($nameCicloList, $schoolPeriod[$ciclo-1]->getSchoolPeriodObject()->getName());    
    /*foreach($totalGrade[$ciclo] as $key => $value){
        if($key<=$ciclo-2){
            $totalRezagoGrave[$ciclo] = $value + $totalRezagoGrave[$ciclo];
        } 
    }*/
    
    for($x=1; $x<10; $x++){
        if(!isset($totalGrade[$ciclo][$x])){
            $totalGrade[$ciclo][$x] = 0;
        }
        //$totalRezagoGrave[$ciclo] = $totalCicloList[$ciclo] - $totalGrade[$ciclo][$ciclo] - $totalGrade[$ciclo][$ciclo-1];        
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
    echo '
            <tr>
                <td>' . $schoolPeriod[$ciclo-1]->getSchoolPeriodObject()->getName() . '</td>
                <td>' . $totalCicloList[$ciclo] . '</td>';
           echo'<td>' . $schoolPeriod[$ciclo-1]->getGrade() . '</td>';
           
          if($ciclo == 1){
            echo'<td class="success">' . $totalGrade[$ciclo][1] . '</td>';
          }elseif($ciclo > 2){
            echo'<td class="warning">' . $totalGrade[$ciclo][1] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][1] . '</td>';
          }     
          if($ciclo == 2){
            echo'<td class="success">' . $totalGrade[$ciclo][2] . '</td>';
          }elseif($ciclo > 3){
            echo'<td class="warning">' . $totalGrade[$ciclo][2] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][2] . '</td>';
          } 
          if($ciclo == 3){
            echo'<td class="success">' . $totalGrade[$ciclo][3] . '</td>';
          }elseif($ciclo > 4){
            echo'<td class="warning">' . $totalGrade[$ciclo][3] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][3] . '</td>';
          } 
          if($ciclo == 4){
            echo'<td class="success">' . $totalGrade[$ciclo][4] . '</td>';
          }elseif($ciclo > 5){
            echo'<td class="warning">' . $totalGrade[$ciclo][4] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][4] . '</td>';
          } 
          if($ciclo == 5){
            echo'<td class="success">' . $totalGrade[$ciclo][5] . '</td>';
          }elseif($ciclo > 6){
            echo'<td class="warning">' . $totalGrade[$ciclo][5] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][5] . '</td>';
          } 
          if($ciclo == 6){
            echo'<td class="success">' . $totalGrade[$ciclo][6] . '</td>';
          }elseif($ciclo > 7){
            echo'<td class="warning">' . $totalGrade[$ciclo][6] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][6] . '</td>';
          } 
          if($ciclo == 7){
            echo'<td class="success">' . $totalGrade[$ciclo][7] . '</td>';
          }elseif($ciclo > 8){
            echo'<td class="warning">' . $totalGrade[$ciclo][7] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][7] . '</td>';
          } 
          if($ciclo == 8){
            echo'<td class="success">' . $totalGrade[$ciclo][8] . '</td>';
          }elseif($ciclo > 9){
            echo'<td class="warning">' . $totalGrade[$ciclo][8] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][8] . '</td>';
          }
          if($ciclo == 9){
            echo'<td class="success">' . $totalGrade[$ciclo][9] . '</td>';
          }elseif($ciclo > 10){
            echo'<td class="warning">' . $totalGrade[$ciclo][9] . '</td>';
          }else{
            echo'<td>' . $totalGrade[$ciclo][9] . '</td>';
          }    
           echo'
            </tr>';
            
        array_push ($studentCicloList, $studentList);
        unset($studentList);
        
        ++$ciclo;
    
}
    echo'</tbody>
    </table>';
    
    //print_r($totalGrade);
    //exit;
    
    //Varaible que alamacena los datos para la primer grafica    
    $datos = "[['Ciclo escolar', 'Estudiantes inscritos', 'Inscritos grado ideal'],";
     for($i=1; $i<count($totalCicloList); $i++){    
        $datos .= "['".$nameCicloList[$i-1]."',".$totalCicloList[$i].",".$totalGrade[$i][$i]."],";
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
				<th colspan="8"> Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</th>
			</tr>
			<tr>
				<th colspan="8"> Cohorte <?php echo $cohorteName ?> </th>
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
		<tbody>
		
		<?php
		
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
				
				//$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[$i-1], $studentCicloList[$i-2], $studentCicloList[$i-3]);       
				$noReg3PeriodPorcent = round(($totalStatus[$i-1]['unregistered_three']/$totalCicloList[1]*100), 1);
				
				echo '
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
		echo'</tbody>
	</table>';
	
	//$idealInsc =  $idealList;
	//unset($idealInsc[0]);
 	//$namePeriod =  $nameCicloList;
	
	 $datos2 = "[['Ciclo escolar', 'Inscritos grado ideal', 'Rezago ligero', 'Rezago grave', 'No inscritos'],";
	 for($i=1; $i<count($totalCicloList); $i++){
	 	
		$noInsc = $totalCicloList[1] - $totalCicloList[$i];
			
	 	$datos2 .= "['".$nameCicloList[$i-1]."',".$totalIdealList[$i].",".$totalGrade[$i][$i-1].",".$totalRezagoGrave[$i].",".$noInsc."],";
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
	          
		for($i=1; $i<=$totIdeal; ++$i){
			
			$eficIntergrado = round(($totalStatus[$i-1]['statusA']/$totalIdealList[$i]*100), 1);
			$eficIntragrado = round(($totalIdealList[$i+1]/$totalStatus[$i-1]['statusA']*100), 1);
			$eficCohorte = round(($totalStatus[$i-1]['statusA']/$totalCicloList[1]*100), 1);
				
				echo '
					<tr>						
						<td>' . $schoolPeriod[$i-1]->getGrade() . '&deg; ' .  $schoolPeriod[$i-1]->getSchoolLevelObject()->getName() . '</td>
						<td>' . $schoolPeriod[$i-1]->getSchoolPeriodObject()->getName() . '</td>
						<td>' . $totalIdealList[$i] . '</td>
						<td>' . $totalStatus[$i-1]['statusA'] . '</td>
						<td>' . $totalStatus[$i-1]['statusR'] . '</td>
						<td>' . $totalStatus[$i-1]['statusX'] . '</td>
						<td>' . $totalStatus[$i-1]['statusZ'] . '</td>
						<td>' . $eficIntergrado . '%</td>
						<td>' . $eficIntragrado . '%</td>
						<td>' . $eficCohorte . '%</td>
					</tr>';
		}
		echo'</tbody>
	</table>
</div>';
	if($numCiclo >= 6){
	
	?>		
		<br />
		<div class="table-responsive col-xs-12 col-md-12">	
		<table class="table table-bordered table-striped table-hover table-condensed">
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
			<tbody>
		
<?php
			
			$cohorteReportController = new CohorteReportController();
			$cohorteReportList = $cohorteReportController->displayAction();
			$totalCohorteReport = count($cohorteReportList);
			
			foreach($cohorteReportList as $cohorteReport){
				
				if($cohorte->getId() == $cohorteReport->getCohorte()){
					echo '
						<tr class="info">						
							<td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
							<td>' . $cohorteReport->getTotalStudents() . '</td>
							<td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
							<td>' . $cohorteReport->getEnrolledStudents() . '</td>
							<td>' . $cohorteReport->getTotalIdealDegree() . '</td>
							<td>' . $cohorteReport->getSlightLag() . '</td>
							<td>' . $cohorteReport->getSeriousLag() . '</td>
							<td>' . $cohorteReport->getUnregistered() . '</td>
							<td>' . $cohorteReport->getUnregisteredThree() . '</td>
							<td>' . $cohorteReport->getGraduates() . '</td>
							<td>' . $cohorteReport->getEnrolledNextGrade() . '</td>
						</tr>';	
				}else{
					echo '
						<tr>						
							<td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
							<td>' . $cohorteReport->getTotalStudents() . '</td>
							<td>' . $cohorteReport->getSchoolPeriodObject()->getName() . '</td>
							<td>' . $cohorteReport->getEnrolledStudents() . '</td>
							<td>' . $cohorteReport->getTotalIdealDegree() . '</td>
							<td>' . $cohorteReport->getSlightLag() . '</td>
							<td>' . $cohorteReport->getSeriousLag() . '</td>
							<td>' . $cohorteReport->getUnregistered() . '</td>
							<td>' . $cohorteReport->getUnregisteredThree() . '</td>
							<td>' . $cohorteReport->getGraduates() . '</td>
							<td>' . $cohorteReport->getEnrolledNextGrade() . '</td>
						</tr>';
				}
								
			}
			echo'</tbody>
		</table>
	</div>';
?>
    <br />
    <div class="table-responsive col-xs-12 col-md-12">  
        <table class="table table-bordered table-striped table-hover table-condensed">
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
            <tbody>
<?php
            //$cohorteReportController = new CohorteReportController();
            //$cohorteReportList = $cohorteReportController->displayAction();
            //$totalCohorteReport = count($cohorteReportList);
            
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
                    echo '
                        <tr class="info">                       
                            <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
                            <td>' . $cohorteReport->getTotalStudents() . '</td>
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
                    echo '
                        <tr>                        
                            <td>' . $cohorteReport->getCohorteObject()->getName() . '</td>
                            <td>' . $cohorteReport->getTotalStudents() . '</td>
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
            echo'</tbody>
        </table>
    </div>';
}
	if($numCiclo >= 9){		
?>
	
		<br />
		<div class="table-responsive col-xs-12 col-md-12">	
		<table class="table table-bordered table-striped table-hover table-condensed">
			<thead>
				<tr>
					<th colspan="11">Estatus de los alumnos al cursar educaci&oacute;n basica</th>
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
					<th>Inscritos (3&deg; Secundaria)</th>
					<th>Ligero</th>
					<th>Grave</th>
					<th>Ciclo escolar</th>
					<th>Hace 3 ciclos escolares</th>
					<th>Egresados</th>
				</tr>
			</thead>
			<tbody>
		
<?php		
			//$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[8], $studentCicloList[7], $studentCicloList[6]);
			$noReg3Period = $totalStatus[8]['unregistered_three'];
			
			echo '
					<tr>						
						<td>' . $cohorteName . '</td>
						<td>' . $totalCicloList[1] . '</td>
						<td>' . $nameCicloList[8] . '</td>
						<td>' . $totalCicloList[9] . '</td>
						<td>' . $totalIdealList[9] . '</td>
						<td>' . $totalGrade[9][8] . '</td>
						<td>' . $totalRezagoGrave[9] . '</td>
						<td>' . ($totalCicloList[1] - $totalCicloList[9]). '</td>
						<td>' . $noReg3Period . '</td>
						<td>' . $totalStatus[8]['statusA'] . '</td>
					</tr>';
			echo'</tbody>
		</table>
		</div>';
?>
        <br />
        <div class="table-responsive col-xs-12 col-md-12">  
        <table class="table table-bordered table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th colspan="11">Estatus de los alumnos al cursar educaci&oacute;n basica</th>
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
                    <th>Inscritos (3&deg; Secundaria)</th>
                    <th>Ligero</th>
                    <th>Grave</th>
                    <th>Ciclo escolar</th>
                    <th>Hace 3 ciclos escolares</th>
                    <th>Egresados</th>
                </tr>
            </thead>
            <tbody>
<?php

            //$noReg3Period = array_diff($studentCicloList[0], $studentCicloList[8], $studentCicloList[7], $studentCicloList[6]);
            $noReg3PeriodPorcent = round(($noReg3Period/$totalCicloList[1]*100), 1);
            
            echo '
                    <tr>                        
                        <td>' . $cohorteName . '</td>
                        <td>' . $totalCicloList[1] . '</td>
                        <td>' . $nameCicloList[8] . '</td>
                        <td>' . round($totalCicloList[9]/$totalCicloList[1]*100,1) . '</td>
                        <td>' . round($totalIdealList[9]/$totalCicloList[1]*100,1) . '</td>
                        <td>' . round($totalGrade[9][8]/$totalCicloList[1]*100,1) . '</td>
                        <td>' . round($totalRezagoGrave[9]/$totalCicloList[1]*100,1) . '</td>
                        <td>' . round(($totalCicloList[1] - $totalCicloList[9])/$totalCicloList[1]*100,1). '</td>
                        <td>' . $noReg3PeriodPorcent . '</td>
                        <td>' . round($totalStatus[8]['statusA']/$totalCicloList[1]*100,1) . '</td>
                    </tr>';
        echo'</tbody>
        </table>
        </div>';
    }
?>
	
	<a class="go-top" href="#">Subir</a>		
    <script src="../lib/bootstrap/bootstrap.js"></script>    			
    <script src="../imports/js/buttonTop.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>			
	<script>	        
            	
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
			        			ticks: [10000,20000,30000,40000,50000]
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