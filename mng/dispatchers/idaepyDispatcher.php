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
}

extract($_POST);
switch($_POST['year']){
	case '2016':        
		echo('<form name="valid" id="valid" action="../idaepy2016PDF.php" method="post">');
        echo("<input name='cct' id='cct' type='hidden' value='$cct'/>");
        echo("<input name='year' id='year' type='hidden' value='$year'/>");
        echo('</form>');
        echo('<script>document.forms.valid.submit()</script>');                                 
		break;
    case '2017':
        echo('<form name="valid" id="valid" action="../idaepy2017PDF.php" method="post">');
        echo("<input name='cct' id='cct' type='hidden' value='$cct'/>");
        echo("<input name='year' id='year' type='hidden' value='$year'/>");
        echo('</form>');
        echo('<script>document.forms.valid.submit()</script>');                                                                
        break;
}

echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
echo('<script>document.forms.valid.submit()</script>');


?>