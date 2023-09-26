<?php
require ('../checkSession.php');

if (isset($_GET['term'])){

	$return_arr = array();
	$user = unserialize($_SESSION['user']);
	$supervisorSchoolRegionController = new SupervisorSchoolRegionController();
	$supervisorSchoolRegion = $supervisorSchoolRegionController->getEntityByAction('user', $user->getId());

	try {

		$fields = array(0 => 'e.cct');
		$where = '(e.level = 2  && e.mode = '.$supervisorSchoolRegion[0]->getSchoolMode() .
			' && e.zone = '.$supervisorSchoolRegion[0]->getSchoolZone(). ')';
		$whereFields = '';
		$join = '';
		$order = 'e.cct';
		$model = new SchoolModel();
		$result = $model -> listAll('', '', $_GET['term'], $fields, $order, $where, $whereFields, $join, '');
		foreach($result as $entry){
			$return_arr[] = $entry->getCct();
		}

	}catch(Exception $e){
        echo 'ERROR: ' . $e->getMessage();
    }

	echo json_encode($return_arr);
}

?>
