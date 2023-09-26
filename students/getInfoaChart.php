<?php
include ('../checkSession.php');

if (!isset($_SESSION['user'])) {
  header('Location:../login.php');
}else{
  $user = unserialize($_SESSION['user']);
}

$schoolController = new SchoolController();
$school = $schoolController->getEntityByAction('cct', $user->getCct());
$school = $school[0];

$subjectController = new SubjectController();
$subjectList = $subjectController->displayByAction('e.id < 4');

$achievementController = new AchievementController();
$where = 'e.id != 999';
$whereFields = '';
$achievementList = $achievementController->displayByAction($where, $whereFields);

$idaepyAchievementRegionController = new IdaepyAchievementRegionController();
$where = 'e.school_region = 19 and e.year = 2018';
$idaepyRegionList = $idaepyAchievementRegionController->displayByAction($where);

$idaepyAchievementRegion = array();
foreach ($idaepyRegionList as $entry) {
	$idaepyAchievementRegion[$entry->getSubjectObject()->getAlias()][$entry->getAchievement()] = $entry->getTotal();
}

$achievementIdaepyController = new AchievementIdaepyController();
$achievementIdaepyList = $achievementIdaepyController->displayByAction('e.year = 2019');

$achievementColors = array();
foreach($achievementIdaepyList as $achievementEntry){
	$achievementColors[$achievementEntry->getAchievement()]['codeR'] = $achievementEntry->getCodeR();
	$achievementColors[$achievementEntry->getAchievement()]['codeG'] = $achievementEntry->getCodeG();
	$achievementColors[$achievementEntry->getAchievement()]['codeB'] = $achievementEntry->getCodeB();
}

//Nivel de logro del alumno
$idaepyAchievementController = new IdaepyAchievementController();
$where = 'e.student = :student AND e.year = 2019';
$whereFields = array('student' => $user->getStudent());
$idaepyAchievement = $idaepyAchievementController->displayByAction($where, $whereFields);

// Evaluados escuela
$join = 'INNER JOIN idaepy_students ida on ida.student = e.student';
$where = 'ida.cct = :cct AND e.year = :year and ida.year = :year';
$whereFields = array('cct' => $user->getCct(), 'year' => 2019);
$showFields = 'e.student, ida.cct, ida.grade, ida.school_group, e.percentage_hits, e.percentage_math, e.percentage_science,
e.percentage_spanish, e.achievement_math, e.achievement_science, e.achievement_spanish';
$idaepyList = $idaepyAchievementController->displayBy2Action($where, $whereFields, $join, $showFields);

// Total de alumnos en cada nivel de logro para la escuela
$idaepyAchievementSchool['maths'] = array_count_values(array_column($idaepyList, 'achievement_math'));
$idaepyAchievementSchool['spanish'] = array_count_values(array_column($idaepyList, 'achievement_spanish'));
$idaepyAchievementSchool['sciences'] = array_count_values(array_column($idaepyList, 'achievement_science'));
//Ordenar array
ksort($idaepyAchievementSchool['maths']);
ksort($idaepyAchievementSchool['spanish']);
ksort($idaepyAchievementSchool['sciences']);
//Eliminar alumnos sin logro
$idaepyAchievementSchool['maths'] = array_diff_key($idaepyAchievementSchool['maths'], array(999 => 1));
$idaepyAchievementSchool['spanish'] = array_diff_key($idaepyAchievementSchool['spanish'], array(999 => 1));
$idaepyAchievementSchool['sciences'] = array_diff_key($idaepyAchievementSchool['sciences'], array(999 => 1));

$totalAchievementLevel['maths'] = array_sum($idaepyAchievementSchool['maths']);
$totalAchievementLevel['spanish'] = array_sum($idaepyAchievementSchool['spanish']);
$totalAchievementLevel['sciences'] = array_sum($idaepyAchievementSchool['sciences']);

$idaepyGrade = array();
$idaepyGroup = array();
foreach($idaepyList as $idaepy){
	$idaepyGrade[$idaepy['grade']]['maths'][] = $idaepy['achievement_math'];
	$idaepyGrade[$idaepy['grade']]['sciences'][] = $idaepy['achievement_science'];
	$idaepyGrade[$idaepy['grade']]['spanish'][] = $idaepy['achievement_spanish'];

	$idaepyGroup[$idaepy['grade']][$idaepy['school_group']]['maths'][] = $idaepy['achievement_math'];
	$idaepyGroup[$idaepy['grade']][$idaepy['school_group']]['sciences'][] = $idaepy['achievement_science'];
	$idaepyGroup[$idaepy['grade']][$idaepy['school_group']]['spanish'][] = $idaepy['achievement_spanish'];
}

