<?php
include('checkSession.php');
$newsController = new NewsController();
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

		<title>CEEEY</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet">
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">	
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php include('header.php'); ?>
		<div class="container">
			<div class='text-center'><h2 class='form-signin-heading'>Eventos</h2></div><hr />
			<div class="table-responsive">
				<table class="table table-bordered" id='entity' cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>ID</th>
							<th>Noticia</th>
							<th>Fecha</th>					
						</tr>
					</thead>
				</table>
				<form id='deleteForm' action="linkDelete" method="post">            	
	        	</form>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
		<script src="http://code.jquery.com/jquery-migrate-1.4.1.js"></script>
		<script src="lib/bootstrap/bootstrap.min.js"></script>
		<script src="imports/js/offcanvas.js"></script>	
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">    	
    	var linkAdd="";    	
    	var linkEdit="";
    	var linkDelete="";
		var sourceLink="imports/php/auxiliarFunctions/NewsList2.php";
        </script>        
        <script type="text/javascript" src="imports/js/configureNewsListTable.js"></script>
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
		<!-- /container -->      
		<?php include('footer.php'); ?>			  	
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
