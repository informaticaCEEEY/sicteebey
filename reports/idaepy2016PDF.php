<?php

$year = $_POST['year'];

$schoolController = new SchoolController();
$school = $schoolController->getEntityByAction('cct', $_POST['cct']);

$achievementController = new AchievementController();
$where = 'e.id > 1 and e.id <= 4';
$whereFields = '';
$achievementList = $achievementController->displayByAction($where, $whereFields);

// Evaluados
$idaepyAchievementController = new IdaepyAchievementController();
$join = 'INNER JOIN idaepy_students ida on ida.student = e.student';
$where = 'ida.cct = :cct AND e.year = :year and ida.year = :year';
$whereFields = array('cct' => $_POST['cct'], 'year' => $year);
$showFields = 'e.student, ida.cct, ida.grade, ida.school_group, e.percentage_math, e.percentage_science, e.percentage_spanish,
               e.achievement_math, e.achievement_science, e.achievement_spanish';
$idaepyAchievementList = $idaepyAchievementController->displayBy2Action($where, $whereFields, $join, $showFields);

// Programados
$idaepyStudentsController = new IdaepyStudentsController();
$where = 'e.cct = :cct AND e.year = :year';
$whereFields = array('cct' => $_POST['cct'], 'year' => $year);
$idaepyStudentsList = $idaepyStudentsController->displayBy2Action($where, $whereFields);

$totalGradeEva = array_count_values(array_column($idaepyAchievementList, 'grade'));
$totalGradeProg = array_count_values(array_column($idaepyStudentsList, 'grade'));
$idaepyGrade = array(3 => 'Tercer Grado', 4 => 'Cuarto Grado', 5 => 'Quinto Grado', 6 => 'Sexto Grado');

$achievementDescriptionController = new AchievementDescriptionController();
$whereA = 'year = :year';
$whereAFields = array('year' => $year);
$achievementDescriptionList = $achievementDescriptionController->displayByAction($whereA, $whereAFields);

$schoolZoneHistorialController = new SchoolZoneHistorialController();
$where = "cct = :cct AND year = :year";
$whereFields = array('cct' =>$school[0]->getCct(), 'year' => $year);
$schoolZoneHistorialList = $schoolZoneHistorialController->displayByAction($where, $whereFields);

foreach($idaepyGrade as $keyGrade => $grade){
    if (!array_key_exists($keyGrade, $totalGradeProg)) {
        $totalGradeProg[$keyGrade] = 0;
    }

    if (!array_key_exists($keyGrade, $totalGradeEva)) {
        $totalGradeEva[$keyGrade] = 0;
    }
}

$idaepyAchievementResult = array();
$idaepyAchievementAchievement = array();
$idaepyAchievementTotalGroup = array();

