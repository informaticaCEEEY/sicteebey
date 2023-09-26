<?php

include ('../checkSession.php');
require_once dirname(__FILE__) . '/../lib/PHPExcel/Classes/PHPExcel.php';

if(!isset($_POST['cct'])){
    $_SESSION['message'] = 'La escuela no existe';
    header('location:index.php');
}

if(!isset($_POST['year'])){
    $_SESSION['message'] = 'Seleccione un año';
    header('location:index.php');
}

if (!isset($_SESSION['user'])) {
    header('Location:../login.php');
}else{
    $user = unserialize($_SESSION['user']);
    $user = $userController->getEntityAction($user->getId());
}
extract($_POST);
$schoolController = new SchoolController();
$schoolObject = $schoolController->getEntityByAction('cct', $_POST['cct']);

if(!$schoolObject){
    $_SESSION['message'] = 'La escuela no existe';
    header('location:index.php');
}else{
    $school = $schoolObject[0];
}

$achievementController = new AchievementController();
if($year == 2016){
    $where = 'e.id > 1 and e.id <= 4';
    $whereFields = '';
}else{
    $where = 'e.id != 999';
    $whereFields = '';
}
$achievementList = $achievementController->displayByAction($where, $whereFields);
$achievementArrayList = array();
foreach ($achievementList as $key => $achievement) {
    $achievementArrayList[$achievement->getOrderLevel()]['level'] = $achievement->getName();
    $achievementArrayList[$achievement->getOrderLevel()]['key'] = $achievement->getId();
}
ksort($achievementArrayList);

$subjectController = new SubjectController();
$where = 'e.id < 4';
$subjectList = $subjectController->displayByAction($where);

$achievementSubjectController = new AchievementSubjectController();
$achievementSubjectList = $achievementSubjectController->getEntityByAction('year', $year);
$achievementSubjectArray = array();
foreach ($achievementSubjectList as $achievementSubject) {
    $subject = $achievementSubject->getSubject();
    $orderA = $achievementSubject->getAchievementObject()->getOrderLevel();
    $achievementSubjectArray[$subject][$orderA] = $achievementSubject->getAchievementObject()->getName();
}

$schoolZoneHistorialController = new SchoolZoneHistorialController();
$where = "cct = :cct AND year = :year";
$whereFields = array('cct' =>$school->getCct(), 'year' => $year);
$schoolZoneHistorialList = $schoolZoneHistorialController->displayByAction($where, $whereFields);

$achievementTotal = array();
foreach($achievementSubjectArray as $key => $achievementS){
    $achievementTotal[$key] = count($achievementS);
}

//$dirFolder = "../Carteles IDAEPY 2016/";
//$modeFolder = "Modalidad " . ucfirst(strtolower($schoolMode)) . "/";
//$sectorFolder = "Sector " . str_pad($schoolSector, 2, "0", STR_PAD_LEFT) . "/";
//$zoneFolder = "Primaria " . ucfirst(strtolower($schoolMode)) . " Zona " . str_pad($schoolZone, 3, "0", STR_PAD_LEFT) . "/";
//$docName =  "IDAEPY 2017 " . $cct . " Región " . $schoolRegion . " Zona " . str_pad($schoolZone, 3, "0", STR_PAD_LEFT) . ".pdf";
/*$folderName = $dirFolder . utf8_decode(html_entity_decode($modeFolder)) . $sectorFolder .
        utf8_decode(html_entity_decode($zoneFolder)) . utf8_decode(html_entity_decode($docName));*/

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("William Pacheco")
							 ->setLastModifiedBy("William Pacheco")
							 ->setTitle("IDAEPY 2016 " . $school->getCct())
							 ->setSubject("IDAEPY 2016 " . $school->getCct())
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setName('imgNotice');
$objDrawing->setDescription('Noticia');
$img = '../img/Segey900.png'; // Provide path to your logo file
$objDrawing->setPath($img);
$objDrawing->setOffsetX(28);    // setOffsetX works properly
$objDrawing->setOffsetY(50);  //setOffsetY has no effect
$objDrawing->setCoordinates('A1');
$objDrawing->setHeight(75); // logo height
//$objDrawing->setWorksheet($objPHPExcel->setActiveSheetIndex($pos+1));
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

$title = "Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY $year)";
// Se combinan las celdas Xn hasta Yn, para colocar ahí el titulo del reporte
if($year == '2016'){
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:R1');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:R5');
}else {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U1');
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:U5');
}

$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2',$title);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A6:A8');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A6','CCT');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B6:B8');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B6','Nombre de la Escuela');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('C6:C8');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C6','Grado');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D6:D8');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D6','Grupo');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('E6:E8');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E6','Alumnos Evaluados');
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('F6:I7');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F6','Porcentaje de aciertos');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F8','Global');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G8','Matemáticas');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H8','Español');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I8','Ciencias Naturales');
if($year == '2016'){
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J6:R6');
}else {
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells('J6:U6');
}
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('J6','Porcentaje de estudiantes por Nivel de Logro');
$cell = 'j';
foreach($subjectList as $subjectEntry){
    $firstCell = $cell;
    $lastCell = $firstCell;
    for($i=1; $i < $achievementTotal[$subjectEntry->getId()]; $i++){
        $lastCell++;
    }
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($firstCell.'7:'.$lastCell.'7');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue($firstCell.'7',$subjectEntry->getName());
    $lastCell++;
    $cell = $lastCell;
}

// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M7:O7');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('M7','Español');
// $objPHPExcel->setActiveSheetIndex(0)->mergeCells('P7:R7');
// $objPHPExcel->setActiveSheetIndex(0)->setCellValue('P7','Ciencias Naturales');
$cell = 'j';
foreach($achievementSubjectArray as $achievementSubject){
    ksort($achievementSubject);
    foreach ($achievementSubject as $key => $value) {
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.'8', $value);
        $cell++;
    }
}

$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A9:D9');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A9','Yucatán');
if($year <= 2016){
    $schoolMode = "Modalidad " . $school->getOldSchoolRegionObject()->getSchoolModeObject()->getName();
    $schoolRegion = "Región " . $school->getOldSchoolRegionObject()->getSchoolRegionObject()->getName();
    $schoolZone = "Zona " . $school->getOldSchoolRegionObject()->getZone();
}else{
    $schoolMode = "Modalidad " . $school->getSchoolRegionZoneObject()->getSchoolModeObject()->getName();
    $schoolRegion = "Región " . $school->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName();
    $schoolZone = "Zona " . $school->getSchoolRegionZoneObject()->getZone();
}


$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A10:D10');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A10',$schoolMode);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A11:D11');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A11',$schoolRegion);
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A12:D12');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A12',$schoolZone);

