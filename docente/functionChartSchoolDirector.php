<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$factorSchoolController = new FactorCctController();
$join = 'INNER JOIN factors_index on factors_index.factor = e.factor';
$where = 'cct LIKE :school AND factors_index.index_list = :indexList';
$whereFields = array('school' => $school->getCct(), 'indexList' => $indexList->getId());
$dataReportGeneral = $factorSchoolController->chartSchool($where, $whereFields, $join);
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";

?>