foreach($idaepyAchievementList as $idaepyAchievement){
    $classRoom = $idaepyAchievement['grade'].$idaepyAchievement['school_group'];
    //$idaepyAchievementTotalGroup[$idaepyAchievement['grade']][] = $idaepyAchievement['school_group'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['math'][] = $idaepyAchievement['percentage_math'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['science'][] = $idaepyAchievement['percentage_science'];
    $idaepyHitsResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['spanish'][] = $idaepyAchievement['percentage_spanish'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['math'][] = $idaepyAchievement['achievement_math'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['science'][] = $idaepyAchievement['achievement_science'];
    $idaepyAchievementResult[$idaepyAchievement['grade']][$idaepyAchievement['school_group']]['spanish'][] = $idaepyAchievement['achievement_spanish'];
}

foreach($idaepyHitsResult as $key => $idaepyHitsResultEntry){
    $idaepyAchievementTotalGroup[$key] = array_keys($idaepyHitsResultEntry);
}

$schoolName = $school[0]->getName();
$cct = $school[0]->getCct();
$schoolSchedule = strtoupper(utf8_decode($school[0]->getSchoolScheduleObject()->getName()));
$schoolMode = strtoupper(utf8_decode($schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getSchoolModeObject()->getName()));
$schoolRegion = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName();
$schoolZone = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getZone();
$schoolSector = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getSector();

$dirFolder = "../Carteles IDAEPY 2016/";
$modeFolder = "Modalidad " . ucfirst(strtolower($schoolMode)) . "/";
$sectorFolder = "Sector " . str_pad($schoolSector, 2, "0", STR_PAD_LEFT) . "/";
$zoneFolder = "Primaria " . ucfirst(strtolower($schoolMode)) . " Zona " . str_pad($schoolZone, 3, "0", STR_PAD_LEFT) . "/";
$docName =  $cct . " Región " . $schoolRegion . " Zona " . str_pad($schoolZone, 3, "0", STR_PAD_LEFT) . ".pdf";
$folderName = $dirFolder . utf8_decode(html_entity_decode($modeFolder)) . $sectorFolder .
    utf8_decode(html_entity_decode($zoneFolder)) . utf8_decode(html_entity_decode($docName));

$htmlTable='
<table border="0">
    <tr>
        <td align="left" width="200">Escuela:<b>'.$school[0]->getName().'</b></td>
        <td width="600">CCT: '.$school[0]->getCct().'</td>
        <td width="600">Turno: </td>
        <td width="600">Modalidad: </td>
        <td width="600">Zona: </td>
    </tr>
</table>';

//$html = "<div class='text-center idaepyTitle'><p align='center' class='form-signin-heading'>Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY 2016)</p></div>";
$title = "Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY 2016)";
$title = utf8_decode($title);

foreach($idaepyAchievementTotalGroup as $idaepyGroup){
    $totalGroup = count($idaepyGroup);
    $totalMaxGroup = max($totalMaxGroup, $totalGroup);
}

$pdf = new PDF_MC_Table('L','mm',array(835,674));
$pdf->AddFont('OpenSans','','OpenSans-Regular.php');
$pdf->AddFont('OpenSans','B','OpenSans-Bold.php');
$pdf->AddPage();
$pdf->Image('../content/images/idaepy/fondo.jpg',0,0,835,674.5,'');
$pdf -> Image('../img/Logo_segey.png', 30, 10, 90);
$pdf->Ln(10);
$pdf->SetFont('OpenSans', 'B', '36');
$pdf->SetLeftMargin(200);
$pdf->SetRightMargin(200);
$pdf->SetTopMargin(10);
$pdf->MultiCell(0, 12, $title, 0, 'C');
$pdf->Ln();
$pdf->SetFont('OpenSans', '', '18');
//$pdf->Ln(15);
$pdf->SetLineWidth(1);
//$pdf->MultiCell(0, 12, 'Datos Generales', 0, 'C');
$pdf->SetLeftMargin(30);
$pdf->SetRightMargin(10);
$pdf->Ln();
$pdf->Ln(5);
//$pdf->SetFont('OpenSans','',22);

$sizeLetterTitles = 24;
//$pdf->SetWidths(array(42, 300, 24, 100, 32, 75, 52, 60));
$pdf->SetWidths(array(40, 300, 20, 120, 35, 120, 55, 120));
$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
        array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles)));
//$pdf->setBorders(array('LTRB','LTRB','LTRB','LTRB','LTRB','LTRB','LTRB','LTRB'));
$pdf->Row(array('ESCUELA:', $schoolName, 'CCT:', $cct, 'TURNO:', $schoolSchedule, 'MODALIDAD:', $schoolMode));
$pdf->Ln(10);

$schoolTown = strtoupper(utf8_decode($school[0]->getTownObject()->getName()));
$schoolLocality = strtoupper(utf8_decode($school[0]->getLocality()));
$schoolRegion = utf8_decode($schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getSchoolRegionObject()->getAlternativeName());
$schoolZone = $schoolZoneHistorialList[0]->getSchoolRegionZoneObject()->getZone();
$schoolMarginalization = strtoupper($school[0]->getSchoolMarginalizationObject()->getName());

$pdf->SetWidths(array(52, 120, 52, 125, 37, 100, 28, 90, 64, 115));
$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
        array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
        array('OpenSans','B',$sizeLetterTitles)));
$pdf->Row(array('MUNICIPIO:', $schoolTown, 'LOCALIDAD:', $schoolLocality, utf8_decode('REGIÓN:'), $schoolRegion, 'ZONA:',
        $schoolZone, utf8_decode('MARGINACIÓN:'), $schoolMarginalization));
$pdf->Ln(15);

// Logro Educativo por grupos
$pdf->SetWidths(array(120, 60, 100, 48, 85, 120, 60, 100, 48, 100));
$pdf->setFonts(array(array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
        array('OpenSans','B',$sizeLetterTitles)));