// Lista de estudiantes de la escuela seleccionada
$idaepyAchievementController = new IdaepyAchievementController();
$join = 'INNER JOIN idaepy_students ida on ida.student = e.student';
$where = 'ida.cct = :cct AND e.year = :year and ida.year = :year';
$whereFields = array('cct' => $_POST['cct'], 'year' => $year);
$showFields = 'e.student, ida.cct, ida.grade, ida.school_group, e.percentage_hits, e.percentage_math, e.percentage_science,
               e.percentage_spanish, e.achievement_math, e.achievement_science, e.achievement_spanish';
$idaepyAchievementList = $idaepyAchievementController->displayBy2Action($where, $whereFields, $join, $showFields);
// Total de alumnos evaluados por escuela
$totalSchool = count($idaepyAchievementList);
// Total alumnos evaluados por grado
$totalGradeEva = array_count_values(array_column($idaepyAchievementList, 'grade'));
//$totalGradeEva2 = array_count_values(array_column($idaepyAchievementList, 'school_group'));
// Total de grados evaluados
$totalGrade = count($totalGradeEva);
// Porcentaje de aciertos de la escuela por materia
$percentageAchievementHits['total']= array_sum(array_column($idaepyAchievementList, 'percentage_hits'))/$totalSchool;
$percentageAchievementHits['math'] = array_sum(array_column($idaepyAchievementList, 'percentage_math'))/$totalSchool;
$percentageAchievementHits['science'] = array_sum(array_column($idaepyAchievementList, 'percentage_science'))/$totalSchool;
$percentageAchievementHits['spanish'] = array_sum(array_column($idaepyAchievementList, 'percentage_spanish'))/$totalSchool;
// Total de alumnos en cada nivel de logro para la escuela
$totalAchievementLevel['spanish'] = array_count_values(array_column($idaepyAchievementList, 'achievement_spanish'));
$totalAchievementLevel['math'] = array_count_values(array_column($idaepyAchievementList, 'achievement_math'));
$totalAchievementLevel['science'] = array_count_values(array_column($idaepyAchievementList, 'achievement_science'));

if(isset($totalAchievementLevel['math'][999])){
  unset($totalAchievementLevel['math'][999]);
  $totalMath = array_sum($totalAchievementLevel['math']);
}else{
  $totalMath = $totalSchool;
}

if(isset($totalAchievementLevel['spanish'][999])){
  unset($totalAchievementLevel['spanish'][999]);
  $totalSpanish = array_sum($totalAchievementLevel['spanish']);
}else{
  $totalSpanish = $totalSchool;
}

if(isset($totalAchievementLevel['science'][999])){
  unset($totalAchievementLevel['science'][999]);
  $totalScience = array_sum($totalAchievementLevel['science']);
}else{
  $totalScience = $totalSchool;
}

foreach($achievementList as $achievementSubjectLevel){
    $keyLevel = $achievementSubjectLevel->getId();
    $percentageAchievementLevel[1][$keyLevel] = $totalAchievementLevel['math'][$keyLevel]/$totalMath*100;
    $percentageAchievementLevel[2][$keyLevel] = $totalAchievementLevel['spanish'][$keyLevel]/$totalSpanish*100;
    $percentageAchievementLevel[3][$keyLevel] = $totalAchievementLevel['science'][$keyLevel]/$totalScience*100;
}
/*
 * Recorre el array de los alumnos evaluados en la escuela
 *
 * $idaepySchoolGroupTotal - Array de alumnos evaluados por grado y grupo
 * $idaepyHitsResult - Array del porcentaje de aciertos de los alumnos evaluados por grado y grupo para cada asignatura
 * $idaepyAchievementResult - Array del nivel de logro de los alumnos evaluados por grado y grupo para cada asignatura
 *
 * */
