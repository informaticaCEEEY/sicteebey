<?php
class SchoolController{

	private $model;

	function __construct(){

		$this->model=new SchoolModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join=''){

		return $this->model->listAll('', '', '', '', '', $where, $whereFields, $join);
	}

  public function displayBy2Action($where='', $whereFields='', $join='', $showFields = ''){

    return $this->model->listAll2('', '', '', '', '', $where, $whereFields, $join, $showFields);
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
			if(!isset($_POST['cohorte']) && !isset($_POST['cct'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}

			$school = $this->getEntityByAction('cct', $cct);

			if(!$school){
				throw new Exception('La clave del centro de trabajo no es correcta.');
			}

			switch($school[0]->getLevel()){
				case 2:
					echo('<form name="valid" id="valid" action="../../reports/reportSchool.php" method="post">');
					echo("<input name='idSchool' id='idSchool' type='hidden' value='".$school[0]->getId()."'/>");
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 3:
					echo('<form name="valid" id="valid" action="../../reports/reportSchool2.php" method="post">');
					echo("<input name='idSchool' id='idSchool' type='hidden' value='".$school[0]->getId()."'/>");
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
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

			if (!isset($_POST['cohorte']) && !isset($_POST['schoolLevel']) && !isset($_POST['schoolZone']) && !isset($_POST['schoolMode'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}

			$schoolRegionZoneController =  new SchoolRegionZoneController();
			$schoolRegionZone = $schoolRegionZoneController->getEntityAction($schoolZone);

			switch($_POST['schoolLevel']){
				case 2:
					echo('<form name="valid" id="valid" action="../../reports/reportZone.php" method="post">');
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
					echo("<input name='schoolLevel' id='schoolLevel' type='hidden' value='$schoolLevel'/>");
					echo("<input name='schoolMode' id='schoolMode' type='hidden' value='$schoolMode'/>");
					echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 3:
					echo('<form name="valid" id="valid" action="../../reports/reportZoneSecu.php" method="post">');
					echo("<input name='schoolLevel' id='schoolLevel' type='hidden' value='$schoolLevel'/>");
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
					echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
					echo("<input name='schoolMode' id='schoolMode' type='hidden' value='$schoolMode'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
			}

		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}


    public function redirectSchoolZone2Action(){

        extract($_POST);
        try{

            if (!isset($_POST['cohorte']) && !isset($_POST['schoolZone']) && !isset($_POST['oldSchoolZone'])) {
                echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
                echo('<script>document.forms.valid.submit()</script>');
                exit;
            }

            $schoolRegionZoneController =  new SchoolRegionZoneController();
            $schoolRegionZone = $schoolRegionZoneController->getEntityAction($schoolZone);

            switch($schoolRegionZone->getLevel()){
                case 2:
                    echo('<form name="valid" id="valid" action="../../reports/reportZone.php" method="post">');
                    echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
                    echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
                    echo("<input name='oldSchoolZone' id='oldSchoolZone' type='hidden' value='$oldSchoolZone'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 3:
                    echo('<form name="valid" id="valid" action="../../reports/reportZoneSecu.php" method="post">');
                    echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
                    echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
                    echo("<input name='oldSchoolZone' id='oldSchoolZone' type='hidden' value='$oldSchoolZone'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
            }

        }catch(Exception $e){
            $_SESSION['flash'] = $e->getMessage();
            echo('<script>javascript:history.go(-1)</script>');
        }
    }

	public function redirectDirectorAction(){

		extract($_POST);
		try{

			if (!isset($_POST['cohorte']) && !isset($_POST['school'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}
			$school = $this->getEntityAction($school);
			if(!$school){
				throw new Exception('La clave del centro de trabajo no es correcta.');
			}

			switch($school->getLevel()){
				case 2:
					echo('<form name="valid" id="valid" action="../../reports/reportSchool.php" method="post">');
					echo("<input name='idSchool' id='idSchool' type='hidden' value='".$school->getId()."'/>");
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 3:
					echo('<form name="valid" id="valid" action="../../reports/reportSchool2.php" method="post">');
					echo("<input name='idSchool' id='idSchool' type='hidden' value='".$school->getId()."'/>");
					echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
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
			$object= new School();
			$object->setCct($cct);
			$object->setName($name);
			$object->setAddress($address);
			$object->setSuburb($suburb);
			$object->setCp($cp);
			$object->setLevel($level);
			$object->setSector($sector);
			$object->setZone($zone);
			$object->setSchedule($schedule);
			$object->setMode($mode);
			$object->setLocality($locality);
			$object->setTown($town);
            $object->setCdiClassification($cdiClassification);
			$object->setRegionZone($regionZone);
			$object->setRegion_territory($region_territory);
			$object->setMarginalization($marginalization);
			$object->setSchoolRegionZone($schoolRegionZone);
			$object->setOldSchoolRegion($oldSchoolRegion);
			$this -> model -> addSchool($object);
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
			//$object->setCct($cct);
			$object->setName($name);
			//$object->setAddress($address);
			//$object->setSuburb($suburb);
			//$object->setCp($cp);
			$object->setLevel($schoolLevel);
			//$object->setSector($sector);
			$object->setZone($object->getSchoolRegionZoneObject()->getZone());
			//$object->setSchedule($schedule);
			//$object->setMode($schoolMode);
			//$object->setLocality($locality);
			//$object->setTown($town);
			//$object->setRegionZone($schoolRegion);
			//$object->setRegion_territory($object->getSchoolRegionObject()->getName());
			//$object->setMarginalization($marginalization);
			$object->setSchoolRegionZone($schoolRegionZone);
			$this -> model -> updateSchool($object);
			$_SESSION['flash'] = 'Actualizac&oacute;n Correcta';
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function updateDataAction(){

		extract($_POST);
		print_r($_POST);
		exit;
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

			$schoolRegionZoneController = new SchoolRegionZoneController();
			$schoolRegionZone = $schoolRegionZoneController->getEntityAction($schoolZone);

			if(empty($schoolRegionZone)){
				throw new Exception('La zona no existe');
			}
			$object->setSchoolRegionZone($schoolZone);
			$this -> model -> updateSchool($object);
			$_SESSION['flash'] = 'Actualizac&oacute;n Correcta';
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

				$this -> model -> deleteSchool($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}

	public function listAction($schoolMode = '', $schoolZone = '', $schoolLevel = '') {

		$fields = array('e.cct', 'e.name', 'sl.name', 'sm.name', 'sr.name', 'srz.zone', 'CONCAT_WS(" ", sl.name, sm.name)',
			'CONCAT_WS(" ", sl.name, sm.name, sr.name)', 'CONCAT_WS(" ", sl.name, sm.name, "Zona", srz.zone)');
		if($schoolMode != '' && $schoolZone != '' && $schoolLevel != ''){
			$where = 'srz.level = :schoolLevel AND srz.mode = :schoolMode AND srz.zone = :schoolZone';
			$whereFields = array('schoolLevel' => $schoolLevel, 'schoolMode' => $schoolMode, 'schoolZone' => $schoolZone);
		}else{
			$where = 'srz.level != :schoolLevel AND srz.level != :schoolLevel2';
			$whereFields = array('schoolLevel' => 1, 'schoolLevel2' => 10);
		}

		$join = 'INNER JOIN school_region_zone srz ON srz.id = e.school_region_zone
						 INNER JOIN school_level sl ON sl.id = srz.level
						 INNER JOIN school_mode sm ON sm.id = srz.mode
						 INNER JOIN school_region sr ON sr.id = srz.school_region';
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
				$row[] = $data -> getCct();
				$row[] = $data -> getName();
				$row[] = $data -> getSchoolLevelObject()->getName();
				$row[] = $data -> getSchoolRegionZoneObject() -> getSchoolModeObject()->getName();
				$row[] = $data -> getSchoolRegionZoneObject() -> getSchoolRegionObject()->getName();
				$row[] = $data -> getSchoolRegionZoneObject()->getZone();
				$row[] = $data -> getSchoolScheduleObject() -> getName();
				$output['aaData'][] = $row;
			}
		}
		echo(json_encode($output));
	}

}
?>
