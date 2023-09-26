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

		<title>Trayectorias Escolares</title>

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

			<h2 class="text-center">Trayectorias escolares</h2>
			<hr />
			<div class="projects">
				Entre las acciones planteadas en el Plan Estatal de Desarrollo 2012-2018 para atender la calidad en la educaci&oacute;n b&aacute;sica
				del estado de Yucat&aacute;n, se propone fortalecer la articulaci&oacute;n de la educaci&oacute;n, implementando acciones que
				contribuyan a la permanencia de los alumnos en el sistema educativo, la inclusi&oacute;n de las tecnolog&iacute;as de la informaci&oacute;n
				y acciones como la abolici&oacute;n del rezago educativo que permitan el logro educativo de los ni&ntilde;os y j&oacute;venes del estado
				(Consejo Estatal de Planeaci&oacute;n de Yucat&aacute;n, 2013).
			</div>
			<h3 class="text-center">Objetivo</h3>
			<div class="projects">
				Identificar el comportamiento y los resultados de los alumnos de cinco cohortes durante su trayectoria escolar en educaci&oacute;n
				b&aacute;sica y utilizar la informaci&oacute;n obtenida para ser analizada y sirva de punto de partida para futuras investigaciones
				educativas.
			</div>
			<h3 class="text-center">Proyecto</h3>
			<div class="projects">
				Ante la necesidad de generar indicadores m&aacute;s precisos y reales sobre el tr&aacute;nsito de los alumnos en educaci&oacute;n b&aacute;sica,
				a diferencia de los obtenidos a trav&eacute;s de la estad&iacute;stica 911, era primordial el contar con una base de datos por alumno y
				su comportamiento a&ntilde;o con a&ntilde;o a lo largo de su trayectoria escolar.
				<br />
				<br />
				Para esto, se utilizaron las bases de control escolar que genera el Departamento de Registro y Certificaci&oacute;n de la SEGEY.
				<br />
				<br />
				En Yucat&aacute;n existe poca informaci&oacute;n sobre los comportamientos que presentan los alumnos a trav&eacute;s de su tr&aacute;nsito por el
				sistema educativo en educaci&oacute;n b&aacute;sica, estos comportamientos est&aacute;n &iacute;ntimamente relacionados y conforman las
				llamadas &#8220;trayectorias escolares&#8221;.
				<br />
				<br />
				Las <i>trayectorias escolares</i> son el resultado del seguimiento de los alumnos a trav&eacute;s de diferentes ciclos escolares. Este
				seguimiento se traduce en indicadores de aprobaci&oacute;n, eficiencia terminal, rezago educativo y reprobaci&oacute;n escolar.
				<br />
				<br />
				La trayectoria escolar ideal representa a los alumnos de determinada generaci&oacute;n que son promovidos al siguiente grado en forma
				ininterrumpida hasta concluir el nivel educativo de referencia.
				<br />
				<br />
				Los alumnos que cursan grados inferiores a los ideales se dividen en dos grupos: rezago ligero (los que cursan el grado inmediato inferior al ideal) y
				rezago grave (aquellos que se encuentran atrasados por al menos dos grados escolares) (Panorama Educativo de M&eacute;xico, 2012).
				<br />
				<br />
			</div>			
			<div class="table-responsive">
				<table class="table table-bordered col-xs-12 col-md-12">
					<thead>
						<tr class="success">
							<th class="col-xs-2 col-md-2">Indicador</th>
							<th class="col-xs-8 col-md-8">Definici&oacute;n</th>
							<th class="col-xs-2 col-md-2">Formula</th>
						</tr>
					</thead>
					<tbody>
						<tr class="tableText">
							<td>Aprobados</td>
							<td class="tableText2">Representa al total de alumnos que despu&eacute;s de cursar y finalizar el grado escolar (g), puedan ingresar al 
								siguiente ya que han cumplido con los requisitos establecidos para ello.</td>
							<td><div lang="latex">\small \sum AlumnosAprobados_{g}</div></td>
						</tr>
						<tr class="tableText">
							<td>Eficiencia Intragrado</td>
							<td class="tableText2">Representa el porcentaje de alumnos que aprueban el grado escolar del total de alumnos inscritos en el mismo grado (g).</td>
							<td><div lang="latex">\small \frac{AlumnosAprobados_{g}}{AlumnosInscritos_{g}} x 100</div></td>
						</tr>
						<tr class="tableText">
							<td>Eficiencia Intergrado</td>
							<td class="tableText2">Representa el porcentaje de alumnos que se inscriben al siguiente grado (g+1) escolar del total de alumnos aprobados 
								del grado escolar (g).</td>
							<td><div lang="latex">\small \frac{AlumnosInscritos_{g+1}}{AlumnosAprobados_{g}} x 100</div></td>
						</tr>
						<tr class="tableText">
							<td>Eficiencia de la Cohorte</td>
							<td class="tableText2">Representa el porcentaje de alumnos que aprueban el grado escolar ideal (g) respecto al total de alumnos de la cohorte 
								inicial (c).</td>
							<td><div lang="latex">\small \frac{AlumnosAprobados_{g}}{AlumnosInscritos_{c}} x 100</div></td>
						</tr>
						<tr class="tableText">
							<td>Rezago Ligero</td>
							<td class="tableText2">Representa el porcentaje de alumnos inscritos un grado escolar inmediato por debajo (g-1) del trayecto ideal de la 
								cohorte respecto al total de alumnos de la cohorte inicial (c).</td>
							<td><div lang="latex">\small \frac{AlumnosInscritos_{g-1}}{AlumnosInscritos_{c}} x 100</div></td>
						</tr>
						<tr class="tableText">
						<td>Rezago Grave</td>
							<td class="tableText2">Representa el porcentaje de alumnos inscritos dos o m&aacute;s grados escolares (g&ge;2) por debajo del trayecto ideal de la 
								cohorte respecto al total de alumnos de la cohorte inicial (c).</td>
							<td><div lang="latex">\small \frac{\sum AlumnosInscritos_{g\geq 2}}{AlumnosInscritos_{c}} x 100</div></td>
						</tr>
					</tbody>
				</table>
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
