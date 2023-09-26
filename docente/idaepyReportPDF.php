<?php

include ('../checkSession.php');
include ('../lib/fpdf/mc_table.php');


$schoolController = new SchoolController();
$school = $schoolController->getEntityAction($user->getSchool());

if(!$school){
    $_SESSION['message'] = 'La escuela no existe';
    header('location:index.php');
}

$achievementController = new AchievementController();
$achievementList = $achievementController->displayAction();
array_pop($achievementList);

$idaepyAchievementController = new IdaepyAchievementController();
$join = 'INNER JOIN idaepy_students ida on ida.student = e.student';
$where = 'ida.cct = :cct AND e.year = 2016 and ida.year = 2016';
$whereFields = array('cct' => $school->getCct());
$showFields = 'e.student, ida.cct, ida.grade, ida.school_group, e.percentage_math, e.percentage_science, e.percentage_spanish, 
               e.achievement_math, e.achievement_science, e.achievement_spanish';
$idaepyAchievementList = $idaepyAchievementController->displayBy2Action($where, $whereFields, $join, $showFields);

$idaepyStudentsController = new IdaepyStudentsController();
$where = 'e.cct = :cct AND e.year = 2016';
$whereFields = array('cct' => $school->getCct());
$idaepyStudentsList = $idaepyStudentsController->displayBy2Action($where, $whereFields);

$totalGradeEva = array_count_values(array_column($idaepyAchievementList, 'grade'));
$totalGradeProg = array_count_values(array_column($idaepyStudentsList, 'grade'));
$idaepyGrade = array(3 => 'Tercer Grado', 4 => 'Cuarto Grado', 5 => 'Quinto Grado', 6 => 'Sexto Grado');

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

$htmlTable='
<table border="0">
    <tr>
        <td align="left" width="200">Escuela:<b>'.$school->getName().'</b></td>
        <td width="600">CCT: '.$school->getCct().'</td>
        <td width="600">Turno: </td>
        <td width="600">Modalidad: </td>
        <td width="600">Zona: </td>
    </tr>
</table>';

//$html = "<div class='text-center idaepyTitle'><p align='center' class='form-signin-heading'>Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY 2016)</p></div>";
$title = "Instrumento para el Diagnóstico de Alumnos de Escuelas Primarias de Yucatán (IDAEPY 2016)";
$title = utf8_decode($title);

$pdf = new PDF_MC_Table('L','mm',array(755.1,583.5));
$pdf->AddFont('OpenSans','','OpenSans-Regular.php');
$pdf->AddFont('OpenSans','B','OpenSans-Bold.php');
$pdf->AddPage();
$pdf->Image('../content/images/idaepy/fondo.jpg',0,0,755.1,583.5,'');
$pdf -> Image('../img/segey80v.png', 30, 10, 80);
$pdf->SetFont('OpenSans', 'B', '32');
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
$pdf->Ln(1);
//$pdf->SetFont('OpenSans','',22);

$sizeLetterTitles = 18;
$heightOneGroup = 10;
$heightTwoGroup = $heightOneGroup * 2;
//$pdf->SetWidths(array(42, 300, 24, 100, 32, 75, 52, 60));
$pdf->SetWidths(array(31, 250, 16, 100, 26, 100, 42, 100));
$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), 
        array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles)));
//$pdf->setBorders(array('LTRB','LTRB','LTRB','LTRB','LTRB','LTRB','LTRB','LTRB'));
$schoolName = $school->getName();
$cct = $school->getCct();
$schoolSchedule = strtoupper(utf8_decode($school->getSchoolScheduleObject()->getName()));
$schoolMode = strtoupper(utf8_decode($school->getSchoolRegionZoneObject()->getSchoolModeObject()->getName()));
$pdf->Row(array('ESCUELA:', $schoolName, 'CCT:', $cct, 'TURNO:', $schoolSchedule, 'MODALIDAD:', $schoolMode));
$pdf->Ln(5);
//$pdf->SetWidths(array(46, 120, 50, 90, 35, 90, 26, 60, 60, 60));
$pdf->SetWidths(array(37, 102, 40, 102, 28, 88, 22, 104, 50, 100));
$pdf->setFonts(array(array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), 
        array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), 
        array('OpenSans','B',$sizeLetterTitles)));
        
