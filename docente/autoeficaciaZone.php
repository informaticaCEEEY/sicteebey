<?php
require ('../checkSession.php');

if (!isset($_POST['factor']) || !isset($_POST['schoolZone'])) {
    echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
} else {
    // Obtiene el objeto cohorte
    extract($_POST);
    $controller = new FactorController();
    $factorObject = $controller -> getEntityAction($factor);
}

if (!$factor) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}

$schoolZoneController = new SchoolRegionZoneController();
$schoolZoneObject = $schoolZoneController->getEntityAction($schoolZone);

if (!$schoolZoneObject) {
    echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
}

$contextController = new ContextController();
$join = 'INNER JOIN autoeficacia_context on autoeficacia_context.student = e.student
         INNER JOIN school ON school.cct = autoeficacia_context.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$where = 'school_region_zone.zone = :schoolZone AND school_region_zone.level = 2 AND autoeficacia_context.answered = :answered 
          AND e.year = 2015';
$whereFields = array('schoolZone' => $schoolZoneObject->getZone(), 'answered' => 1);
$contextList = $contextController -> displayByAction($where, $whereFields, $join);

$contextArray = array();

foreach ($contextList as $context) {
    switch($context->getGrade()) {
        case 3 :
            $contextArray[3][] += 1;
            break;
        case 4 :
            $contextArray[4][] += 1;
            break;
        case 5 :
            $contextArray[5][] += 1;
            break;
        case 6 :
            $contextArray[6][] += 1;
            break;
    }
}

ksort($contextArray[3]);
ksort($contextArray[4]);
ksort($contextArray[5]);
ksort($contextArray[6]);

$totalContext[3] = array_sum($contextArray[3]);
$totalContext[4] = array_sum($contextArray[4]);
$totalContext[5] = array_sum($contextArray[5]);
$totalContext[6] = array_sum($contextArray[6]);
$totalContext['total'] = $totalContext[3] + $totalContext[4] + $totalContext[5] + $totalContext[6];

$idaepyController = new IdaepyController();
$where = 'e.type = :type AND school_region_zone.zone = :schoolZone AND school_region_zone.level = 2 AND year = 2015';
$whereFields = array('type' => 1, 'schoolZone' => $schoolZoneObject->getZone());
$join = 'INNER JOIN school ON school.cct = e.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$idaepyList = $idaepyController -> displayByAction($where, $whereFields, $join);

$idaepyArray = array();

foreach ($idaepyList as $idaepy) {
    switch($idaepy->getGrade()) {
        case 3 :
            $idaepyArray[3][] = $idaepy -> getTotal();
            break;
        case 4 :
            $idaepyArray[4][] = $idaepy -> getTotal();
            break;
        case 5 :
            $idaepyArray[5][] = $idaepy -> getTotal();
            break;
        case 6 :
            $idaepyArray[6][] = $idaepy -> getTotal();
            break;
    }
}

$totalIdaepy[3] = array_sum($idaepyArray[3]);
$totalIdaepy[4] = array_sum($idaepyArray[4]);
$totalIdaepy[5] = array_sum($idaepyArray[5]);
$totalIdaepy[6] = array_sum($idaepyArray[6]);
$totalIdaepy['total'] = $totalIdaepy[3] + $totalIdaepy[4] + $totalIdaepy[5] + $totalIdaepy[6];

$where = 'e.type = :type AND school_region_zone.zone = :schoolZone AND school_region_zone.level = 2 AND year = 2015';
$whereFields = array('type' => 2, 'schoolZone' => $schoolZoneObject->getZone());
$join = 'INNER JOIN school ON school.cct = e.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$idaepyProgList = $idaepyController -> displayByAction($where, $whereFields, $join);

$idaepyProgArray = array();

foreach ($idaepyProgList as $idaepyProg) {
    switch($idaepyProg->getGrade()) {
        case 3 :
            $idaepyProgArray[3][] = $idaepyProg -> getTotal();
            break;
        case 4 :
            $idaepyProgArray[4][] = $idaepyProg -> getTotal();
            break;
        case 5 :
            $idaepyProgArray[5][] = $idaepyProg -> getTotal();
            break;
        case 6 :
            $idaepyProgArray[6][] = $idaepyProg -> getTotal();
            break;
    }
}

