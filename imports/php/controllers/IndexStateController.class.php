<?php
class IndexStateController{

	private $model;

	function __construct(){

		$this->model=new IndexStateModel();
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
			$object= new IndexState();
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$object->setTotal($total);
			$this -> model -> addIndexState($object);
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
			$object->setIndexList($indexList);
			$object->setMedia($media);
			$object->setTotal($total);
			$this -> model -> updateIndexState($object);
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

				$this -> model -> deleteIndexState($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function chartState(){
            
        $indexStateList = $this -> displayAction();
           
        $isMediaNull = TRUE;
        $dataReportGeneral = "[['', 'Media', { role: 'annotation' }, { role: 'style' }],";
        for ($i = 0; $i < count($indexStateList); $i++) {
        
            $indexName = $indexStateList[$i] -> getIndexListObject() -> getName();
            
            if ($indexStateList[$i] -> getMedia() != 999) {
                if ($indexStateList[$i] -> getIndexList() == 3 || $indexStateList[$i] -> getIndexList() == 9) {
                    if ($indexStateList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexStateList[$i] -> getIndexListObject() -> getName() . "'," . 
                            round($indexStateList[$i] -> getMedia(), 2) . ",'" . round($indexStateList[$i] -> getMedia(), 2) . 
                            "', '#E9F26D'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexStateList[$i] -> getIndexListObject() -> getName() . "'," . 
                            round($indexStateList[$i] -> getMedia(), 2) . ",'" . round($indexStateList[$i] -> getMedia(), 2) . 
                            "', '#3AC777'],";
                    }
                } else {
                    if ($indexStateList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($indexStateList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    } else {
                        $dataReportGeneral .= "['" . $indexName . "'," . round($indexStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($indexStateList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    }
                }
            } else {
                $isMediaNull = FALSE;
                $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
                $dataReportGeneral .= "['" . $indexName . "'," . round($indexStateList[$i] -> getMedia(), 2) . ",'" . 
                    $messageMediaNull . "', ''],";
        
            }
        }
        $dataReportGeneral .= ']';
        return $dataReportGeneral;
    }

}
?>