$pdf->Row(array('Tercer Grado', 'Programados:', $totalGradeProg['3'], 'Evaluados:', $totalGradeEva['3'], 'Cuarto Grado',
        'Programados:', $totalGradeProg['4'], 'Evaluados:', $totalGradeEva['4']));

$pdf->Ln(5);
$actualPosition = $pdf->GetY();
$actualPosition2 = $pdf->GetY();
$sizeNumGroup = 0;

// Tercer Grado
$pdf->SetFont('OpenSans', 'B', '20');
$heightOneGroup = 16;
$heightTwoGroup = $heightOneGroup * 2;

$pdf->SetDrawColor(247, 124, 22);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->CellX(60,$heightTwoGroup, "Reactivos\n Evaluados",1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->CellX(65,$heightTwoGroup, "Porcentaje de\n aciertos",1,0,'C');
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(150,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition = $actualPosition + $heightOneGroup;
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(50,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(50,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(50,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[3]) && $totalGradeProg[3] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[3]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup3 = $actualPosition + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'14','B',0,'C');
    // Español
    $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'14','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->CellX(60,$heightGroup, "Ciencias\n Naturales",'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    foreach($idaepyAchievementTotalGroup[3] as $idaepyGroup){

        $percentageMathHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['math'])/count($idaepyHitsResult[3][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['science'])/count($idaepyHitsResult[3][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['spanish'])/count($idaepyHitsResult[3][$idaepyGroup]['spanish']);

        $mathAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['spanish']);

        $totalMathAchievement =  $mathAchievementList[4] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[4] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[4] + $spanishAchievementList[2] + $spanishAchievementList[3];

        if($countGroup == $numGroup){
            $border = 'B';
        }else{
            $border = '0';
        }

        if($idaepyGroup == 'A'){
            $heightPositionGroup3 = $actualPosition + $heightOneGroup;
        }elseif($idaepyGroup == 'B'){
            $heightPositionGroup3 = $actualPosition + ($heightOneGroup*2);
        }elseif($idaepyGroup == 'C'){
            $heightPositionGroup3 = $actualPosition + ($heightOneGroup*3);
        }elseif($idaepyGroup == 'D'){
            $heightPositionGroup3 = $actualPosition + ($heightOneGroup*4);
        }

        // Porcentaje de Aciertos
        // Matematicas
        $pdf->SetXY(150, $heightPositionGroup3);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup3);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
        $pdf->SetXY(150, $heightPositionGroup3);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup3);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
        $pdf->SetXY(150, $heightPositionGroup3);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup3);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup3 = 190 + $heightOneGroup;
        $sizeNumAchievement = 240;
        foreach($achievementList as $achievementSubjectLevel){

            if($idaepyGroup == 'A'){
                $heightPositionGroup3 = $actualPosition + $heightOneGroup;
            }elseif($idaepyGroup == 'B'){
                $heightPositionGroup3 = $actualPosition + ($heightOneGroup*2);
            }elseif($idaepyGroup == 'C'){
                $heightPositionGroup3 = $actualPosition + ($heightOneGroup*3);
            }elseif($idaepyGroup == 'D'){
                $heightPositionGroup3 = $actualPosition + ($heightOneGroup*4);
            }

            $keyLevel = $achievementSubjectLevel->getId();
            $percentageMathAchievement[$keyLevel] = number_format($mathAchievementList[$keyLevel]/$totalMathAchievement*100,1);
            $percentageSpanishAchievement[$keyLevel] = number_format($spanishAchievementList[$keyLevel]/$totalSpanishAchievement*100,1);
            $percentageScienceAchievement[$keyLevel] = number_format($scienceAchievementList[$keyLevel]/$totalScienceAchievement*100,1);

            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup3);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup3);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup3);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');

            $sizeNumAchievement = $sizeNumAchievement + 50;

        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }

}

