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
		<link rel="icon" href="../img/logog.ico">

		<title>Centro de Evaluaci&oacute;n Educativa del Estado de Yucat&aacute;n</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<!--link href="../css/jumbotron.css" rel="stylesheet"-->
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
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
        ?>

		<div class="container">
			<div class="col-xs-12 text-center">
				<div class='text-center'>
					<h2 class='form-signin-heading'>Panel de administraci&oacute;n</h2>
				</div>
				<hr />
				<?php
                if (isset($_SESSION['flash'])) {
                    echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
                    unset($_SESSION['flash']);
                }

                if (isset($_SESSION['message'])) {
                    echo('<label class="formError">' . $_SESSION['message'] . '</label>');
                    unset($_SESSION['message']);
                }
				?>
				<h3>Instrucciones</h3>
				<br />
				<div class="text-justify" id="instructions">
					<ul class="custom-bullet">
						<li>
							En el menu <a href="../trayectorias.php">Trayectorias escolares</a> se podran consultar los siguientes reportes:
						</li>
						<ul>
							<li><a href="general.php">Reporte General</a></li>
							<li><a href="gender.php">Reporte por Sexo</a></li>
							<li><a href="mode.php">Reporte por Modalidad</a></li>
							<li><a href="generalRegion.php">Reporte por Región</a></li>
							<li><a href="generalZone.php">Reporte por Zona</a></li>
							<li><a href="generalSchool.php">Reporte por Escuela</a></li>
						</ul>
						<li>
							En el menu <a href="../contexto.php">Cuestionarios de Contexto</a> se podran consultar los siguientes reportes:
						</li>
						<ul>
							<li>
								Cuestionarios de Contexto de Alumnos
							</li>
							<ul>
								<li>
									<a onclick="document.forms.context16.submit()" style="cursor:pointer;">Contexto 2015 y 2016</a>
								</li>
							</ul>
							<ul>
								<li>
									<a onclick="document.forms.context17.submit()" style="cursor:pointer;">Contexto 2017</a>
								</li>
							</ul>
						</ul>
						<ul>
                            <li>
                                Cuestionarios de Contexto de Docentes y Directores
                            </li>
                            <ul>
                                <li>
                                    <a href="contextDirector.php">Reporte General</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="contextZoneDirector.php">Reporte por Zona Escolar</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="contextSchoolDirector.php">Reporte por Escuela</a>
                                </li>
                            </ul>
                        </ul>
						<li>
							En el menu <a href="../idaepy.php">IDAEPY</a> se podran consultar lo siguiente:
						</li>
						<ul>
							<li>
								<a href="idaepySchoolExcel.php">Reporte</a>
							</li>
							<li>
								<a href="idaepySchoolPDF.php">Cartel</a>
							</li>
						</ul>
						<li>
							El menu <a href="#">Catalogos</a> contiene:
						</li>
						<ul>
							<li>
								<a href="adminSchools.php">Escuelas:</a> se realizar&aacute; la modificaci&oacute;n
								de los datos las escuelas registradas en el sistema.
							</li>
						</ul>
						<ul>
							<li>
								<a href="adminNews.php">Eventos:</a> se realizar&aacute; la creaci&oacute;n, eliminaci&oacute;n o modificaci&oacute;n
								de los eventos que aparecen en la pagina principal.
							</li>
						</ul>
						<ul>
							<li>
								<a href="adminUsers.php">Usuarios:</a> se realizar&aacute; la creaci&oacute;n o modificaci&oacute;n de los usuarios
								registrados en el sistema.
							</li>
						</ul>
					</ul>
					<br />
				</div>
				<form class="form-group" role="form" name="entry" id="entry" action="survey.php" method="post"></form>
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
		<!--script src="../imports/js/accordion.js"></script-->
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
		<?php
            include ('../footer.php');
 ?>
	</body>
</html>
