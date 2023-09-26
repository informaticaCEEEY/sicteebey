<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 * 
 * 
 */

$factorStateController = new FactorStateController();
$join = 'INNER JOIN factors_index on factors_index.factor = e.factor';
$where = 'factors_index.index_list = :indexList';
$whereFields = array('indexList' => $indexList->getId());
$dataReportGeneral = $factorStateController->chartState($where, $whereFields, $join);
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";

?>