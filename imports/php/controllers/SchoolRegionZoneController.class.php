<?php
class SchoolRegionZoneController{

	private $model;

	function __construct(){

		$this->model=new SchoolRegionZoneModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join='', $order=''){

		return $this->model->listAll('', '', '', '', $order, $where, $whereFields, $join);
	}

	public function displayBy2Action($where='', $whereFields='', $join='', $order='', $showFields='', $groupby = ''){

		return $this->model->listAll2('', '', '', '', $order, $where, $whereFields, $join, $showFields, $groupby);
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

			$where = 'e.school_region = :schoolRegion AND e.level = :level AND
				e.mode = :mode AND zone = :zone';
			$whereFields = array('schoolRegion' => $schoolRegion, 'level' => $level,
				'mode' => $mode, 'zone' => $zone);
			$schoolRegionZone = $this->displayByAction($where, $whereFields);

			if(!empty($schoolRegionZone)){
				throw new Exception("La zona ya existe");
			}

			$object= new SchoolRegionZone();
			$object->setSchoolRegion($schoolRegion);
			$object->setLevel($level);
			$object->setMode($mode);
			$object->setZone($zone);
      $object->setSector($sector);
			$this -> model -> addSchoolRegionZone($object);
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

			$where = 'e.school_region = :schoolRegion AND e.level = :level AND
				e.mode = :mode AND zone = :zone AND e.id != :idZone';
			$whereFields = array('schoolRegion' => $schoolRegion, 'level' => $level,
				'mode' => $mode, 'zone' => $zone, 'idZone' => $object->getId());
			$schoolRegionZone = $this->displayByAction($where, $whereFields);

			if(!empty($schoolRegionZone)){
				throw new Exception("La zona ya existe");

			}

			$object->setSchoolRegion($schoolRegion);
			$object->setLevel($level);
			$object->setMode($mode);
			$object->setZone($zone);
      $object->setSector($sector);
			$this -> model -> updateSchoolRegionZone($object);
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

				$this -> model -> deleteSchoolRegionZone($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function listAction() {

		$fields = array('sl.name', 'sm.name', 'sr.name', 'e.zone', 'e.sector', 'CONCAT_WS(" ", sl.name, sm.name, sr.name)',
			'CONCAT_WS(" ", sl.name, sr.name)');
		$join = 'INNER JOIN school_level sl ON sl.id = e.level
						 INNER JOIN school_mode sm ON sm.id = e.mode
						 INNER JOIN school_region sr ON sr.id = e.school_region';
	  $where = '';
 		$whereFields = '';
		$showFields= '';
		if(!isset($_GET['sSearch'])){
			$total = $this -> model -> countActives($where, $whereFields, $join);
		}else{
			$total = $this -> model -> countActivesBy($where, $whereFields, $join, $fields, $_GET['sSearch']);
		}

		if ($total == 0) {
			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => count(0), "iTotalDisplayRecords" => count(0), "aaData" => array());
		} else {
			$order = '';
			if (isset($_GET['iSortCol_0'])) {

				for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {

					if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {

						if (intval($_GET['iSortCol_' . $i]) == 0) {

							$order .= $fields[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
						} else {

							$order .= $fields[intval($_GET['iSortCol_' . $i]) - 1] . " " . $_GET['sSortDir_' . $i] . ", ";
						}
					}
				}
				$order = substr_replace($order, "", -2);
			}
			$result = $this -> model -> listAll($_GET['iDisplayStart'], $_GET['iDisplayLength'], $_GET['sSearch'], $fields, $order, $where, $whereFields, $join, $showFields);

			$output = array("sEcho" => intval($_GET['sEcho']), "iTotalRecords" => $total, "iTotalDisplayRecords" => $total, "aaData" => array());
			foreach ($result as $data) {
				$row = array();
				$row[] = $data -> getId();
				$row[] = $data -> getSchoolLevelObject()->getName();
				$row[] = $data -> getSchoolModeObject()->getName();
				$row[] = $data -> getSchoolRegionObject()->getName();
				$row[] = $data -> getZone();
				$row[] = $data -> getSector();
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}

}
?>