// Cuarto Grado
$pdf->SetFont('OpenSans', 'B', '20');
$pdf->SetDrawColor(247, 124, 22);
$pdf->SetXY(440, $actualPosition2);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->CellX(60,$heightTwoGroup, "Reactivos\n Evaluados",1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->CellX(65,$heightTwoGroup, "Porcentaje de\n aciertos",1,0,'C');
$pdf->SetXY(650, $actualPosition2);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(150,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition2 = $actualPosition2 + $heightOneGroup;
$pdf->SetXY(650, $actualPosition2);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(50,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(50,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(50,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[4]) && $totalGradeProg[4] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[4]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup = $actualPosition2 + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'17','B',0,'C');
    // Español
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'20','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->CellX(60,$heightGroup,"Ciencias\n Naturales",'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    foreach($idaepyAchievementTotalGroup[4] as $idaepyGroup){

        $percentageMathHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['math'])/count($idaepyHitsResult[4][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['science'])/count($idaepyHitsResult[4][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['spanish'])/count($idaepyHitsResult[4][$idaepyGroup]['spanish']);

        $mathAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['spanish']);

        $totalMathAchievement =  $mathAchievementList[4] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[4] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[4] + $spanishAchievementList[2] + $spanishAchievementList[3];

        if($countGroup == $numGroup){
            $border = 'B';
        }else{
            $border = '0';
        }

        if($idaepyGroup == 'A'){
            $heightPositionGroup = $actualPosition2 + $heightOneGroup;
        }elseif($idaepyGroup == 'B'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*2);
        }elseif($idaepyGroup == 'C'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*3);
        }elseif($idaepyGroup == 'D'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*4);
        }

        // Porcentaje de Aciertos
        // Matematicas
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup = 190 + $heightOneGroup;
        $sizeNumAchievement = 650;
        foreach($achievementList as $achievementSubjectLevel){

            if($idaepyGroup == 'A'){
                $heightPositionGroup = $actualPosition2 + $heightOneGroup;
            }elseif($idaepyGroup == 'B'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*2);
            }elseif($idaepyGroup == 'C'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*3);
            }elseif($idaepyGroup == 'D'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*4);
            }

            $keyLevel = $achievementSubjectLevel->getId();
            $percentageMathAchievement[$keyLevel] = number_format($mathAchievementList[$keyLevel]/$totalMathAchievement*100,1);
            $percentageSpanishAchievement[$keyLevel] = number_format($spanishAchievementList[$keyLevel]/$totalSpanishAchievement*100,1);
            $percentageScienceAchievement[$keyLevel] = number_format($scienceAchievementList[$keyLevel]/$totalScienceAchievement*100,1);

            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');

            $sizeNumAchievement = $sizeNumAchievement + 50;

        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }

}

$actualPosition = $pdf->GetY();
if($actualPosition >= $heightPositionGroup3){
    $pdf->SetY($actualPosition);
    $pdf->Ln();
}else{
    $pdf->SetY($heightPositionGroup3);
    $pdf->Ln();
}

$pdf->Ln(25);
$pdf->SetWidths(array(120, 60, 100, 48, 85, 120, 60, 100, 48, 100));
$pdf->setFonts(array(array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles),
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
        array('OpenSans','B',$sizeLetterTitles)));
$pdf->Row(array('Quinto Grado', 'Inscritos:', $totalGradeProg['5'], 'Evaluados:', $totalGradeEva['5'], 'Sexto Grado',
        'Inscritos:', $totalGradeProg['6'], 'Evaluados:', $totalGradeEva['6']));

$pdf->Ln(15);
$actualPosition = $pdf->GetY();
$actualPosition2 = $pdf->GetY();

