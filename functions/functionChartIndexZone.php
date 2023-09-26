<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$indexZoneController = new IndexZoneController();
$where = 'zone = :zone AND modality = :modality and school_region = :schoolRegion';
$whereFields = array('zone' => $schoolRegionZone->getZone(), 'modality' => $schoolRegionZone->getMode(),
    'schoolRegion' => $schoolRegionZone->getSchoolRegion());
$dataReportGeneral = $indexZoneController->chartZone($where, $whereFields);
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";

?>
