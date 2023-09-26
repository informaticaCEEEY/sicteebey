<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolLevel']) && isset($_POST['schoolMode'])){
	$level = $_POST['schoolLevel'];
	$mode = $_POST['schoolMode'];
  $cohorte = $_POST['cohorte'];
}else{
	$level = 0;
	$mode = 0;
	$cohorte = 0;
}

if($mode == 5){
	$where = 'e.level = :level AND e.mode = :mode AND szh.year = 2018 and e.zone < 100';
	$whereFields = array('level' => $level, 'mode' => $mode);
  // if($cohorte == 12){
  //   //$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
	// 	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2017 and e.zone < 100';
  //   $whereFields = array('level' => $level, 'mode' => $mode);
  // }elseif($cohorte >= 13){
  //   //$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
	// 	$where = 'e.level = :level AND e.mode = :mode AND szh.year = 2018 and e.zone < 100';
  //   $whereFields = array('level' => $level, 'mode' => $mode);
  // }else{
	// 	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2016';
	// 	$whereFields = array('level' => $level, 'mode' => $mode);
	// }
}else{
	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2018';
	$whereFields = array('level' => $level, 'mode' => $mode);
	// if($cohorte == 12){
	// 	//$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode';
	// 	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2017';
	// 	$whereFields = array('level' => $level, 'mode' => $mode);
	// }elseif($cohorte >= 13){
	// 	//$where = 'e.school_region = :schoolRegion AND e.level = :level AND e.mode = :mode and e.zone < 100';
	// 	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2018';
	// 	$whereFields = array('level' => $level, 'mode' => $mode);
	// }else{
	// 	$where = 'e.level = :level AND e.mode = :mode and szh.year = 2016';
	// 	$whereFields = array('level' => $level, 'mode' => $mode);
	// }
}

$order = 'e.zone asc, e.id asc';

$controller = new SchoolRegionZoneController();
$join = 'INNER JOIN school_zone_historial szh ON szh.school_region_zone = e.id';
$showFields = 'e.zone';
$groupby = 'e.zone';
$schoolZoneList = $controller->displayBy2Action($where, $whereFields, $join, $order, $showFields, $groupby);

$schoolZoneArray = array();

foreach($schoolZoneList as $schoolZone){

	$schoolZoneArray[$schoolZone['zone']] = $schoolZone['zone'];
	//echo ("<option value='" . $schoolMode->getId() . "'>". $schoolMode->getId() . "</option>\t\n");
}
$schoolZoneArray = array_unique($schoolZoneArray);
foreach($schoolZoneArray as $key => $entry){
	echo ("<option value='" . $key . "'>". str_pad($entry,  3, "0", STR_PAD_LEFT) . "</option>\t\n");
}
?>
