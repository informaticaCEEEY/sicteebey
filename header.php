<?php

if(isset($_SESSION['user'])) {
    $user = unserialize($_SESSION['user']);
    $user = $userController->getEntityAction($user->getId());
}

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 36000)) {
  // last request was more than 30 minutes ago
  session_unset();     // unset $_SESSION variable for the run-time
  session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();



if(isset($user)){
?>
<form role="form" name="context15" id="context15" action="../<?php echo $user->getAbbreviation() ?>/indexContext.php" method="post" accept-charset="UTF-8">
    <input type="hidden" id="year" name="year" value="2015"/>
</form>
<form role="form" name="context17" id="context17" action="../<?php echo $user->getAbbreviation() ?>/indexContext.php" method="post" accept-charset="UTF-8">
    <input type="hidden" id="year" name="year" value="2017"/>
</form>
<?php
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php">SICTEEBEY</a>
			<!--a href="#" class="navbar-left"><img src="docs/logo_segey1.png"></a-->
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<?php
      if(!isset($user)){
      ?>
				<form method="post" accept-charset="UTF-8" class="navbar-form navbar-right" id="entryLogin" action="login.php">
					<button type="submit" class="btn btn-success">
						Iniciar Sesi&oacute;n
					</button>
				</form>
			<?php
			}else{
            ?>
      <ul class="nav navbar-nav">
        <?php if($user->getType() == 5){ ?>
				<li>
          <a href="../<?php echo $user->getAbbreviation() ?>/adminSchools.php">Escuelas</a>
        </li>
				<?php } ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trayectorias escolares <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../trayectorias.php">Descripci&oacute;n del proyecto</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/general.php">Reporte general</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/gender.php">Reporte por sexo</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/mode.php">Reporte por modalidad</a>
						</li>
            <li>
							<a href="../<?php echo $user->getAbbreviation() ?>/generalRegion.php">Reporte por región</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/generalZone.php">Reporte por zona</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/generalSchool.php">Reporte por escuela</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuestionarios de contexto <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../contexto.php">Descripci&oacute;n del proyecto</a>
						</li>
						<li>
              <a onclick="document.forms.context15.submit()" style="cursor:pointer;">Contexto 2015 y 2016</a>
            </li>
            <li>
              <a onclick="document.forms.context17.submit()" style="cursor:pointer;">Contexto 2017</a>
            </li>
					</ul>
				</li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">IDAEPY <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li>
              <a href="../<?php echo $user->getAbbreviation() ?>/idaepySchoolExcel.php">Reporte</a>
            </li>
            <li>
              <a href="../<?php echo $user->getAbbreviation() ?>/idaepySchoolPDF.php">Cartel</a>
            </li>
          </ul>
        </li>
				<?php if($user->getType() == 1){ ?>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catalogos <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/adminSchools.php">Escuelas</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/adminNews.php">Eventos</a>
						</li>
						<li>
							<a href="../<?php echo $user->getAbbreviation() ?>/adminUsers.php">Usuarios</a>
						</li>
					</ul>
				</li>
				<?php } ?>
			</ul>
            <ul class="nav navbar-nav navbar-right">
            	<li class="dropdown">
            		<a id="userName" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user->getCompleteName(); ?><span class="caret"></span></a>
	           		<ul class="dropdown-menu">
	          			<li><a href="../<?php echo $user->getAbbreviation() ?>/editUser.php">Datos Personales</a></li>
	           			<li><a href="../<?php echo $user->getAbbreviation() ?>/changePassword.php">Cambiar  Contrase&ntilde;a</a></li>
	               		<li><a href="../imports/php/auxiliarFunctions/logoutAction.php"><span class="glyphicon glyphicon-off"></span> Cerrar Sesi&oacute;n</a></li>
	               		<!--li><a href="imports/php/auxiliarFunctions/logoutAction.php">Cerrar Sesi&oacute;n</a></li-->
	               	</ul>
            	</li>
            </ul>
            <?php
			}
            ?>
		</div><!--/.navbar-collapse -->
	</div>
</nav>
