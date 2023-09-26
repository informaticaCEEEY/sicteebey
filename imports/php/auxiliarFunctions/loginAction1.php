<?php
if (!isset($_SESSION)) {
	session_name('c3E3y_Tr4Y3Ct0r14S');
	session_start();
}
include_once '../../../lib/genius/Core/gosConfig.inc.php';
require_once "../../../lib/recaptcha/recaptchalib.php";
include_once('../Autoloader.class.php');
Autoloader::setup();

$controller=new UsersController();
$params=array();

/*if(($_POST['captcha1'] + $_POST['captcha2']) != $_POST['captcha']){
	$_SESSION['message'] = 'La respuesta de la pregunta de seguridad no es correcta';
	header('Location: ../../../index.php');
	exit;
}*/

// your secret key
$secret = "6LdjCBsUAAAAAOXhq9xydgCTYITh5n8ExVS0dQLc";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

if ($_POST["g-recaptcha-response"]) {
    $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
    );
}
if($response != null && $response->success){
	$controller -> loginAction($_POST['userName'], hash('sha512', $_POST['password']));
}else{
	$_SESSION['message'] = 'Para continuar resuelva el Captcha';
	header('Location: ../../../login.php');
}
?>