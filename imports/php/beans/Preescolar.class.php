<?php
class Preescolar{

	private $id;

	private $idAlumno;

	private $nombre;

	private $apellidoPaterno;

	private $aMaterno;

	private $ciclo;

	private $curp;

	private $cct;

	private $escuela;

	private $grado;

	private $grupo;

	private $turno;

	private $nivel;

	private $modalidad;

	private $sector;

	private $zona;

	private $estatus;

	function __construct($id=''){

		if($id!=''){

			$this->id=Validate::validateInteger($id);
		}
	}
	public function setId($id){

		$this->id=$id;
	}

	public function getId(){

		return $this->id;
	}

	public function setIdAlumno($idAlumno){

		$this->idAlumno=$idAlumno;
	}

	public function getIdAlumno(){

		return $this->idAlumno;
	}

	public function setNombre($nombre){

		$this->nombre=Validate::validateEmpty($nombre);
	}

	public function getNombre(){

		return $this->nombre;
	}

	public function setApellidoPaterno($apellidoPaterno){

		$this->apellidoPaterno=Validate::validateEmpty($apellidoPaterno);
	}

	public function getApellidoPaterno(){

		return $this->apellidoPaterno;
	}

	public function setAMaterno($aMaterno){

		$this->aMaterno=Validate::validateEmpty($aMaterno);
	}

	public function getAMaterno(){

		return $this->aMaterno;
	}

	public function setCiclo($ciclo){

		$this->ciclo=Validate::validateEmpty($ciclo);
	}

	public function getCiclo(){

		return $this->ciclo;
	}

	public function setCurp($curp){

		$this->curp=Validate::validateEmpty($curp);
	}

	public function getCurp(){

		return $this->curp;
	}

	public function setCct($cct){

		$this->cct=Validate::validateEmpty($cct);
	}

	public function getCct(){

		return $this->cct;
	}

	public function setEscuela($escuela){

		$this->escuela=Validate::validateEmpty($escuela);
	}

	public function getEscuela(){

		return $this->escuela;
	}

	public function setGrado($grado){

		$this->grado=Validate::validateEmpty($grado);
	}

	public function getGrado(){

		return $this->grado;
	}

	public function setGrupo($grupo){

		$this->grupo=Validate::validateEmpty($grupo);
	}

	public function getGrupo(){

		return $this->grupo;
	}

	public function setTurno($turno){

		$this->turno=Validate::validateEmpty($turno);
	}

	public function getTurno(){

		return $this->turno;
	}

	public function setNivel($nivel){

		$this->nivel=Validate::validateEmpty($nivel);
	}

	public function getNivel(){

		return $this->nivel;
	}

	public function setModalidad($modalidad){

		$this->modalidad=Validate::validateEmpty($modalidad);
	}

	public function getModalidad(){

		return $this->modalidad;
	}

	public function setSector($sector){

		$this->sector=Validate::validateEmpty($sector);
	}

	public function getSector(){

		return $this->sector;
	}

	public function setZona($zona){

		$this->zona=Validate::validateEmpty($zona);
	}

	public function getZona(){

		return $this->zona;
	}

	public function setEstatus($estatus){

		$this->estatus=Validate::validateEmpty($estatus);
	}

	public function getEstatus(){

		return $this->estatus;
	}

	public function dataVector(){

		$vector= array();
		array_push($vector, $this->getId());
		array_push($vector, $this->getIdAlumno());
		array_push($vector, $this->getNombre());
		array_push($vector, $this->getApellidoPaterno());
		array_push($vector, $this->getAMaterno());
		array_push($vector, $this->getCiclo());
		array_push($vector, $this->getCurp());
		array_push($vector, $this->getCct());
		array_push($vector, $this->getEscuela());
		array_push($vector, $this->getGrado());
		array_push($vector, $this->getGrupo());
		array_push($vector, $this->getTurno());
		array_push($vector, $this->getNivel());
		array_push($vector, $this->getModalidad());
		array_push($vector, $this->getSector());
		array_push($vector, $this->getZona());
		array_push($vector, $this->getEstatus());
		return $vector;
	}
}
?>