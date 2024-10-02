<?php
require ('../checkSession.php');
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

		<title>Cuestionarios de Contexto</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/autocomplete.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/chart.css">		
		<link rel="stylesheet" href="../css/factorTable.css">
		<link rel="stylesheet" href="../css/description.css">
		<link rel="stylesheet" href="../css/table.css">		
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php include('header.php'); ?>

		<div class="container-fluid">
				<?php 
				
				$schoolController = new SchoolController();
                $school = $schoolController->getEntityAction($user->getSchool());
                            
                if(!$school){
                    $_SESSION['flash'] = 'La Clave del Centro de Trabajo no existe';
                    echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    exit;     
                }

				$form = new IndexListForm();				

				echo('<form name="valid" id="valid" action="index.php" method="post">');
				//echo('<input type="hidden" name="project_id" id="project_id" value="'.$entity->getProject().'">');
				echo('</form>');										
                                
                include_once('functionChartIndexSchool.php');
				$titleChart = "'Media por \u00EDndice'";
                
				?>
			<form name="schoolFactor" id="schoolFactor" action="index.php" method="post" accept-charset="UTF-8"></form>
			<button class="buttonBack" type="button" onclick="document.forms.schoolFactor.submit()"><span>Regresar</span></button>
		    <?php 
		    
		    if($dataReportGeneral == FALSE){
		        $_SESSION['flash'] = 'La escuela con CCT: '. $school->getCct() .' no se encuentra disponible por falta de datos';               
                echo('<script>document.forms.schoolFactor.submit()</script>');
		    }
		    
		    ?>		    
			<div class='text-center'>
				<h2 class='form-signin-heading'>Reporte por Escuela</h2>
			</div>
			<br />				
			<div class="col-xs-12 col-md-12">
				<div><h4 class='form-signin-heading'>CCT: <?php echo($school -> getCct()); ?></h4></div>
				<div><h4 class='form-signin-heading'>Escuela: <?php echo($school -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading col-md-3 text-left'>Nivel: <?php echo($school -> getSchoolLevelObject() -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading col-md-3'>Modalidad: <?php echo($school -> getSchoolModeObject() -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading col-md-3'>Regi&oacute;n: <?php echo($school -> getSchoolRegionObject() -> getName()); ?> </h4></div>
				<div><h4 class='form-signin-heading col-md-3'>Zona Escolar: <?php echo(str_pad($school->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
			</div>
			<div class="col-xs-12 col-md-12">
				<hr />	
			</div>					
			<div class="row">
				<div class='text-center'><h3 class='form-signin-heading'>Cuestionario de Contexto 2015</h3></div>
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>Las pruebas de contexto exploran factores que pueden influir en el logro educativo de los estudiantes, y explicar sus 
						diferentes resultados, de aqu&iacute; la importancia del presente estudio que tiene como fin apoyar con instrumentos y 
						resultados v&aacute;lidos y confiables a los principales actores educativos, investigadores y todo aquel interesado en 
						mejorar la calidad educativa.
					</p>
					<p>
						La delimitaci&oacute;n del contenido es el resultado de una revisi&oacute;n de los cuestionarios de contexto aplicados en 
						estudiantes de Educaci&oacute;n B&aacute;sica del estado de Yucat&aacute;n, pero desde una perspectiva de m&eacute;todos, 
						t&eacute;cnicas y teor&iacute;as que implican la medici&oacute;n de variables psicol&oacute;gicas y educativas.	
					</p>
					<p>
						De esta manera se utiliz&oacute; un &iacute;ndice cuya unidad de medida se le denomina escala logit, y puede tener 
						valores desde puntuaciones muy bajas o negativas hasta valores muy altos o positivos, &plusmn;&infin;; de tal forma que los valores 
						negativos indican menor intensidad o menos del factor medido por el conjunto de &iacute;tems; por el contrario, valores altos 
						indican mayor intensidad o m&aacute;s cuant&iacute;a de dicho factor (Mart&iacute;nez-Arias &amp; Hern&aacute;ndez-LLoreda, 2014; Nering 
						&amp; Ostini, 2011; Tejeda-Rojas, 1999).
					</p>
				</div>
				<div id="reportGeneral" class="col-xs-12 col-md-12">
					<div id="chartState" class="col-xs-12 col-md-12 chartCenter" align="center"></div>				
				</div>
			</div>
			<form role="form" name="entry" id="entry" class="form-signin" action="dispatchers/indexListDispatcher.php" method="post" accept-charset="UTF-8">
				<?php
				$form -> contextSchoolForm($school->getCct());
                
                if (isset($_SESSION['error'])) {
                    echo('<label class="formError">' . $_SESSION['error'] . '</label>');
                    $_SESSION['error'] = null;
                }
                
				?>
				<br />
					
				<div class="text-center">
					<div class="col-xs-12 center-block" id="loading" style="display: none"><img src="../img/loading_spinner.gif" /><br /></div> 
					<button type="submit" class="btn btn-lg btn-primary" id="sendForm">Enviar</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.schoolFactor.submit()">Cancelar</button>
				</div>
			</form>
		</div>
		<!-- /container -->
		<?php include('../footer.php'); ?>
        <script>
            var dataReportGeneral = <?php echo $dataReportGeneral; ?>;
            var ticks = <?php echo $ticks; ?>;
            var titleChart = <?php echo $titleChart; ?>;
        </script>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
		<script>window.jQuery || document.write('<script src="../lib/jquery/jquery.min.js"><\/script>')</script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="../lib/jquery/jquery.validate.js"></script>
		<script src="../imports/js/indexListSchoolValidate.js"></script>
		<script src="../imports/js/buttonTop.js"></script>
		<script src="../lib/jquery/jquery.plainoverlay.min.js"></script>					
		<script src="../lib/bootstrap/bootstrap.min.js"></script>
		<script src="../imports/js/chartGeneralReportDirector.js"></script>
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
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
