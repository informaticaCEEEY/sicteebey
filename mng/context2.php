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
		<link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/buttonTop.css" rel="stylesheet">
        <link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/chart.css" rel="stylesheet">
        <link href="../css/factorTable.css" rel="stylesheet">
        <link href="../css/description.css" rel="stylesheet">
        <link href="../css/table.css" rel="stylesheet">
        <link href="../css/projects.css" rel="stylesheet">
        <link href="../css/callout.css" rel="stylesheet">
        <link href="../css/panel.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php
        include ('header.php');
 ?>
		<div class="container-fluid">
			<?php 
			
			$form = new FactorForm();

            echo('<form name="valid" id="valid" action="index.php" method="post">');
            //echo('<input type="hidden" name="project_id" id="project_id" value="'.$entity->getProject().'">');
            echo('</form>');

            include_once('../functions/functionChart2.php');      
			?>
			<div class='text-center'>
				<h2 class='form-signin-heading'>Reporte General</h2>
			</div>
			<hr />
			<div class="row">
				<div class='text-center'>
					<h3 class='form-signin-heading'>Cuestionario de Contexto 2015</h3>
				</div>
				<!--input class="btn btn-lg btn-success" type="button" name="imprimir" value="Imprimir P&aacute;gina" onclick="window.print();"-->
				<div class='col-xs-12 col-md-12 description' align="center">
					<p>
						Las pruebas de contexto exploran factores que pueden influir en el logro educativo de los estudiantes, y explicar sus
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
					<div id="" class="col-xs-12 col-md-2"></div>
					<div id="mediaNull" class="col-xs-12 col-md-10">
						* Factores solo para sexto grado
					</div>
				</div>
			</div>

			<form role="form" name="entry" id="entry" class="form-signin" action="dispatchers/factorDispatcher.php" method="post" accept-charset="UTF-8">
				<?php
                if (isset($_SESSION['flash'])) {
                    echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
                    $_SESSION['flash'] = null;
                }
                $form -> addForm();
				?>
				<br />

				<div class="text-center">
					<div class="col-xs-12 center-block" id="loading" style="display: none"><img src="../img/loading_spinner.gif" />
						<br />
					</div>
					<button type="submit" class="btn btn-lg btn-primary" id="sendForm">
						Enviar
					</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.valid.submit()">
						Cancelar
					</button>
				</div>
			</form>
			<hr />
			<a class="go-top" href="#">Subir</a>
			<div class="row">
				<div class='text-center'>
					<h3 class='form-signin-heading'>Cuestionario de Contexto 2016</h3>
					<br />
				</div>
				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
				    <div class="panel panel-default" id="schoolEnvironment">
                        <div class="panel-heading hsss" role="tab" id="generalHeading1">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo1">
                                Ambiente Escolar </a>
                            </h4>
                        </div>
                        <div id="generalInfo1" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                        El ambiente escolar es un conjunto de factores objetivos y subjetivos que interactúan e 
                                        influyen sobre el organismo del niño, adolescente o el joven en el desarrollo del 
                                        proceso educativo y que contribuyen de forma decisiva a la conservación y fortalecimiento 
                                        del estado de salud y a su formación general integral (Fuentes, 2005). 
                                    </p>                                   
                                    <p>
                                        Este grupo cinco reactivos indagan la percepción que tiene el estudiante de su 
                                        interacción con sus demás compañeros incluyendo la percepción de conductas de aceptación 
                                        o agresión.
                                    </p>
                                </div>
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartSchoolEnvironment1" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                    <div id="chartSchoolEnvironment2" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="panel panel-default" id="interactionTeacher">
						<div class="panel-heading" role="tab" id="generalHeading2">
							<h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo2">
							    Relaci&oacute;n Maestro-Estudiante </a>
						    </h4>
						</div>
						<div id="generalInfo2" class="panel-collapse collapse" role="tabpanel">
							<div class="panel-body">
							    <div class="bs-callout bs-callout-default">
                                    <p>
                                        Son procesos de construcción e intercambio de conocimientos, conductas y procesos de 
                                        pensamiento entre quienes conviven en un salón de clases. Las interacciones educativas 
                                        significativas deben impulsar el enriquecimiento intelectual, social y cultural, tanto 
                                        de los estudiantes como de los maestros, al tiempo que permitan identificar y fomentar 
                                        los intereses personales y las motivaciones intrínsecas de los alumnos (SEP, 2016).
                                    </p>                                    
                                    <p>
                                        Estos cinco reactivos indagan la percepción del alumno sobre las actitudes y conductas 
                                        de los docentes hacia los estudiantes durante las actividades escolares relacionadas 
                                        con el proceso de enseñanza aprendizaje, en función de la motivación escolar, 
                                        reconocimiento, trato, etc.
                                    </p>
                                </div>
								<div id="reportGeneral2016" class="col-xs-12 col-md-12">
									<div id="chartInteractionTeacher" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="panel panel-warning" id="foodConsumption">
                        <div class="panel-heading" role="tab" id="generalHeading3">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo3">
                                Hábitos Alimentarios </a>
                            </h4>
                        </div>
                        <div id="generalInfo3" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                        Los hábitos alimentarios se definen como el conjunto de conductas adquiridas por un 
                                        individuo, por la repetición de actos en cuanto a la selección, la preparación y el 
                                        consumo de alimentos. Asimismo las bebidas se definen como todos aquellos líquidos que 
                                        ingieren los seres humanos, incluida el agua. (Rivera, J; Muñoz, O.; Rosas, M.; Aguilar, 
                                        C.; Popkin, B. & Willett, W., 2008). Estos elementos se relacionan principalmente con 
                                        las características sociales, económicas y culturales de una población o región 
                                        determinada (DOF, 2013). 
                                    </p>
                                    <p>
                                        Se muestran un conjunto de siete reactivos que refieren al tipo de alimento que consume 
                                        semanalmente y su frecuencia, en referencia alimentos pertenecientes a los tres grupos: 
                                        1. Frutas y verduras, 2. Cereales y 3. Leguminosas y alimentos de origen animal; así 
                                        como alimentos procesados.<br />
                                        Adicionalmente se incluyen cinco reactivos de la frecuencia de consumo por día de 
                                        diferentes tipos de bebidas, naturales o procesadas y agua.
                                    </p>
                                </div>
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartFoodConsumption1" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                    <div id="chartFoodConsumption" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                    <div id="chartDrinksConsumption" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-danger" id="familyContext">
                        <div class="panel-heading" role="tab" id="generalHeading5">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo5">
                                Composición y Factores Socioeconómicos (Contexto Familiar)</a>
                            </h4>
                        </div>
                        <div id="generalInfo5" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                        En el contexto familiar intervienen cuatro dimensiones: a) composición, historia y factores 
                                        socioeconómicos, b) la dimensión afectiva-emocional, c) la dimensión referente al 
                                        desarrollo de los aprendizajes y d) la dimensión relativa a la organización y la 
                                        estabilidad (Parra, J.; Gomariz, M. & Sánchez, M., 2011). 
                                    </p>
                                        Este grupo de reactivos indaga aspectos  relacionados con el lugar dónde vive el alumno que 
                                        incluye: personas con las que vive, si realiza alguna actividad laboral, el transporte que 
                                        usa para ir a la escuela y la percepción del alumno sobre las actitudes y conductas de sus 
                                        padres en relación a la afectividad y apoyo emocional hacia él mismo.
                                    </p>
                                </div>
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartFamilyContext1" class="col-xs-12 col-md-6 chartCenter" align="center"></div>
                                    <div id="chartFamilyContext2" class="col-xs-12 col-md-6 chartCenter" align="center"></div>
                                    <div id="chartFamilyContext3" class="col-xs-12 col-md-6 chartCenter"></div>
                                    <div id="chartFamilyContext4" class="col-xs-12 col-md-6 chartCenter"></div>
                                    <div id="chartFamilyContext5" class="col-xs-12 col-md-6 chartCenter"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-danger" id="affectiveEnvironment">
                        <div class="panel-heading" role="tab" id="generalHeading6">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo6">
                                Ambiente Afectivo-Emocional (Contexto Familiar) </a>
                            </h4>
                        </div>
                        <div id="generalInfo6" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                        La función afectiva de la familia es amplia y compleja, incluye las siguientes 
                                        dimensiones: las emociones, inteligencia emocional, sentimientos y aspectos afectivos 
                                        de la comunicación familiar.  Estos componentes deben manifestarse de manera favorable, 
                                        porque así influyen en la estabilidad, así como en la armonía individual y del 
                                        mencionado grupo social. (Pi, A. & Cobián, A., 2009).
                                    </p>
                                </div>
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartAffectiveEnvironment1" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                    <div id="chartAffectiveEnvironment2" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                    <div id="chartAffectiveEnvironment3" class="col-xs-12 col-md-6 chartCenter" align="center"></div>
                                    <div id="chartAffectiveEnvironment4" class="col-xs-12 col-md-6 chartCenter" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-danger" id="homework">
                        <div class="panel-heading" role="tab" id="generalHeading7">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo7">
                                Organización y Estabilidad (Contexto Familiar) </a>
                            </h4>
                        </div>
                        <div id="generalInfo7" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                        Trabajo no remunerado que los miembros del hogar realizan en actividades productivas 
                                        para la generación de servicios destinados a la satisfacción de sus necesidades. 
                                        Incluye: Alimentación, limpieza y mantenimiento de la vivienda, limpieza y cuidado de 
                                        la ropa y calzado, compras y administración del hogar, cuidados y apoyo. (INEGI, 2014)
                                    </p>
                                    <p>
                                        Actividades que realiza el alumno en el lugar donde vive y que tienen que ver con el 
                                        cuidado y mantenimiento de la casa, las pertenencias y los miembros de la familia, así 
                                        como con la labor que realizan los padres.
                                    </p>
                                </div>    
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartHomework" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-success" id="mayanLanguage">
                        <div class="panel-heading" role="tab" id="generalHeading8">
                            <h4 class="panel-title" ><a data-toggle="collapse" data-parent="#accordion" data-target="#generalInfo8">
                                Lengua Maya </a>
                            </h4>
                        </div>
                        <div id="generalInfo8" class="panel-collapse collapse" role="tabpanel">
                            <div class="panel-body">
                                <div class="bs-callout bs-callout-default">
                                    <p>
                                       Grado en que el estudiante usa la lengua maya; además, como una lengua se vincula con aspectos como un territorio común, el parentesco sanguino y las costumbres, por lo anterior se considera que este factor tiene una fuerte vinculación con la identidad étnica (Chihu-Amparán, 2002). 
                                    </p>
                                    <p>
                                        Conocimiento y uso de la lengua maya por parte del alumno en el contexto familiar y escolar: si habla o sabe hablar maya y con quiénes lo habla.
                                    </p>
                                </div>                                
                                <div id="reportGeneral2016" class="col-xs-12 col-md-12">
                                    <div id="chartMayanLanguage" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<?php
            include ('../footer.php');
 ?>
		<!-- /container -->

		<script>
		    var dataReportGeneral = <?php echo $dataReportGeneral; ?>;     
		    var dataInteractionTeacher = <?php echo $dataInteractionTeacher; ?>;       
            var dataSchoolEnvironment1 = <?php echo $dataSchoolEnvironment1; ?>;
            var dataSchoolEnvironment2 = <?php echo $dataSchoolEnvironment2; ?>;
            var dataFoodConsumption1 = <?php echo $dataFoodConsumption1; ?>;
            var dataFoodConsumption = <?php echo $dataFoodConsumption; ?>;
            var dataDrinksConsumption = <?php echo $dataDrinksConsumption; ?>;
            var dataFamilyContext1 = <?php echo $dataFamilyContext1; ?>;
            var dataFamilyContext2 = <?php echo $dataFamilyContext2; ?>;
            var dataFamilyContext3 = <?php echo $dataFamilyContext3; ?>;
            var dataFamilyContext4 = <?php echo $dataFamilyContext4; ?>;
            var dataFamilyContext5 = <?php echo $dataFamilyContext5; ?>;
            var dataAffectiveEnvironment1 = <?php echo $dataAffectiveEnvironment1; ?>;
            var dataAffectiveEnvironment2 = <?php echo $dataAffectiveEnvironment2; ?>;
            var dataAffectiveEnvironment3 = <?php echo $dataAffectiveEnvironment3; ?>;
            var dataAffectiveEnvironment4 = <?php echo $dataAffectiveEnvironment4; ?>;
            var dataHomework = <?php echo $dataHomework; ?>;
            var dataMayanLanguage = <?php echo $dataMayanLanguage; ?>;
            var ticks = <?php echo $ticks; ?>;
		</script>        
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script src="../lib/jquery/jquery.validate.js"></script>
		<script type="text/javascript" src="../imports/js/factorValidate.js"></script>
		<script src="../lib/jquery/jquery.plainoverlay.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')
		</script>
		<script src="../imports/js/buttonTop.js"></script>
		<script src="../imports/js/chartGeneralReport.js"></script>
		<script src="../lib/bootstrap/bootstrap.min.js"></script>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../lib/bootstrap/ie10-viewport-bug-workaround.js"></script>		
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
	</body>
</html>
