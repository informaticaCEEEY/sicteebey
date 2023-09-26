<?php
if (!isset($_SESSION)) {
	session_name('c3E3y_Tr4Y3Ct0r14S');
	session_start();
}
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
Autoloader::setup();

extract($_POST);
$controller=new UsersController();
$params=array();

if(($_POST['captcha1'] + $_POST['captcha2']) != $_POST['captcha']){
	$_SESSION['message'] = 'La respuesta de la pregunta de seguridad no es correcta';
	header('Location: ../../../index.php');
	exit;
}


if($loginType == 1){
	$controller -> loginAction($_POST['userName'], hash('sha512', $_POST['password']));
}else{
	$controller -> loginIdaepyAction($_POST['folioStudent'], hash('sha512', $_POST['folioStudent']));
}

?>
