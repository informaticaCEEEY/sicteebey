<?php
class NewsForm extends AbstractForm{
	
	private function exploitNewsStatus($array) {

		$exploit = array();
		
		array_push($exploit, array('value' => '', 'label' => 'Seleccione el estatus'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}
	
	private function exploitNewsType($array) {

		$exploit = array();
		array_push($exploit, array('value' => '', 'label' => 'Seleccione el tipo'));
		foreach ($array as $entry) {

			array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
		}
		return $exploit;
	}

	public function addForm($idUser){
		
		$controller = new NewsStatusController();
		$newsStatus = $this -> exploitNewsStatus($controller -> displayAction());
		
		$controller = new NewsTypeController();
		$newsType = $this -> exploitNewsType($controller -> displayAction());

		$this -> hidden('action', 'add');
		$this -> hidden('autor', $idUser);
		//echo("<table width='100%' border='0' class='tableForm'>");
		echo("<div class='row'>");
		echo("	<div class='col-md-12'>");	
		$this -> formHeader('Agregar Evento');		
		$this -> select2('Tipo de noticia', 'type', '', $newsType,'','','Tipo de noticia', 'required', 'Seleccione un tipo');		
		$this -> select2('Estatus de la noticia', 'status', '', $newsStatus,'','','Estatus de la noticia', 'required', 'Seleccione un estatus');
		$this -> calendar('Fecha de publicaci&oacute;n', 'publicationDate', 'Fecha de publicaci&oacute;n', '', 'data-validation="required" data-validation-error-msg="Seleccione la fecha de publicaci&oacute;n para la noticia"');
		$this->_file("Imagen de la noticia", "image", '', '2000000', 'data-validation="required mime" data-validation-allowing="jpg, png" data-validation-error-msg="Seleccione la imagen para la noticia" data-validation-error-msg-mime="Solo se pueden subir imagenes en formato jpg o png"');		
		$this -> entryText('T&iacute;tulo de la noticia','title', '','Ingrese el t&iacute;tulo de la noticia', '', '', '', 'data-validation="required" data-validation-error-msg="Ingrese el t&iacute;tulo de la noticia"');
		$this -> textAreaLittle('Resumen', 'summary', '', 'Resumen de la noticia', '', 'data-validation="required" data-validation-error-msg="Ingrese el resumen de la noticia"');
		$this -> entryText('Redirecci&oacute;n','redirect', '','Ingrese el enlace completo de la pagina a la que se va a redireccionar', '', '', '', 'data-validation="url" data-validation-optional="true" data-validation-error-msg="Ingrese un enlace valido"');
		$this -> textArea('Contenido', 'content', '', 'Contenido de la noticia');		
		echo("	</div>");
		echo("</div>");
	}

	public function editForm(News $entity, $idUser){
		
		$controller = new NewsStatusController();
		$newsStatus = $this -> exploitNewsStatus($controller -> displayAction());
		
		$controller = new NewsTypeController();
		$newsType = $this -> exploitNewsType($controller -> displayAction());
		
		$date = new DateTime($entity->getPublicationDate(), new DateTimeZone('	America/Mexico_City'));

		$this -> hidden('action', 'edit');
		$this -> hidden('id', $entity->getId());
        $this -> hidden('autor', $idUser);
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar Evento');
		$this -> select2('Tipo de noticia', 'type', '', $newsType, $entity->getType(),'','Tipo de noticia', 'required', 'Seleccione un tipo');		
		$this -> select2('Estatus de la noticia', 'status', '', $newsStatus, $entity->getStatus(),'','Estatus de la noticia', 'required', 'Seleccione un estatus');
		$this -> calendar('Fecha de publicaci&oacute;n', 'publicationDate', 'Fecha de publicaci&oacute;n', $date->format('d/m/Y H:i'), 'data-validation="required" data-validation-error-msg="Seleccione la fecha de publicaci&oacute;n para la noticia"');
		$this->_file("Imagen de la noticia", "image", '', '2000000', 'data-validation="mime size" data-validation-allowing="jpg, png" data-validation-max-size="2M" data-validation-error-msg="Seleccione la imagen para la noticia" data-validation-error-msg-mime="Solo se pueden subir imagenes en formato jpg o png" data-validation-error-msg-size="Solo se pueden subir archivos ,enores de 2mb"');
		echo('<label><a href="../docs/imagenes/' . $entity->getImage() . '">Ver imagen</a></label><br>');				
		$this -> entryText('T&iacute;tulo de la noticia','title', '','Ingrese el t&iacute;tulo de la noticia', $entity->getTitle(), '', '', 'data-validation="required" data-validation-error-msg="Ingrese el t&iacute;tulo de la noticia"');
		$this -> textAreaLittle('Resumen', 'summary', $entity->getSummary(), 'Resumen de la noticia', '', 'data-validation="required" data-validation-error-msg="Ingrese el resumen de la noticia"');
		$this -> entryText('Redirecci&oacute;n','redirect', '','Ingrese el enlace de la pagina a la que se va a redireccionar. Ejemplo http://www.google.com', $entity->getRedirect(), '', '', 'data-validation="url" data-validation-optional="true" data-validation-error-msg="Ingrese un enlace valido"');
		$this -> textArea('Contenido', 'content', $entity->getContent(), 'Contenido de la noticia');	
		echo("</table>");
	}

}
?>