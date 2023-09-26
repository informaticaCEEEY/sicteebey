<?php
class FactorCctController{

	private $model;

	function __construct(){

		$this->model=new FactorCctModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join=''){

		return $this->model->listAll('', '', '', '', '', $where, $whereFields, $join);
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
			$object= new FactorCct();
			$object->setCct($cct);
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
			$this -> model -> addFactorCct($object);
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
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
			$this -> model -> updateFactorCct($object);
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

				$this -> model -> deleteFactorCct($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

    public function chartSchool($where, $whereFields, $join = ''){
              
        $factorSchoolList = $this -> displayByAction($where, $whereFields, $join);
                     
        /*$factorIndexController = new FactorsIndexController();
        $factorIndex = $factorIndexController->displayByAction('index_list = :indexList', 
            array('indexList' => $whereFields['indexList']));
       */
        
        $isMediaNull = TRUE;
        $dataReportGeneral = "[['', 'Media', { role: 'annotation' }, { role: 'style' }],";
        for ($i = 0; $i < count($factorSchoolList); $i++) {
        
            if ($factorSchoolList[$i] -> getFactor() > 8 && $factorSchoolList[$i]->getFactorObject()->getYearApplication() == 2015) {
                $factorName = $factorSchoolList[$i] -> getFactorObject() -> getName() . '*';
            } else {
                $factorName = $factorSchoolList[$i] -> getFactorObject() -> getName();
            }
            
            if($factorSchoolList[$i]->getFactorObject()->getType() == 2){
                $factorName = $factorSchoolList[$i] -> getFactorObject() -> getName() . '*';
            }elseif($factorSchoolList[$i]->getFactorObject()->getType() == 3){
                $factorName = $factorSchoolList[$i] -> getFactorObject() -> getName() . '**';
            }
        
            if ($factorSchoolList[$i] -> getFactorCount() != 0) {
                if ($factorSchoolList[$i]->getFactorObject()->getTrend() == 2) {
                    if ($factorSchoolList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorSchoolList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    } else {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorSchoolList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    }
                } else {
                    if ($factorSchoolList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorSchoolList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    } else {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorSchoolList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorSchoolList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    }
                }
            } else {
                $isMediaNull = FALSE;
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $factorName . "'," . 0 . ",'" . 
                    $messageMediaNull . "', ''],";
        
            }
        }
        if(empty($factorSchoolList)){
            $isMediaNull = FALSE;
            $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
            $dataReportGeneral .= "['" . 'Informaci\u00F3n no disponible' . "'," . '0'
                                                     . ",'" . $messageMediaNull . "', ''],";                    
        }
        $dataReportGeneral .= ']';
        return $dataReportGeneral;
    }

}
?>