//$schoolMarg = new SchoolMargController();        
$schoolTown = strtoupper(utf8_decode($school->getTownObject()->getName()));
$schoolLocality = strtoupper(utf8_decode($school->getLocality()));
$schoolRegion = strtoupper(utf8_decode($school->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName()));
$schoolZone = $school->getSchoolRegionZoneObject()->getZone();
$schoolMarginalization = strtoupper($school->getSchoolMarginalizationObject()->getName());
$pdf->Row(array('MUNICIPIO:', $schoolTown, 'LOCALIDAD:', $schoolLocality, utf8_decode('REGIÓN:'), $schoolRegion, 'ZONA:', 
        $schoolZone, utf8_decode('MARGINACIÓN:'), $schoolMarginalization));
$pdf->Ln();

// Logro Educativo por grupos
$pdf->SetWidths(array(110, 35, 80, 41, 90, 110, 35, 80, 41, 80));
$pdf->setFonts(array(array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), 
        array('OpenSans','B',$sizeLetterTitles)));       
$pdf->Row(array('Tercer Grado', 'Inscritos:', $totalGradeProg['3'], 'Evaluados:', $totalGradeEva['3'], 'Cuarto Grado', 
        'Inscritos:', $totalGradeProg['4'], 'Evaluados:', $totalGradeEva['4']));
                
$pdf->Ln(10);
$actualPosition = $pdf->GetY();
$actualPosition2 = $pdf->GetY();
$sizeNumGroup = 0;

// Tercer Grado
$pdf->SetFont('OpenSans', 'B', '16');
$pdf->SetDrawColor(247, 124, 22);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->Cell(60,$heightTwoGroup, 'Reactivos Evaluados',1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->Cell(65,$heightTwoGroup, 'Porcentaje de aciertos',1,0,'C');
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(120,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition = $actualPosition + $heightOneGroup;
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(40,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(40,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(40,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[3]) && $totalGradeProg[3] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[3]);    
    $heightGroup = $heightOneGroup * $numGroup;    
    $heightPositionGroup3 = $actualPosition + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'14','B',0,'C');
    // Español
    $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'14','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup3);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,'Ciencias Naturales','B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    foreach($idaepyAchievementTotalGroup[3] as $idaepyGroup){
            
        $percentageMathHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['math'])/count($idaepyHitsResult[3][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['science'])/count($idaepyHitsResult[3][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[3][$idaepyGroup]['spanish'])/count($idaepyHitsResult[3][$idaepyGroup]['spanish']);    
        
        $mathAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[3][$idaepyGroup]['spanish']);
        
        $totalMathAchievement =  $mathAchievementList[1] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[1] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[1] + $spanishAchievementList[2] + $spanishAchievementList[3];
        
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
            $pdf->Cell(40,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup3);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup3 = $heightPositionGroup3 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup3);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');            
            
            $sizeNumAchievement = $sizeNumAchievement + 40;
            
        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }

}

