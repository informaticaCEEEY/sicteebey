<?php
class ContextoAnswersController{

	private $model;

	function __construct(){

		$this->model=new ContextoAnswersModel();
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
			$object= new ContextoAnswers();
			$object->setStudent($student);
			$object->setFolio($folio);
			$object->setCct($cct);
			$object->setP1O1($P1O1);
			$object->setP1O2($P1O2);
			$object->setP2O1($P2O1);
			$object->setP2O2($P2O2);
			$object->setP2O3($P2O3);
			$object->setP2O4($P2O4);
			$object->setP2O5($P2O5);
			$object->setP2O6($P2O6);
			$object->setP4O1($P4O1);
			$object->setP4O2($P4O2);
			$object->setP4O3($P4O3);
			$object->setP4O4($P4O4);
			$object->setP4O5($P4O5);
			$object->setP4O6($P4O6);
			$object->setP4O7($P4O7);
			$object->setP4O8($P4O8);
			$object->setP5O($P5O);
			$object->setP6O1($P6O1);
			$object->setP6O2($P6O2);
			$object->setP6O3($P6O3);
			$object->setP6O4($P6O4);
			$object->setP7O1($P7O1);
			$object->setP7O2($P7O2);
			$object->setP7O3($P7O3);
			$object->setP7O5($P7O5);
			$object->setP7O4($P7O4);
			$object->setP7O7($P7O7);
			$object->setP7O6($P7O6);
			$object->setP8O1($P8O1);
			$object->setP8O2($P8O2);
			$object->setP8O3($P8O3);
			$object->setP8O4($P8O4);
			$object->setP8O5($P8O5);
			$object->setP9O1($P9O1);
			$object->setP9O2($P9O2);
			$object->setP9O3($P9O3);
			$object->setP9O4($P9O4);
			$object->setP10O1($P10O1);
			$object->setP10O2($P10O2);
			$object->setP10O3($P10O3);
			$object->setP10O4($P10O4);
			$object->setP10O5($P10O5);
			$object->setP11O1($P11O1);
			$object->setP11O2($P11O2);
			$object->setP11O3($P11O3);
			$object->setP11O4($P11O4);
			$object->setP11O5($P11O5);
			$object->setP11O6($P11O6);
			$object->setP11O7($P11O7);
			$object->setP11O8($P11O8);
			$object->setP14O1($P14O1);
			$object->setP14O2($P14O2);
			$object->setP14O3($P14O3);
			$object->setP14O4($P14O4);
			$object->setP14O5($P14O5);
			$object->setP14O6($P14O6);
			$object->setP14O7($P14O7);
			$object->setP14O8($P14O8);
			$object->setP14O9($P14O9);
			$object->setP14O10($P14O10);
			$object->setP14O11($P14O11);
			$this -> model -> addContextoAnswers($object);
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
			$object->setP1O1($P1O1);
			$object->setP1O2($P1O2);
			$object->setP2O1($P2O1);
			$object->setP2O2($P2O2);
			$object->setP2O3($P2O3);
			$object->setP2O4($P2O4);
			$object->setP2O5($P2O5);
			$object->setP2O6($P2O6);
			$object->setP4O1($P4O1);
			$object->setP4O2($P4O2);
			$object->setP4O3($P4O3);
			$object->setP4O4($P4O4);
			$object->setP4O5($P4O5);
			$object->setP4O6($P4O6);
			$object->setP4O7($P4O7);
			$object->setP4O8($P4O8);
			$object->setP5O($P5O);
			$object->setP6O1($P6O1);
			$object->setP6O2($P6O2);
			$object->setP6O3($P6O3);
			$object->setP6O4($P6O4);
			$object->setP7O1($P7O1);
			$object->setP7O2($P7O2);
			$object->setP7O3($P7O3);
			$object->setP7O5($P7O5);
			$object->setP7O4($P7O4);
			$object->setP7O7($P7O7);
			$object->setP7O6($P7O6);
			$object->setP8O1($P8O1);
			$object->setP8O2($P8O2);
			$object->setP8O3($P8O3);
			$object->setP8O4($P8O4);
			$object->setP8O5($P8O5);
			$object->setP9O1($P9O1);
			$object->setP9O2($P9O2);
			$object->setP9O3($P9O3);
			$object->setP9O4($P9O4);
			$object->setP10O1($P10O1);
			$object->setP10O2($P10O2);
			$object->setP10O3($P10O3);
			$object->setP10O4($P10O4);
			$object->setP10O5($P10O5);
			$object->setP11O1($P11O1);
			$object->setP11O2($P11O2);
			$object->setP11O3($P11O3);
			$object->setP11O4($P11O4);
			$object->setP11O5($P11O5);
			$object->setP11O6($P11O6);
			$object->setP11O7($P11O7);
			$object->setP11O8($P11O8);
			$object->setP14O1($P14O1);
			$object->setP14O2($P14O2);
			$object->setP14O3($P14O3);
			$object->setP14O4($P14O4);
			$object->setP14O5($P14O5);
			$object->setP14O6($P14O6);
			$object->setP14O7($P14O7);
			$object->setP14O8($P14O8);
			$object->setP14O9($P14O9);
			$object->setP14O10($P14O10);
			$object->setP14O11($P14O11);
			$this -> model -> updateContextoAnswers($object);
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

				$this -> model -> deleteContextoAnswers($object);
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