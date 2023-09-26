<?php
class IndexListController{

	private $model;

	function __construct(){

		$this->model=new IndexListModel();
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
    
    public function redirectAction(){

        extract($_POST);
        try{
                
            if (!isset($_POST['indexList'])) {    
                echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
                echo('<script>document.forms.valid.submit()</script>');
                exit;
            }
            
            switch($indexList){              
                case 9:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                                        
                    echo('<form name="valid" id="valid" action="../factorIndexState.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                case 10:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                    
                    echo('<form name="valid" id="valid" action="../factorIndexState.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                default:                    
                    echo('<form name="valid" id="valid" action="../factorStateDirector.php" method="post">');
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
            }
            
        }catch(Exception $e){
            $_SESSION['flash'] = $e->getMessage();
            echo('<script>javascript:history.go(-1)</script>');
        }
    }

    public function redirectSchoolZoneAction(){

        extract($_POST);
        try{
                
            if (!isset($_POST['indexList']) || !isset($_POST['schoolZone'])) {    
                echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
                echo('<script>document.forms.valid.submit()</script>');
                exit;
            }
            
            $schoolZoneController = new SchoolRegionZoneController();
            $schoolZoneObject = $schoolZoneController->getEntityAction($schoolZone);
            
            if(!$schoolZoneObject){
                throw new Exception('La zona escolar no es correcta.');
            }
            
            switch($indexList){              
                case 9:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                    
                    echo('<form name="valid" id="valid" action="../factorIndexZone.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                case 10:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                    
                    echo('<form name="valid" id="valid" action="../factorIndexZone.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                default:                    
                    echo('<form name="valid" id="valid" action="../factorSchoolZoneDirector.php" method="post">');
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
            }
            
        }catch(Exception $e){
            $_SESSION['flash'] = $e->getMessage();
            echo('<script>javascript:history.go(-1)</script>');
        }
    }
    
    public function redirectSchoolAction(){

        extract($_POST);
        try{
                
            if (!isset($_POST['indexList']) || !isset($_POST['cct'])) {    
                echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
                echo('<script>document.forms.valid.submit()</script>');
                exit;
            }
            
            $schoolController = new SchoolController();
            $schoolObject = $schoolController->getEntityByAction('cct', $cct);
            
            if(!$schoolObject){
                throw new Exception('La clave del centro de trabajo no es correcta.');
            }

            $school = $schoolObject[0]->getId();
            
            switch($indexList){              
                case 9:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                    
                    echo('<form name="valid" id="valid" action="../factorIndexSchool.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                case 10:
                    
                    $factorIndexController = new FactorsIndexController();
                    $factorIndex = $factorIndexController->getEntityByAction('index_list', $_POST['indexList']);
                    
                    $factor = $factorIndex[0]->getFactor();
                    
                    echo('<form name="valid" id="valid" action="../factorIndexSchool.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
                default:                    
                    echo('<form name="valid" id="valid" action="../factorSchoolDirector.php" method="post">');
                    echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
                    echo("<input name='school' id='school' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>'); 
                    break;
            }
            
        }catch(Exception $e){
            $_SESSION['flash'] = $e->getMessage();
            echo('<script>javascript:history.go(-1)</script>');
        }
    }

	public function createAction(){

		extract($_POST);
		try{
			$object= new IndexList();
			$object->setName($name);
			$this -> model -> addIndexList($object);
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
			$object->setName($name);
			$this -> model -> updateIndexList($object);
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

				$this -> model -> deleteIndexList($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function listAction(){

/*TO DO Colocar los campos a mostrar*/
$fields = array();$total = $this -> model -> countActives();
if ($total == 0) {
$output = array('sEcho' => intval($_GET['sEcho']), 'iTotalRecords' => count(0), 'iTotalDisplayRecords' => count(0), 'aaData' => array());
} else {
$order = '';
if (isset($_GET['iSortCol_0'])) {
for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == 'true') {
if (intval($_GET['iSortCol_' . $i]) == 0) {
$order .= $fields[intval($_GET['iSortCol_' . $i])] . ' ' . $_GET['sSortDir_' . $i] . ', ';
} else {
$order .= $fields[intval($_GET['iSortCol_' . $i]) - 1] . ' ' . $_GET['sSortDir_' . $i] . ', ';
}
}
}
$order = substr_replace($order, '', -2);
}
$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order);
$output = array('sEcho' => intval($_GET['sEcho']), 'iTotalRecords' => $total, 'iTotalDisplayRecords' => $total, 'aaData' => array());
foreach ($result as $data) {
$row = array();
/*TO DO Colocar los campos a mostrar*/
$output['aaData'][] = $row;
}
}
echo(json_encode($output));
	}

}
?>