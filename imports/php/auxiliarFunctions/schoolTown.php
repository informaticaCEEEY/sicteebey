<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
Autoloader::setup();

$controller = new SchoolController();
$townList = $controller->getEntityByAction('town', $_POST['town']);
echo("<label for='ejemplo_Escuela' class='textLabel'>Escuela</label>");
echo ("<select class='form-control' placeholder='.col-xs-5' id='_school' name='_school' >\t\n");
foreach($townList as $town){
	echo ("<option value='" . $town->getId() . "'>". $town->getName() . "</option>\t\n");
}
echo ("</select>");
?>