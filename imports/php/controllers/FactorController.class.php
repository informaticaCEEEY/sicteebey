<?php
class FactorController{

	private $model;

	function __construct(){

		$this->model=new FactorModel();
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

			if (!isset($_POST['factor'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}

			switch($factor){
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				case 38:
				case 39:
				case 40:
				case 41:
				case 42:
				case 43:
				case 44:
				case 45:
				case 46:
				case 47:
				case 48:
				case 49:
				case 50:
				case 51:
				case 52:
				case 53:
				case 54:
				case 55:
					echo('<form name="valid" id="valid" action="../../reports/factorState.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='type' id='type' type='hidden' value='$type'/>");
					echo("<input name='level' id='level' type='hidden' value='$level'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
        default:
	        echo('<form name="valid" id="valid" action="../../reports/factorIndexState.php" method="post">');
	        echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
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

	public function redirectSchoolAction(){

		extract($_POST);
		try{

			if (!isset($_POST['factor']) || !isset($_POST['cct'])) {
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

			switch($factor){
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				case 38:
				case 39:
				case 40:
				case 41:
				case 42:
				case 43:
				case 44:
				case 45:
				case 46:
				case 47:
				case 48:
				case 49:
				case 50:
				case 51:
				case 52:
				case 53:
				case 54:
				case 55:
					echo('<form name="valid" id="valid" action="../../reports/factorSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo("<input name='type' id='type' type='hidden' value='$type'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
        default:
        	echo('<form name="valid" id="valid" action="../../reports/factorIndexSchool.php" method="post">');
        	echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
        	echo("<input name='indexList' id='indexList' type='hidden' value='$indexList'/>");
        	echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
        	echo('</form>');
        	echo('<script>document.forms.valid.submit()</script>');
        	break;
			}

		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function redirectZoneAction(){

    extract($_POST);
    try{

        if (!isset($_POST['factor']) || !isset($_POST['schoolZone'])) {
            echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
            echo('<script>document.forms.valid.submit()</script>');
            exit;
        }

        $schoolZoneController = new SchoolRegionZoneController();
        $schoolZoneObject = $schoolZoneController->getEntityAction($schoolZone);

        if(!$schoolZoneObject){
            throw new Exception('La clave del centro de trabajo no es correcta.');
        }

        switch($factor){
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
			case 10:
			case 11:
			case 38:
			case 39:
			case 40:
			case 41:
			case 42:
			case 43:
			case 44:
			case 45:
			case 46:
			case 47:
			case 48:
			case 49:
			case 50:
			case 51:
			case 52:
			case 53:
			case 54:
			case 55:
				echo('<form name="valid" id="valid" action="../../reports/factorSchoolZone.php" method="post">');
				echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
				echo("<input name='schoolZone' id='schoolZone' type='hidden' value='$schoolZone'/>");
				echo("<input name='schoolLevel' id='schoolLevel' type='hidden' value='$schoolLevel'/>");
				echo("<input name='schoolMode' id='schoolMode' type='hidden' value='$schoolMode'/>");
				echo("<input name='type' id='type' type='hidden' value='$type'/>");
				echo('</form>');
				echo('<script>document.forms.valid.submit()</script>');
				break;
        	default:
	            if (!isset($_POST['indexList'])) {
	              echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
	              echo('<script>document.forms.valid.submit()</script>');
	              exit;
	            }
	            echo('<form name="valid" id="valid" action="../../reports/factorIndexZone.php" method="post">');
	            echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
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

	public function redirectSchoolGroupAction(){
		extract($_POST);
		try{
			if (!isset($_POST['factor']) || !isset($_POST['cct'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}

			$schoolController = new SchoolController();
			$schoolObject = $schoolController->getEntityByAction('cct', $cct);
			if(!$schoolObject){
				throw new Exception('La clave del centro de trabajo no es correcta.');
			}else{
				$school = $schoolObject[0]->getId();
			}

			switch($factor){
				case 1:
				case 2:
				case 3:
				case 4:
				case 5:
				case 6:
				case 7:
				case 8:
				case 9:
				case 10:
				case 11:
				case 38:
				case 39:
				case 40:
				case 41:
				case 42:
				case 43:
				case 44:
				case 45:
				case 46:
				case 47:
				case 48:
				case 49:
					echo('<form name="valid" id="valid" action="../../reports/factorSchoolGroupInfo.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo("<input name='year' id='year' type='hidden' value='$year'/>");
					echo("<input name='groupby' id='groupby' type='hidden' value='$groupby'/>");
					echo("<input name='type' id='type' type='hidden' value='$type'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
			}

		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

    public function redirectSchoolGroup2Action(){

        extract($_POST);
        try{

            if (!isset($_POST['factor']) || !isset($_POST['cct'])) {
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

            switch($factor){
                case 1:
                    echo('<form name="valid" id="valid" action="../bullyingClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 2:
                    echo('<form name="valid" id="valid" action="../parentSupportClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 3:
                    echo('<form name="valid" id="valid" action="../economicCapitalClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 4:
                    echo('<form name="valid" id="valid" action="../ethnicIdentityClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 5:
                    echo('<form name="valid" id="valid" action="../traditionsClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                    //cambiar url
                case 6:
                    echo('<form name="valid" id="valid" action="../motivationClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 7:
                    echo('<form name="valid" id="valid" action="../studyTechniquesClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 8:
                    echo('<form name="valid" id="valid" action="../autoeficaciaClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 9:
                    echo('<form name="valid" id="valid" action="../learningClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 10:
                    echo('<form name="valid" id="valid" action="../englishClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
                case 11:
                    echo('<form name="valid" id="valid" action="../learningMathClassroom2.php" method="post">');
                    echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
                    echo("<input name='groupSchool' id='groupSchool' type='hidden' value='$schoolGroup'/>");
                    echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
                    echo('</form>');
                    echo('<script>document.forms.valid.submit()</script>');
                    break;
            }

        }catch(Exception $e){
            $_SESSION['flash'] = $e->getMessage();
            echo('<script>javascript:history.go(-1)</script>');
        }
    }

	public function redirectSchoolDirectorAction(){

		extract($_POST);
		try{
			if (!isset($_POST['factor']) || !isset($_POST['school'])) {
				echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
				echo('<script>document.forms.valid.submit()</script>');
				exit;
			}

			$schoolController = new SchoolController();
			$schoolObject = $schoolController->getEntityAction($school);

			if(!$schoolObject){
				throw new Exception('La clave del centro de trabajo no es correcta.');
			}

			switch($factor){
				case 1:
					echo('<form name="valid" id="valid" action="../bullyingSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 2:
					echo('<form name="valid" id="valid" action="../parentSupportSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 3:
					echo('<form name="valid" id="valid" action="../economicCapitalSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 4:
					echo('<form name="valid" id="valid" action="../ethnicIdentitySchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 5:
					echo('<form name="valid" id="valid" action="../traditionsSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
					//cambiar url
				case 6:
					echo('<form name="valid" id="valid" action="../motivationSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 7:
					echo('<form name="valid" id="valid" action="../studyTechniquesSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 8:
					echo('<form name="valid" id="valid" action="../autoeficaciaSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 9:
					echo('<form name="valid" id="valid" action="../learningSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
					echo('</form>');
					echo('<script>document.forms.valid.submit()</script>');
					break;
				case 10:
					echo('<form name="valid" id="valid" action="../englishSchool.php" method="post">');
					echo("<input name='factor' id='factor' type='hidden' value='$factor'/>");
					echo("<input name='idSchool' id='idSchool' type='hidden' value='$school'/>");
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
			$object= new Factor();
			$object->setName($name);
            $object->setType($type);
            $object->setDescription($description);
            $object->setYearApplication($yearApplication);
            $object->setTrend($trend);
			$this -> model -> addFactor($object);
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
			$this -> model -> updateFactor($object);
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

				$this -> model -> deleteFactor($object);
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
