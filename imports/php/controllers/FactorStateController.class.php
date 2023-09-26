<?php
class FactorStateController{

	private $model;

	function __construct(){

		$this->model=new FactorStateModel();
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
			$object= new FactorState();
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
            $object->setYear($year);
			$this -> model -> addFactorState($object);
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
			$object->setFactor($factor);
			$object->setMedia($media);
			$object->setFactorCount($factorCount);
            $object->setYear($year);
			$this -> model -> updateFactorState($object);
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

				$this -> model -> deleteFactorState($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}
    
    public function chartState($where, $whereFields="", $join=""){
        
        
        $factorStateList = $this -> displayByAction($where, $whereFields, $join);
        
        $dataReportGeneral = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
        for ($i = 0; $i < count($factorStateList); $i++) {            
            if ($factorStateList[$i] -> getFactor() == 1) {
                if ($factorStateList[$i] -> getMedia() > 0) {
                    $dataReportGeneral .= "['" . $factorStateList[$i] -> getFactorObject() -> getName() . "'," . 
                        round($factorStateList[$i] -> getMedia(), 2) . ",'" . round($factorStateList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                } else {
                    $dataReportGeneral .= "['" . $factorStateList[$i] -> getFactorObject() -> getName() . "'," . 
                        round($factorStateList[$i] -> getMedia(), 2) . ",'" . round($factorStateList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                }
            } else {
                if ($factorStateList[$i] -> getFactor() > 8 && $factorStateList[$i] -> getYear() == 2015) {
                    $factorName = $factorStateList[$i] -> getFactorObject() -> getName() . '*';
                } else {
                    $factorName = $factorStateList[$i] -> getFactorObject() -> getName();
                }
                if($factorStateList[$i]->getFactorObject()->getType() == 2){
                    $factorName = $factorStateList[$i] -> getFactorObject() -> getName() . '*';
                }elseif($factorStateList[$i]->getFactorObject()->getType() == 3){
                    $factorName = $factorStateList[$i] -> getFactorObject() -> getName() . '**';
                }
                
                if ($factorStateList[$i]->getFactorObject()->getTrend() == 2) {
                    if ($factorStateList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorStateList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    } else {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorStateList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    }
                } else {
                    if ($factorStateList[$i] -> getMedia() > 0) {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorStateList[$i] -> getMedia(), 2) . "', '#3AC777'],";
                    } else {
                        $dataReportGeneral .= "['" . $factorName . "'," . round($factorStateList[$i] -> getMedia(), 2) . ",'" . 
                            round($factorStateList[$i] -> getMedia(), 2) . "', '#E9F26D'],";
                    }
                }
            }
        }
        $dataReportGeneral .= ']';
        
        return $dataReportGeneral;
    }

    function teacherInteraction(){
           
        $teacherInteractionTotal = 0;
        $teacherInteractionController = new TeacherInteractionController();
        $teacherInteractionList = $teacherInteractionController -> displayAction();
        $teacherInteractionTotal = count($teacherInteractionTotal);
        
        $teacherInteractionArray = array();
        $teacherInteractionName = array("0" => "No", "1" => "Si", "2" => "Sin respuesta");
        
        $teacherInteractionQuestions = array(1 => 'Tu maestro,  \u00BFte cae bien?', 2 => 'Tu maestro,  \u00BFte trata bien?', 
            3 => 'Tu maestro,  \u00BFte felicita cuando te portas bien?', 4 => 'Tu maestro,  \u00BFte felicita cuando respondes bien?', 
            5 => 'Tu maestro,  \u00BFte anima para hacer la tarea?');
        
        foreach ($teacherInteractionList as $teacherInteraction) {
            switch($teacherInteraction->getR8_R8()) {
                case 0 :
                    ++$teacherInteractionArray[1][0];
                    break;
                case 1 :
                    ++$teacherInteractionArray[1][1];
                    break;
                case 999 :
                    ++$teacherInteractionArray[1][2];
                    break;
            }
        
            switch($teacherInteraction->getR9_R9()) {
                case 0 :
                    ++$teacherInteractionArray[2][0];
                    break;
                case 1 :
                    ++$teacherInteractionArray[2][1];
                    break;
                case 999 :
                    ++$teacherInteractionArray[2][2];
                    break;
            }
        
            switch($teacherInteraction->getR10_R12()) {
                case 0 :
                    ++$teacherInteractionArray[3][0];
                    break;
                case 1 :
                    ++$teacherInteractionArray[3][1];
                    break;
                case 999 :
                    ++$teacherInteractionArray[3][2];
                    break;
            }
        
            switch($teacherInteraction->getR11_R17()) {
                case 0 :
                    ++$teacherInteractionArray[4][0];
                    break;
                case 1 :
                    ++$teacherInteractionArray[4][1];
                    break;
                case 999 :
                    ++$teacherInteractionArray[4][2];
                    break;
            }
        
            switch($teacherInteraction->getR12_R19()) {
                case 0 :
                    ++$teacherInteractionArray[5][0];
                    break;
                case 1 :
                    ++$teacherInteractionArray[5][1];
                    break;
                case 999 :
                    ++$teacherInteractionArray[5][2];
                    break;
            }
        }
        
        $cols[] = array("id"=>"","label"=>"Categoria","pattern"=>"","type"=>"string");
        $cols[] = array("id"=>"","label"=>"Sin respuesta","pattern"=>"","type"=>"number"); 
        $cols[] = array("id"=>"","label"=>"No","pattern"=>"","type"=>"number");
        $cols[] = array("id"=>"","label"=>"Si","pattern"=>"","type"=>"number");
        $dataInteractionTeacher = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
        foreach($teacherInteractionQuestions as $key => $value){
            
            if($teacherInteractionArray[$key][0] == ''){
                $teacherInteractionArray[$key][0] = 0;
            }
            if($teacherInteractionArray[$key][1] == ''){
                $teacherInteractionArray[$key][1] = 0;
            }
            if($teacherInteractionArray[$key][2] == ''){
                $teacherInteractionArray[$key][2] = 0;
            }
            $rows[] = array("c"=>array(array("v"=>$teacherInteractionQuestions[$key],"f"=>null),
                array("v"=>(int)$teacherInteractionArray[$key][2],"f"=>null),
                array("v"=>(int)$teacherInteractionArray[$key][0],"f"=>null),
                array("v"=>(int)$teacherInteractionArray[$key][1],"f"=>null)));
            $dataInteractionTeacher .= "['" . $teacherInteractionQuestions[$key] . "'," . $teacherInteractionArray[$key][2] . "," . 
                $teacherInteractionArray[$key][0] . "," . $teacherInteractionArray[$key][1] . "],";
            
        }
        $dataInteractionTeacher .= ']';
        foreach($rows as &$record){
            array_map(utf8_encode,$record);
        }
        $array = array("cols"=>$cols,"rows"=>$rows);
        return $array;
    }

}
?>