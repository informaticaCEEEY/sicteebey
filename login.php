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
  <link rel="icon" href="img/favicon_.png">
  <title>Centro de Evaluaci&oacute;n Educativa del Estado de Yucat&aacute;n</title>
  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
  <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/footer.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">
  <link href="css/idaepyLogin.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <?php
  include('header.php');
  ?>
  <div class="container">
    <form name="back" id="back" action="index.php" method="post"></form>
    <form role="form" name="entry" id="entry" class="form-signin" action="imports/php/auxiliarFunctions/loginAction.php" method="post" accept-charset="UTF-8">
      
      <?php
        $loginForm = new LoginForm();
		$loginForm->loginUsersForm();

        if(isset($_SESSION['message']) && $_SESSION['message'] != ''){
    			echo ('<div class="alert alert-danger" role="alert">');
    			echo ('<label>' . $_SESSION['message'] . '</label>');
    			echo('<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    							<span aria-hidden="true">&times;</span>
    						</button>');
    			echo ('</div>');
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
  <script src="lib/jquery/jquery.validate.js"></script>
  <script src="imports/js/loginStudentsValidate.js"></script>
  <script src="imports/js/showPassword.js"></script>
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
