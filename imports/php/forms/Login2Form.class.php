<?php
class LoginForm extends AbstractForm {
	
	public function LoginForm() {

	}

	//Bloque de Código para Formulario de Logueo
	public function accessForm() {
		echo '<div id="login">';
		echo '<form name="" id="" action="imports/php/auxiliarFunctions/loginAction.php" method="post">';
		$this->hidden('tpass', '');
		echo '<h2>Iniciar Sesi&oacute;n</h2>';
		echo '<label for="userName"><b>Nombre de Usuario</b></label>';
		echo '<input type="text" class="textfield" name="userName" id="userName" />';
		echo '<label for="password"><b>Contrase&ntilde;a</b></label>';
		echo '<input type="password" class="textfield" name="password" id="pw" />';
		echo '<center><button type="submit" class="button rounded-button" name="Submit" class="submit" onclick="sub(this.form)">Iniciar Sesión</button></center>';
		echo '</form>';
		if (isset($_GET['errorLogin'])) {
			echo '<p class="error">  Nombre de Usuario o Contrase&ntilde;a incorrecto</p>';
		}
		echo '</div>';
	}
	//Bloque de Código para Formulario de Creación de Passwords
	public function createPasswordForm() {

		echo '<div id="login">';
		echo '<form name="" id="" action="imports/php/auxiliarFunctions/savePasswordAction.php" method="post">';
		echo '<h3>Su contrase&ntilde;a ha sido desactivada, por favor ingrese una nueva.</h3>';
		echo '<label for="password">Contrase&ntilde;a</label>';
		echo '<input type="password" class="textfield" name="password"/>';
		echo '<label for="repassword">Repita su contrase&ntilde;a</label>';
		echo '<input type="password" class="textfield" name="repassword"/>';
		echo '<button type="button" class="button rounded-button" name="Submit" class="submit" onclick="validatePasswords(this.form)">Guardar</button>';
		echo '</div>';
	}

	public function recoverPasswordForm() {
		
		$this -> hidden('action', 'add');
		echo("<div class='row'>");	
		$this -> formHeader('Recuperar Contrase&ntilde;a');	
		$this -> entryText('Titulo','title', '','Titulo', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese un titulo"');
		echo("</div>");
	}
}
?>