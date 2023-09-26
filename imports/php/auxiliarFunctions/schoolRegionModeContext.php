<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolRegion'])){
	$level = 2;
	$region = $_POST['schoolRegion'];
}else{
	$level = 0;
	$region = 0;
}

if($level == 2){
    $where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode != 9';    
}

$whereFields = array('schoolRegion' => $region, 'level' => $level);

$controller = new SchoolRegionZoneController();
$schoolModeList = $controller->displayByAction($where, $whereFields);
$schoolModeArray = array();
foreach($schoolModeList as $schoolMode){
	$schoolModeArray[$schoolMode->getMode()] = $schoolMode->getSchoolModeObject()->getName();
	//echo ("<option value='" . $schoolMode->getId() . "'>". $schoolMode->getId() . "</option>\t\n");
}

$schoolModeArray = array_unique($schoolModeArray);
foreach($schoolModeArray as $key => $entry){
	echo ("<option value='" . $key . "'>". $entry . "</option>\t\n");
}
?>