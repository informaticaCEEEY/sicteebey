<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$indexZoneController = new IndexZoneController();
$where = 'zone = :zone';
$whereFields = array('zone' => $schoolRegionZone->getZone());
$dataReportGeneral = $indexZoneController->chartZone($where, $whereFields);
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";

?>
