<?php
class LoginForm extends AbstractForm {

	//Bloque de Código para Formulario de Logueo
	public function loginStudentsForm() {

		if( isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
	    if( $_POST['captcha'] != ($_SESSION['captcha'][0]+$_SESSION['captcha'][1]) ) {
	      die('Invalid captcha answer');  // client does not have javascript enabled
	    }
	  }
	  $_SESSION['captcha'] = array( mt_rand(0,9), mt_rand(1, 9) );
		$this -> hidden('loginType', '2');
		echo('<div class="form-signin-heading">
			<h2>
				Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán
				<br />IDAEPY 2019
			</h2>
			<hr />
		</div>');

		echo('<div class="form-signin-body">
			<h3>Resultados del Alumno</h3>
			<br />
			<div class="form-signin-content">
				<div class="form-group">
					<p>
						<label for="folioStudent" class="">Número de folio del alumno(a)</label>
						<input type="text" name="folioStudent" id="folioStudent" class="form-control" placeholder="Folio"
						data-toggle="tooltip" title="Ingrese su del folio IDAEPY para identificarse en el sistema">
					</p>
				</div>
				<div class="form-group">
					<label for="inputCaptcha" class="">&iquest;Cual es la suma de ' . $_SESSION['captcha'][0] . ' + ' . $_SESSION['captcha'][1] . '?</label>
					<input name="captcha" placeholder="Pregunta de seguridad" class="form-control" data-validation="spamcheck" data-toggle="tooltip" title="Ingrese la respuesta a la pregunta de seguridad"
					data-validation-captcha="' . ( $_SESSION['captcha'][0] + $_SESSION['captcha'][1] ) . '" data-validation-error-msg="La respuesta de la pregunta de seguridad no es correcta"/>
				</div>

				<input type="hidden" id="captcha1" name="captcha1" value="' . $_SESSION['captcha'][0] . '" />
				<input type="hidden" id="captcha2" name="captcha2" value="' . $_SESSION['captcha'][1] . '" />
				<div class="text-center">
					<button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.back.submit()">Cancelar</button>
				</div>
			</div>
		</div>');
	}

	public function loginUsersForm() {

		if( isset($_POST['captcha']) && isset($_SESSION['captcha'])) {
	    if( $_POST['captcha'] != ($_SESSION['captcha'][0]+$_SESSION['captcha'][1]) ) {
	      die('Invalid captcha answer');  // client does not have javascript enabled
	    }
	  }
	  $_SESSION['captcha'] = array( mt_rand(0,9), mt_rand(1, 9) );
		$this -> hidden('loginType', '1');
		echo('<div class="form-signin-heading">
			<h2>
				Iniciar Sesión
			</h2>
			<hr />
		</div>');

		echo('<div class="form-signin-body">
			<div class="form-signin-content">
				<div class="form-group">
					<p>
						<label for="inputUser" class="">Nombre de usuario</label>
						<input type="text" name="userName" id="inputUserName" class="form-control" placeholder="Nombre de usuario"
						data-toggle="tooltip" title="Ingrese un nombre de usuario para identificarse en el sistema"
						data-validation="length letternumeric" data-validation-allowing="-_." data-validation-length="5-50"
						data-validation-error-msg="Ingrese un nombre de usuario para identificarse en el sistema (5-50 caracteres)">
					</p>
				</div>
				<div class="form-group">
					<p>
						<label for="inputPassword" class="">Contrase&ntilde;a</label>
						<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contrase&ntilde;a"
						data-toggle="tooltip" title="Ingrese un contrase&ntilde;a para acceder al sistema"
						data-validation="length" data-validation-length="min8" data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres">
						<input type="button" class="btn btn-default" id="showPassword" value="Mostrar Contraseña" class="button"/>
					</p>
				</div>
				<div class="form-group">
					<label for="inputCaptcha" class="">&iquest;Cual es la suma de ' . $_SESSION['captcha'][0] . ' + ' . $_SESSION['captcha'][1] . '?</label>
					<input name="captcha" placeholder="Pregunta de seguridad" class="form-control" data-validation="spamcheck" data-toggle="tooltip" title="Ingrese la respuesta a la pregunta de seguridad"
					data-validation-captcha="' . ( $_SESSION['captcha'][0] + $_SESSION['captcha'][1] ) . '" data-validation-error-msg="La respuesta de la pregunta de seguridad no es correcta"/>
				</div>

				<input type="hidden" id="captcha1" name="captcha1" value="' . $_SESSION['captcha'][0] . '" />
				<input type="hidden" id="captcha2" name="captcha2" value="' . $_SESSION['captcha'][1] . '" />
				<div class="text-center">
					<button type="submit" class="btn btn-lg btn-primary">Ingresar</button>
					<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.back.submit()">Cancelar</button>
				</div>
			</div>
		</div>');
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
