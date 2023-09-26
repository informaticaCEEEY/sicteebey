<?php

include('checkSession.php');

require_once ('lib/genius/Core/gosConfig.inc.php');
include_once ('imports/php/auxiliarFunctions/today.php');
include_once ('imports/php/Autoloader.class.php');
include_once ('imports/php/auxiliarFunctions/cohorte.php');
Autoloader::setup();

if (!isset($_SESSION)) {
	session_name('c3E3y_Tr4Y3Ct0r14S');		
	session_start();	
}

$userController = new UsersController();
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
		<meta name="google-site-verification" content="ZVSr7fEk_KKefqY98iAdi-0s6E1Fzpadtft2vAjtM0I" />
		<meta name="keywords" content="sicteebey,indicadores,idaepy,trayectorias,contexto">
		<link rel="icon" href="img/favicon_.png">
		<title>Centro de Evaluaci&oacute;n Educativa del Estado de Yucat&aacute;n</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
		<!-- Custom styles for this template -->		
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<link href="css/carousel2.css" rel="stylesheet">
		<link href="css/buttonTop.css" rel="stylesheet">
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>

		<?php 
		
		include('header.php');
		
		$newsController = new NewsController();	
		$date = new DateTime('', new DateTimeZone('	America/Mexico_City'));
		$order = 'publication_date DESC';
		$where = "status = :status AND type = :type AND publication_date <= :publication_date";
		$whereVal = array('status' => 1, 'type' => 1, 'publication_date' => $date->format('Y-m-d H:i:s'));
		$newsList = $newsController->displayBy2Action('0', '5', $order, $where, $whereVal);
		$totalNews = count($newsList);
		?>
		<div class="container">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
	      <!-- Indicators -->
	      <ol class="carousel-indicators">
		   	<?php
		   	
		   	for($i=0; $i<$totalNews; $i++){
		   		if($i == 0){
		   			echo('<li data-target="#myCarousel" data-slide-to="' . $i . '" class="active"></li>');
		   		}else{
		   			echo('<li data-target="#myCarousel" data-slide-to="' . $i . '"></li>');
		   		}		   
		   	}	      	
	      	?>
	      </ol>
	      <div class="carousel-inner" role="listbox">
	      <?php
	      $countNews = 0;
	      	foreach($newsList as $news){
	      		if($countNews == 0){
	      			$active = 'item active';
	      		}else{
	      			$active = 'item';
	      		}
	      		echo('<div class="' . $active . '">');
				echo(	'<img class="img-responsive" src="docs/imagenes/' . $news->getImage() .'" alt="First slide">');
				echo(	'<div class="container">');
				echo(		'<div class="carousel-caption">');
				echo(			'<h1>' . $news->getTitle() . '</h1>');
				echo(			'<p id="summary">' . $news->getSummary() . '...</p>');
				if($news->getRedirect() != ''){
					echo(			'<p id="buttonNews" ><a class="btn btn-md btn-primary" href="' . $news->getRedirect() . '" role="button">Ver m&aacute;s</a></p>');
				}else{
					echo(			'<p id="buttonNews" ><a class="btn btn-md btn-primary" href="news.php?id=' . $news->getId() . '" role="button">Ver m&aacute;s</a></p>');
				}
				echo(			'<p id="buttonNews2" ><a class="btn btn-sm btn-primary" href="news.php?id=' . $news->getId() . '" role="button">Ver m&aacute;s</a></p>');
				echo(		'</div>');
				echo(	'</div>');
				echo('</div>');
				
				$countNews++;
	      	}		
			?>
	      </div>
	      <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
	        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
	        <span class="sr-only">Previous</span>
	      </a>
	      <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
	        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
	        <span class="sr-only">Next</span>
	      </a>
	    </div>
	    <hr class="featurette-divider">	    
			<!-- Example row of columns -->
			<div class="row">
				<div class="col-lg-6">
					<h2>Trayectorias escolares</h2>
					<p>
						Las trayectorias escolares son el resultado del seguimiento de los alumnos a trav&eacute;s de diferentes ciclos escolares. 
						Este seguimiento se traduce en indicadores de aprobaci&oacute;n, eficiencia terminal, rezago educativo y reprobaci&oacute;n 
						escolar.
					</p>
					<p>
						<a class="btn btn-default" href="trayectorias.php" role="button">Ir a la pagina &raquo;</a>
					</p>
				</div>
				<div class="col-lg-6">
					<h2>Cuestionarios de contexto</h2>
					<p>
						Es un cuestionario para obtener informaci&oacute;n de ciertas caracter&iacute;sticas de los evaluados, compara los resultados 
						del logro de acuerdo con las variables de inter&eacute;s. No existen respuestas correctas o incorrectas.
					</p>
					<p>
						<a class="btn btn-default" href="contexto.php" role="button">Ir a la pagina &raquo;</a>
					</p>
				</div>
				<!--div class="col-lg-4">
					<h2>Trayectorias escolares por modalidad</h2>
					<p>
						Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
					</p>
					<p>
						<a class="btn btn-default" href="#" role="button">View details &raquo;</a>
					</p>
				</div-->
			</div>
			<hr class="featurette-divider">
		</div>
		<a class="go-top" href="#">Subir</a>
		<?php include('footer.php'); ?>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')
		</script>
		<script src="lib/bootstrap/bootstrap.min.js"></script>
		<script src="imports/js/buttonTop.js"></script>
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
