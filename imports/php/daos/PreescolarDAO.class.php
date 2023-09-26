<?php
class PreescolarDAO extends AbstractDAO implements ManipulateObjects {

	function __construct($id=''){

		parent::__construct('preescolar', 'id');
	}

	public function createObject($data=null){

		if($data!=null){

			extract($data);
			$object = new Preescolar(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setId(gosSanitizer::sanitizeForHTMLContent($id));
			$object->setIdAlumno(gosSanitizer::sanitizeForHTMLContent($idAlumno));
			$object->setNombre(gosSanitizer::sanitizeForHTMLContent($nombre));
			$object->setApellidoPaterno(gosSanitizer::sanitizeForHTMLContent($apellidoPaterno));
			$object->setAMaterno(gosSanitizer::sanitizeForHTMLContent($aMaterno));
			$object->setCiclo(gosSanitizer::sanitizeForHTMLContent($ciclo));
			$object->setCurp(gosSanitizer::sanitizeForHTMLContent($curp));
			$object->setCct(gosSanitizer::sanitizeForHTMLContent($cct));
			$object->setEscuela(gosSanitizer::sanitizeForHTMLContent($escuela));
			$object->setGrado(gosSanitizer::sanitizeForHTMLContent($grado));
			$object->setGrupo(gosSanitizer::sanitizeForHTMLContent($grupo));
			$object->setTurno(gosSanitizer::sanitizeForHTMLContent($turno));
			$object->setNivel(gosSanitizer::sanitizeForHTMLContent($nivel));
			$object->setModalidad(gosSanitizer::sanitizeForHTMLContent($modalidad));
			$object->setSector(gosSanitizer::sanitizeForHTMLContent($sector));
			$object->setZona(gosSanitizer::sanitizeForHTMLContent($zona));
			$object->setEstatus(gosSanitizer::sanitizeForHTMLContent($estatus));
			return $object;
		}else{
			return null;
		}
	}

	public function getEntity($id){

		$objects = $this -> getBy($this -> keyValue, $id);
		if(count($objects)==1){

			return $objects[0];
		}else{
			return null;
		}
	}

	public function add(Preescolar $entity=null){

		if($entity!=null){

			$this->addObject($entity);
		}
	}

	public function update(Preescolar $entity=null){

		if($entity!=null){

			$this->updateObject($entity);
		}
	}

	public function delete(Preescolar $entity=null){

		if($entity!=null){

			$this->deleteObject($entity);
		}
	}

	public function listObjects($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join){

		return $this -> listAll($startLimit, $endLimit, $search, $fields, $order, $where, $whereFields, $join);
	}

}
?>