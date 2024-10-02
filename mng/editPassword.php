<?php
require ('../checkSession.php');

$form = new UsersForm();

if(!isset($_GET['id'])){
	header('Location: index.php');
}else{
	$idUs3r = $_GET['id'];
}

$us3r = $userController->getEntityAction($idUs3r);

if(!$us3r){
    echo('<form name="valid2" id="valid2" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid2.submit()</script>');
    exit;
}

if(is_numeric($idUs3r) === FALSE){
    echo('<form name="valid2" id="valid2" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid2.submit()</script>');
    exit;
}

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
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/form.css" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php include('header.php'); ?>

		<div class="container">
			<form name="valid" id="valid" action="adminUsers.php" method="post"></form>
			<form role="form" name="entry" id="entry" class="form-signin" action="dispatchers/usersDispatcher.php" method="post" accept-charset="UTF-8">										
			<?php											
							
				$form -> changePasswordAdminForm($us3r);
							
				if (isset($_SESSION['flash'])) {
					echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
					$_SESSION['flash'] = null;
				}
								
			?>
				<br />
				<div class="text-center">
					<button type="submit" class="btn btn-lg btn-primary">Enviar</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.valid.submit()">Cancelar</button>
				</div>
			</form>
		</div>		
		<!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
		<script src="../imports/js/changePasswordValidate.js"></script>
		<script src="../imports/js/offcanvas.js"></script>
		<script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')
		</script>
		<script type="text/javascript" src="../lib/jquery/jquery.validate.js"></script>
		<?php include('../footer.php'); ?>
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
