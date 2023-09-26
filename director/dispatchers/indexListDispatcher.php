<?php
require_once ('../../lib/genius/Core/gosConfig.inc.php');
include_once ('../../imports/php/Autoloader.class.php');
Autoloader::setup();
if (!isset($_SESSION)) {
    
    session_name('c3E3y_Tr4Y3Ct0r14S');     
    session_start();    
}

if (!isset($_POST['action'])) {
		echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
		echo('<script>document.forms.valid.submit()</script>');
}else{
		$controller = new IndexListController();
}

switch($_POST['action']){
	case 'view':        
		$controller->redirectAction();        
		break;
    case 'viewSchoolZone':
        $controller->redirectSchoolZoneAction();
        break;
	case 'viewSchool':
		$controller->redirectSchoolAction();
		break;
	case 'viewSchoolGroup':
		$controller->redirectSchoolGroupAction();
		break;
}

echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
echo('<script>document.forms.valid.submit()</script>');


?>