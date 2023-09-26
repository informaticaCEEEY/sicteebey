<?php
class FactorZoneController{

	private $model;

	function __construct(){

		$this->model=new FactorZoneModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join='', $order=''){

		return $this->model->listAll('', '', '', '', $order, $where, $whereFields, $join);
	}

	public function getEntityAction($id){

		return $this->model->getEntity($id);
	}

	public function getEntityByAction($field, $search){

		return $this->model->getBy($field, $search);
	}

	public function createAction(){

		extract($_POST);
		try{
			$object= new FactorZone();
			$object->setModality($modality);
			$object->setSchoolRegion($schoolRegion);
			$object->setZone($zone);
			$object->setLevel($level);
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
			$this -> model -> addFactorZone($object);
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function updateAction(){

		extract($_POST);
		if(isset($id)){

			$object= $this-> getEntityAction($id);
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		if(is_null($object)){

			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		try{
			$object->setModality($modality);
			$object->setZone($zone);
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
			$this -> model -> updateFactorZone($object);
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function deleteAction(){

		extract($_POST);
		extract($_GET);
		if(isset($form_id) && isset($id) && is_numeric($form_id) && is_numeric($id) && $id==$form_id){

			$form_id = intval($form_id);
			$object = $this -> getEntityAction($form_id);
			if($object != null){

				$this -> model -> deleteFactorZone($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function chartZone($where, $whereFields, $join = ''){

		$factorZoneList = $this -> displayByAction($where, $whereFields, $join);

		$isMediaNull = TRUE;
		$dataReportGeneral = "[['', 'Media', { role: 'annotation' }, { role: 'style' }],";
		for ($i = 0; $i < count($factorZoneList); $i++) {

			if ($factorZoneList[$i] -> getFactor() >= 9 && $factorZoneList[$i] -> getFactor() <= 11) {
				$factorName = $factorZoneList[$i] -> getFactorObject() -> getName() . '*';
			} else {
				$factorName = $factorZoneList[$i] -> getFactorObject() -> getName();
			}

			if($factorZoneList[$i]->getFactorObject()->getType() == 2){
				$factorName = $factorZoneList[$i] -> getFactorObject() -> getName() . '*';
			}elseif($factorZoneList[$i]->getFactorObject()->getType() == 3){
				$factorName = $factorZoneList[$i] -> getFactorObject() -> getName() . '**';
			}

			if ($factorZoneList[$i] -> getFactorCount() != 0) {
				if ($factorZoneList[$i]->getFactorObject()->getTrend() == 2) {
					if ($factorZoneList[$i] -> getMedia() > 0) {
						$dataReportGeneral .= "['" . $factorName . "'," . round($factorZoneList[$i] -> getMedia(), 2) . ",'" .
						round($factorZoneList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
					} else {
						$dataReportGeneral .= "['" . $factorName . "'," . round($factorZoneList[$i] -> getMedia(), 2) . ",'" .
						round($factorZoneList[$i] -> getMedia(), 2) . "', '#3AC777'],";
					}
				} else {
					if ($factorZoneList[$i] -> getMedia() > 0) {
						$dataReportGeneral .= "['" . $factorName . "'," . round($factorZoneList[$i] -> getMedia(), 2) . ",'" .
						round($factorZoneList[$i] -> getMedia(), 2) . "', '#3AC777'],";
					} else {
						$dataReportGeneral .= "['" . $factorName . "'," . round($factorZoneList[$i] -> getMedia(), 2) . ",'" .
						round($factorZoneList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
					}
				}
			} else {
				$isMediaNull = FALSE;
				$messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
				$dataReportGeneral .= "['" . $factorName . "'," . 0 . ",'" . $messageMediaNull . "', ''],";
			}
		}

		if(empty($factorZoneList)){
			$isMediaNull = FALSE;
			$messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
			$dataReportGeneral .= "['" . 'Informaci\u00F3n no disponible' . "'," . '0' . ",'" . $messageMediaNull . "', ''],";
		}
		$dataReportGeneral .= ']';
		return $dataReportGeneral;
	}

}
?>
