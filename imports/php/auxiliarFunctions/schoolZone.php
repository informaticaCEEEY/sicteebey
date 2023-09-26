<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolMode'])){
	$level = 2;
	$mode = $_POST['schoolMode'];
}else{
	$level = 0;
	$mode = 0;
}

$where = 'e.level = :level AND e.mode = :mode and e.zone < 100';
$whereFields = array('level' => $level, 'mode' => $mode);
$order = 'e.zone';

$controller = new SchoolRegionZoneController();
$schoolZoneList = $controller->displayByAction($where, $whereFields, '', $order);
$schoolZoneArray = array();
foreach($schoolZoneList as $schoolZone){
	$schoolZoneArray[$schoolZone->getId()] = $schoolZone->getZone();
	//echo ("<option value='" . $schoolMode->getId() . "'>". $schoolMode->getId() . "</option>\t\n");
}
$schoolZoneArray = array_unique($schoolZoneArray);
foreach($schoolZoneArray as $key => $entry){
	echo ("<option value='" . $key . "'>". str_pad($entry,  3, "0", STR_PAD_LEFT) . "</option>\t\n");
}
?>
