<?php
class UsersForm extends AbstractForm{

	private function exploitGender($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione el sexo'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolLevel($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione el nivel de estudios'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	private function exploitSchoolMode($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione la modalidad'));
		array_push($exploit, array('value' => '5', 'label' => 'Indígena'));
		array_push($exploit, array('value' => '4', 'label' => 'General'));
		return $exploit;
	}

	private function exploitSchoolGrade($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione el grado'));
		array_push($exploit, array('value' => '3', 'label' => '3°'));
		array_push($exploit, array('value' => '4', 'label' => '4°'));
		array_push($exploit, array('value' => '5', 'label' => '5°'));
		array_push($exploit, array('value' => '6', 'label' => '6°'));
		return $exploit;
	}

	private function exploitSchoolGroup($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione el grupo'));
		array_push($exploit, array('value' => 'A', 'label' => 'A'));
		array_push($exploit, array('value' => 'B', 'label' => 'B'));
		array_push($exploit, array('value' => 'C', 'label' => 'C'));
		array_push($exploit, array('value' => 'D', 'label' => 'D'));
		return $exploit;
	}

	private function exploitSchoolZone() {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione una zona escolar'));
		return $exploit;
	}

	private function exploitUserType($array) {

		$exploit = array();

		array_push($exploit, array('value' => '', 'label' => 'Seleccione el tipo de usuario'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	public function addForm(){

		$controller = new SchoolLevelController();
		$schoolLevels = $this -> exploitSchoolLevel($controller -> displayAction());

		$controller = new GenderController();
		$gender = $this -> exploitGender($controller -> displayAction());

		$schoolModeList = $this -> exploitSchoolMode();
		$schoolZoneList = $this -> exploitSchoolZone();
		$schoolGradeList = $this -> exploitSchoolGrade();
		$schoolGroupList = $this -> exploitSchoolGroup();

		$controller = new UserTypeController();
		$where = 'e.id > 1';
		$userTypeList = $this -> exploitUserType($controller -> displayByAction($where));

		$this -> hidden('action', 'add');
		echo("<div class='row'>");
		$this -> formHeader('Nuevo  Usuario');
		echo("	<div class='col-md-6'>");
		$this -> entryText('Título','title', '','Título', '', '', '', 'data-validation-optional="true"
			data-validation-error-msg="Ingrese un título"');
		$this -> entryText('Nombre','name', '','Nombre', '', '', '', 'data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-error-msg="Ingrese su nombre"');
		$this -> entryText('Primer Apellido','lastName', '','Primer Apellido', '', '', '', 'data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-error-msg="Ingrese su Primer Apellido"');
		$this -> entryText('Segundo Apellido','secondName', '','Segundo Apellido', '', '', '','data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-optional="true" data-validation-error-msg="Ingrese su Segundo Apellido"');
		$this -> select2('Seleccione el sexo', 'gender', '', $gender, '','','Seleccione el sexo',
			'required', 'Seleccione el sexo');
		echo("	</div>");
		echo("	<div class='col-md-6'>");
		$this -> select2('Seleccione el nivel de estudios', 'schoolLevel', '', $schoolLevels, '', '',
			'Seleccione el nivel de estudios', 'required', 'Seleccione el nivel de estudios');
		$this -> select2('Seleccione el tipo de usuario', 'userType', '', $userTypeList, '','','Seleccione el tipo de usuario',
			'required', 'Seleccione el tipo de usuario');
		echo('<div id="userN">');
		$this -> entryText('Nombre de Usuario', 'userName', '', 'Nombre de Usuario', '', '', '',
			'data-validation="custom" data-validation-regexp="^[a-zA-Z0-9]+(.*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$"
			data-validation-error-msg="Ingrese un nombre de usuario para acceder al sistema. Utiliza solo letras (a-z), números y puntos. El último carácter del nombre de usuario debe ser una letra o un número."');
		echo "</div>";
		echo('<div id="school">');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '',
			'data-validation="length" data-validation-length="10" data-validation-error-msg="Ingrese un CCT"', 10);
		echo "</div>";
		echo('<div id="schoolG">');
		$this -> select2('Seleccione un Grado', 'schoolGrade', '', $schoolGradeList, '','','Seleccione un Grado',
			'required', 'Seleccione un Grado');
		$this -> select2('Seleccione un Grupo', 'schoolGroup', '', $schoolGroupList, '','','Seleccione un Grupo',
			'required', 'Seleccione un Grupo');
		echo "</div>";
		echo('<div id="schoolM">');
		$this -> select2('Seleccione una Modalidad', 'schoolMode', '', $schoolModeList, '','','Seleccione una Modalidad',
			'required', 'Seleccione una Modalidad');
		echo "</div>";
		echo('<div id="schoolZ">');
		$this -> select2('Seleccione una Zona', 'schoolZone', '', $schoolZoneList, '', 'TRUE','Seleccione una Zona',
			'required', 'Seleccione una Zona');
		echo "</div>";
		$this -> entryText('Correo Electr&oacute;nico','email', '','Correo Electr&oacute;nico', '', '', '',
			'data-validation="email" data-validation-error-msg="Ingrese un correo electr&oacute;nico valido"');
		// $this -> entryText('Confirmar Correo Electr&oacute;nico','repeatEmail', '',
		// 	'Confirmar Correo Electr&oacute;nico', '', '', '', 'data-validation="confirmation"
		// 		data-validation-confirm="email" data-validation-error-msg="El correo electr&oacute;nico no coincide"');
		$this -> entryPassword('Contraseña', 'password', 40, 'data-validation="length" data-validation-length="min8"
			data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres"', 'Contraseña');
		// $this -> entryPassword('Confirmar Contraseña', 'repeatPassword', 40, 'data-validation="confirmation"
		// 	data-validation-confirm="password" data-validation-error-msg="Las contrase&ntilde;a no son iguales"',
		// 	'Confirmar Contraseña');
		echo("	</div>");
		echo("</div>");
	}

	public function addDataForm($userType){

		$controller = new SchoolLevelController();
		$schoolLevels = $this -> exploitSchoolLevel($controller -> displayAction());

		$controller = new GenderController();
		$gender = $this -> exploitGender($controller -> displayAction());

		$controller = new UserTypeController();
		$where = 'e.id > 1';
		$userTypeList = $this -> exploitUserType($controller -> displayByAction($where));

		$this -> hidden('action', 'add');
		echo("<div class='row'>");
		$this -> formHeader('Nuevo  Usuario');
		echo("	<div class='col-md-6'>");
		$this -> entryText('Nombre de Usuario', 'userName', '', 'Nombre de Usuario', '', '', '',
			'data-validation="custom" data-validation-regexp="^[a-zA-Z0-9]+(.*[a-zA-Z0-9]*)*[a-zA-Z0-9]+$"
			data-validation-error-msg="Ingrese un nombre de usuario para acceder al sistema. Utiliza solo letras (a-z), números y puntos. El último carácter del nombre de usuario debe ser una letra o un número."');
		$this -> entryText('Título','title', '','Título', '', '', '', 'data-validation="required"
			data-validation-error-msg="Ingrese un título"');
		$this -> entryText('Nombre','name', '','Nombre', '', '', '', 'data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-error-msg="Ingrese su nombre"');
		$this -> entryText('Primer Apellido','lastName', '','Primer Apellido', '', '', '', 'data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-error-msg="Ingrese su Primer Apellido"');
		$this -> entryText('Segundo Apellido','secondName', '','Segundo Apellido', '', '', '','data-validation="custom"
			data-validation-regexp="^[a-zA-ZñÑáéíóúÁÉÍÓÚ]+(\s*[a-zA-ZñÑáéíóúÁÉÍÓÚ]*)*[a-zA-ZñÑáéíóúÁÉÍÓÚ]+$"
			data-validation-optional="true" data-validation-error-msg="Ingrese su Segundo Apellido"');
		$this -> select2('Seleccione el sexo', 'gender', '', $gender, '','','Seleccione el sexo',
			'required', 'Seleccione el sexo');
		echo("	</div>");
		echo("	<div class='col-md-6'>");
		$this -> select2('Seleccione el nivel de estudios', 'schoolLevel', '', $schoolLevels, '', '',
			'Seleccione el nivel de estudios', 'required', 'Seleccione el nivel de estudios');
		$this -> select2('Seleccione el tipo de usuario', 'userType', '', $userTypeList, '','','Seleccione el tipo de usuario',
			'required', 'Seleccione el tipo de usuario');
		echo('<div id="school">');
		$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '',
			'data-validation="length" data-validation-length="10" data-validation-error-msg="Ingrese un CCT"', 10);
		echo "</div>";
		$this -> entryText('Correo Electr&oacute;nico','email', '','Correo Electr&oacute;nico', '', '', '',
			'data-validation="email" data-validation-error-msg="Ingrese un correo electr&oacute;nico valido"');
		// $this -> entryText('Confirmar Correo Electr&oacute;nico','repeatEmail', '',
		// 	'Confirmar Correo Electr&oacute;nico', '', '', '', 'data-validation="confirmation"
		// 		data-validation-confirm="email" data-validation-error-msg="El correo electr&oacute;nico no coincide"');
		$this -> entryPassword('Contraseña', 'password', 40, 'data-validation="length" data-validation-length="min8"
			data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres"', 'Contraseña');
		// $this -> entryPassword('Confirmar Contraseña', 'repeatPassword', 40, 'data-validation="confirmation"
		// 	data-validation-confirm="password" data-validation-error-msg="Las contrase&ntilde;a no son iguales"',
		// 	'Confirmar Contraseña');
		echo("	</div>");
		echo("</div>");
	}

	public function editForm(Users $entity){

		$controller = new SchoolLevelController();
		$schoolLevels = $this -> exploitSchoolLevel($controller -> displayAction());

		$controller = new GenderController();
		$gender = $this -> exploitGender($controller -> displayAction());

		$this -> hidden('action', 'edit');
		$this -> hidden('id', $entity->getId());
		echo("<div class='row'>");
		$this -> formHeader('Datos Personales');
		echo("	<div class='col-md-6'>");
		$this -> entryText('Título','title', '','Título', $entity->getTitle(), '', '', 'data-validation="required" data-validation-error-msg="Ingrese un título"');
		$this -> entryText('Nombre','name', '','Nombre', $entity->getName(), '', '', 'data-validation="required" data-validation-error-msg="Ingrese su nombre"');
		$this -> entryText('Primer Apellido','lastName', '','Primer Apellido', $entity->getLastName(), '', '', 'data-validation="required" data-validation-error-msg="Ingrese su Primer Apellido"');
		$this -> entryText('Segundo Apellido','secondName', '','Segundo Apellido', $entity->getSecondName(), '', '', 'data-validation="required" data-validation-error-msg="Ingrese su Segundo Apellido"');
		echo("	</div>");
		echo("	<div class='col-md-6'>");
		$this -> select2('Seleccione el sexo', 'gender', '', $gender, $entity->getGender(),'','Seleccione el sexo', 'required', 'Seleccione el sexo');
		$this -> select2('Seleccione el nivel de estudios', 'schoolLevel', '', $schoolLevels, $entity->getSchoolLevel(),'','Seleccione el nivel de estudios', 'required', 'Seleccione el nivel de estudios');
		$this -> entryText('Correo Electr&oacute;nico','email', '','Correo Electr&oacute;nico', $entity->getEmail(), '', '', 'data-validation="email" data-validation-error-msg="Ingrese un correo electr&oacute;nico valido"');
		$this -> entryText('Confirmar Correo Electr&oacute;nico','repeatEmail', '','Confirmar Correo Electr&oacute;nico', $entity->getEmail(), '', '', 'data-validation="confirmation" data-validation-confirm="email" data-validation-error-msg="El correo electr&oacute;nico no coincide"');
		echo("	</div>");
		echo("</div>");

	}

	public function changePasswordForm(Users $entity){

		$this -> hidden('action', 'changePassword');
		$this -> hidden('id', $entity->getId());
		$this -> formHeader('Cambiar Contrase&ntilde;a :: ' . $entity->__toString());
		echo('<label for="inputPassword" class="textLabel">Contrase&ntilde;a Anterior</label>');
		echo('<p><input type="password" name="oldPassword" id="oldPassword" class="form-control" placeholder="Contrase&ntilde;a anterior"
		      data-validation="length" data-validation-length="min8" data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres"></p>');
		echo('<label for="inputPassword" class="textLabel">Contrase&ntilde;a Nueva</label>');
		echo('<p><input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Contrase&ntilde;a nueva"
		      data-validation="length" data-validation-length="min8" data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres"></p>');
		echo('<label for="inputPassword" class="textLabel">Repetir Contrase&ntilde;a</label>');
		echo('<p><input type="password" name="repeatPassword" id="repeatPassword" class="form-control" placeholder="Repetir contrase&ntilde;a"
		      data-validation="confirmation" data-validation-confirm="newPassword" data-validation-error-msg="Las contrase&ntilde;a no son iguales"></p>');
	}
	
	public function changePasswordAdminForm(Users $entity){

		$this -> hidden('action', 'changePasswordAdmin');
		$this -> hidden('id', $entity->getId());
		$this -> formHeader('Cambiar Contrase&ntilde;a :: ' . $entity->__toString());
		echo('<label for="inputPassword" class="textLabel">Contrase&ntilde;a Anterior</label>');
		echo('<label for="inputPassword" class="textLabel">Contrase&ntilde;a Nueva</label>');
		echo('<p><input type="password" name="newPassword" id="newPassword" class="form-control" placeholder="Contrase&ntilde;a nueva" 
		      data-validation="length" data-validation-length="min8" data-validation-error-msg="La contrase&ntilde;a debe tener al menos 8 caracteres"></p>');
		echo('<label for="inputPassword" class="textLabel">Repetir Contrase&ntilde;a</label>');
		echo('<p><input type="password" name="repeatPassword" id="repeatPassword" class="form-control" placeholder="Repetir contrase&ntilde;a" 
		      data-validation="confirmation" data-validation-confirm="newPassword" data-validation-error-msg="Las contrase&ntilde;a no son iguales"></p>');
	}

}
?>