// Cuarto Grado
$pdf->SetFont('OpenSans', 'B', '16');
$pdf->SetDrawColor(247, 124, 22);
$pdf->SetXY(400, $actualPosition2);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->Cell(60,$heightTwoGroup, 'Reactivos Evaluados',1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->Cell(65,$heightTwoGroup, 'Porcentaje de aciertos',1,0,'C');
$pdf->SetXY(610, $actualPosition2);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(120,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition2 = $actualPosition2 + $heightOneGroup;
$pdf->SetXY(610, $actualPosition2);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(40,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(40,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(40,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[4]) && $totalGradeProg[4] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[4]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup = $actualPosition2 + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'17','B',0,'C');
    // Español
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'16','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,'Ciencias Naturales','B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    foreach($idaepyAchievementTotalGroup[4] as $idaepyGroup){
            
        $percentageMathHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['math'])/count($idaepyHitsResult[4][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['science'])/count($idaepyHitsResult[4][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[4][$idaepyGroup]['spanish'])/count($idaepyHitsResult[4][$idaepyGroup]['spanish']);    
        
        $mathAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[4][$idaepyGroup]['spanish']);
        
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
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup = 190 + $heightOneGroup;
        $sizeNumAchievement = 610;    
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
            $pdf->Cell(40,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');
            
            $sizeNumAchievement = $sizeNumAchievement + 40;
            
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

$pdf->Ln(15);
$pdf->SetWidths(array(110, 35, 80, 41, 90, 110, 35, 80, 41, 80));
$pdf->setFonts(array(array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), 
        array('OpenSans','',$sizeLetterTitles), array('OpenSans','B',$sizeLetterTitles), array('OpenSans','',$sizeLetterTitles), 
        array('OpenSans','B',$sizeLetterTitles)));     
$pdf->Row(array('Quinto Grado', 'Inscritos:', $totalGradeProg['5'], 'Evaluados:', $totalGradeEva['5'], 'Sexto Grado', 
        'Inscritos:', $totalGradeProg['6'], 'Evaluados:', $totalGradeEva['6']));
        
$pdf->Ln(10);
$actualPosition = $pdf->GetY();
$actualPosition2 = $pdf->GetY();        

// Quinto Grado
$pdf->SetFont('OpenSans', 'B', '16');
$pdf->SetDrawColor(247, 124, 22);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->Cell(60,$heightTwoGroup, 'Reactivos Evaluados',1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->Cell(65,$heightTwoGroup, 'Porcentaje de aciertos',1,0,'C');
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(120,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition = $actualPosition + $heightOneGroup;
$pdf->SetXY(240, $actualPosition);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(40,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(40,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(40,$heightOneGroup, 'Avanzado',1,0,'C',1);

if(isset($totalGradeProg[5]) && $totalGradeProg[5] != 0){
    $numGroup = count($idaepyAchievementTotalGroup[5]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup5 = $actualPosition + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    
    // Matematicas
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'20','B',0,'C');
    // Español
    $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'16','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
    $pdf->SetXY(30, $heightPositionGroup5);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,'Ciencias Naturales','B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'8','B',0,'C');
    $countGroup = 1;
    
    foreach($idaepyAchievementTotalGroup[5] as $idaepyGroup){
            
        $percentageMathHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['math'])/count($idaepyHitsResult[5][$idaepyGroup]['math']);
        $percentageScienceHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['science'])/count($idaepyHitsResult[5][$idaepyGroup]['science']);
        $percentageSpanishHits =  array_sum($idaepyHitsResult[5][$idaepyGroup]['spanish'])/count($idaepyHitsResult[5][$idaepyGroup]['spanish']);    
        
        $mathAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['math']);
        $scienceAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['science']);
        $spanishAchievementList =  array_count_values($idaepyAchievementResult[5][$idaepyGroup]['spanish']);
        
        $totalMathAchievement =  $mathAchievementList[1] + $mathAchievementList[2] + $mathAchievementList[3];
        $totalScienceAchievement =  $scienceAchievementList[1] + $scienceAchievementList[2] + $scienceAchievementList[3];
        $totalSpanishAchievement =  $spanishAchievementList[1] + $spanishAchievementList[2] + $spanishAchievementList[3];
        
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
            $pdf->Cell(40,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup5);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup5 = $heightPositionGroup5 + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup5);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');
            
            $sizeNumAchievement = $sizeNumAchievement + 40;
            
        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }
}

// Sexto Grado
$pdf->SetFont('OpenSans', 'B', '16');
$pdf->SetDrawColor(247, 124, 22);
$pdf->SetXY(400, $actualPosition2);
$pdf->Cell(60,$heightTwoGroup, 'Asignatura',1,0,'C');
$pdf->Cell(60,$heightTwoGroup, 'Reactivos Evaluados',1,0,'C');
$pdf->Cell(25,$heightTwoGroup, 'Grupo',1,0,'C');
$pdf->Cell(65,$heightTwoGroup, 'Porcentaje de aciertos',1,0,'C');
$pdf->SetXY(610, $actualPosition2);
$pdf->SetFillColor(54, 96, 146);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(120,$heightOneGroup, 'Porcentaje de alumnos por nivel de logro',1,0,'C',1);
$actualPosition2 = $actualPosition2 + $heightOneGroup;
$pdf->SetXY(610, $actualPosition2);
$pdf->SetFillColor(178, 18, 112);
$pdf->Cell(40,$heightOneGroup, 'Basico',1,0,'C',1);
$pdf->SetFillColor(247, 124, 22);
$pdf->Cell(40,$heightOneGroup, 'Medio',1,0,'C',1);
$pdf->SetFillColor(28, 153, 83);
$pdf->Cell(40,$heightOneGroup, 'Avanzado',1,0,'C',1);
if(isset($totalGradeProg[6]) && $totalGradeProg[6] != 0){

    $numGroup = count($idaepyAchievementTotalGroup[6]);
    $heightGroup = $heightOneGroup * $numGroup;
    $heightPositionGroup = $actualPosition2 + $heightOneGroup;
    $pdf->SetDrawColor(255, 255, 255);
    // Matematicas
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(254, 165, 32);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Matemáticas'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'21','B',0,'C');
    // Español
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(48, 171, 158);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,utf8_decode('Español'),'B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
    $pdf->Cell(60,$heightGroup,'19','B',0,'C');
    // Ciencias Naturales
    $heightPositionGroup = $heightPositionGroup + $heightGroup;
    $pdf->SetXY(400, $heightPositionGroup);
    $pdf->SetFillColor(245, 85, 50);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('OpenSans', 'B', '16');
    $pdf->Cell(60,$heightGroup,'Ciencias Naturales','B',0,'C',1);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('OpenSans', '', '16');
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
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageMathHits, 1),$border,0,'C');
        // Español
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageSpanishHits, 1),$border,0,'C');
        // Ciencias Naturales
        $heightPositionGroup = $heightPositionGroup + $heightGroup;
        $pdf->SetXY(520, $heightPositionGroup);
        $pdf->Cell(25,$heightOneGroup, $idaepyGroup,$border,0,'C');
        $pdf->SetXY(545, $heightPositionGroup);    
        $pdf->Cell(65,$heightOneGroup, number_format($percentageScienceHits, 1),$border,0,'C');
        $heightPositionGroup = 190 + $heightOneGroup;
        $sizeNumAchievement = 610;    
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
            $pdf->Cell(40,$heightOneGroup, number_format($percentageMathAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageSpanishAchievement[$keyLevel], 1),$border,0,'C');
            $heightPositionGroup = $heightPositionGroup + $heightGroup;
            $pdf->SetXY($sizeNumAchievement, $heightPositionGroup);    
            $pdf->Cell(40,$heightOneGroup, number_format($percentageScienceAchievement[$keyLevel], 1),$border,0,'C');
            
            $sizeNumAchievement = $sizeNumAchievement + 40;
            
        }
        $sizeNumGroup = $sizeNumGroup + $heightOneGroup;
        $countGroup = $countGroup + 1;
    }
}

$actualPosition = $pdf->GetY();

if($actualPosition >= $heightPositionGroup5){
    $pdf->SetY($actualPosition);
    $pdf->Ln();
}else{
    $pdf->SetY($heightPositionGroup5);
    $pdf->Ln();
}

//$pdf->Image('../content/images/idaepy/niveles_logro.png', 25, $pdf->GetY(), 720);

$pdf->Output();
?>