// Calcular los niveles de logro por grado
$idaepyAchievementGrade['maths'] =  array_count_values($idaepyGrade[$user->getGrade()]['maths']);
$idaepyAchievementGrade['spanish'] =  array_count_values($idaepyGrade[$user->getGrade()]['spanish']);
$idaepyAchievementGrade['sciences'] =  array_count_values($idaepyGrade[$user->getGrade()]['sciences']);
// Calcular los niveles de logro por grupo
$idaepyAchievementGroup['maths'] =  array_count_values($idaepyGroup[$user->getGrade()][$user->getSchoolGroup()]['maths']);
$idaepyAchievementGroup['spanish'] =  array_count_values($idaepyGroup[$user->getGrade()][$user->getSchoolGroup()]['spanish']);
$idaepyAchievementGroup['sciences'] =  array_count_values($idaepyGroup[$user->getGrade()][$user->getSchoolGroup()]['sciences']);

$idaepyAchievementGrade['maths'] = array_diff_key($idaepyAchievementGrade['maths'], array(999 => 1));
$idaepyAchievementGrade['spanish'] = array_diff_key($idaepyAchievementGrade['spanish'], array(999 => 1));
$idaepyAchievementGrade['sciences'] = array_diff_key($idaepyAchievementGrade['sciences'], array(999 => 1));
$idaepyAchievementGroup['maths'] = array_diff_key($idaepyAchievementGroup['maths'], array(999 => 1));
$idaepyAchievementGroup['spanish'] = array_diff_key($idaepyAchievementGroup['spanish'], array(999 => 1));
$idaepyAchievementGroup['sciences'] = array_diff_key($idaepyAchievementGroup['sciences'], array(999 => 1));

function replaceEmpty($array){
	$achievementArray = array(1 => 0, 2 => 0, 3 => 0, 4 => 0);
	$result = $array + $achievementArray;
	return $result;
}

$idaepyResult['state'] = array_map("replaceEmpty", $idaepyAchievementRegion);
$idaepyResult['school'] = array_map("replaceEmpty", $idaepyAchievementSchool);
$idaepyResult['grade'] = array_map("replaceEmpty", $idaepyAchievementGrade);
$idaepyResult['group'] = array_map("replaceEmpty", $idaepyAchievementGroup);

foreach($achievementColors as $keyLevel => $achievementColor){
	$color[$keyLevel] = "rgba(".$achievementColor['codeR'].", ".$achievementColor['codeG'].", ".$achievementColor['codeB'].")";
}

$subjectArray = array(1 => 'maths', 2 => 'spanish', 3 => 'sciences');

$dataChart = array();
foreach($subjectArray as $subjectKey => $subjectValue){
  $dataChart[$subjectValue] =
  "datasets: [
  	{ label: 'Inicial', data: [".$idaepyResult['state'][$subjectValue][1].", ".$idaepyResult['school'][$subjectValue][1].", ".$idaepyResult['grade'][$subjectValue][1].", ".$idaepyResult['group'][$subjectValue][1]."], backgroundColor: '$color[1]', },
  	{ label: 'Básico', data: [".$idaepyResult['state'][$subjectValue][2].", ".$idaepyResult['school'][$subjectValue][2].", ".$idaepyResult['grade'][$subjectValue][2].", ".$idaepyResult['group'][$subjectValue][2]."], backgroundColor: '$color[2]' },
  	{ label: 'Medio', data: [".$idaepyResult['state'][$subjectValue][3].", ".$idaepyResult['school'][$subjectValue][3].", ".$idaepyResult['grade'][$subjectValue][3].", ".$idaepyResult['group'][$subjectValue][3]."], backgroundColor: '$color[3]' },
  	{ label: 'Avanzado', data: [".$idaepyResult['state'][$subjectValue][4].", ".$idaepyResult['school'][$subjectValue][4].", ".$idaepyResult['grade'][$subjectValue][4].", ".$idaepyResult['group'][$subjectValue][4]."], backgroundColor: '$color[4]' },
  	]";
}

