<?php
class IndexCctController{

	private $model;

	function __construct(){

		$this->model=new IndexCctModel();
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
			$object= new IndexCct();
			$object->setCct($cct);
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$this -> model -> addIndexCct($object);
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
			$object->setCct($cct);
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$this -> model -> updateIndexCct($object);
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

				$this -> model -> deleteIndexCct($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function chartSchool($school){
            
        $where = 'cct LIKE :school';        
        $whereFields = array('school' => $school);
        $indexSchoolList = $this -> displayByAction($where, $whereFields);
        
        $indexListController = new IndexListController();
        $indexList = $indexListController->displayAction();
       
        $isMediaNull = TRUE;
        $dataReportGeneral = "[['', 'Media', { role: 'annotation' }, { role: 'style' }],";
        for ($i = 0; $i < count($indexSchoolList); $i++) {
        
            $indexName = $indexSchoolList[$i] -> getIndexListObject() -> getName();
        
            if ($indexSchoolList[$i] -> getMedia() != 999) {
                if ($indexSchoolList[$i] -> getIndexList() == 3 || $indexSchoolList[$i] -> getIndexList() == 9) {
                    if ($indexSchoolList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexSchoolList[$i] -> getIndexListObject() -> getName() . "'," . 
                            round($indexSchoolList[$i] -> getMedia(), 2) . ",'" . round($indexSchoolList[$i] -> getMedia(), 2) . 
                            "', '#E9F26D'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexSchoolList[$i] -> getIndexListObject() -> getName() . "'," . 
                            round($indexSchoolList[$i] -> getMedia(), 2) . ",'" . round($indexSchoolList[$i] -> getMedia(), 2) . 
                            "', '#3AC777'],";
                    }
                } else {
                    if ($indexSchoolList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($indexSchoolList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($indexSchoolList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    }
                }
            } else {
                $isMediaNull = FALSE;
                $messageMediaNull = "La media del \u00EDndice no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $indexName . "'," . 0 . ",'" . 
                    $messageMediaNull . "', ''],";
        
            }
        }
        /*if(empty($indexSchoolList)){
            $isMediaNull = FALSE;
            $messageMediaNull = "La media del \u00EDndice no se encuentra disponible por falta de datos.";
            for ($i = 0; $i < count($indexList); $i++) {
                $dataReportGeneral .= "['" . $indexList[$i]->getName() . "'," . 0 . ",'" . 
                    $messageMediaNull . "', ''],";    
            }                       
        }*/
        $dataReportGeneral .= ']';
        
        if(empty($indexSchoolList)){
            $dataReportGeneral = FALSE;
        }
        
        return $dataReportGeneral;
    }

}
?>