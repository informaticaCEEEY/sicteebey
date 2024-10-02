<?php
include ('../checkSession.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="icon" href="../img/favicon_.png">

	<title>Centro de Evaluaci&oacute;n Educativa del Estado de Yucat&aacute;n</title>

	<!-- Bootstrap core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">

	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<!--link href="../css/jumbotron.css" rel="stylesheet"-->
	<link href="../css/idaepyResult.css" rel="stylesheet">
	<link href="../css/footer.css" rel="stylesheet">
	<link href="../css/header.css" rel="stylesheet">
	<link href="../css/buttonTop.css" rel="stylesheet">
	<!-- <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" /> -->

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<?php
	include ('header.php');
	include_once('getInfoChart.php');
	?>

	<div class="container">
		<?php
		if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
			echo ('<div class="alert alert-success" role="alert">');
			echo ('<label>' . $_SESSION['message'] . '</label>');
			echo('<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>');
			echo ('</div>');
			unset($_SESSION['message']);
		}

		?>
		<div class="text-center">
			<h3>Resultados del Alumno</h3>
		</div>
		<form name="savePDFForm" id="savePDFForm" class="form-signin" action="resultadosPDF.php" method="post" accept-charset="UTF-8">
			<input type="hidden" id="urlmathsChart" name="urlmathsChart" />
			<input type="hidden" id="urlspanishChart" name="urlspanishChart" />
			<input type="hidden" id="urlsciencesChart" name="urlsciencesChart" />
			<!-- <button type="submit" class="btn btn-info">Imprimir Resultados</button> -->
			<button type="button" id="downloadBtn" class="buttonReport pull-right"><span class="glyphicon glyphicon-download-alt"></span> Imprimir Resultados</button>
		</form>
		<div class="divDataSchool col-xs-12 col-sm-12">
			<label>Folio IDAEPY:</label> <?php echo(str_pad($user->getFolio(), 6, "0", STR_PAD_LEFT)); ?>
		</div>
		<div class="divSchool col-xs-12 col-sm-12">
			<h4>Datos Generales de la Escuela</h4>
			<div class="divDataSchool col-xs-12 col-sm-3">
				<label>CCT:</label> <?php echo($school->getCct()); ?>
			</div>
			<div class="divDataSchool col-xs-12 col-sm-9">
				<label>Nombre de la Escuela:</label> <?php echo(mb_convert_case($school->getName(), MB_CASE_TITLE, "UTF-8")); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Nivel:</label> <?php echo($school->getSchoolLevelObject()->getName()); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Modalidad:</label> <?php echo($school->getSchoolRegionZoneObject()->getSchoolModeObject()->getName()); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Región:</label> <?php echo($school->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName()); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Zona:</label> <?php echo($school->getSchoolRegionZoneObject()->getZone()); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Turno:</label> <?php echo($school->getSchoolScheduleObject()->getName()); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Municipio:</label> <?php echo(mb_convert_case($school->getTownObject()->getName(), MB_CASE_TITLE, "UTF-8")); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Localidad:</label> <?php echo(mb_convert_case($school->getLocality(), MB_CASE_TITLE, "UTF-8")); ?>
			</div>
			<div class="divDataSchool col-xs-6 col-sm-3">
				<label>Grado de Marginación:</label> <?php echo($school->getSchoolMarginalizationObject()->getName()); ?>
			</div>
			<div class="divDataSchool col-xs-12 col-sm-12">
				<hr />
			</div>
		</div>

		<div id="subjectDiv" class="divStudent col-xs-12 col-sm-12">
				<?php
				foreach($subjectList as $subject){

					echo('<div id="dataDiv" class="col-xs-12 col-md-12">');

					switch ($subject->getId()) {
						case 1:
						$subjectAchievement = $idaepyAchievement[0]->getAchievementMath();
						break;
						case 2:
						$subjectAchievement = $idaepyAchievement[0]->getAchievementSpanish();
						break;
						case 3:
						$subjectAchievement = $idaepyAchievement[0]->getAchievementScience();
						break;
						default:
						$subjectAchievement = 0;
						break;
					}

					$achievementDescriptionController = new AchievementDescriptionController();
					$where = 'e.achievement = :achievement AND e.subject = :subject AND e.grade = :grade AND e.year = 2019';
					$whereFields = array('achievement' => $subjectAchievement, 'grade' => $user->getGrade(),
					'subject' => $subject->getId());
					$achievementDescription = $achievementDescriptionController->displayByAction($where, $whereFields);

					if($subject->getId() == 1){
						$style = 'class="tab-pane fade in active"';
					}else{
						$style = 'class="tab-pane fade"';
					}
					echo('<div id="'.$subject->getAlias().'">');
					//Titulo de la pestaña
					echo('<h3>'.$subject->getName().'</h3>');
					echo('<div class="divState col-xs-12 col-md-12">');
					//echo('<h4>Resultados</h4>');
					echo("<div class='chart'>");
					echo('<canvas id="'.$subject->getAlias().'Chart" width="400" height="400"></canvas>');
					echo('</div>');
					echo('</div>');
					echo('<div class="divStudent col-xs-12 col-md-12">');
					//echo('<h4>Resultados del Alumno</h4>');
					echo('<p><b>Nivel de Logro: </b>');
					echo('<a id="achievement'.$subjectAchievement.'">'.$achievementDescription[0]->getAchievementObject()->getName().'</a>');
					echo('</p>');
					echo('<p><b>Habilidades del Alumno: </b></p>');
					echo('<ul>');
					foreach($achievementDescription as $achievementD){
						echo('<li>'. $achievementD->getDescription() .'</li>');
						//echo('<p><span class="glyphicon glyphicon-menu-right"></span>'. $achievementD->getDescription() .'</p>');
					}
					echo('</ul>');
					echo('</div>');
					echo('</div>'); //Fin Div Subject
					echo('</div>');
				}
				?>
		</div>
	</div>
	<!-- /container -->

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> -->
	<script>
	window.jQuery || document.write('<script src="../lib/jquery/jquery.min.js"><\/script>')
	</script>
	<script src="../lib/bootstrap/bootstrap.min.js"></script>
	<script src="../lib/node_modules/chart.js/dist/Chart.js"></script>
	<script src="../lib/node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.js"></script>
	<script src="../lib/node_modules/chartjs-plugin-stacked100/src/index.js"></script>
	<script src="../lib/node_modules/chartjs-plugin-annotation/chartjs-plugin-annotation.js"></script>
	<!--script src="../imports/js/accordion.js"></script-->
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<script src="../lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
	<script>

	const totalizer = {
		id: 'totalizer',

		beforeUpdate: chart => {
			let totals = {}
			let utmost = 0

			chart.data.datasets.forEach((dataset, datasetIndex) => {
				if (chart.isDatasetVisible(datasetIndex)) {
					utmost = datasetIndex
					dataset.data.forEach((value, index) => {
						totals[index] = (totals[index] || 0) + value
					})
				}
			})

			chart.$totalizer = {
				totals: totals,
				utmost: utmost
			}
		}
	}

	function done(){
		//alert("haha");
		var urlmathsChart = mathsChart.toBase64Image();
		var urlspanishChart = spanishChart.toBase64Image();
		var urlsciencesChart = sciencesChart.toBase64Image();
		document.getElementById("urlmathsChart").value = urlmathsChart;
		document.getElementById("urlspanishChart").value = urlspanishChart;
		document.getElementById("urlsciencesChart").value = urlsciencesChart;
	}

	<?php echo $charts1; ?>;
	<?php echo $charts2; ?>;
	<?php echo $charts3; ?>;

	</script>
	<script type="text/javascript">
		jQuery("#downloadBtn").on("click", function() {
			// submit the form
			jQuery('#savePDFForm').submit();
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
<?php
include ('../footer.php');
?>
</body>
</html>
