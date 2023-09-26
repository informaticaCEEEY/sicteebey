<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolLevel'])){
    $level = $_POST['schoolLevel'];
}else{
    $level = 0;
}

if($level == 2){
    $where = 'e.id = 4 || e.id = 5';
}else{
    $where = 'e.id = 2 || e.id = 4 || e.id = 9 || e.id = 10 || e.id = 11';
}

$controller = new SchoolModeController();
$schoolModeList = $controller->displayByAction($where);

$schoolModeArray = array();
foreach($schoolModeList as $schoolMode){
    $schoolModeArray[$schoolMode->getId()] = $schoolMode->getName();
    //echo ("<option value='" . $schoolMode->getId() . "'>". $schoolMode->getId() . "</option>\t\n");
}

$schoolModeArray = array_unique($schoolModeArray);
foreach($schoolModeArray as $key => $entry){
    echo ("<option value='" . $key . "'>". $entry . "</option>\t\n");
}
?>