$idaepyAchievementTotalGroup = array();
foreach($idaepyAchievementList as $idaepyAchievement){
    $classRoom = $idaepyAchievement['grade'].$idaepyAchievement['school_group'];
    //$idaepyAchievementTotalGroup[$idaepyAchievement['grade']][] = $idaepyAchievement['school_group'];
    $idaepySchoolGroupTotal[$idaepyAchievement['grade']][$idaepyAchievement['school_group']][] = $idaepyAchievement['student'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['hits'][] = $idaepyAchievement['percentage_hits'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['math'][] = $idaepyAchievement['percentage_math'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['science'][] = $idaepyAchievement['percentage_science'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['spanish'][] = $idaepyAchievement['percentage_spanish'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['math'][] = $idaepyAchievement['achievement_math'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['science'][] = $idaepyAchievement['achievement_science'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['spanish'][] = $idaepyAchievement['achievement_spanish'];
}

//$maxWidth = max(array_map('count',$idaepySchoolGroupTotal[3]));
/*
 * Recorrel el array $idaepyHitsResult para obtener los grupos por grado ya guardarlos en $idaepyAchievementTotalGroup
 *
 * */
foreach($idaepyHitsResult as $key => $idaepyHitsResultEntry){
    $idaepyAchievementTotalGroup[$key] = array_keys($idaepyHitsResultEntry);
}

// numero de la ultima fila
$count = 13;
// reccorer el arreglo de grupos
$totalStudentsByGroup = array();
$totalEvaByGroup = array();
$totalEvaByGrade = array();
$listPercentageByGrade = array();
foreach($idaepyAchievementTotalGroup as $keyGrade => $idaepyGrade){
    $listPercentageHits = array();
    $listPercentageAchievement = array();
    foreach($idaepyGrade as $idaepyGroup){
        //Alumnos Evaluados  en el grupo
        $totalGroup = count($idaepySchoolGroupTotal[$keyGrade][$idaepyGroup]);
        $totalStudentsByGroup[$keyGrade][$idaepyGroup] = $totalGroup;
        $listSumHits[$keyGrade][$idaepyGroup] =  array_sum($idaepyHitsResult[$keyGrade][$idaepyGroup]['hits']);
        // Porcentaje de aciertos por grupo
        $percentageHits =  array_sum($idaepyHitsResult[$keyGrade][$idaepyGroup]['hits'])/count($idaepyHitsResult[$keyGrade][$idaepyGroup]['hits']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[$keyGrade][$idaepyGroup]['spanish'])/count($idaepyHitsResult[$keyGrade][$idaepyGroup]['spanish']);
        $percentageMathHits =  array_sum($idaepyHitsResult[$keyGrade][$idaepyGroup]['math'])/count($idaepyHitsResult[$keyGrade][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[$keyGrade][$idaepyGroup]['science'])/count($idaepyHitsResult[$keyGrade][$idaepyGroup]['science']);
        // Array que almacena los porcentajes de aciertos por grupo
        $listPercentageHits['hits'][] = $percentageHits;
        $listPercentageHits['spanish'][] = $percentageSpanishHits;
        $listPercentageHits['math'][] = $percentageMathHits;
        $listPercentageHits['science'][] = $percentageScienceHits;
        // Calcular los niveles de logro por grupo
        $mathAchievementList =  array_count_values($idaepyAchievementResult[$keyGrade][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[$keyGrade][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[$keyGrade][$idaepyGroup]['spanish']);
        // Total de alumnos evaluados por materia en base a los niveles de logro

        $totalMathAchievement =  $mathAchievementList[1] + $mathAchievementList[2] + $mathAchievementList[3] + $mathAchievementList[4];
        $totalScienceAchievement =  $scienceAchievementList[1] + $scienceAchievementList[2] + $scienceAchievementList[3] + $scienceAchievementList[4];
        $totalSpanishAchievement =  $spanishAchievementList[1] + $spanishAchievementList[2] + $spanishAchievementList[3] + $spanishAchievementList[4];

        $totalEvaByGroup[1][$keyGrade][$idaepyGroup] = $totalMathAchievement;
        $totalEvaByGroup[3][$keyGrade][$idaepyGroup] = $totalScienceAchievement;
        $totalEvaByGroup[2][$keyGrade][$idaepyGroup] = $totalSpanishAchievement;

        $countLetterMath = 'J';
        if($year == 2016){
            $countLetterSpanish = 'M';
            $countLetterScience = 'P';
        }else{
            $countLetterSpanish = 'N';
            $countLetterScience = 'R';
        }
        //Recorrer array de niveles de logro para asignar a cada celda su valor correspondiente por grupo
        foreach($achievementArrayList as $keyLevel => $achievementSubjectLevel){
            $keyLevel = $achievementSubjectLevel['key'];
            // Porcentaje de alumnos evaluados para cada nivel de logro en matematicas
            $percentageMathAchievement[$keyLevel] = number_format($mathAchievementList[$keyLevel]/$totalMathAchievement*100,4);
            $listPercentageAchievement['math'][$keyLevel][$idaepyGroup] = $percentageMathAchievement[$keyLevel] * $totalMathAchievement;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($countLetterMath.$count, $percentageMathAchievement[$keyLevel]);
            $countLetterMath++;
            // Porcentaje de alumnos evaluados para cada nivel de logro en español
            $percentageSpanishAchievement[$keyLevel] = number_format($spanishAchievementList[$keyLevel]/$totalSpanishAchievement*100,4);
            $listPercentageAchievement['spanish'][$keyLevel][$idaepyGroup] = $percentageSpanishAchievement[$keyLevel] * $totalSpanishAchievement;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($countLetterSpanish.$count, $percentageSpanishAchievement[$keyLevel]);
            $countLetterSpanish++;
            // Porcentaje de alumnos evaluados para cada nivel de logro en ciencias
            $percentageScienceAchievement[$keyLevel] = number_format($scienceAchievementList[$keyLevel]/$totalScienceAchievement*100,4);
            $listPercentageAchievement['science'][$keyLevel][$idaepyGroup] = $percentageScienceAchievement[$keyLevel] * $totalScienceAchievement;
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($countLetterScience.$count, $percentageScienceAchievement[$keyLevel]);
            $countLetterScience++;

        }
        //733033930581
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$count, $keyGrade);
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$count, $idaepyGroup);

        //Alumnos Evaluados
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$count, $totalGroup);

        // Porcentaje de Aciertos
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$count, number_format($percentageHits, 2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$count, number_format($percentageMathHits, 2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$count, number_format($percentageSpanishHits, 2));
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$count, number_format($percentageScienceHits, 2));
        // Array para almacenar los totales para la ponderacion de medias
        $listPercentageByGrade[$keyGrade]['spanish'][$idaepyGroup] = $percentageSpanishHits * $totalSpanishAchievement;
        $listPercentageByGrade[$keyGrade]['math'][$idaepyGroup] = $percentageMathHits * $totalMathAchievement;
        $listPercentageByGrade[$keyGrade]['science'][$idaepyGroup] = $percentageScienceHits * $totalScienceAchievement;
        $count = $count + 1;
    }//Fin Grupo

    // Calcular porcentaje de aciertos por grado
    $totalGroup = count($idaepyAchievementTotalGroup[$keyGrade]);
    $totalPercentageHits = array_sum($listSumHits[$keyGrade])/$totalGradeEva[$keyGrade];
    $totalPercentageSpanishHits = array_sum($listPercentageByGrade[$keyGrade]['spanish'])/$totalGradeEva[$keyGrade];
    $totalPercentageMathHits = array_sum($listPercentageByGrade[$keyGrade]['math'])/$totalGradeEva[$keyGrade];
    $totalPercentageScienceHits = array_sum($listPercentageByGrade[$keyGrade]['science'])/$totalGradeEva[$keyGrade];

    $totalEvaByGrade[1][$keyGrade] = array_sum($totalEvaByGroup[1][$keyGrade]);
    $totalEvaByGrade[2][$keyGrade] = array_sum($totalEvaByGroup[2][$keyGrade]);
    $totalEvaByGrade[3][$keyGrade] = array_sum($totalEvaByGroup[3][$keyGrade]);

    //Recorrer array de niveles de logro para obtener el porcentaje por grado
    foreach($achievementList as $achievementSubjectLevel){
        $keyLevel = $achievementSubjectLevel->getId();

        $percentageGradeAchievement[2][$keyGrade][$keyLevel] = array_sum($listPercentageAchievement['spanish'][$keyLevel])/$totalEvaByGrade[2][$keyGrade];
        $percentageGradeAchievement[1][$keyGrade][$keyLevel] = array_sum($listPercentageAchievement['math'][$keyLevel])/$totalEvaByGrade[1][$keyGrade];
        $percentageGradeAchievement[3][$keyGrade][$keyLevel] = array_sum($listPercentageAchievement['science'][$keyLevel])/$totalEvaByGrade[3][$keyGrade];
    }

    //Porcentaje de aciertos por grado
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$count, $totalGradeEva[$keyGrade]);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$count, $keyGrade);
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$count, 'Total Grado');
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$count, number_format($totalPercentageHits,4));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$count, number_format($totalPercentageMathHits,4));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$count, number_format($totalPercentageSpanishHits,4));
    $objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$count, number_format($totalPercentageScienceHits,4));
    // Porcentaje de alumnos en cada nivel de logro para el grado
    $cell = 'j';
    foreach ($subjectList as $keySubject => $subject) {
        foreach ($achievementArrayList as $keyAchievement => $achievement) {
            $achievKey = $achievement['key'];
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.$count, number_format($percentageGradeAchievement[$subject->getId()][$keyGrade][$achievKey],4));
            $cell++;
        }
    }
    //Porcentaje de alumnos evaluados por nivel de logro y materia del grado
    $count = $count + 1;
}//Fin Grado;
$objPHPExcel->getActiveSheet()->getStyle('E9:R12')->getNumberFormat()->setFormatCode('#,##0');

