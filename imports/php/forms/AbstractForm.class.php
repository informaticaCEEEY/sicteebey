<?php
class AbstractForm {

	public function __construct() {

	}
	/*
	 */
	protected function formHeader($header, $colspan = 2) {

		echo("<div class='text-center'><h2 class='form-signin-heading'>$header</h2></div><hr />");
	}

	/*
	 *Bloque de Código para los campos Hidden
	 */
	protected function hidden($name, $value) {

		echo ("<input name='$name' id='$name' type='hidden' value='$value'/>");
	}
	/**
	 * @param unknown_type $name
	 * @param unknown_type $label
	 * @param unknown_type $options
	 * @param unknown_type $values
	 */
	protected function check($name, $label, $options, $title = '',
			$values = array()) {

		$values = explode('|', $values);
		echo ("<tr><td class='formHead'><strong><label>$label</label></strong> <img title='$title' src='img/help.gif'/></td></tr>");
		echo ("<tr><td class='inputRow'>");
		foreach ($options as $option) {

			if (in_array($option['value'], $values)) {

				echo ("<input class='check' type='checkbox' id='$name' name='$name' value='"
						. $option['value'] . "' checked>" . $option['label']
						. "<br>");
			} else {
				echo ("<input class='check' type='checkbox' id='$name' name='$name' value='"
						. $option['value'] . "'>" . $option['label'] . "<br>");
			}
		}
		echo ("</td></tr>");
	}

