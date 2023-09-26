<?php
include('checkSession.php');
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
        <link rel="icon" href="img/logog.ico">
        <title>Centro de Evaluaci&oacute;n Educativa del Estado de Yucat&aacute;n</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
        <!-- Custom styles for this template -->        
        <link href="css/footer.css" rel="stylesheet">
        <link href="css/header.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">
        <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />
		<script src='https://www.google.com/recaptcha/api.js'></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php include('header.php'); ?>
        <div class="container">
            <form role="form" name="entry" id="entry" class="form-signin" action="imports/php/auxiliarFunctions/loginAction.php" method="post" accept-charset="UTF-8">
                <img src="docs/segey80v.png"  class="img-responsive center-block" />                
                <div class="login"><h2 class="form-signin-heading">Iniciar Sesi&oacute;n</h2></div>
                <hr />
                <?php                   
                    /*if( isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
                      if( $_POST['captcha'] != ($_SESSION['captcha'][0]+$_SESSION['captcha'][1]) ) {
                        die('Invalid captcha answer');  // client does not have javascript enabled
                      }
                    }*/
                    $_SESSION['captcha'] = array( mt_rand(0,9), mt_rand(1, 9) );
                ?>
                <label for="inputEmail" class="">Nombre de usuario</label>
                <p>
                <input type="text" name="userName" id="inputUserName" class="form-control" placeholder="Nombre de usuario"
                    data-toggle="tooltip" title="Ingrese un nombre de usuario para identificarse en el sistema"                    
                    data-validation="length alphanumeric" data-validation-allowing="-_." data-validation-length="5-50"                     
                    data-validation-error-msg="Ingrese un nombre de usuario para identificarse en el sistema (5-50 caracteres)">
                </p>
                <label for="inputPassword" class="">Contrase&ntilde;a</label>
                <p>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a"
                    data-toggle="tooltip" title="Ingrese un contrase&ntilde;a para acceder al sistema" 
                    data-validation="length" data-validation-length="min8" data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres">
                </p>

                <div>
					<div class="g-recaptcha" data-sitekey="6LdjCBsUAAAAAPw-FfRKHZDGDeBCYS4cMHvWYXQu"></div>              
				</div>
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
        <script src="imports/js/loginValidate.js"></script>
        <script>
            window.jQuery || document.write('<script src="jquery/jquery.min.js"><\/script>')            
        </script>       
        <!--script src="imports/js/loginValidate.js"></script-->
        <script src="lib/bootstrap/bootstrap.min.js"></script>      
        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
        <?php include('footer.php'); ?>
    </body>
</html>