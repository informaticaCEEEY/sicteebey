<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include('../../../checkSession.php');

if(isset($_POST['year'])){
	$year = $_POST['year'];
}else{
	$year = 0;
}

$where = 'e.year_application = :yearApplication';
$whereFields = array('yearApplication' => $year);

$controller = new ContextReportController();
$groupByPeriodList = $controller->displayByAction($where, $whereFields);

//echo("<label for='ejemplo_Region' class='textLabel'>Regi&oacute;n Educativa</label>");
//echo ("<select class='form-control' placeholder='.col-xs-5' id='_schoolRegion' name='schoolRegion'>\t\n");
foreach($groupByPeriodList as $groupByPeriod){
	echo ("<option value='" . $groupByPeriod->getGroupByPeriodObject()->getEndYear() . "'>". $groupByPeriod->getGroupByPeriodObject()->getName() . "</option>\t\n");
}
?>