//Logro por estado
$idaepyAchievementRegionController = new IdaepyAchievementRegionController();
$where = 'e.school_region = :schoolRegion AND e.year = :year';
$whereFields = array('schoolRegion' => 19, 'year' => $year);
$idaepyAchievementStateList = $idaepyAchievementRegionController->displayByAction($where, $whereFields);
$achievementStateList = array();
foreach ($idaepyAchievementStateList as $idaepyAchievementState) {
    $subject = $idaepyAchievementState->getSubject();
    $achievement = $idaepyAchievementState->getAchievement();
    $achievementStateList['achievement'][$subject][$achievement] = $idaepyAchievementState->getPercentage();
}

$idaepyPercentageRegionController = new IdaepyPercentageRegionController();
$idaepyPercentageStateList = $idaepyPercentageRegionController->displayByAction($where, $whereFields);
foreach ($idaepyPercentageStateList as $idaepyPercentageState) {
    $subject = $idaepyPercentageState->getSubject();
    $achievementStateList['hits'][$subject] = $idaepyPercentageState->getPercentage();
    $achievementStateList['evaluated'][$subject] = $idaepyPercentageState->getEvaluated();
}

//Procentaje de aciertos global y por materia para el estado
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E9',$achievementStateList['evaluated'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F9',$achievementStateList['hits'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G9',$achievementStateList['hits'][1]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H9',$achievementStateList['hits'][2]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I9',$achievementStateList['hits'][3]);

// Porcentaje de alumnos en cada nivel de logro para el estado
$cell = 'j';
foreach ($subjectList as $keySubject => $subject) {
    foreach ($achievementArrayList as $keyAchievement => $achievement) {
        $achievKey = $achievement['key'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.'9',$achievementStateList['achievement'][$subject->getId()][$achievKey]);
        $cell++;
    }
}
// Logro por modalidad
$idaepyAchievementModeController = new IdaepyAchievementModeController();
$where = 'e.school_mode = :schoolMode AND e.year = :year';
$whereFields = array('schoolMode' => $school->getMode(), 'year' => $year);
$idaepyAchievementModeList = $idaepyAchievementModeController->displayByAction($where, $whereFields);
$achievementModeList = array();
foreach ($idaepyAchievementModeList as $idaepyAchievementMode) {
    $subject = $idaepyAchievementMode->getSubject();
    $achievement = $idaepyAchievementMode->getAchievement();
    $achievementModeList['achievement'][$subject][$achievement] = $idaepyAchievementMode->getPercentage();
}

$idaepyPercentageModeController = new IdaepyPercentageModeController();
$idaepyPercentageModeList = $idaepyPercentageModeController->displayByAction($where, $whereFields);
foreach ($idaepyPercentageModeList as $idaepyPercentageMode) {
    $subject = $idaepyPercentageMode->getSubject();
    $achievementModeList['hits'][$subject] = $idaepyPercentageMode->getPercentage();
    $achievementModeList['evaluated'][$subject] = $idaepyPercentageMode->getEvaluated();
}

//Procentaje de aciertos global y por materia para la modalidad
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E10',$achievementModeList['evaluated'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F10',$achievementModeList['hits'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G10',$achievementModeList['hits'][1]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H10',$achievementModeList['hits'][2]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I10',$achievementModeList['hits'][3]);

// Porcentaje de alumnos en cada nivel de logro para la modalidad
$cell = 'j';
foreach ($subjectList as $keySubject => $subject) {
    foreach ($achievementArrayList as $keyAchievement => $achievement) {
        $achievKey = $achievement['key'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.'10',$achievementModeList['achievement'][$subject->getId()][$achievKey]);
        $cell++;
    }
}

$field = 'school_region';
// if($year <= 2016){
//     $search = $school->getOldSchoolRegionObject()->getSchoolRegion();
// }else{
//     $search = $school->getSchoolRegionZoneObject()->getSchoolRegion();
// }
$search = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getSchoolRegion();

// Logro por Region
$idaepyAchievementRegionController = new IdaepyAchievementRegionController();
$where = 'e.school_region = :schoolRegion AND e.year = :year';
$whereFields = array('schoolRegion' => $search, 'year' => $year);
$idaepyAchievementRegionList = $idaepyAchievementRegionController->displayByAction($where, $whereFields);
$achievementRegionList = array();
foreach ($idaepyAchievementRegionList as $idaepyAchievementRegion) {
    $subject = $idaepyAchievementRegion->getSubject();
    $achievement = $idaepyAchievementRegion->getAchievement();
    $achievementRegionList['achievement'][$subject][$achievement] = $idaepyAchievementRegion->getPercentage();
}

$idaepyPercentageRegionController = new IdaepyPercentageRegionController();
$idaepyPercentageRegionList = $idaepyPercentageRegionController->displayByAction($where, $whereFields);
foreach ($idaepyPercentageRegionList as $idaepyPercentageRegion) {
    $subject = $idaepyPercentageRegion->getSubject();
    $achievementRegionList['hits'][$subject] = $idaepyPercentageRegion->getPercentage();
    $achievementRegionList['evaluated'][$subject] = $idaepyPercentageRegion->getEvaluated();
}

//Procentaje de aciertos global y por materia para la region
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E11',$achievementRegionList['evaluated'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F11',$achievementRegionList['hits'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G11',$achievementRegionList['hits'][1]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H11',$achievementRegionList['hits'][2]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I11',$achievementRegionList['hits'][3]);

// Porcentaje de alumnos en cada nivel de logro para la region
$cell = 'j';
foreach ($subjectList as $keySubject => $subject) {
    foreach ($achievementArrayList as $keyAchievement => $achievement) {
        $achievKey = $achievement['key'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.'11',$achievementRegionList['achievement'][$subject->getId()][$achievKey]);
        $cell++;
    }
}

$idaepyAchievementRegionZoneController = new IdaepyAchievementRegionZoneController();
$field = 'school_region_zone';
if($year == 2018){
  $search = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getZone();
}else{
  $search = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getId();
}
// if($year <= 2016){
//     $search = $school->getOldSchoolRegionObject()->getId();
// }else{
//     $search = $school->getSchoolRegionZoneObject()->getId();
// }

// Logro por Zona
$idaepyAchievementZoneController = new IdaepyAchievementZoneController();
$where = 'e.school_zone = :schoolZone AND e.school_mode = :schoolMode AND e.year = :year';
$whereFields = array('schoolZone' => $search, 'year' => $year, 'schoolMode' => $school->getSchoolRegionZoneObject()->getMode());
$idaepyAchievementZoneList = $idaepyAchievementZoneController->displayByAction($where, $whereFields);

$achievementZoneList = array();
foreach ($idaepyAchievementZoneList as $idaepyAchievementZone) {
    $subject = $idaepyAchievementZone->getSubject();
    $achievement = $idaepyAchievementZone->getAchievement();
    $achievementZoneList['achievement'][$subject][$achievement] = $idaepyAchievementZone->getPercentage();
}

$idaepyPercentageZoneController = new IdaepyPercentageZoneController();
$idaepyPercentageZoneList = $idaepyPercentageZoneController->displayByAction($where, $whereFields);
foreach ($idaepyPercentageZoneList as $idaepyPercentageZone) {
    $subject = $idaepyPercentageZone->getSubject();
    $achievementZoneList['hits'][$subject] = $idaepyPercentageZone->getPercentage();
    $achievementZoneList['evaluated'][$subject] = $idaepyPercentageZone->getEvaluated();
}

//Procentaje de aciertos global y por materia para la zona
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E12',$achievementZoneList['evaluated'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F12',$achievementZoneList['hits'][4]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G12',$achievementZoneList['hits'][1]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H12',$achievementZoneList['hits'][2]);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I12',$achievementZoneList['hits'][3]);

// Porcentaje de alumnos en cada nivel de logro para la zona
$cell = 'j';
foreach ($subjectList as $keySubject => $subject) {
    foreach ($achievementArrayList as $keyAchievement => $achievement) {
        $achievKey = $achievement['key'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.'12',$achievementZoneList['achievement'][$subject->getId()][$achievKey]);
        $cell++;
    }
}
// se escriben los datos en las celdas seleccionadas
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A13:A'.$count);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A13',$school->getCct());
$objPHPExcel->setActiveSheetIndex(0)->mergeCells('B13:B'.$count);
$schoolName = $school->getName();
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B13',$schoolName);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C'.$count, 'Escuela');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$count, 'Total');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$count, $totalSchool);
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('F'.$count, number_format($percentageAchievementHits['total'],4));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('G'.$count, number_format($percentageAchievementHits['math'],4));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('H'.$count, number_format($percentageAchievementHits['spanish'],4));
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('I'.$count, number_format($percentageAchievementHits['science'],4));
$cell = 'j';

