<?php
if (!isset($_SESSION['user'])) {
    header('Location:../login.php');
}else{
    $user = unserialize($_SESSION['user']);
    $user = $userController->getEntityAction($user->getId());
    if($user->getType() != 6){
        header('location:../index.php');
        exit;
    }
}

?>
<form role="form" name="classroomReport1" id="classroomReport1" action="factorSchoolGroup.php" method="post" accept-charset="UTF-8">
    <input type="hidden" id="year" name="year" value="2016"/>
</form>
<form role="form" name="classroomReport2" id="classroomReport2" action="factorSchoolGroup.php" method="post" accept-charset="UTF-8">
    <input type="hidden" id="year" name="year" value="2017"/>
</form>
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="../index.php">CEEEY</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Trayectorias escolares <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../trayectorias.php">Descripci&oacute;n del proyecto</a>
                        </li>
                        <li>
                            <a href="general.php">Reporte general</a>
                        </li>
                        <li>
                            <a href="gender.php">Reporte por sexo</a>
                        </li>
                        <li>
                            <a href="mode.php">Reporte por modalidad</a>
                        </li>
						<li>
							<a href="generalRegion.php">Reporte por región</a>
						</li>
						<li>
                            <a href="generalZone.php">Reporte por zona escolar</a>
                        </li>
                        <li>
                            <a href="generalSchool.php">Reporte por escuela</a>
                        </li>                       
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Cuestionarios de Contexto <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="../contexto.php">Descripci&oacute;n del proyecto</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Contexto Alumnos</li>
                        <li>
                            <a href="context.php">Reporte general</a>
                        </li>                        
                        <?php
                        if($user->getSchoolObject()->getLevel() == 2){
                        ?>
                        <li>
                            <a href="factorZone.php">Reporte por zona escolar</a>
                        </li>
                        <li>
                            <a href="factorSchool.php">Reporte por escuela</a>
                        </li>
                        <?php } ?>
                        <li>
                            <a onclick="document.forms.classroomReport1.submit()" style="cursor:pointer;">Reporte por aula (2015-2016)</a>
                        </li>
                        <li>
                            <a onclick="document.forms.classroomReport2.submit()" style="cursor:pointer;">Reporte por aula (2016-2017)</a>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Contexto Docentes y Directores</li>
                        <li>
                            <a href="contextDirector.php">Reporte general</a>
                        </li>
                        <?php
                        if($user->getSchoolObject()->getLevel() == 2){
                        ?>
                        <li>
                            <a href="schoolZoneIndex.php">Reporte por zona escolar</a>
                        </li>
                        <li>
                            <a href="schoolIndexChart.php">Reporte por escuela</a>
                        </li>
                        <?php } ?>
                    </ul>
                </li>								
			</ul>
			<?php
            if(!$user){
			?>
			<form method="post" accept-charset="UTF-8" class="navbar-form navbar-right" id="entryLogin" action="login.php">
				<button type="submit" class="btn btn-success">
					Iniciar Sesi&oacute;n
				</button>
			</form>
			<?php 
			}else{				
			?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a id="userName" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user -> getCompleteName(); ?><span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li>
							<a href="editUser.php">Datos Personales</a>
						</li>
						<li>
							<a href="changePassword.php">Cambiar  Contrase&ntilde;a</a>
						</li>
						<li>
							<a href="../imports/php/auxiliarFunctions/logoutAction.php">Cerrar Sesi&oacute;n</a>
						</li>
						<!--li><a href="imports/php/auxiliarFunctions/logoutAction.php">Cerrar Sesi&oacute;n</a></li-->
					</ul>
				</li>
			</ul>
			<?php
			}
			?>
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					
				</li>
			</ul>
		</div><!--/.navbar-collapse -->
	</div>
</nav>