	/*
	 *Bloque de Códiga para los campos Hidden
	 */
	protected function calendar($label, $name, $title = '', $value = '', $validation = '') {

		//echo ("<tr><td class='formHead'><strong><label>$label</label></strong><img title='$title' src='../img/help.gif'/></td></tr>");
		echo("<label for='input$name' class='textLabel'>$label</label>");
		echo("<p><input type='text' name='$name' id='_$name' class='form-control' data-toggle='tooltip' data-placement='left' title='$title' placeholder='$title' value='$value'
		    		$validation></p>");
		//echo ("<tr><td class='inputRow'><input type='date' id='_$name' name='$name' value='$value'/></td></tr>");
	}
	/*
	*Bloque de Código para los PasswordFields
	*@values Los valores de la función son:
	*-La Etiqueta para El cuadro de Texto
	*-El Tamaño en vista del cuadro de Texto
	*-El nombre de acceso por JavaScript del campo
	*/
	protected function entryPassword($label, $name, $maxlength, $validation="", $placeholder = ""){
		echo("<label for='input$name' class='textLabel'>$label</label>");
		echo("<p><input type='password' class='form-control' name='$name' id='$name' maxlength='$maxlength'
					placeholder='$placeholder' $validation></p>");
	}
	/*
	 *Bloque de Código para los TextFields
	 *@values Los valores de la función son:
	 *-La Etiqueta para El cuadro de Texto
	 *-El Tamaño en vista del cuadro de Texto
	 *-El nombre de acceso por JavaScript del campo
	 *-Evento para el cuadro de texto, este campo es opcional. P.E. onkeypress
	 *-EL Tooltip para el cuadro de Texto
	 */
	protected function entryText($label, $name, $event = "", $title = "",
			$value = '', $disabled = '', $readOnly = '', $validation = '') {

		echo("<label for='input$name' class='textLabel'>$label</label>");
		if ($disabled != '') {
			echo("<p><input type='text' name='$name' id='_$name' class='form-control' placeholder='$title'
						value='$value' disabled	$validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value' disabled /></td></tr>");
		} else if ($readOnly != '') {
			echo("<p><input type='text' name='$name' id='_$name' class='form-control' placeholder='$title'
						value='$value' readonly $validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value' readonly /></td></tr>");
		} else {
			echo("<p><input type='text' name='$name' id='_$name' class='form-control' data-toggle='tooltip'
						data-placement='left' title='$title' placeholder='$title' value='$value' $validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value'/></td></tr>");
		}
	}

	protected function entryTextAutocomplete($label, $name, $event = "", $title = "",
			$value = '', $disabled = '', $readOnly = '', $validation = '', $maxlength="") {

		echo("<label for='input$name' class='textLabel'>$label</label>");
		if ($disabled != '') {
			echo("<p><input type='text' maxlength='$maxlength' name='$name' id='_$name' class='form-control autocomplete' placeholder='$title' value='$value' disabled
		    		$validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value' disabled /></td></tr>");
		} else if ($readOnly != '') {
			echo("<p><input type='text' maxlength='$maxlength' name='$name' id='_$name' class='form-control autocomplete' placeholder='$title' value='$value' readonly
		    		$validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value' readonly /></td></tr>");
		} else {
			echo("<p><input type='text' maxlength='$maxlength' name='$name' id='_$name' class='form-control autocomplete' data-toggle='tooltip' data-placement='left' title='$title' placeholder='$title' value='$value'
		    		$validation></p>");
			//echo ("<tr><td class='inputRow'><input type='text' id='_$name' name='$name' value='$value'/></td></tr>");
		}
	}
	/*
	 *Bloque de Código para los TextAreas
	 *@values Los valores de la función son:
	 *-La Etiqueta para El cuadro de Texto
	 *-El nombre de acceso por JavaScript del campo
	 */
	protected function textArea($label, $name, $value = '', $title = '', $disabled = '', $validation = '') {

		echo("<label for='input$name' class='textLabel'>$label</label>");
		echo("<p><textarea rows='10' name='$name' id='_$name' class='form-control' data-toggle='tooltip' data-placement='left' title='$title' placeholder='$title'
		    		$validation>$value</textarea></p>");

		/*if($title != ''){
			echo ("<tr><td class='formHead'><strong><label>$label</label></strong> <img title='$title' src='img/help.gif'/></td></tr>");
			echo ("<tr><td class='inputRow'><textarea $disabled id='_$name' name='$name' cols='20' rows='5'>$value</textarea></td></tr>");
		}else{
			echo ("<tr><td class='formHead'><strong><label>$label</label></strong></td></tr>");
			echo ("<tr><td class='inputRow'><textarea $disabled id='_$name' name='$name' cols='20' rows='5'>$value</textarea></td></tr>");

		}*/
	}

	protected function textAreaLittle($label, $name, $value = '', $title = '', $disabled = '', $validation = '') {

		echo("<label for='input$name' class='textLabel'>$label</label>");
		echo("<p><span id='max-length-element'>150</span> caracteres restantes
				<textarea rows='3' name='$name' id='_$name' class='form-control' data-toggle='tooltip' data-placement='left' title='$title' placeholder='$title'
		    		$validation>$value</textarea></p>");

		/*if($title != ''){
			echo ("<tr><td class='formHead'><strong><label>$label</label></strong> <img title='$title' src='img/help.gif'/></td></tr>");
			echo ("<tr><td class='inputRow'><textarea $disabled id='_$name' name='$name' cols='20' rows='5'>$value</textarea></td></tr>");
		}else{
			echo ("<tr><td class='formHead'><strong><label>$label</label></strong></td></tr>");
			echo ("<tr><td class='inputRow'><textarea $disabled id='_$name' name='$name' cols='20' rows='5'>$value</textarea></td></tr>");

		}*/
	}

	protected function _file($label, $name, $title = '',$size = '', $validation = '') {


		echo("<label for='input$name' class='textLabel'>$label</label>");
		if($size != ''){
			echo("<input type='hidden' name='MAX_FILE_SIZE' value='$size' />");
		}
		echo("<p><input type='file' name='$name' id='_$name' class='form-control' $validation></p>");

		//echo ("<tr><td class='formHead'><strong><label>$label</label></strong> <img title='$title' src='img/help.gif'/></td></tr>");
		//echo ("<tr><td class=''><input type='file' id='_$name' name='$name' /></td></tr>");
	}
	/*
	 *Bloque de Código para los PasswordFields
	 *@values Los valores de la función son:
	 *-La Etiqueta para El cuadro de Texto
	 *-El Tamaño en vista del cuadro de Texto
	 *-El nombre de acceso por JavaScript del campo
	 */
	protected function entryPasswordX($label, $size, $name) {

		echo ("<tr>\t\n<td class='formColumn label-column'>\t\n");
		echo ("<strong class='tstrong'>$label:</strong>\t\n</td>\t\n");
		echo ("<td class='formColumn value-column'>\t\n");
		echo ("<input type='password' name='$name' maxlength='$size'/>\t\n</td>\t\n</tr>\t\n");
	}
	/*
	 *Bloque de Código para los PasswordFields
	 *@values Los valores de la función son:
	 *-La Etiqueta para El cuadro de Texto
	 *-El Tamaño en vista del cuadro de Texto
	 *-El nombre de acceso por JavaScript del campo
	 */
	protected function entryPasswordTwoRows($label, $size, $name, $validation = '') {

		echo ("<tr><td class='formHead'><strong><label>$label</label></strong> </td></tr>");
		echo ("<tr><td class='inputRow'><input type='password' name='$name' maxlength='$size'/></td></tr>");
	}

	/*
	 *Bloque de Código para los Selects a.k.a ComboBox
	 *@values Los valores de la función son:
	 *-La Etiqueta para El Combo
	 *-El nombre de acceso por JavaScript del campo
	 *-Evento para el cuadro de texto, este campo es opcional. P.E. onkeypress
	 *-El arreglo de opciones para el combo con la estructura: array{array{value='..', label='..'}},
	 *en donde value es lo que se muestra al usuario, label es la etiqueta de la opción
	 */
	protected function select($label, $name, $event, $options, $selected = '',
			$disabled = '', $title = '', $required = '', $message = '') {

		echo('<div class="form-group">');
		echo('<div class="row">');
		echo('<div class="col-xs-5">');
		echo("<label for='ejemplo_$name'>$label</label>");
		//echo ("<tr><td class='inputRow'>");
		if ($event != '' && $disabled == '') {

			echo ("<select class='form-control' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\"" . $event
					. "\">\t\n");
		} elseif ($disabled != '') {

			echo ("<select class='form-control' placeholder='.col-xs-5' id='_$name' disabled='disabled'' name='$name' onchange=\""
					. $event . "\">\t\n");
		} elseif ($required != '' && $message != '') {

			echo ("<select class='form-control' data-validation='required' data-validation-error-msg='$message' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\""
					. $event . "\">\t\n");
		} elseif ($required != '') {

			echo ("<select class='form-control' data-validation='required' data-validation-error-msg='$message' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\""
					. $event . "\">\t\n");
		} else {
			echo ("<select class='form-control' placeholder='.col-xs-5' id='_$name' name='$name' >\t\n");
		}
		foreach ($options as $option) {

			if ($option['label'] === $selected || $option['value'] == $selected) {

				echo ("<option value='" . $option['value']
						. "' selected='selected'>" . $option['label']
						. "</option>\t\n");
			} else {
				echo ("<option value='" . $option['value'] . "'>"
						. $option['label'] . "</option>\t\n");
			}
		}
		echo ("</select>");
		echo('</div>');
		echo('</div>');
		echo('</div>');
	}

	protected function select2($label, $name, $event, $options, $selected = '',
			$disabled = '', $title = '', $required = '', $message = '') {

		echo("<label for='ejemplo_$name' class='textLabel'>$label</label>");
		echo('<p>');
		//echo ("<tr><td class='inputRow'>");
		if ($event != '' && $disabled == '') {

			echo ("<select class='form-control' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\"" . $event
					. "\">\t\n");
		} elseif ($disabled != '') {

			echo ("<select class='form-control' placeholder='.col-xs-5' id='_$name' disabled='disabled'' name='$name' onchange=\""
					. $event . "\">\t\n");
		} elseif ($required != '' && $message != '') {

			echo ("<select class='form-control' data-validation='required' data-toggle='tooltip' data-placement='left' title='$title' data-validation-error-msg='$message' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\""
					. $event . "\">\t\n");
		} elseif ($required != '') {

			echo ("<select class='form-control' data-validation='required' data-toggle='tooltip' data-placement='left' title='$title' data-validation-error-msg='$message' placeholder='.col-xs-5' id='_$name' name='$name' onchange=\""
					. $event . "\">\t\n");
		} else {
			echo ("<select class='form-control' data-toggle='tooltip' data-placement='left' title='$title' placeholder='.col-xs-5' id='_$name' name='$name' >\t\n");
		}
		foreach ($options as $option) {

			if ($option['label'] === $selected || $option['value'] == $selected) {

				echo ("<option value='" . $option['value']
						. "' selected='selected'>" . $option['label']
						. "</option>\t\n");
			} else {
				echo ("<option value='" . $option['value'] . "'>"
						. $option['label'] . "</option>\t\n");
			}
		}
		echo ("</select>");
		echo('</p>');
	}

	/*
	 *Dibuja un autucomplete
	 *@values Los valores de la función son:
	 *-La Etiqueta para texto
	 *- El valor si se ha seleccionado algo anteriormente
	 */
	protected function autocomplete($label, $name, $value = '') {

		echo "<div class=\"ui-widget\">";

		echo "<label for=\"_" . $name . "\">" . $label . ": </label>";
		echo "<input id=\"_" . $name . "\" name=\"" . $name . "\" />";
		echo "</div>";
	}

	/*
	 *Dibuja un autucomplete
	 *@values Los valores de la función son:
	 *-La Etiqueta para texto
	 *- El valor si se ha seleccionado algo anteriormente
	 */
	protected function autocompleteTwoColumns($label, $name, $valuename = '',
			$valueid = '') {
		echo ("<tr><td class='formHead'>");
		echo "<div id=\"" . $name . "_ui_label_wrapper\">";
		echo ("<strong><label for=\"" . $name . "_ui\">$label</label></strong>");
		echo ("</div>");
		echo ("</td></tr>");
		echo ("<tr><td class='inputRow'>");
		echo "<div id=\"" . $name . "_ui_input_wrapper\">";
		echo "<div class=\"ui-widget\">";
		echo "<input id=\"" . $name . "_ui\" name=\"" . $name
				. "_ui_name\" value=\"" . $valuename . "\" />";
		echo "</div>";
		echo "</div>";
		echo ("</td></tr>");
		echo "</div>";
		$this->hidden($name, $valueid);
	}

	/*
	 *Bloque de Código para los Botones
	 *@values Los valores de la función son:
	 *-El texto que aparece en el Boton
	 *-Evento para el cuadro de texto, este campo es opcional. P.E. onkeypress
	 */
	protected function button($value, $event) {
		echo ("<tr>\t\n<td colspan='2' align='center'>\t\n");
		echo ("<button type='button' class='button' onclick='$event'><span class='ok'>"
				. $value . "</span></button>");
		echo ("\t\n</td>\t\n</tr>\t\n");
	}
	protected function submitButton($value) {
		echo ("<tr>\t\n<td colspan='2'><center>\t\n");
		echo ("<button type='submit' class='button'><span class='ok'>" . $value
				. "</span></button>");
		echo ("\t\n</center></td>\t\n</tr>\t\n");
	}
	/*
	 *Bloque de Código para los Choice a.k.a RadioButtons
	 *@values Los valores de la función son:
	 *-La Etiqueta para El Grupo de Opciones
	 *-El arreglo de opciones para el combo con la estructura: array{array{value='..', label='..', name='..'}},
	 *en donde value es lo que se muestra al usuario, label es la etiqueta de la opción y name es el nombre de acceso para el radio group
	 */
	protected function choice($label, $choices, $checked = '', $event = '') {

		echo ("<tr>\t\n<td class='formColumn label-column'>\t\n<strong class='tstrong'>$label:</strong>\t\n");
		echo ("</td>\t\n<td class='formColumn value-column'>\t\n");
		foreach ($choices as $choice) {

			if ($checked === $choice['value']) {

				echo ($choice['label'] . "<input onclick=\"$event('"
						. $choice['value']
						. "')\" class='radio' checked='checked' name='"
						. $choice['name'] . "' type='radio' value='"
						. $choice['value'] . "' onclick=\"" . $choice['event']
						. "\"/>&nbsp;");
			} else {
				echo ($choice['label'] . "<input onclick=\"$event('"
						. $choice['value'] . "')\" class='radio' name='"
						. $choice['name'] . "' type='radio' value='"
						. $choice['value'] . "' onclick=\"" . $choice['event']
						. "\"/>&nbsp;");
			}
		}
		echo ("\t\n</td>\t\n</tr>\t\n");
	}
}
?>
