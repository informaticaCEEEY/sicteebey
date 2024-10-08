<?php
require ('../checkSession.php');

if (!isset($_POST['factor']) || !isset($_POST['indexList'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
} else {
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new FactorController();
	$factorObject = $controller -> getEntityAction($factor);
    
    $indexListController = new IndexListController();
    $indexObject = $indexListController->getEntityAction($indexList);
}

if (!$factorObject || !$indexList) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}
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
		<link rel="icon" href="../img/favicon_.png">
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
		    <?php if($factor == 17 || $factor == 30){ ?>
                <form name="stateIndex" id="stateIndex" action="contextDirector.php" method="post" accept-charset="UTF-8">
                </form>
            <?php }else{ ?>
                <form name="stateIndex" id="stateIndex" action="factorStateDirector.php" method="post" accept-charset="UTF-8">
                    <input type="hidden" id="indexList" name="indexList" value="<?php echo($indexObject -> getId()); ?>"/>
                </form>
            <?php } ?>
            <button class="buttonBack" type="button" onclick="document.forms.stateIndex.submit()"><span>Regresar</span></button>
			<div class='text-center'>
				<h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
			</div>
			<hr />
			<div class='col-xs-12 col-md-12 description' align="center">
                <p><?php echo $factorObject->getDescription() ?></p>
            </div>
			
			<?php 			
			include_once('../functions/functionChartIndexState.php');
			?>

			<div class="row">
				<div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				<?php
				$questionCount = 1;
				for($i=1; $i<=$totalQuestions; $i++){				    
				    echo '<div id="chart'.$i.'" class="col-xs-12 col-md-6 factorGraph" align="center"></div>';
				}
				
				?>
			</div>
			<a class="go-top" href="#">Subir</a>
			<script src="../imports/js/buttonTop.js"></script>
			<script>
				var dataRegion = <?php echo $dataRegion ?>;
				var totalQuestion = <?php echo $totalQuestions ?>;
				<?php echo $textJS;?>;
				google.charts.load("current", {
					packages : ['corechart']
				});
				google.charts.setOnLoadCallback(drawChartRegion);
				<?php echo $chartJS ?>;
				
				function drawChartRegion() {
					var data = google.visualization.arrayToDataTable(dataRegion);
			
					var options = {
						width : 1000,
						height : 600,
						orientation: 'vertical',
						title : 'Media por estado y regi\u00F3n',	
						 bar: { groupWidth: '85%' },					
						legend : {
							position : 'none',
							alignment : 'left',
							textStyle : {
								fontSize : 12
							}
						},
						hAxis : {
							title : 'Valores',
							titleTextStyle : {
								color : 'black',
								fontSize : 12,
								bold : true,
								italic : false
							},
							ticks : [-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]
						},
						vAxis : {
							title : '',
							textPosition: 'out',
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
							width: '75%', 
							height: '70%'
						},						
					};
			
					var chart = new google.visualization.BarChart(document.getElementById("chartRegion"));
					chart.draw(data, options);
			
				}
				
				<?php echo $drawChartJS ?>;
				
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