foreach ($subjectList as $keySubject => $subject) {
    foreach ($achievementArrayList as $keyAchievement => $achievement) {
        $achievKey = $achievement['key'];
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cell.$count, number_format($percentageAchievementLevel[$subject->getId()][$achievKey],4));
        $cell++;
    }
}

// Graficas de nivel de logro por materia y grado
// Matemáticas
//  Set the Labels for each data series we want to plot
if($year == 2016){
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
    );
}else{
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$M$8", NULL, 1),   //  Avanzado
    );
}

$totalGroup = array();
$totalGraph = array();

foreach($idaepyAchievementTotalGroup as $keyGrade => $valueGroup){
    $totalGroup['grade'][] = $keyGrade;
    $totalGroup['total'][] = count($idaepyAchievementTotalGroup[$keyGrade]);
    //echo $keyGrade . "<br>";
}

$countG = 0;
foreach($idaepyAchievementTotalGroup as $keyGrade => $valueGroup){
    if($countG == 0){
        $totalGraph[$keyGrade] = 12 + $totalGroup['total'][$countG] + 1;
    }else{
        $totalGraph[$keyGrade] = current($totalGraph) + $totalGroup['total'][$countG] + 1;
        next($totalGraph);
    }
    $countG = $countG + 1;
}


$graphTicks = '';
$graphMatInicial = '';
$graphMatBasic = '';
$graphMatMedium = '';
$graphMatAdvance = '';
$totalGrad = count($idaepyAchievementTotalGroup);

if($year == 2016){
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphTicks .= "'Reporte IDAEPY'!\$C$".$totalG;
            $graphMatBasic .= "'Reporte IDAEPY'!\$J$".$totalG;
            $graphMatMedium .= "'Reporte IDAEPY'!\$K$".$totalG;
            $graphMatAdvance .= "'Reporte IDAEPY'!\$L$".$totalG;
        }else{
            $graphTicks .= "'Reporte IDAEPY'!\$C$".$totalG.",";
            $graphMatBasic .= "'Reporte IDAEPY'!\$J$".$totalG.",";
            $graphMatMedium .= "'Reporte IDAEPY'!\$K$".$totalG.",";
            $graphMatAdvance .= "'Reporte IDAEPY'!\$L$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}else{
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphTicks .= "'Reporte IDAEPY'!\$C$".$totalG;
            $graphMatInicial .= "'Reporte IDAEPY'!\$J$".$totalG;
            $graphMatBasic .= "'Reporte IDAEPY'!\$K$".$totalG;
            $graphMatMedium .= "'Reporte IDAEPY'!\$L$".$totalG;
            $graphMatAdvance .= "'Reporte IDAEPY'!\$M$".$totalG;
        }else{
            $graphTicks .= "'Reporte IDAEPY'!\$C$".$totalG.",";
            $graphMatInicial .= "'Reporte IDAEPY'!\$J$".$totalG.",";
            $graphMatBasic .= "'Reporte IDAEPY'!\$K$".$totalG.",";
            $graphMatMedium .= "'Reporte IDAEPY'!\$L$".$totalG.",";
            $graphMatAdvance .= "'Reporte IDAEPY'!\$M$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}

$xAxisTickValues = array(
    new PHPExcel_Chart_DataSeriesValues('String',
            $graphTicks, NULL, 4),  //  Q1 to Q4
);
if($year == 2016){
    //  Set the Data values for each data series we want to plot
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatAdvance, NULL, 4),
    );
}else{
    //  Set the Data values for each data series we want to plot
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatInicial, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphMatAdvance, NULL, 4),
    );
}

//  Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
    PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
    PHPExcel_Chart_DataSeries::GROUPING_STANDARD,   // plotGrouping
    range(0, count($dataSeriesValues)-1),           // plotOrder
    $dataSeriesLabels,                              // plotLabel
    $xAxisTickValues,                               // plotCategory
    $dataSeriesValues                               // plotValues
);
//  Set additional dataseries parameters
//      Make it a vertical column rather than a horizontal bar graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//  Set up a layout object for the Pie chart
$layout = new PHPExcel_Chart_Layout();
$layout->setShowVal(TRUE);
$layout->setXPosition(20);
$layout->setYPosition(20);
//  Set the series in the plot area
$plotArea = new PHPExcel_Chart_PlotArea($layout, array($series));
//  Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_BOTTOM, $layout, false);

$title = new PHPExcel_Chart_Title('Matemáticas');


//  Create the chart
$chart = new PHPExcel_Chart(
    'chart1',       // name
    $title,         // title
    $legend,        // legend
    $plotArea,      // plotArea
    true,           // plotVisibleOnly
    0,              // displayBlanksAs
    NULL,           // xAxisLabel
    $yAxisLabel     // yAxisLabel
);

