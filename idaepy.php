<?php
include ('checkSession.php');
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
		<link rel="icon" href="img/favicon_.png">

		<title>IDAEPY</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/projects.css" rel="stylesheet">
		<link href="css/projectsTable.css" rel="stylesheet">
		<link href="css/buttonTop.css" rel="stylesheet">
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
		<div class="container">

			<h2 class="text-center">Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán</h2>
			<hr />
			<div class="projects">
				<p>
					El Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY) es una prueba estandarizada de
					opción múltiple, criterial, alineada al currículo; creada por la Secretaría de Educación del Gobierno del Estado de
					Yucatán (SEGEY) a través del Centro de Evaluación Educativa del Estado de Yucatán (CEEEY), para conocer el nivel de
					dominio de los alumnos en los Aprendizajes Esperados de las diferentes asignaturas que integran el Plan y Programa de
					Estudios 2011.
				</p>
				<p>
					La planeación, diseño, elaboración e implementación de la prueba integra diferentes comités con funciones específicas y
					perfiles diferentes como: docentes, profesionales en educación, psicología, estadística, entre otros. Todos vinculados
					mediante un software administrativo (Sistema de Gestión de Reactivos) creado por el CEEEY para desarrollar la prueba.
				</p>
				<p>
					La prueba mide los conocimientos y habilidades de los alumnos de tercero a sexto año, adquiridos durante el ciclo escolar
					de educación básica en las asignaturas de Español, Matemáticas, Ciencias Naturales, Entidad donde vivo, Historia,
					Geografía, Formación Cívica y Ética.
				</p>
				<p>
					Los reactivos que componen la prueba se crean a partir de los contenidos o temas derivados de los Aprendizajes
					Esperados que conforman el ciclo escolar que cursa el niño, especificados en el Plan y Programas de Estudios
					publicados por la Secretaría de Educación Pública. Por lo tanto, la cantidad de reactivos que el niño responde
					depende del grado que cursa y del ciclo escolar.
				</p>
				<h3 class="text-center">Aplicación y Análisis de los Resultados</h3>
				<div class="projects">
					<p>
						Se aplica cada año al final del quinto bimestre del ciclo escolar a todos los alumnos de escuelas primarias
						públicas y privadas del Estado de Yucatán.
					</p>
					<p>
						El docente de aula es quien recibe los cuadernillos, las hojas de respuesta y las instrucciones para aplicar
						la prueba a sus alumnos.
					</p>
					<p>
						Los cuadernillos y las hojas de respuesta de los alumnos son recibidas en el CEEEY, se digitalizan sus respuestas
						mediante un lector óptico y son analizadas con programas computacionales especializados.
					</p>
					<p>
						Posteriormente, los supervisores escolares reciben un análisis más detallado y una capacitación en el <u>uso y la
						interpretación de los resultados</u> por parte del Departamento de Análisis y Difusión de la información del CEEEY.
					</p>
				</div>
			</div>
		</div>
		<a class="go-top" href="#">Subir</a>
		<script src="lib/jquery/jquery.min.js"></script>
		<script src="imports/js/buttonTop.js"></script>
		<script src="lib/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="http://latex.codecogs.com/latexit.js"></script>
		<!-- /container -->
		<?php
		include ('footer.php');
		?>
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
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
