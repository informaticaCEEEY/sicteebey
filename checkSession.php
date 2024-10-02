<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
//ini_set('display_errors', TRUE);
//ini_set('display_startup_errors', FALSE);
date_default_timezone_set('America/Mexico_City');

require_once ('lib/genius/Core/gosConfig.inc.php');
include_once ('imports/php/auxiliarFunctions/today.php');
include_once ('imports/php/auxiliarFunctions/cohorte.php');
include_once ('imports/php/Autoloader.class.php');
Autoloader::setup();

$userController = new UsersController();

if(!isset($_SESSION['user'])){
	session_name('c3E3y_Tr4Y3Ct0r14S');		
	session_start();	
}

$visitCounterController = new VisitorCounterController();
$where = 'ip_address = :ipAddress';
$whereFields = array('ipAddress' => $_SERVER['REMOTE_ADDR']);
$visitCounterUser = $visitCounterController->displayByAction($where, $whereFields);
if(!$visitCounterUser){
    
    $visitDate = new DateTime('', new DateTimeZone('America/Mexico_City'));
    $visitCounter = new VisitorCounter();
    $visitCounter->setIpAddress($_SERVER['REMOTE_ADDR']);
    $visitCounter->setVisitDate($visitDate->format('Y-m-d H:i:s'));
    $visitCounterModel = new VisitorCounterModel();
    $visitCounterModel->addVisitorCounter($visitCounter);
}

?>