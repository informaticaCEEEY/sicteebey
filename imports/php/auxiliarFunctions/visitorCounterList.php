<?php
include_once '../../../lib/genius/Core/gosConfig.inc.php';
include_once('../Autoloader.class.php');
Autoloader::setup();

$controller = new VisitorCounterController();
$controller -> listAction();
?>