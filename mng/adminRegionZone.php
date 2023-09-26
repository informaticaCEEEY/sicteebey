<?php include('../checkSession.php'); ?>
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
		<!-- <link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet"> -->
		<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<!--link href="../css/jumbotron.css" rel="stylesheet"-->
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">

		<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js">s</script>
		<![endif]-->
	</head>
	<body>
		<?php include('header.php'); ?>

		<div class="container">
			<div class='text-center'><h2 class='form-signin-heading'>Zonas</h2></div><hr />
			<?php
			if (isset($_SESSION['flash'])) {
				echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
				unset($_SESSION['flash']);
			}
			?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id='entity' cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Nivel</th>
							<th>Modalidad</th>
							<th>Regi&oacute;n</th>
							<th>Zona</th>
							<th>Sector</th>
						</tr>
					</thead>
				</table>
				<form id='deleteForm' action="linkDelete" method="post"></form>
			</div>
		</div>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-sm" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Aviso</h4>
		      </div>
		      <div class="modal-body text-center" id="tesd">
		        <h4>Seleccione una zona</h4>
		      </div>
		    </div>
		  </div>
		</div>
		<!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
		<!--script src="http://code.jquery.com/jquery-migrate-1.4.1.js"></script-->
		<script src="../lib/bootstrap/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jqc-1.12.3/dt-1.10.16/datatables.min.js"></script> -->
		<script type="text/javascript">
    	var linkAdd="newZone.php";
    	var linkEdit="editZone.php?id=";
    	var linkDelete="../imports";
			var sourceLink="../imports/php/auxiliarFunctions/schoolRegionZoneList.php";
    </script>
    <script type="text/javascript" src="../imports/js/configureRegionZoneTable.js"></script>
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
		<!--script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')
		</script-->
		<!--script src="../imports/js/accordion.js"></script-->
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
		<?php include('../footer.php'); ?>
	</body>
</html>