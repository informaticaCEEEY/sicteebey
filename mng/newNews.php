<?php
require ('../checkSession.php');
$form = new NewsForm();
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

		<title>CEEEY</title>

		<!-- Bootstrap core CSS -->
		<link href="../css/bootstrap.min.css" rel="stylesheet">

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

		<!-- Custom styles for this template -->
		<link href="../css/footer.css" rel="stylesheet">
		<link href="../css/header.css" rel="stylesheet">
		<link href="../css/form.css" rel="stylesheet">
		<link href="../css/bootstrap-datetimepicker.min.css" rel="stylesheet">
		<link href="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />
		<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.1/summernote.css" rel="stylesheet">	
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>		
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/jquery.form-validator.min.js"></script>		
		<script type="text/javascript" src="../lib/jquery/moment-with-locales.js"></script>
		<script type="text/javascript" src="../lib/jquery/bootstrap-datetimepicker.min.js"></script>
		<script src="../lib/bootstrap/bootstrap.min.js"></script>
		<script src="../lib/ckeditor/ckeditor.js"></script>
		<script src="../lib/elFinder/js/elfinder.min.js"></script>
		<script type="text/javascript">
		$().ready(function() {
		  
		     var funcNum = window.location.search.replace(/^.*CKEditorFuncNum=(\d+).*$/, "$1");
		     var langCode = window.location.search.replace(/^.*langCode=([a-z]{2}).*$/, "$1");
		  
		     var elf = $('#elfinder').elfinder({
		       url : '../lib/elfinder/connectors/php/connector.php',
		      	editorCallback : function(url) {
		         window.opener.CKEDITOR.tools.callFunction(funcNum, url);
		         window.close();
		      }
		    })
		 
		})
		</script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>

	<body>
		<?php include('header.php'); ?>
		<div class="container">
			<form name="valid" id="valid" action="adminNews.php" method="post"></form>
			<form role="form" name="entry" id="entry" class="form-signin" action="dispatchers/newsDispatcher.php" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
				<?php							
										
				$form -> addForm($user->getId());
						
				if (isset($_SESSION['flash'])) {
					echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
					$_SESSION['flash'] = null;
				}
					
				?>						
				<br />
				<div class=""> 
					<button type="submit" class="btn btn-lg btn-primary">Enviar</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.valid.submit()">Cancelar</button>
				</div>
			</form>		
		</div>		
		<!-- /container -->
		<script src="../lib/jquery/jquery.validate.js"></script>	
		<script src="../imports/js/newsValidate.js"></script>	
		<script type="text/javascript">
			 CKEDITOR.replace( 'content', {
			 	 filebrowserUploadUrl: "../upload.php",
			 	 height: 350
			 });
		</script>
		<script type="text/javascript">
            $(function () {
                $('#_publicationDate').datetimepicker({
                	locale: 'es'
                });
            });
        </script>
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
		<?php include('../footer.php'); ?>			  	
		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../lib/bootstrap/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
