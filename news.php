<?php

include('checkSession.php');

if(!isset($_GET['id'])){
	header('location:index.php');
}

$newsController = new NewsController();
$news = $newsController->getEntityAction($_GET['id']);

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

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="css/jumbotron.css" rel="stylesheet">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
		<link href="css/offcanvas.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>		
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>		
		<script src="imports/js/offcanvas.js"></script>
		<script src="lib/bootstrap/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php include('header.php'); ?>

		<div class="container">
			<div class="row row-offcanvas row-offcanvas-left">
		        <div class="col-xs-12 col-sm-12">
		        	<p class="pull-left visible-xs">
		            	<button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Menu lateral</button>
		          	</p>					
					<?php	
					
						if($news->getRedirect() != ''){
							echo('<form name="valid" id="valid" action="'. $news->getRedirect() .'" method="post"></form>');
							echo('<script>document.forms.valid.submit()</script>');
							exit;
						}						
							
						echo($news->getContent());
							
						if (isset($_SESSION['flash'])) {
							echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
							$_SESSION['flash'] = null;
						}
							
						?>
				</div>				
	        </div>			
		</div>		
		<!-- /container -->
		<script src="lib/jquery/jquery.validate.js"></script>     
		<?php include('footer.php'); ?>			  	
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
