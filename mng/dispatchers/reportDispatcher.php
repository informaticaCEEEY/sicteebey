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
	$cohorte = $_POST['cohorte'];
}

switch($_POST['action']){
	case 'view':
		//$controller->redirectAction();
		echo('<form name="valid" id="valid" action="../report.php" method="post">');
		echo("<input name='cohorte' id='cohorte' type='hidden' value='$cohorte'/>");
		echo('</form>');
		echo('<script>document.forms.valid.submit()</script>');							
		break;
	case 'edit':
		$controller->updateAction();
		break;
}

echo('<form name="valid" id="valid" action="../adminSchools.php" method="post"></form>');
echo('<script>document.forms.valid.submit()</script>');


?>