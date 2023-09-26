<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolRegion'])){
	$region = $_POST['schoolRegion'];
    $level = 2;
}else{
	$region = 0;
    $level = 0;
}

if($level == 2){
    $where = 'e.school_region = :schoolRegion AND e.level = :level AND (e.mode = :mode1 OR e.mode = :mode2)';
    $whereFields = array('schoolRegion' => $region, 'level' => $level, 'mode1' => 4, 'mode2' => 5);    
}

$controller = new SchoolRegionZoneController();
$schoolZoneList = $controller->displayByAction($where, $whereFields);
$schoolZoneArray = array();
foreach($schoolZoneList as $schoolZone){
	$schoolZoneArray[$schoolZone->getId()] = $schoolZone->getZone();
	//echo ("<option value='" . $schoolMode->getId() . "'>". $schoolMode->getId() . "</option>\t\n");
}
$schoolZoneArray = array_unique($schoolZoneArray);
asort($schoolZoneArray);
foreach($schoolZoneArray as $key => $entry){
	echo ("<option value='" . $key . "'>". str_pad($entry,  3, "0", STR_PAD_LEFT) . "</option>\t\n");
}
?>