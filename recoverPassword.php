<?php
include('checkSession.php');
$form = new CohorteForm();
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
		<link href="css/signin.css" rel="stylesheet">
		<link href="css/footer.css" rel="stylesheet">
		<link href="css/header.css" rel="stylesheet">
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
			<form role="form" name="recoverPassword" id="recoverPassword" class="form-signin" action="imports/php/auxiliarFunctions/recoverPassword.php" method="post" accept-charset="UTF-8">
				<img src="docs/segey80v.png"  class="img-responsive center-block" />				
		        <div class="login"><h2 class="form-signin-heading">Recuperar Contrase&ntilde;a</h2></div>
		        <hr />
		        <?php					
					if( isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
					  if( $_POST['captcha'] != ($_SESSION['captcha'][0]+$_SESSION['captcha'][1]) ) {
					    die('Invalid captcha answer');  // client does not have javascript enabled
					  }
					}
					$_SESSION['captcha'] = array( mt_rand(0,9), mt_rand(1, 9) );
		        ?>
		        <label for="inputEmail" class="">Correo Electr&oacute;nico</label>
		        <p>
		        <input type="text" name="email" id="email" class="form-control" placeholder="Correo Electr&oacute;nico"
		        	data-toggle="tooltip" title="Ingrese su correo electr&oacute;nico para recuperar la contrase&ntilde;a"
		        	data-validation="email" data-validation-error-msg="Ingrese un correo electr&oacute;nico valido para recuperar la contrase&ntilde;a">
		        </p>
		        <input type="hidden" id="captcha1" name="captcha1" value="<?=$_SESSION['captcha'][0]?>" />
		        <input type="hidden" id="captcha2" name="captcha2" value="<?=$_SESSION['captcha'][1]?>" />
		        <p>
				    &iquest;Cual es la suma de <?=$_SESSION['captcha'][0]?> + <?=$_SESSION['captcha'][1]?>?
				<input name="captcha" placeholder="Pregunta de seguridad" class="form-control" data-validation="spamcheck" 
					data-validation-captcha="<?=( $_SESSION['captcha'][0] + $_SESSION['captcha'][1] )?>" data-validation-error-msg="La respuesta de la pregunta de seguridad no es correcta"/>
				</p>
		        <br />
		        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
		        <?php
		        	if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
		        		echo ('<p><label class="formError">' . $_SESSION['message'] . '</label></p>');
		        		unset($_SESSION['message']);
		        	}
		        ?>	        
			</form>
		</div>
		<!-- /container -->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>
		<script src="imports/js/recoverPassword.js"></script>
		<script>
			window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')			
		</script>		
		<!--script src="imports/js/loginValidate.js"></script-->
		<script src="lib/bootstrap/bootstrap.min.js"></script>		
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
		<?php include('footer.php'); ?>
	</body>
</html>
