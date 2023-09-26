<?php
class AffectiveEnvironmentController{

	private $model;

	function __construct(){

		$this->model=new AffectiveEnvironmentModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join='', $order=''){

		return $this->model->listAll('', '', '', '', $order, $where, $whereFields, $join);
	}
    
    public function displayBy2Action($where='', $whereFields='', $join='', $order='', $showFields=''){

        return $this->model->listAll2('', '', '', '', $order, $where, $whereFields, $join, $showFields);
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
			$object= new AffectiveEnvironment();
			$object->setStudent($student);
			$object->setCct($cct);
			$object->setR43_R64($R43_R64);
			$object->setR44_R65($R44_R65);
			$object->setR45_R66($R45_R66);
			$object->setR46_R67($R46_R67);
			$object->setR47_R68($R47_R68);
			$object->setR48_R69($R48_R69);
			$object->setR49_R71($R49_R71);
			$object->setR50_R72($R50_R72);
			$this -> model -> addAffectiveEnvironment($object);
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
			$object->setCct($cct);
			$object->setR43_R64($R43_R64);
			$object->setR44_R65($R44_R65);
			$object->setR45_R66($R45_R66);
			$object->setR46_R67($R46_R67);
			$object->setR47_R68($R47_R68);
			$object->setR48_R69($R48_R69);
			$object->setR49_R71($R49_R71);
			$object->setR50_R72($R50_R72);
			$this -> model -> updateAffectiveEnvironment($object);
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

				$this -> model -> deleteAffectiveEnvironment($object);
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