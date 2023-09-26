<?php
require ('../checkSession.php');

if (!isset($_POST['factor'])) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
} else {
	// Obtiene el objeto cohorte
	extract($_POST);
	$controller = new FactorController();
	$factorObject = $controller -> getEntityAction($factor);
}

if (!$factor) {
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
}

$schoolController = new SchoolController();
$school = $schoolController->getEntityAction($idSchool);
			
if(!$school){
	echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
	exit;
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
		<title>Reporte Contexto</title>
		<!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
		<!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
		<link rel="icon" href="../img/logog.ico">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/buttonTop.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
		<script src="../lib/jquery/jquery.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.js"></script>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<link rel="stylesheet" href="../css/chart.css">
		<link rel="stylesheet" href="../css/table.css">
	</head>
	<body>
		<?php
		include ('header.php');
 ?>

		<div class="container">
			<div id='external-events'>
  	<h4>Draggable Events</h4>
  	<div class='fc-event'>New Event</div>
  	<p>
    	<img src="trash-can.png" id="trash" alt="">
  	</p>
</div>
<div id='calendar'></div>
		</div>
		<?php include ('../footer.php'); ?>
	</body>
</html>