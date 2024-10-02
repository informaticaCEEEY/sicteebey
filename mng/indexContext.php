<?php
include ('../checkSession.php');

if(isset($_POST['year'])){
  extract($_POST);
}else{
  header("Location: index.php");
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
  <!--link href="../css/jumbotron.css" rel="stylesheet"-->
  <link href="../css/form.css" rel="stylesheet">
  <link href="../css/footer.css" rel="stylesheet">
  <link href="../css/header.css" rel="stylesheet">
  <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.8/theme-default.min.css" rel="stylesheet" type="text/css" />

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
  <?php
  include ('header.php');
  ?>

  <div class="container">
    <div class="col-xs-12 text-center">
      <div class='text-center'>
        <h2 class='form-signin-heading'>Panel de administraci&oacute;n</h2>
      </div>
      <hr />
      <?php
      if (isset($_SESSION['flash'])) {
        echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
        unset($_SESSION['flash']);
      }

      if (isset($_SESSION['message'])) {
        echo('<label class="formError">' . $_SESSION['message'] . '</label>');
        unset($_SESSION['message']);
      }
      ?>
      <!-- Yucatán -->
      <form role="form" name="contexto15" id="contexto15" action="../reports/context.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2015"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contexto17" id="contexto17" action="../reports/context.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contexto1Docentes17" id="contexto1Docentes17" action="../reports/context.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="2"/>
        <input type="hidden" id="level" name="level" value="1"/>
      </form>
      <form role="form" name="contexto2Docentes17" id="contexto2Docentes17" action="../reports/context.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="2"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contexto3Docentes17" id="contexto3Docentes17" action="../reports/context.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="2"/>
        <input type="hidden" id="level" name="level" value="3"/>
      </form>

      <!-- Zona -->
      <form role="form" name="contextZone15" id="contextZone15" action="../reports/contextZone.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2015"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contextZone17" id="contextZone17" action="../reports/contextZone.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contextDocentesZone17" id="contextDocentesZone17" action="../reports/contextZone.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="2"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>

      <!-- Escuela -->
      <form role="form" name="contextCCT15" id="contextCCT15" action="../reports/contextSchool.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2015"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contextCCT17" id="contextCCT17" action="../reports/contextSchool.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contextDocentesCCT17" id="contextDocentesCCT17" action="../reports/contextSchool.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="2"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>

     <!-- Grupo -->
      <form role="form" name="contextSchoolGroup15" id="contextSchoolGroup15" action="../reports/contextAdm.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2015"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>
      <form role="form" name="contextSchoolGroup17" id="contextSchoolGroup17" action="../reports/contextAdm.php" method="post" accept-charset="UTF-8">
        <input type="hidden" id="year" name="year" value="2017"/>
        <input type="hidden" id="type" name="type" value="1"/>
        <input type="hidden" id="level" name="level" value="2"/>
      </form>

      <br />
      <div class="text-justify" id="instructions">
        <?php
        if($year == 2015){
          ?>
          <ul class="custom-bullet">
            <li>
              Cuestionarios de Contexto 2015 y 2016
            </li>
            <ul>
              <li>
                Cuestionarios de Contexto de Alumnos
              </li>
              <ul>
                <li>
                  <a onclick="document.forms.contexto15.submit()" style="cursor:pointer;">Reporte General</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextZone15.submit()" style="cursor:pointer;">Reporte por Zona Escolar</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextCCT15.submit()" style="cursor:pointer;">Reporte por Escuela</a>
                </li>
              </ul>
              <ul>
                <li>
                  <!-- <a href="contextAdm.php" target="_blank">Reporte por Aula</a> -->
                  <a onclick="document.forms.contextSchoolGroup15.submit()" style="cursor:pointer;">Reporte por Aula</a>
                </li>
              </ul>
            </ul>
            <ul>
              <li>
                Cuestionarios de Contexto de Docentes y Directores 2016
              </li>
              <ul>
                <li>
                  <a href="contextDirector.php">Reporte General</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="contextZoneDirector.php">Reporte por Zona Escolar</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="contextSchoolDirector.php">Reporte por Escuela</a>
                </li>
              </ul>
            </ul>
          </ul>
          <?php
        }elseif($year == 2017){
          ?>
          <ul class="custom-bullet">
            <li>
              Cuestionarios de Contexto 2017
            </li>
            <ul>
              <li>
                Cuestionarios de Contexto de Alumnos
              </li>
              <ul>
                <li>
                  <a onclick="document.forms.contexto17.submit()" style="cursor:pointer;">Reporte General</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextZone17.submit()" style="cursor:pointer;">Reporte por Zona Escolar</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextCCT17.submit()" style="cursor:pointer;">Reporte por Escuela</a>
                </li>
              </ul>
              <ul>
                <li>
                  <!-- <a href="contextAdm.php" target="_blank">Reporte por Aula</a> -->
                  <a onclick="document.forms.contextSchoolGroup17.submit()" style="cursor:pointer;">Reporte por Aula</a>
                </li>
              </ul>
            </ul>
            <ul>
              <li>
                Cuestionarios de Contexto de Docentes
              </li>
              <ul>
                <li>
                  <a onclick="document.forms.contexto1Docentes17.submit()" style="cursor:pointer;">Reporte General Preescolar</a>
                </li>
                <li>
                  <a onclick="document.forms.contexto2Docentes17.submit()" style="cursor:pointer;">Reporte General Primaria</a>
                </li>
                <li>
                  <a onclick="document.forms.contexto3Docentes17.submit()" style="cursor:pointer;">Reporte General Secundaria</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextDocentesZone17.submit()" style="cursor:pointer;">Reporte por Zona Escolar</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a onclick="document.forms.contextDocentesCCT17.submit()" style="cursor:pointer;">Reporte por Escuela</a>
                </li>
              </ul>
            </ul>
          </ul>
          <?php
        }
        ?>
        <br />
      </div>
      <form class="form-group" role="form" name="entry" id="entry" action="survey.php" method="post"></form>
    </div>
  </div>
  <!-- /container -->

  <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
  window.jQuery || document.write('<script src="../lib/jquery/jquery.min.js"><\/script>')
  </script>
  <script src="../lib/bootstrap/bootstrap.min.js"></script>
  <!--script src="../imports/js/accordion.js"></script-->
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
  <?php
  include ('../footer.php');
  ?>
</body>
</html>
