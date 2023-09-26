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
		$controller = new SchoolController();
}

switch($_POST['action']){
	case 'view':
		$controller->redirectSchoolZoneAction();
		break;
}

echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
echo('<script>document.forms.valid.submit()</script>');


?>