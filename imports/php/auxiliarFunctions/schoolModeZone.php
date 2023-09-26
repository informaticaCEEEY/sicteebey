<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolRegion']) && isset($_POST['schoolMode']) && isset($_POST['year'])){
	$level = 2;
	$region = $_POST['schoolRegion'];
	$mode = $_POST['schoolMode'];
  $year = $_POST['year'];
}else{
	$level = 0;
	$region = 0;
	$mode = 0;
  $year = 0;
}

if($mode == 5){
    if($year < 2017){
        $where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
        $whereFields = array('schoolRegion' => $region, 'level' => $level, 'mode' => $mode);
    }else{
        $where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
        $whereFields = array('schoolRegion' => $region, 'level' => $level, 'mode' => $mode);
    }
}else{
    $where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode';
    $whereFields = array('schoolRegion' => $region, 'level' => $level, 'mode' => $mode);
}
print_r($_POST);
$controller = new SchoolRegionZoneController();
$schoolZoneList = $controller->displayByAction($where, $whereFields);
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
