<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolLevel'])){
	$level = $_POST['schoolLevel'];
}else{
	$level = 0;
}

if($level != 0){
	$where = 'e.id != 17 AND e.id != 19 AND e.level = :level';
	$whereFields = array('level' => $level);
}else{
	$where = 'e.id = 0';
}

$controller = new SchoolRegionZoneController();
$schoolRegionZoneList = $controller->displayByAction($where, $whereFields);

$schoolRegionArray = array();
foreach($schoolRegionZoneList as $schoolRegionZone){
    $schoolRegionArray[$schoolRegionZone->getSchoolRegion()] = $schoolRegionZone->getSchoolRegionObject()->getName();
}

$schoolRegionArray = array_unique($schoolRegionArray);
foreach($schoolRegionArray as $key => $entry){
    echo ("<option value='" . $key . "'>". $entry . "</option>\t\n");
}
?>