// Quinto Grado
$pdf->SetFont('OpenSans', 'B', '20');
$pdf->SetDrawColor(247, 124, 22);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->CellX(60,$heightTwoGroup, "Reactivos\n Evaluados",1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->CellX(65,$heightTwoGroup, "Porcentaje de\n aciertos",1,0,'C');
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(150,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition = $actualPosition + $heightOneGroup;
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(50,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(50,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(50,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[5]) && $totalGradeProg[5] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[5]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup5 = $actualPosition + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);

    // Matematicas
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'20','B',0,'C');
    // Español
    $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'16','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->CellX(60,$heightGroup,"Ciencias\n Naturales",'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;

    foreach($idaepyAchievementTotalGroup[5] as $idaepyGroup){

        $percentageMathHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['math'])/count($idaepyHitsResult[5][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['science'])/count($idaepyHitsResult[5][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['spanish'])/count($idaepyHitsResult[5][$idaepyGroup]['spanish']);

        $mathAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['spanish']);

        $totalMathAchievement =  $mathAchievementList[4] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[4] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[4] + $spanishAchievementList[2] + $spanishAchievementList[3];

        if($countGroup == $numGroup){
            $border = 'B';
        }else{
            $border = '0';
        }

        if($idaepyGroup == 'A'){
            $heightPositionGroup5 = $actualPosition + $heightOneGroup;
        }elseif($idaepyGroup == 'B'){
            $heightPositionGroup5 = $actualPosition + ($heightOneGroup*2);
        }elseif($idaepyGroup == 'C'){
            $heightPositionGroup5 = $actualPosition + ($heightOneGroup*3);
        }elseif($idaepyGroup == 'D'){
            $heightPositionGroup5 = $actualPosition + ($heightOneGroup*4);
        }

        // Porcentaje de Aciertos
        // Matematicas
        $pdf->SetXY(150, $heightPositionGroup5);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup5);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
        $pdf->SetXY(150, $heightPositionGroup5);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup5);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
        $pdf->SetXY(150, $heightPositionGroup5);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(175, $heightPositionGroup5);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup5 = 190 + $heightPositionGroup5;
        $sizeNumAchievement = 240;
        foreach($achievementList as $achievementSubjectLevel){

            if($idaepyGroup == 'A'){
                $heightPositionGroup5 = $actualPosition + $heightOneGroup;
            }elseif($idaepyGroup == 'B'){
                $heightPositionGroup5 = $actualPosition + ($heightOneGroup*2);
            }elseif($idaepyGroup == 'C'){
                $heightPositionGroup5 = $actualPosition + ($heightOneGroup*3);
            }elseif($idaepyGroup == 'D'){
                $heightPositionGroup5 = $actualPosition + ($heightOneGroup*4);
            }

            $keyLevel = $achievementSubjectLevel->getId();
            $percentageMathAchievement[$keyLevel] = number_format($mathAchievementList[$keyLevel]/$totalMathAchievement*100,1);
            $percentageSpanishAchievement[$keyLevel] = number_format($spanishAchievementList[$keyLevel]/$totalSpanishAchievement*100,1);
            $percentageScienceAchievement[$keyLevel] = number_format($scienceAchievementList[$keyLevel]/$totalScienceAchievement*100,1);

            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup5);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup5);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup5);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');

            $sizeNumAchievement = $sizeNumAchievement + 50;

        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }
}

