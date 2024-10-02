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
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />

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
				<div class='text-center'><h2 class='form-signin-heading'>Panel de administraci&oacute;n</h2></div><hr />
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
				<div class="text-left">
					<div><h4 class='form-signin-heading'>CCT: <?php echo($user -> getSchoolObject() -> getCct()); ?></h4></div>
					<div><h4 class='form-signin-heading'>Escuela: <?php echo($user -> getSchoolObject() -> getName()); ?> </h4></div>
					<div><h4 class='form-signin-heading'>Nivel: <?php echo($user -> getSchoolObject() -> getSchoolLevelObject() -> getName()); ?> </h4></div>
					<div><h4 class='form-signin-heading'>Modalidad: <?php echo($user -> getSchoolObject() -> getSchoolRegionZoneObject() -> getSchoolModeObject() -> getName()); ?> </h4></div>
					<div><h4 class='form-signin-heading'>Región: <?php echo($user -> getSchoolObject() -> getSchoolRegionZoneObject() -> getSchoolRegionObject() -> getName()); ?> </h4></div>
					<div><h4 class='form-signin-heading'>Zona: <?php echo(str_pad($user -> getSchoolObject() -> getSchoolRegionZoneObject() -> getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
				</div>				
				<h3>Instrucciones</h3>
                <br />
                <div class="text-justify" id="instructions">
                    <ul class="custom-bullet">
                        <li>En el menu <a href="../trayectorias.php">Trayectorias escolares</a> se podran consultar los siguientes reportes:</li>
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
                                    <a href="schoolZoneIndex.php">Reporte por Zona Escolar</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="schoolIndexChart.php">Reporte por Escuela</a>
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
							Puedes cambiar tu contraseña en el menu: <a href="changePassword.php">Cambiar Contraseña</a>
						</li>
						<li>
							Puedes actualizar los datos de tu cuenta en el menu: <a href="editUser.php">Actualizar Datos</a>
						</li>
                    </ul>
                    <br />
                </div>
				<form class="form-group" role="form" name="entry" id="entry" action="survey.php" method="post">		
				</form>
			</div>
		</div>
		<!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.min.js"></script>	
		<script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')
		</script>
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
