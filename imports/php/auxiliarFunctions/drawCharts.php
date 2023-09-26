<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
Autoloader::setup();
header('Content-Type: application/json');
//error_reporting(E_ALL);
ini_set('display_errors', FALSE);
ini_set('display_startup_errors', FALSE);

extract($_POST);

$controller = new FactorStateController();

switch ($chart) {
    case 'interactionTeacher':
        $dataInteractionTeacher = $controller->teacherInteraction();
        //echo json_encode($dataInteractionTeacher);        
        json_encode($dataInteractionTeacher);
        break;
}
?>