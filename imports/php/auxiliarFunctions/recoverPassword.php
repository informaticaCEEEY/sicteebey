<?php
if (!isset($_SESSION)) {
	session_name('c3E3y_Tr4Y3Ct0r14S');
	session_start();
}
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
Autoloader::setup();

$controller=new UsersController();
$controller -> recoverPaswordAction();
?>