<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['schoolLevel'])){
	$level = $_POST['schoolLevel'];
}else{
	$level = 0;
}

if($level != 0){
	$where = 'e.id < 17';	
}else{
	$where = 'e.id = 0';
}

$controller = new SchoolRegionController();
$schoolRegionList = $controller->displayByAction($where);
//echo("<label for='ejemplo_Region' class='textLabel'>Regi&oacute;n Educativa</label>");
//echo ("<select class='form-control' placeholder='.col-xs-5' id='_schoolRegion' name='schoolRegion'>\t\n");
foreach($schoolRegionList as $schoolRegion){	
	echo ("<option value='" . $schoolRegion->getId() . "'>". $schoolRegion->getName() . "</option>\t\n");
}
?>