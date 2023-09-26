<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$indexSchoolController = new IndexCctController();
$dataReportGeneral = $indexSchoolController->chartSchool($school->getCct());
$ticks = "[-10, -8, -6, -4, -2, 0, 2, 4, 6, 8, 10]";

?>