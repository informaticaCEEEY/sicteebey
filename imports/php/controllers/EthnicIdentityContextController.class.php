<?php
class EthnicIdentityContextController{

	private $model;

	function __construct(){

		$this->model=new EthnicIdentityContextModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}
    
    public function display2Action(){

        return $this->model->listAll2('', '', '', '', '', '', '', '');
    }

	public function displayByAction($where='', $whereFields='', $join=''){

		return $this->model->listAll('', '', '', '', '', $where, $whereFields, $join);
	}
    
    public function displayBy2Action($where='', $whereFields='', $join=''){

        return $this->model->listAll2('', '', '', '', '', $where, $whereFields, $join);
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
			$object= new EthnicIdentityContext();
			$object->setStudent($student);
			$object->setFolio($folio);
			$object->setCct($cct);
			$object->setP10O1($P10O1);
			$object->setP10O2($P10O2);
			$object->setP10O3($P10O3);
			$object->setP10O5($P10O5);
			$object->setP11O5($P11O5);
			$object->setP11O6($P11O6);
			$object->setP11O7($P11O7);
			$object->setAnswered($answered);
			$this -> model -> addEthnicIdentityContext($object);
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
			$object->setStudent($student);
			$object->setFolio($folio);
			$object->setCct($cct);
			$object->setP10O1($P10O1);
			$object->setP10O2($P10O2);
			$object->setP10O3($P10O3);
			$object->setP10O5($P10O5);
			$object->setP11O5($P11O5);
			$object->setP11O6($P11O6);
			$object->setP11O7($P11O7);
			$object->setAnswered($answered);
			$this -> model -> updateEthnicIdentityContext($object);
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

				$this -> model -> deleteEthnicIdentityContext($object);
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