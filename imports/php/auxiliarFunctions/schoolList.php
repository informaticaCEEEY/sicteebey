<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
include('../../../checkSession.php');
Autoloader::setup();


if(isset($_SESSION['user'])){
	$user = unserialize($_SESSION['user']);
	$user = $userController->getEntityAction($user->getId());
}

$controller = new SchoolController();
if($user->getType() == 5){

	$supervisorSchoolRegionController = new SupervisorSchoolRegionController();
	$supervisorSchoolRegion = $supervisorSchoolRegionController->getEntityByAction('user', $user->getId());

	if(!$supervisorSchoolRegion){
		header('Location:../../../index.php');
	}
	
	$schoolLevel = $supervisorSchoolRegion[0]->getSchoolRegionZoneObject()->getLevel();
	$controller -> listAction($supervisorSchoolRegion[0]->getSchoolMode(), $supervisorSchoolRegion[0]->getSchoolZone(), $schoolLevel);
}elseif($user->getType() == 1){
	$controller -> listAction();
}
?>
