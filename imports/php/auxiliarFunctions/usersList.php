<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
include('../../../checkSession.php');
Autoloader::setup();

$controller = new UsersController();
$controller -> listAction();
?>