// $dataChart = array();
// $dataChart['maths'] =
// "datasets: [
// 	{ label: 'Inicial', data: [".$idaepyResult['state']['maths'][111].", ".$idaepyResult['school']['maths'][111].", ".$idaepyResult['grade']['maths'][111].", ".$idaepyResult['group']['maths'][111]."], backgroundColor: '$color[111]', },
// 	{ label: 'Básico', data: [".$idaepyResult['state']['maths'][1].", ".$idaepyResult['school']['maths'][1].", ".$idaepyResult['grade']['maths'][1].", ".$idaepyResult['group']['maths'][1]."], backgroundColor: '$color[1]' },
// 	{ label: 'Medio', data: [".$idaepyResult['state']['maths'][2].", ".$idaepyResult['school']['maths'][2].", ".$idaepyResult['grade']['maths'][2].", ".$idaepyResult['group']['maths'][2]."], backgroundColor: '$color[2]' },
// 	{ label: 'Avanzado', data: [".$idaepyResult['state']['maths'][3].", ".$idaepyResult['school']['maths'][3].", ".$idaepyResult['grade']['maths'][3].", ".$idaepyResult['group']['maths'][3]."], backgroundColor: '$color[3]' },
// 	]";
//
// $dataChart['spanish'] =
// "datasets: [
// 	{ label: 'Inicial', data: [".$idaepyResult['state']['spanish'][111].", ".$idaepyResult['school']['spanish'][111].", ".$idaepyResult['grade']['spanish'][111].", ".$idaepyResult['group']['spanish'][111]."], backgroundColor: '$color[111]', },
// 	{ label: 'Básico', data: [".$idaepyResult['state']['spanish'][1].", ".$idaepyResult['school']['spanish'][1].", ".$idaepyResult['grade']['spanish'][1].", ".$idaepyResult['group']['spanish'][1]."], backgroundColor: '$color[1]' },
// 	{ label: 'Medio', data: [".$idaepyResult['state']['spanish'][2].", ".$idaepyResult['school']['spanish'][2].", ".$idaepyResult['grade']['spanish'][2].", ".$idaepyResult['group']['spanish'][2]."], backgroundColor: '$color[2]' },
// 	{ label: 'Avanzado', data: [".$idaepyResult['state']['spanish'][3].", ".$idaepyResult['school']['spanish'][3].", ".$idaepyResult['grade']['spanish'][3].", ".$idaepyResult['group']['spanish'][3]."], backgroundColor: '$color[3]' },
// 	]";
//
// $dataChart['science'] =
// "datasets: [
// 	{ label: 'Inicial', data: [".$idaepyResult['state']['sciences'][111].", ".$idaepyResult['school']['science'][111].", ".$idaepyResult['grade']['science'][111].", ".$idaepyResult['group']['science'][111]."], backgroundColor: '$color[111]', },
// 	{ label: 'Básico', data: [".$idaepyResult['state']['sciences'][1].", ".$idaepyResult['school']['science'][1].", ".$idaepyResult['grade']['science'][1].", ".$idaepyResult['group']['science'][1]."], backgroundColor: '$color[1]' },
// 	{ label: 'Medio', data: [".$idaepyResult['state']['sciences'][2].", ".$idaepyResult['school']['science'][2].", ".$idaepyResult['grade']['science'][2].", ".$idaepyResult['group']['science'][2]."], backgroundColor: '$color[2]' },
// 	{ label: 'Avanzado', data: [".$idaepyResult['state']['sciences'][3].", ".$idaepyResult['school']['science'][3].", ".$idaepyResult['grade']['science'][3].", ".$idaepyResult['group']['science'][3]."], backgroundColor: '$color[3]' },
// 	]";

$chartsController = new ChartsController();
$chartName1 = "mathsChart";
$chartName2 = "spanishChart";
$chartName3 = "sciencesChart";

$charts1 = $chartsController->drawBarChart('Resultados de la Escuela', $chartName1, $dataChart['maths']);
$charts2 = $chartsController->drawBarChart('Resultados de la Escuela', $chartName2, $dataChart['spanish']);
$charts3 = $chartsController->drawBarChart('Resultados de la Escuela', $chartName3, $dataChart['sciences']);

?>
