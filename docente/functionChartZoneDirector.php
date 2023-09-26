<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$factorZoneController = new FactorZoneController();
$join = 'INNER JOIN factors_index on factors_index.factor = e.factor';
$where = 'zone = :zone AND factors_index.index_list = :indexList';
$whereFields = array('zone' => $schoolZone->getZone(), 'indexList' => $indexList->getId());
$dataReportGeneral = $factorZoneController->chartZone($where, $whereFields, $join);
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";
?>