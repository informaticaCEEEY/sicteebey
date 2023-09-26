<?php
class IndexZoneController{

	private $model;

	function __construct(){

		$this->model=new IndexZoneModel();
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
			$object= new IndexZone();
			$object->setModality($modality);
			$object->setSchoolRegion($schoolRegion);
			$object->setZone($zone);
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$this -> model -> addIndexZone($object);
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
			$object->setSchoolRegion($schoolRegion);
			$object->setZone($zone);
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$this -> model -> updateIndexZone($object);
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

				$this -> model -> deleteIndexZone($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function chartZone($where, $whereFields, $join = ''){

        $indexZoneList = $this -> displayByAction($where, $whereFields, $join);
		
        $isMediaNull = TRUE;
        $dataReportGeneral = "[['', 'Media', { role: 'annotation' }, { role: 'style' }],";
        for ($i = 0; $i < count($indexZoneList); $i++) {

                $indexName = $indexZoneList[$i] -> getIndexListObject() -> getName();

            if ($indexZoneList[$i] -> getMedia() != 999) {
                if ($indexZoneList[$i] -> getIndexList() == 3 || $indexZoneList[$i] -> getIndexList() == 9) {
                    if ($indexZoneList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexZoneList[$i] -> getMedia(), 2) . ",'" .
                            round($indexZoneList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexZoneList[$i] -> getMedia(), 2) . ",'" .
                            round($indexZoneList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    }
                } else {
                    if ($indexZoneList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexZoneList[$i] -> getMedia(), 2) . ",'" .
                            round($indexZoneList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexZoneList[$i] -> getMedia(), 2) . ",'" .
                            round($indexZoneList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    }
                }
            } else {
                $isMediaNull = FALSE;
                $messageMediaNull = "La media del \u00EDndice no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $indexName . "'," . 0 . ",'" .
                    $messageMediaNull . "', ''],";

            }
        }
        if(empty($indexZoneList)){
            $isMediaNull = FALSE;
            $messageMediaNull = "La media del \u00EDndice no se encuentra disponible por falta de datos.";
            $dataReportGeneral .= "['" . 'Informaci\u00F3n no disponible' . "'," . '0'
                                                     . ",'" . $messageMediaNull . "', ''],";
        }
        $dataReportGeneral .= ']';

        return $dataReportGeneral;
    }

}
?>