//  Set the position where the chart should appear in the worksheet
$pos = 'A'.($count + 2);
$chart->setTopLeftPosition('A'.($count + 2));
$chart->setBottomRightPosition('E'.($count + 15), 50, 50);
//$chart->setBottomRightCell();

//  Add the chart to the worksheet
$objPHPExcel->getActiveSheet()->addChart($chart);

// Español
//  Set the Labels for each data series we want to plot
if($year == 2016){
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
    );
}else{
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$M$8", NULL, 1),   //  Avanzado
    );
}
//  Set the X-Axis Labels
$graphEspInicial = '';
$graphEspBasic = '';
$graphEspMedium = '';
$graphEspAdvance = '';

if($year == '2016'){
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphEspBasic .= "'Reporte IDAEPY'!\$M$".$totalG;
            $graphEspMedium .= "'Reporte IDAEPY'!\$N$".$totalG;
            $graphEspAdvance .= "'Reporte IDAEPY'!\$O$".$totalG;
        }else{
            $graphEspBasic .= "'Reporte IDAEPY'!\$M$".$totalG.",";
            $graphEspMedium .= "'Reporte IDAEPY'!\$N$".$totalG.",";
            $graphEspAdvance .= "'Reporte IDAEPY'!\$O$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}else{
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphEspInicial .= "'Reporte IDAEPY'!\$N$".$totalG;
            $graphEspBasic .= "'Reporte IDAEPY'!\$O$".$totalG;
            $graphEspMedium .= "'Reporte IDAEPY'!\$P$".$totalG;
            $graphEspAdvance .= "'Reporte IDAEPY'!\$Q$".$totalG;
        }else{
            $graphEspInicial .= "'Reporte IDAEPY'!\$N$".$totalG.",";
            $graphEspBasic .= "'Reporte IDAEPY'!\$O$".$totalG.",";
            $graphEspMedium .= "'Reporte IDAEPY'!\$P$".$totalG.",";
            $graphEspAdvance .= "'Reporte IDAEPY'!\$Q$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}

$xAxisTickValues = array(
    new PHPExcel_Chart_DataSeriesValues('String',
            $graphTicks, NULL, 4),  //  Q1 to Q4
);

//  Set the Data values for each data series we want to plot
if($year == '2016'){
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspAdvance, NULL, 4),
    );
}else{
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspInicial, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphEspAdvance, NULL, 4),
    );
}

//  Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
    PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
    PHPExcel_Chart_DataSeries::GROUPING_STANDARD,   // plotGrouping
    range(0, count($dataSeriesValues)-1),           // plotOrder
    $dataSeriesLabels,                              // plotLabel
    $xAxisTickValues,                               // plotCategory
    $dataSeriesValues                               // plotValues
);
//  Set additional dataseries parameters
//      Make it a vertical column rather than a horizontal bar graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//  Set the series in the plot area
$plotArea = new PHPExcel_Chart_PlotArea($layout, array($series));
//  Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_BOTTOM, NULL, false);

$title = new PHPExcel_Chart_Title('Español');

//  Create the chart
$chart = new PHPExcel_Chart(
    'chart2',       // name
    $title,         // title
    $legend,        // legend
    $plotArea,      // plotArea
    true,           // plotVisibleOnly
    0,              // displayBlanksAs
    NULL,           // xAxisLabel
    $yAxisLabel     // yAxisLabel
);

//  Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('F'.($count + 2), 25);
$chart->setBottomRightPosition('K'.($count + 15), 75, 50);

//  Add the chart to the worksheet
$objPHPExcel->getActiveSheet()->addChart($chart);

// Ciencias
//  Set the Labels for each data series we want to plot
if($year == 2016){
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
    );
}else{
    $dataSeriesLabels = array(
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$J$8", NULL, 1),   //  Inicial
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$K$8", NULL, 1),   //  Basico
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$L$8", NULL, 1),   //  Medio
        new PHPExcel_Chart_DataSeriesValues('String', "'Reporte IDAEPY'!\$M$8", NULL, 1),   //  Avanzado
    );
}

//  Set the X-Axis Labels
$graphScienceInicial = '';
$graphScienceBasic = '';
$graphScienceMedium = '';
$graphScienceAdvance = '';

if($year == '2016'){
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphScienceBasic .= "'Reporte IDAEPY'!\$P$".$totalG;
            $graphScienceMedium .= "'Reporte IDAEPY'!\$Q$".$totalG;
            $graphScienceAdvance .= "'Reporte IDAEPY'!\$R$".$totalG;
        }else{
            $graphScienceBasic .= "'Reporte IDAEPY'!\$P$".$totalG.",";
            $graphScienceMedium .= "'Reporte IDAEPY'!\$Q$".$totalG.",";
            $graphScienceAdvance .= "'Reporte IDAEPY'!\$R$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}else {
    $countG = 1;
    foreach($totalGraph as $totalG){
        if($countG == $totalGrad){
            $graphScienceInicial .= "'Reporte IDAEPY'!\$R$".$totalG;
            $graphScienceBasic .= "'Reporte IDAEPY'!\$S$".$totalG;
            $graphScienceMedium .= "'Reporte IDAEPY'!\$T$".$totalG;
            $graphScienceAdvance .= "'Reporte IDAEPY'!\$U$".$totalG;
        }else{
            $graphScienceInicial .= "'Reporte IDAEPY'!\$R$".$totalG.",";
            $graphScienceBasic .= "'Reporte IDAEPY'!\$S$".$totalG.",";
            $graphScienceMedium .= "'Reporte IDAEPY'!\$T$".$totalG.",";
            $graphScienceAdvance .= "'Reporte IDAEPY'!\$U$".$totalG.",";
        }
        $countG = $countG + 1;
    }
}

$xAxisTickValues = array(
    new PHPExcel_Chart_DataSeriesValues('String',
            $graphTicks, NULL, 4),  //  Q1 to Q4
);

//  Set the Data values for each data series we want to plot
if($year == '2016'){
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceAdvance, NULL, 4),
    );
}else{
    $dataSeriesValues = array(
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceInicial, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceBasic, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceMedium, NULL, 4),
        new PHPExcel_Chart_DataSeriesValues('Number',
                $graphScienceAdvance, NULL, 4),
    );
}

//  Build the dataseries
$series = new PHPExcel_Chart_DataSeries(
    PHPExcel_Chart_DataSeries::TYPE_BARCHART,       // plotType
    PHPExcel_Chart_DataSeries::GROUPING_STANDARD,   // plotGrouping
    range(0, count($dataSeriesValues)-1),           // plotOrder
    $dataSeriesLabels,                              // plotLabel
    $xAxisTickValues,                               // plotCategory
    $dataSeriesValues                               // plotValues
);
//  Set additional dataseries parameters
//      Make it a vertical column rather than a horizontal bar graph
$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);