$totalIdaepyProg[3] = array_sum($idaepyProgArray[3]);
$totalIdaepyProg[4] = array_sum($idaepyProgArray[4]);
$totalIdaepyProg[5] = array_sum($idaepyProgArray[5]);
$totalIdaepyProg[6] = array_sum($idaepyProgArray[6]);
$totalIdaepyProg['total'] = $totalIdaepyProg[3] + $totalIdaepyProg[4] + $totalIdaepyProg[5] + $totalIdaepyProg[6];
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
		<title>Cuestionarios de Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/logog.ico">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" href="../css/chart.css">
		<link rel="stylesheet" href="../css/factorTable.css">
		<link rel="stylesheet" href="../css/description.css">
		<link rel="stylesheet" href="../css/table.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>

		<div class="container-fluid">
		    <form role="form" name="schoolFactor" id="schoolFactor" action="factorZone.php" method="post" accept-charset="UTF-8">
                <input type="hidden" id="schoolZone" name="schoolZone" value="<?php echo$schoolZone ?>"/>            
            </form>
            <?php
            if(empty($contextList)){
                $_SESSION['flash'] = 'El factor no se encuentra disponible por falta de datos';               
                echo('<script>document.forms.schoolFactor.submit()</script>');
            }
            ?>
			<button class="buttonBack" type="button" onclick="document.forms.schoolFactor.submit()"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<br />
			<div class="col-xs-12 col-md-5">
                <div><h4 class='form-signin-heading'>Nivel: Primaria</h4></div>
                <div><h4 class='form-signin-heading'>Modalidad: <?php echo($schoolZoneObject -> getSchoolModeObject() -> getName()); ?> </h4></div>
                <div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($schoolZoneObject -> getSchoolRegionObject() -> getName()); ?> </h4></div>
                <div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($schoolZoneObject->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
            </div>
			<div class="col-xs-12 col-md-7">
				<table class="table table-condensed">
					<thead>
                        <tr>
                            <th>Grado</th>
                            <th>Programados IDAEPY</th>
                            <th>Evaluados IDAEPY</th>
                            <th>Evaluados Contexto</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    
                    $count3 = 1;
                    $count4 = 1;
                    $count5 = 1;
                    $count6 = 1;
                        // Tercero                  
                        echo('<tr>');                       
                        echo('<td class="theadR">3&deg;</td>');
                        echo('<td>'.$totalIdaepyProg[3].'</td>');
                        echo('<td>'.$totalIdaepy[3].'</td>');
                        echo('<td>'.$totalContext[3].'</td>');
                        echo('</tr>');                      
                        echo('<tr>');                      
                        echo('<td class="theadR">4&deg;</td>');
                        echo('<td>'.$totalIdaepyProg[4].'</td>');
                        echo('<td>'.$totalIdaepy[4].'</td>');
                        echo('<td>'.$totalContext[4].'</td>');
                        echo('</tr>');  
                        echo('<tr>');                     
                        echo('<td class="theadR">5&deg;</td>');
                        echo('<td>'.$totalIdaepyProg[5].'</td>');
                        echo('<td>'.$totalIdaepy[5].'</td>');
                        echo('<td>'.$totalContext[5].'</td>');
                        echo('</tr>');  
                        echo('<tr>');                       
                        echo('<td class="theadR">6&deg;</td>');
                        echo('<td>'.$totalIdaepyProg[6].'</td>');
                        echo('<td>'.$totalIdaepy[6].'</td>');
                        echo('<td>'.$totalContext[6].'</td>');
                        echo('</tr>');  
                        echo('<tr>');
                        echo('<td>Total</td>');
                        echo('<td>'.$totalIdaepyProg['total'].'</td>');
                        echo('<td>'.$totalIdaepy['total'].'</td>');
                        echo('<td>'.$totalContext['total'].'</td>');
                        echo('</tr>');
                     ?>
                    </tbody>
				</table>
			</div>
			<div class="col-xs-12 col-md-12">
				<hr />	
			</div>
			
			<?php 
			
			$autoeficaciaSchoolController = new AutoeficaciaContextController();
			$join = 'INNER JOIN school ON school.cct = e.cct
                     INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';       
            $where = "school_region_zone.zone = :schoolZone AND school_region_zone.level = 2";
            $whereFields = array('schoolZone' => $schoolZoneObject->getZone());
			$autoeficaciaList = $autoeficaciaSchoolController -> displayByAction($where, $whereFields, $join);
			$autoeficaciaTotal = count($autoeficaciaList);
			
			$factorZoneController = new FactorZoneController();
            $where = "zone = :schoolZone AND factor = :factor";
            $whereFields = array('factor' => $factor, 'schoolZone' => $schoolZoneObject->getZone());
            $factorZoneList = $factorZoneController -> displayByAction($where, $whereFields);

            $factorRegionController = new FactorRegionController();
            $whereRegion = "region LIKE :region AND factor = :factor";
            $factorRegionList = $factorRegionController -> displayByAction($whereRegion, 
                array('region' => $schoolZoneObject -> getSchoolRegion(), 'factor' => $factor));

            $factorStateController = new FactorStateController();
            $whereRegion = "factor LIKE :factor";
            $factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));
            
            $schoolController = new SchoolController();
            $join = 'INNER JOIN factor_cct ON factor_cct.cct = e.cct
                     INNER JOIN school_region_zone ON school_region_zone.id = e.school_region_zone';
            $where = "school_region_zone.zone = :schoolZone AND school_region_zone.level = 2 AND factor = :factor";
            $whereFields = array('factor' => $factor, 'schoolZone' => $schoolZoneObject->getZone());                
            $schoolList = $schoolController->displayByAction($where, $whereFields, $join);
            
            $factorSchoolController = new FactorCctController();
            $join = 'INNER JOIN school ON school.cct = e.cct
                     INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
            $factorSchoolList = $factorSchoolController->displayByAction($where, $whereFields, $join);

			$autoeficaciaArray1 = array();
			$autoeficaciaArray2 = array();
			$autoeficaciaArray3 = array();
			$autoeficaciaArray4 = array();
			$autoeficaciaArray5 = array();
			
			$autoeficaciaName1 = array("0" => "No tengo la habilidad", "1" => "Tengo poca habilidad", "2" => "Tengo habilidad", "3" => "Tengo mucha habilidad", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $schoolZoneObject -> getSchoolRegionObject() -> getName(), 
                2 => "Zona ".(str_pad($schoolZoneObject->getZone(),  3, "0", STR_PAD_LEFT)));
            foreach($schoolList as $school){
                array_push($reportNameGeneral, $school->getCct());
            }
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");			
			
			foreach ($autoeficaciaList as $autoeficaciaEntry) {
				
				switch($autoeficaciaEntry->getP8O1()) {
					case 0 :
						++$autoeficaciaArray1[0];
						break;
					case 1 :
						++$autoeficaciaArray1[1];
						break;
					case 2 :
						++$autoeficaciaArray1[2];
						break;
					case 3 :
						++$autoeficaciaArray1[3];
						break;
					case 999 :
						++$autoeficaciaArray1[4];
						break;
				}
				
				switch($autoeficaciaEntry->getP8O2()) {
					case 0 :
						++$autoeficaciaArray2[0];
						break;
					case 1 :
						++$autoeficaciaArray2[1];
						break;
					case 2 :
						++$autoeficaciaArray2[2];
						break;
					case 3 :
						++$autoeficaciaArray2[3];
						break;
					case 999 :
						++$autoeficaciaArray2[4];
						break;
				}
				
				switch($autoeficaciaEntry->getP8O3()) {
					case 0 :
						++$autoeficaciaArray3[0];
						break;
					case 1 :
						++$autoeficaciaArray3[1];
						break;
					case 2 :
						++$autoeficaciaArray3[2];
						break;
					case 3 :
						++$autoeficaciaArray3[3];
						break;
					case 999 :
						++$autoeficaciaArray3[4];
						break;
				}
				
				switch($autoeficaciaEntry->getP8O4()) {
					case 0 :
						++$autoeficaciaArray4[0];
						break;
					case 1 :
						++$autoeficaciaArray4[1];
						break;
					case 2 :
						++$autoeficaciaArray4[2];
						break;
					case 3 :
						++$autoeficaciaArray4[3];
						break;
					case 999 :
						++$autoeficaciaArray4[4];
						break;
				}
				
				
				
				switch($autoeficaciaEntry->getP8O5()) {
					case 0 :
						++$autoeficaciaArray5[0];
						break;
					case 1 :
						++$autoeficaciaArray5[1];
						break;
					case 2 :
						++$autoeficaciaArray5[2];
						break;
					case 3 :
						++$autoeficaciaArray5[3];
						break;
					case 999 :
						++$autoeficaciaArray5[4];
						break;
				}
				
				
				
			}

			$data1 = "[";
			for ($i = 0; $i < count($autoeficaciaName1); $i++) {
				$autoeficaciaPercent1 = round(($autoeficaciaArray1[$i] / $autoeficaciaTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$autoeficaciaName1[$i]."', 'Frecuencia', '" . $autoeficaciaArray1[$i] . "')";
				$data1 .= "['" . $autoeficaciaName1[$i] . "'," . $autoeficaciaPercent1 . ",'" . $autoeficaciaPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';
			

			$data2 = "[";
			for ($i = 0; $i < count($autoeficaciaName1); $i++) {
				$autoeficaciaPercent2 = round(($autoeficaciaArray2[$i] / $autoeficaciaTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$autoeficaciaName1[$i]."', 'Frecuencia', '" . $autoeficaciaArray2[$i] . "')";
				$data2 .= "['" . $autoeficaciaName1[$i] . "'," . $autoeficaciaPercent2 . ",'" . $autoeficaciaPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($autoeficaciaName1); $i++) {
				$autoeficaciaPercent3 = round(($autoeficaciaArray3[$i] / $autoeficaciaTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$autoeficaciaName1[$i]."', 'Frecuencia', '" . $autoeficaciaArray3[$i] . "')";
				$data3 .= "['" . $autoeficaciaName1[$i] . "'," . $autoeficaciaPercent3 . ",'" . $autoeficaciaPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

			$data4 = "[";
			for ($i = 0; $i < count($autoeficaciaName1); $i++) {
				$autoeficaciaPercent4 = round(($autoeficaciaArray4[$i] / $autoeficaciaTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$autoeficaciaName1[$i]."', 'Frecuencia', '" . $autoeficaciaArray4[$i] . "')";
				$data4 .= "['" . $autoeficaciaName1[$i] . "'," . $autoeficaciaPercent4 . ",'" . $autoeficaciaPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data4 .= ']';
			
			$data5 = "[";
			for ($i = 0; $i < count($autoeficaciaName1); $i++) {
				$autoeficaciaPercent5 = round(($autoeficaciaArray5[$i] / $autoeficaciaTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$autoeficaciaName1[$i]."', 'Frecuencia', '" . $autoeficaciaArray5[$i] . "')";
				$data5 .= "['" . $autoeficaciaName1[$i] . "'," . $autoeficaciaPercent5 . ",'" . $autoeficaciaPercent5 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data5 .= ']';

			$dataReportGeneral = "[['Valor', 'Indicador', { role: 'annotation' }, { role: 'style' }],";
			if($factorStateList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[0] . "'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . round($factorStateList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}
			if($factorRegionList[0]->getMedia() > 0){
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#3AC777'],";
			}else{
				$dataReportGeneral .= "['" . $reportNameGeneral[1] . "'," . round($factorRegionList[0] -> getMedia(), 2) . ",'" . round($factorRegionList[0] -> getMedia(), 2) . "', '#E9F26D'],";
			}
			if($factorZoneList[0]->getFactorCount() != 0){
                if($factorZoneList[0]->getMedia() > 0){
                    $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#3AC777'],";
                }else{
                    $dataReportGeneral .= "['" . $reportNameGeneral[2] . "'," . round($factorZoneList[0] -> getMedia(), 2) . ",'" . round($factorZoneList[0] -> getMedia(), 2) . "', '#E9F26D'],";
                }   
            }else{
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $reportNameGeneral[2] . "', 0,'" . $messageMediaNull . "', ''],";
            }
            $schoolNum = 3;
            foreach($factorSchoolList as $factorSchool){
                if($factorSchool->getFactorCount() != 0){
                    if($factorSchool->getMedia() > 0){
                        $dataReportGeneral .= "['" . $reportNameGeneral[$schoolNum] . "'," . round($factorSchool -> getMedia(), 2) 
                            . ",'" . round($factorSchool -> getMedia(), 2) . "', '#3AC777'],";
                    }else{
                        $dataReportGeneral .= "['" . $reportNameGeneral[$schoolNum] . "'," . round($factorSchool -> getMedia(), 2) 
                            . ",'" . round($factorSchool -> getMedia(), 2) . "', '#E9F26D'],";
                    }   
                }else{
                    $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                    $dataReportGeneral .= "['" . $reportNameGeneral[$schoolNum] . "', 0,'" . $messageMediaNull . "', ''],";
                }
                $schoolNum = $schoolNum + 1;
            }
			$dataReportGeneral .= ']';

			?>
			
		<div class="row">
			<div class='col-xs-12 col-md-12 description' align="center">
				<p>
				 	Conformado por cinco &iacute;tems que refieren a la convicci&oacute;n del estudiante de su capacidad para regular su propio 
				 	aprendizaje como fijarse metas, auto-monitorearse y el uso de estrategias de estudio (Pajares &amp; Schunk, 2002; 
				 	Zimmerman &amp; Kitsantas, 2005). Los valores bajos del &iacute;ndice se&ntilde;alan poca convicci&oacute;n de su capacidad 
				 	para controlar su aprendizaje; y valores altos indican m&aacute;s convicci&oacute;n. El promedio del Estado es 1.0, y la 
				 	distribuci&oacute;n del &iacute;ndice se inclina hacia valores altos.
				</p>
				<p>
					Los resultados muestran que los estudiantes se perciben con m&aacute;s habilidad para cumplir con las tareas marcadas y 
					ponerse al d&iacute;a cuando se atrasa en las tareas, despu&eacute;s consideran que tienen menos habilidad de relacionar 
					los conceptos que ya conoce con los nuevos, por &uacute;ltimo perciben que tienen poca habilidad para ponerse al corriente 
					cuando han faltado o se est&aacute;n atrasando en clases.				 
				</p>
			</div>
			<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
			<div id="chart3_autoeficacia" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			<div id="chart2_autoeficacia" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			<div id="chart5_autoeficacia" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			<div id="chart4_autoeficacia" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
			<div id="chart1_autoeficacia" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
		</div>

			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data4 = <?php echo $data4; ?>;
				var data5 = <?php echo $data5; ?>;
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>;
				
				
				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
				google.charts.setOnLoadCallback(drawChart4);
				google.charts.setOnLoadCallback(drawChart5);
				google.charts.setOnLoadCallback(drawChartReportGeneral);
				
				
				function drawChart1() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data1);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Si te das cuenta de que te est\u00E1s atrasando cada vez m\u00E1s en clases, \u00BFtienes la habilidad de aumentar tu tiempo de estudio para ponerte al corriente?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart1_autoeficacia')).draw(data, options);
			
				}
			
				function drawChart2() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data2);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Si te das cuenta de que te atrasaste en la tarea durante la semana, \u00BFtienes la habilidad para ponerte al corriente el fin de semana?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart2_autoeficacia')).draw(data, options);
			
				}
			
				function drawChart3() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data3);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Aunque los problemas con tus compa\u00F1eros(as) dificulten tu trabajo en la escuela, \u00BFtienes la habilidad de lograr cumplir con las tareas marcadas?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart3_autoeficacia')).draw(data, options);
			
				}
			
				function drawChart4() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data4);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Si faltaste a varias clases, \u00BFtienes la habilidad para ponerte al corriente en una semana?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart4_autoeficacia')).draw(data, options);
			
				}
				
				function drawChart5() {
					var data = new google.visualization.DataTable();
					data.addColumn('string', 'Valor');
					data.addColumn('number', 'Frecuencia');
					data.addColumn({'type': 'string', 'role': 'annotation'});
					data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
					data.addColumn({'type': 'string', 'role': 'style'});
					data.addRows(data5);
			
					var options = {
						height : 400,
						width : 700,
						title : 'Si est\u00E1s aprendiendo temas nuevos, \u00BFtienes la habilidad para relacionar los conceptos que ya conoces con los nuevos para recordarlos?',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						tooltip: {
							isHtml: true
						},
						hAxis : {
							title : 'Categor\u00EDa',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							}
						},
						vAxis : {
							title : 'Porcentaje',
							titleTextStyle : {
								color : 'black',
								fontSize : 14,
								bold : true,
								italic : false
							},
							ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '75%', 
							height: '70%'
						}
					};
			
					new google.visualization.ComboChart(document.getElementById('chart5_autoeficacia')).draw(data, options);
			
				}
				
			function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'Autoeficacia',
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [-4, -3, -2, -1, 0, 1, 2, 3, 4]
						},
						vAxis : {
							title : '',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [0, 1, 2, 3, 4]
						},
						series : {
							0 : {
								type : 'bars',
								color : '#A8FDCC',
								annotations: {textStyle: {fontSize: 12, color: 'black' }}
							}
						},
						animation : {
							startup : true,
							duration : 2500,
							easing : 'linear'
						},
						chartArea : {
							left : 100,
							top : 50,
							width: '85%', 
							height: '80%'
						},
					};
			
					var chart = new google.visualization.BarChart(document.getElementById("chartReportGeneral"));
					chart.draw(data, options);
			
				}				
				
				function createCustomHTMLContent($category1, title1, frecuency1) {
					return '<div><span cclass="tooltiptext"><b>' + $category1 + '</b></span><br />'
						 +	  '<p>' + title1 + ': <b>' + frecuency1 + '</b></p>'			  		
						 + '</div>';
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
		<?php include ('../footer.php'); ?>
	</body>
</html>