// Sexto Grado
$pdf->SetFont('OpenSans', 'B', '20');
$pdf->SetDrawColor(247, 124, 22);
$pdf->SetXY(440, $actualPosition2);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->CellX(60,$heightTwoGroup, "Reactivos\n Evaluados",1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->CellX(65,$heightTwoGroup, "Porcentaje de\n aciertos",1,0,'C');
$pdf->SetXY(650, $actualPosition2);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(150,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition2 = $actualPosition2 + $heightOneGroup;
$pdf->SetXY(650, $actualPosition2);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(50,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(50,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(50,$heightOneGroup, 'Avanzado',1,0,'C',1);
if(isset($totalGradeProg[6]) && $totalGradeProg[6] != 0){

    $numGroup = count($idaepyAchievementTotalGroup[6]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup = $actualPosition2 + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'21','B',0,'C');
    // Español
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'19','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(440, $heightPositionGroup);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '22');
    $pdf->CellX(60,$heightGroup,"Ciencias\n Naturales",'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '20');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    foreach($idaepyAchievementTotalGroup[6] as $idaepyGroup){

        $percentageMathHits =  array_sum($idaepyHitsResult[6][$idaepyGroup]['math'])/count($idaepyHitsResult[6][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[6][$idaepyGroup]['science'])/count($idaepyHitsResult[6][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[6][$idaepyGroup]['spanish'])/count($idaepyHitsResult[6][$idaepyGroup]['spanish']);

        $mathAchievementList =  array_count_values($idaepyAchievementResult[6][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[6][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[6][$idaepyGroup]['spanish']);

        $totalMathAchievement =  $mathAchievementList[1] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[1] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[1] + $spanishAchievementList[2] + $spanishAchievementList[3];

        if($countGroup == $numGroup){
            $border = 'B';
        }else{
            $border = '0';
        }

        if($idaepyGroup == 'A'){
            $heightPositionGroup = $actualPosition2 + $heightOneGroup;
        }elseif($idaepyGroup == 'B'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*2);
        }elseif($idaepyGroup == 'C'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*3);
        }elseif($idaepyGroup == 'D'){
            $heightPositionGroup = $actualPosition2 + ($heightOneGroup*4);
        }

        // Porcentaje de Aciertos
        // Matematicas
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(560, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(585, $heightPositionGroup);
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup = 190 + $heightOneGroup;
        $sizeNumAchievement = 650;
        foreach($achievementList as $achievementSubjectLevel){

            if($idaepyGroup == 'A'){
                $heightPositionGroup = $actualPosition2 + $heightOneGroup;
            }elseif($idaepyGroup == 'B'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*2);
            }elseif($idaepyGroup == 'C'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*3);
            }elseif($idaepyGroup == 'D'){
                $heightPositionGroup = $actualPosition2 + ($heightOneGroup*4);
            }

            $keyLevel = $achievementSubjectLevel->getId();
            $percentageMathAchievement[$keyLevel] = number_format($mathAchievementList[$keyLevel]/$totalMathAchievement*100,1);
            $percentageSpanishAchievement[$keyLevel] = number_format($spanishAchievementList[$keyLevel]/$totalSpanishAchievement*100,1);
            $percentageScienceAchievement[$keyLevel] = number_format($scienceAchievementList[$keyLevel]/$totalScienceAchievement*100,1);

            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);
            $pdf->Cell(50,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');

            $sizeNumAchievement = $sizeNumAchievement + 50;

        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }
}

$actualPosition = $pdf->GetY();

if($actualPosition >= $heightPositionGroup5){
    $pdf->SetY($actualPosition + 15);
    $pdf->Ln();
}else{
    $pdf->SetY($heightPositionGroup5 + 15);
    $pdf->Ln();
}

$levelAchievement = $pdf->GetY();

$achievementLevels = array();
foreach($achievementDescriptionList as $achievementDescription){
    $achievementSubject = $achievementDescription->getSubject();
    $achievementGrade = $achievementDescription->getGrade();
    $achievementLevel = $achievementDescription->getAchievement();
    $achievementLevels[$achievementSubject][$achievementGrade][$achievementLevel] = $achievementDescription->getDescription();
}

$pdf->AddPage();
$pdf->Image('../content/images/idaepy/fondo.jpg',0,0,835,674,'');
$pdf -> Image('../img/Logo_segey.png', 30, 10, 90);
$pdf->Ln(50);
$levelAchievement = $pdf->GetY();
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->SetXY(10, $levelAchievement+80);
$pdf->Cell(20,15,utf8_decode('3°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+210);
$pdf->Cell(20,15,utf8_decode('4°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+320);
$pdf->Cell(20,15,utf8_decode('5°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+460);
$pdf->Cell(20,15,utf8_decode('6°'),'',0,'C');

//Matematicas
$pdf->SetLineWidth(0.2);
$pdf->SetXY(30, $levelAchievement);
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetFillColor(254, 165, 32);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->Cell(780,18,utf8_decode('Niveles de Logro: MATEMÁTICAS'),'',0,'C',1);
$pdf->Ln();
$pdf->SetX(30);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(240,15, 'Basico',0,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(300,15, 'Medio',0,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(240,15, 'Avanzado','',0,'C',1);
$pdf->Ln();
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);


$pdf->SetWidths(array(240, 300, 240));
//$pdf->setBorders(array('LRB', 'B', 'LRB', 'LRB', 'B', 'LRB', 'LRB', 'B', 'LRB'));
$sizeLetterTitles = 20;
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(247, 125, 23);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('OpenSans', '', '24');

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[1][3][1]), utf8_decode($achievementLevels[1][3][2]),
    utf8_decode($achievementLevels[1][3][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[1][4][1]), utf8_decode($achievementLevels[1][4][2]),
    utf8_decode($achievementLevels[1][4][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[1][5][1]), utf8_decode($achievementLevels[1][5][2]),
    utf8_decode($achievementLevels[1][5][3])));


$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[1][6][1]), utf8_decode($achievementLevels[1][6][2]),
    utf8_decode($achievementLevels[1][6][3])));

$pdf->AddPage();
$pdf->Image('../content/images/idaepy/fondo.jpg',0,0,835,674,'');
$pdf -> Image('../img/Logo_segey.png', 30, 10, 90);
$pdf->Ln(50);
$levelAchievement = $pdf->GetY();
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->SetXY(10, $levelAchievement+75);
$pdf->Cell(20,15,utf8_decode('3°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+180);
$pdf->Cell(20,15,utf8_decode('4°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+275);
$pdf->Cell(20,15,utf8_decode('5°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+400);
$pdf->Cell(20,15,utf8_decode('6°'),'',0,'C');

// Español
$pdf->SetXY(30, $levelAchievement);
$pdf->SetFillColor(48, 171, 158);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->Cell(780,18,utf8_decode('Niveles de Logro: ESPAÑOL'),'',0,'C',1);
$pdf->Ln();
$pdf->SetX(30);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(220,15, 'Basico','',0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(280,15, 'Medio',0,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(280,15, 'Avanzado','',0,'C',1);
$pdf->Ln();
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('OpenSans', '', '12');
//$pdf->Cell(78,10, utf8_decode($achievementLevels[1][3][1]),'R',2,'C',0);
//$pdf->SetLineWidth(0.2);
//$pdf->SetDrawColor(247, 125, 23);

$pdf->SetWidths(array(220, 280, 280));
//$pdf->setBorders(array('LRB', 'B', 'LRB', 'LRB', 'B', 'LRB', 'LRB', 'B', 'LRB'));
$sizeLetterTitles = 20;
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(247, 125, 23);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('OpenSans', '', '20');

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[2][3][1]), utf8_decode($achievementLevels[2][3][2]),
    utf8_decode($achievementLevels[2][3][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[2][4][1]), utf8_decode($achievementLevels[2][4][2]),
    utf8_decode($achievementLevels[2][4][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[2][5][1]), utf8_decode($achievementLevels[2][5][2]),
    utf8_decode($achievementLevels[2][5][3])));


$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[2][6][1]), utf8_decode($achievementLevels[2][6][2]),
    utf8_decode($achievementLevels[2][6][3])));

$pdf->AddPage();
$pdf->Image('../content/images/idaepy/fondo.jpg',0,0,835,674,'');
$pdf -> Image('../img/Logo_segey.png', 30, 10, 90);
$pdf->Ln(50);
$levelAchievement = $pdf->GetY();
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->SetXY(10, $levelAchievement+40);
$pdf->Cell(20,15,utf8_decode('3°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+100);
$pdf->Cell(20,15,utf8_decode('4°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+165);
$pdf->Cell(20,15,utf8_decode('5°'),'',0,'C');

$pdf->SetXY(10, $levelAchievement+245);
$pdf->Cell(20,15,utf8_decode('6°'),'',0,'C');

// Ciencias
$pdf->SetXY(30, $levelAchievement);
$pdf->SetFillColor(245, 85, 50);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('OpenSans', 'B', '28');
$pdf->Cell(780,15,'Niveles de Logro: CIENCIAS NATURALES','',0,'C',1);
$pdf->Ln();
$pdf->SetX(30);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(250,10, 'Basico','',0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(250,10, 'Medio',0,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(280,10, 'Avanzado',0,0,'C',1);
$pdf->Ln();
$pdf->SetDrawColor(0, 0, 0);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('OpenSans', '', '12');
//$pdf->Cell(78,10, utf8_decode($achievementLevels[1][3][1]),'R',2,'C',0);
//$pdf->SetLineWidth(0.2);
//$pdf->SetDrawColor(247, 125, 23);

$pdf->SetWidths(array(250, 250, 280));
//$pdf->setBorders(array('LRB', 'B', 'LRB', 'LRB', 'B', 'LRB', 'LRB', 'B', 'LRB'));
$sizeLetterTitles = 20;
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(247, 125, 23);
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('OpenSans', '', '20');

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[3][3][1]), utf8_decode($achievementLevels[3][3][2]),
    utf8_decode($achievementLevels[3][3][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[3][4][1]), utf8_decode($achievementLevels[3][4][2]),
    utf8_decode($achievementLevels[3][4][3])));

$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[3][5][1]), utf8_decode($achievementLevels[3][5][2]),
    utf8_decode($achievementLevels[3][5][3])));


$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles),
    array('OpenSans','',$sizeLetterTitles)));

$pdf->Row3(array(utf8_decode($achievementLevels[3][6][1]), utf8_decode($achievementLevels[3][6][2]),
    utf8_decode($achievementLevels[3][6][3])));

$pdf->Output('d', utf8_decode($docName));

?>