//  Set the series in the plot area
$plotArea = new PHPExcel_Chart_PlotArea($layout, array($series));
//  Set the chart legend
$legend = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_BOTTOM, NULL, false);

$title = new PHPExcel_Chart_Title('Ciencias Naturales');

//  Create the chart
$chart = new PHPExcel_Chart(
    'chart3',       // name
    $title,         // title
    $legend,        // legend
    $plotArea,      // plotArea
    true,           // plotVisibleOnly
    0,              // displayBlanksAs
    NULL,           // xAxisLabel
    $yAxisLabel     // yAxisLabel
);

//  Set the position where the chart should appear in the worksheet
$chart->setTopLeftPosition('L'.($count + 2), 25);
$chart->setBottomRightPosition('Q'.($count + 15), 75, 50);

//  Add the chart to the worksheet
$objPHPExcel->getActiveSheet()->addChart($chart);

$achievementDescriptionController = new AchievementDescriptionController();
$whereA = 'year = :year';
$whereAFields = array('year' => $year);
$achievementDescriptionList = $achievementDescriptionController->displayByAction($whereA, $whereAFields);

$achievementLevels = array();
foreach($achievementDescriptionList as $achievementDescription){
    $achievementSubject = $achievementDescription->getSubject();
    $achievementGrade = $achievementDescription->getGrade();
    $achievementLevel = $achievementDescription->getAchievement();
    $achievementLevels[$achievementSubject][$achievementGrade][$achievementLevel] = $achievementDescription->getDescription();
}

// Agregar hoja para niveles de logro en Matemáticas
$myWorkSheet1 = new PHPExcel_Worksheet($objPHPExcel, 'Matemáticas');
$objPHPExcel->addSheet($myWorkSheet1, 1);
// Agregar hoja para niveles de logro en Español
$myWorkSheet2 = new PHPExcel_Worksheet($objPHPExcel, 'Español');
$objPHPExcel->addSheet($myWorkSheet2, 2);
// Agregar hoja para niveles de logro en Ciencias Naturales
$myWorkSheet3 = new PHPExcel_Worksheet($objPHPExcel, 'Ciencias Naturales');
$objPHPExcel->addSheet($myWorkSheet3, 3);

// Agregar grado Matematicas
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A3:A12');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A3','3°');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A13:A22');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A13','4°');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A23:A34');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A23','5°');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A35:A49');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A35','6°');
// Agregar niveles de logro por materia
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('A1:X1');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('A1','Matemáticas');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B2:I2');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B2','Básico');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B3:I12');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B3',$achievementLevels[1][3][1]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B13:I22');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B13',$achievementLevels[1][4][1]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B23:I34');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B23',$achievementLevels[1][5][1]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('B35:I49');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('B35',$achievementLevels[1][6][1]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('J2:Q2');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J2','Medio');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('J3:Q12');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J3',$achievementLevels[1][3][2]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('J13:Q22');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J13',$achievementLevels[1][4][2]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('J23:Q34');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J23',$achievementLevels[1][5][2]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('J35:Q49');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('J35',$achievementLevels[1][6][2]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R2:X2');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R2','Avanzado');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R3:X12');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R3',$achievementLevels[1][3][3]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R13:X22');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R13',$achievementLevels[1][4][3]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R23:X34');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R23',$achievementLevels[1][5][3]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells('R35:X49');
$objPHPExcel->setActiveSheetIndex(1)->setCellValue('R35',$achievementLevels[1][6][3]);

// Agregar grado Español
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A3:A11');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A3','3°');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A12:A21');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A12','4°');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A22:A30');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A22','5°');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A31:A43');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A31','6°');
// Agregar niveles de logro por materia
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('A1:X1');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('A1','Español');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('B2:H2');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B2','Básico');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('B3:H11');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B3',$achievementLevels[2][3][1]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('B12:H21');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B12',$achievementLevels[2][4][1]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('B22:H30');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B22',$achievementLevels[2][5][1]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('B31:H43');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('B31',$achievementLevels[2][6][1]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('I2:P2');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I2','Medio');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('I3:P11');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I3',$achievementLevels[2][3][2]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('I12:P21');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I12',$achievementLevels[2][4][2]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('I22:P30');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I22',$achievementLevels[2][5][2]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('I31:P43');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('I31',$achievementLevels[2][6][2]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('Q2:X2');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q2','Avanzado');
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('Q3:X11');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q3',$achievementLevels[2][3][3]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('Q12:X21');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q12',$achievementLevels[2][4][3]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('Q22:X30');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q22',$achievementLevels[2][5][3]);
$objPHPExcel->setActiveSheetIndex(2)->mergeCells('Q31:X43');
$objPHPExcel->setActiveSheetIndex(2)->setCellValue('Q31',$achievementLevels[2][6][3]);

// Agregar grado Ciencias Naturales
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('A3:A10');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A3','3°');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('A11:A20');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A11','4°');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('A21:A29');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A21','5°');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('A30:A37');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A30','6°');
// Agregar niveles de logro por materia
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('A1:X1');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('A1','Ciencias Naturales');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('B2:I2');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B2','Básico');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('B3:I10');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B3',$achievementLevels[3][3][1]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('B11:I20');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B11',$achievementLevels[3][4][1]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('B21:I29');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B21',$achievementLevels[3][5][1]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('B30:I37');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('B30',$achievementLevels[3][6][1]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('J2:Q2');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J2','Medio');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('J3:Q10');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J3',$achievementLevels[3][3][2]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('J11:Q20');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J11',$achievementLevels[3][4][2]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('J21:Q29');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J21',$achievementLevels[3][5][2]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('J30:Q37');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('J30',$achievementLevels[3][6][2]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('R2:X2');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R2','Avanzado');
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('R3:X10');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R3',$achievementLevels[3][3][3]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('R11:X20');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R11',$achievementLevels[3][4][3]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('R21:X29');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R21',$achievementLevels[3][5][3]);
$objPHPExcel->setActiveSheetIndex(3)->mergeCells('R30:X37');
$objPHPExcel->setActiveSheetIndex(3)->setCellValue('R30',$achievementLevels[3][6][3]);

//$objWorkSheet = $objPHPExcel->createSheet("Resultadoss");

/*$objWorksheet->fromArray(
    array(
        array('', 3, 4, 5, 6),
        array('Básico', $percentageGradeAchievement['math'][3][1], $percentageGradeAchievement['math'][4][1],
            $percentageGradeAchievement['math'][5][1], $percentageGradeAchievement['math'][6][1]),
        array('Medio', $percentageGradeAchievement['math'][3][2], $percentageGradeAchievement['math'][4][2],
            $percentageGradeAchievement['math'][6][2], $percentageGradeAchievement['math'][6][2]),
        array('Avanzado', $percentageGradeAchievement['math'][3][3], $percentageGradeAchievement['math'][4][3],
            $percentageGradeAchievement['math'][5][3], $percentageGradeAchievement['math'][4][6]),
    )
);*/


/*$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','3');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','4');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','4');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','5');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','5');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','6');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','6');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C9','Escuela');*/

// Formato del titulo principal
$titleStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>18,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_NONE
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato de los encabezados
$headerStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

// Formato del encabezado de matematicas
$mathStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FEA520')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado de español
$spanishStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => '30AB9E')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado de ciencias
$scienceStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'F55532')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado del nivel de logro inicial
$inicialStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'B07E4B')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado del nivel de logro basico
$basicStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'B21270')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado del nivel de logro medio
$mediumStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'F77C16')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato del encabezado del nivel de logro avanzado
$advancedStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => '1C9953')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => 'F77C16')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato de los datos del estado, modalidad, region y zona
$achievementHeaderStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => 'FFFFFF'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => '31869B')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato de los datos de la escuela
$schoolDataStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => false,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
// Formato de los totales de la escuela
$schoolGroupTotalStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => true,
        'italic'    => false,
        'strike'    => false,
        'size' =>12,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'C0C0C0')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);
$schoolDataIdaepyStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => false,
        'italic'    => false,
        'strike'    => false,
        'size' =>11,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

$achievementGradeStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => false,
        'italic'    => false,
        'strike'    => false,
        'size' =>14,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

$achievementLevelStyle = array(
    'font' => array(
        'name'      => 'Calibri',
        'bold'      => false,
        'italic'    => false,
        'strike'    => false,
        'size' =>11,
        'color'     => array(
            'rgb' => '000000'
        )
    ),
    'fill' => array(
      'type'  => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array(
            'rgb' => 'FFFFFF')
  ),
    'borders' => array(
        'allborders' => array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array(
                'rgb' => '000000')
        )
    ),
    'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_JUSTIFY,
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
        'rotation' => 0,
        'wrap' => TRUE
    )
);

// Asignar estilos a la hoja 1
if($year == 2016){
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getStyle('A2:R5')->applyFromArray($titleStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A6:R8')->applyFromArray($headerStyle);
    $objPHPExcel->getActiveSheet()->getStyle('J7:L7')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('M7:O7')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('P7:R7')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('R8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A9:R12')->applyFromArray($achievementHeaderStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A13:D'.$count)->applyFromArray($schoolDataIdaepyStyle);
    $objPHPExcel->getActiveSheet()->getStyle('E13:R'.$count)->applyFromArray($schoolDataIdaepyStyle);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$count.':R'.$count)->applyFromArray($schoolGroupTotalStyle);
    $objPHPExcel->getActiveSheet()->getStyle('F9:R'.$count)->getNumberFormat()->setFormatCode('#,##0.0');

    // Niveles de Logro Matematicas
    $objPHPExcel->setActiveSheetIndex(1);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A49')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X49')->applyFromArray($achievementLevelStyle);
    // Niveles de Logro Español
    $objPHPExcel->setActiveSheetIndex(2);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A43')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X43')->applyFromArray($achievementLevelStyle);
    // Niveles de Logro Ciencias
    $objPHPExcel->setActiveSheetIndex(3);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A35')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X35')->applyFromArray($achievementLevelStyle);
}else {
    $objPHPExcel->setActiveSheetIndex(0);
    $objPHPExcel->getActiveSheet()->getStyle('A2:U5')->applyFromArray($titleStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A6:U8')->applyFromArray($headerStyle);
    $objPHPExcel->getActiveSheet()->getStyle('J7:M7')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('N7:Q7')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('R7:U7')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('G8')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('H8')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I8')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('J8')->applyFromArray($inicialStyle);
    $objPHPExcel->getActiveSheet()->getStyle('K8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('L8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('M8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('N8')->applyFromArray($inicialStyle);
    $objPHPExcel->getActiveSheet()->getStyle('O8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('P8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('R8')->applyFromArray($inicialStyle);
    $objPHPExcel->getActiveSheet()->getStyle('S8')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('T8')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('U8')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A9:U12')->applyFromArray($achievementHeaderStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A13:D'.$count)->applyFromArray($schoolDataIdaepyStyle);
    $objPHPExcel->getActiveSheet()->getStyle('E13:U'.$count)->applyFromArray($schoolDataIdaepyStyle);
    $objPHPExcel->getActiveSheet()->getStyle('C'.$count.':U'.$count)->applyFromArray($schoolGroupTotalStyle);
    $objPHPExcel->getActiveSheet()->getStyle('F9:U'.$count)->getNumberFormat()->setFormatCode('#,##0.0');

    // Niveles de Logro Matematicas
    $objPHPExcel->setActiveSheetIndex(1);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($mathStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A49')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X49')->applyFromArray($achievementLevelStyle);
    // Niveles de Logro Español
    $objPHPExcel->setActiveSheetIndex(2);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($spanishStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A43')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X43')->applyFromArray($achievementLevelStyle);
    // Niveles de Logro Ciencias
    $objPHPExcel->setActiveSheetIndex(3);
    $objPHPExcel->getActiveSheet()->getStyle('A1:X1')->applyFromArray($scienceStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A2:H2')->applyFromArray($basicStyle);
    $objPHPExcel->getActiveSheet()->getStyle('I2:P2')->applyFromArray($mediumStyle);
    $objPHPExcel->getActiveSheet()->getStyle('Q2:X2')->applyFromArray($advancedStyle);
    $objPHPExcel->getActiveSheet()->getStyle('A3:A37')->applyFromArray($achievementGradeStyle);
    $objPHPExcel->getActiveSheet()->getStyle('B3:X37')->applyFromArray($achievementLevelStyle);
}

// Cambiar ancho de columnas
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
for($i = 'J'; $i <= 'U'; $i++){
    $objPHPExcel->getActiveSheet()->getColumnDimension($i)->setWidth(12);
}
//$objPHPExcel->getActiveSheet()->setSharedStyle($headerStyle, "A2:D4");

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Reporte IDAEPY');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$region = $school->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName();
$zone = $school->getSchoolRegionZoneObject()->getZone();
//$docName = "IDAEPY " . $year . " " . $school->getCct() . " Región " . $region . " Zona " . str_pad($zone, 3, "0", STR_PAD_LEFT);
$docName = "IDAEPY " . $year . " " . $school->getCct();

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $docName . '.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->setIncludeCharts(TRUE);
ob_end_clean();
ob_start();
$objWriter->save('php://output');
exit;
