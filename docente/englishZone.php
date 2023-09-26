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
$join = 'INNER JOIN english_context on english_context.student = e.student
         INNER JOIN school ON school.cct = english_context.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$where = 'school_region_zone.zone = :schoolZone AND school_region_zone.level = 2 AND english_context.answered = :answered 
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
			
			$englishController = new EnglishContextController();
			$join = 'INNER JOIN school ON school.cct = e.cct
                     INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';       
            $where = "school_region_zone.zone = :schoolZone AND school_region_zone.level = 2";
            $whereFields = array('schoolZone' => $schoolZoneObject->getZone());
			$englishList = $englishController -> displayByAction($where, $whereFields, $join);
			$englishTotal = count($englishList);
			
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

			$englishArray1 = array();
			$englishArray2 = array();
			$englishArray3 = array();
			$englishName1 = array("0" => "No tengo la habilidad", "1" => "Tengo poca habilidad", "2" => "Tengo habilidad", "3" => "Tengo mucha habilidad", "4" => "Sin respuesta");
			$reportNameGeneral = array("0" => "Yucat\u00E1n", "1" => $schoolZoneObject -> getSchoolRegionObject() -> getName(), 
                2 => "Zona ".(str_pad($schoolZoneObject->getZone(),  3, "0", STR_PAD_LEFT)));
            foreach($schoolList as $school){
                array_push($reportNameGeneral, $school->getCct());
            }
			$colorGraphic = array("0" => "#F04747", "1" => "#E9F26D", "2" => "#BFFEE6", "3" => "#3AC777", "4" => "#B0B0B0");
			
			foreach ($englishList as $englishEntry) {

				switch($englishEntry->getP14O9()) {
					case 0 :
						++$englishArray1[0];
						break;
					case 1 :
						++$englishArray1[1];
						break;
					case 2 :
						++$englishArray1[2];
						break;
					case 3 :
						++$englishArray1[3];
						break;
					case 999 :
						++$englishArray1[4];
						break;
				}
				
				switch($englishEntry->getP14O10()) {
					case 0 :
						++$englishArray2[0];
						break;
					case 1 :
						++$englishArray2[1];
						break;
					case 2 :
						++$englishArray2[2];
						break;
					case 3 :
						++$englishArray2[3];
						break;
					case 999 :
						++$englishArray2[4];
						break;
				}
				
				switch($englishEntry->getP14O11()) {
					case 0 :
						++$englishArray3[0];
						break;
					case 1 :
						++$englishArray3[1];
						break;
					case 2 :
						++$englishArray3[2];
						break;
					case 3 :
						++$englishArray3[3];
						break;
					case 999 :
						++$englishArray3[4];
						break;
				}
			}

			$data1 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent1 = round(($englishArray1[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray1[$i] . "')";
				$data1 .= "['" . $englishName1[$i] . "'," . $englishPercent1 . ",'" . $englishPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data1 .= ']';
			

			$data2 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent2 = round(($englishArray2[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray2[$i] . "')";
				$data2 .= "['" . $englishName1[$i] . "'," . $englishPercent2 . ",'" . $englishPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data2 .= ']';

			$data3 = "[";
			for ($i = 0; $i < count($englishName1); $i++) {
				$englishPercent3 = round(($englishArray3[$i] / $englishTotal * 100), 2);
				$funtionTooltip = "createCustomHTMLContent('" .$englishName1[$i]."', 'Frecuencia', '" . $englishArray3[$i] . "')";
				$data3 .= "['" . $englishName1[$i] . "'," . $englishPercent3 . ",'" . $englishPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
			}
			$data3 .= ']';

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
					 	Este factor, compuesto de tres &iacute;tems, valora la confianza del estudiante para leer textos escritos en idioma 
					 	ingl&eacute;s (CENEVAL, 2013). Los valores bajos del &iacute;ndice se&ntilde;alan poca confianza de su capacidad para leer 
					 	textos en ingl&eacute;s; y valores altos indican m&aacute;s confianza. El promedio del Estado es -.38, y la 
					 	distribuci&oacute;n del &iacute;ndice se inclina hacia valores bajos. Se encontr&oacute; que los estudiantes se perciben 
					 	con m&aacute;s confianza en comprender informaci&oacute;n en ingl&eacute;s del internet, y perciben menos confianza en 
					 	comprender libros de esparcimiento escritos en ingl&eacute;s.
					</p>
				</div>
				<div id="chartReportGeneral" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<div id="chart1_english" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart2_english" class="col-xs-12 col-md-6 factorGraph"></div>
				<div id="chart3_english" class="col-xs-12 col-md-6 factorGraph"></div>
			</div>

			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
			
				var data1 = <?php echo $data1; ?>;
				var data2 = <?php echo $data2; ?>;
				var data3 = <?php echo $data3; ?>;
				var data3 = <?php echo $data3; ?>;
				var dataReportGeneral = <?php echo $dataReportGeneral; ?>;

				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChart1);
				google.charts.setOnLoadCallback(drawChart2);
				google.charts.setOnLoadCallback(drawChart3);
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
						width : 600,
						title : 'Comprender informaci\u00F3n en ingl\u00E9s del Internet',
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
			
					new google.visualization.ComboChart(document.getElementById('chart1_english')).draw(data, options);
			
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
						width : 600,
						title : 'Comprender textos acad\u00E9micos (libros, revistas) en ingl\u00E9s',
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
			
					new google.visualization.ComboChart(document.getElementById('chart2_english')).draw(data, options);
			
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
						width : 600,
						title : 'Comprender libros de esparcimiento escritos en ingl\u00E9s',
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
			
					new google.visualization.ComboChart(document.getElementById('chart3_english')).draw(data, options);
			
				}
				
				function drawChartReportGeneral() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {
						height : 500,
						width : 1000,
						bar: { groupWidth: '85%' },	
						title : 'Ingles',
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
						}
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
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>