<?php
/**
* Datos region
*/

if($factorObject->getId() < 12){
  $year = 2015;
}else{
  $year = 2017;
}

//Programados y Evaluados IDAEPY
$idaepyController = new IdaepyController();
$join = 'INNER JOIN school ON school.cct = e.cct';
$where = 'school.zone = :schoolZone AND school.mode = :schoolMode AND school.level = :schoolLevel
          AND e.year = :year AND e.grade >= 3 AND (e.type = 1 OR e.type = 2)';
$whereFields = array('year' => $year, 'schoolZone' => $schoolZone, 'schoolMode' => $schoolMode,
              'schoolLevel' => $schoolLevel);
$idaepyList = $idaepyController -> displayByAction($where, $whereFields, $join);

$idaepyGradeList = array(); //Array de respuestas por estudiante
foreach ($idaepyList as $idaepyEntry) {
 $idaepyGradeList[$idaepyEntry->getType()][$idaepyEntry->getGrade()] = $idaepyEntry->getTotal() + $idaepyGradeList[$idaepyEntry->getType()][$idaepyEntry->getGrade()];
}

$factorAnswerList = array(); //Array de respuestas por estudiante
$factorGradeList = array(); //Array de respuestas por estudiante

if($factorObject->getType() == 1){
  $factorStudentController = new FactorStudentController();
  $join = 'INNER JOIN school ON school.cct = e.cct
           INNER JOIN context ON context.student = e.student';
  $showFields = 'e.student, context.grade, e.question, e.answer';
  $where = "e.factor = :factor AND school.zone = :schoolZone AND school.mode = :schoolMode
            AND school.level = :schoolLevel AND context.year = :year";
  $whereFields = array('factor' => $factorObject->getId(), 'schoolMode' => $schoolMode,
                'schoolLevel' => $schoolLevel, 'schoolZone' => $schoolZone, 'year' => $year);
  $factorStudentList = $factorStudentController -> displayBy2Action($where, $whereFields, $join, '', $showFields);
  $factorStudentTotal = count($factorStudentList);

  //Generar array de las respuestas por estudiante
  foreach ($factorStudentList as $factorStudentEntry) {
   $factorAnswerList[$factorStudentEntry['question']][] = $factorStudentEntry['answer'];
   $factorGradeList[$factorStudentEntry['student']] = $factorStudentEntry['grade'];
  }

  $factorGradeStudents = array_count_values($factorGradeList);
}else{
  $factorUserController = new FactorUserController();
  $join = 'INNER JOIN school ON school.cct = e.cct';
  $showFields = 'e.folio, e.question, e.answer';
  $where = "e.factor = :factor AND school.zone = :schoolZone AND school.mode = :schoolMode
            AND school.level = :schoolLevel";
  $whereFields = array('factor' => $factorObject->getId(), 'schoolMode' => $schoolMode,
                'schoolLevel' => $schoolLevel, 'schoolZone' => $schoolZone);
  $factorUserList = $factorUserController -> displayBy2Action($where, $whereFields, $join, '', $showFields);
  $factorUserTotal = count($factorUserList);

  //Generar array de las respuestas por estudiante
  foreach ($factorUserList as $factorEntry) {
   $factorAnswerList[$factorEntry['question']][] = $factorEntry['answer'];
  }
}

?>

<div class="col-xs-12 col-md-5">
  <div><h4 class='form-signin-heading'>Nivel: <?php echo($schoolLevelObject -> getName()); ?></h4></div>
  <div><h4 class='form-signin-heading'>Modalidad: <?php echo($schoolModeObject -> getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Regi&oacute;n: Pendiente </h4></div>
  <div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($schoolZone,  3, "0", STR_PAD_LEFT)); ?> </h4></div>
</div>
<?php
if($factorObject->getType() == 1){
?>
<div class="col-xs-12 col-md-7">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Grado</th>
        <th>Programados IDAEPY</th>
        <th>Evaluados IDAEPY</th>
        <th>Evaluados Contexto</th>
      </tr>
    </thead>
    <tbody>
      <?php

      $count3 = 1;
      $count4 = 1;
      $count5 = 1;
      $count6 = 1;
      // Tercero
      echo('<tr>');
      echo('<td class="theadR">3&deg;</td>');
      echo('<td>'. ($idaepyGradeList[2][3] ? $idaepyGradeList[2][3] : ' 0 ') . '</td>');
      echo('<td>'. ($idaepyGradeList[2][3] ? $idaepyGradeList[2][3] : ' 0 ') . '</td>');
      echo('<td>'. $factorGradeStudents[3].'</td>');
      echo('</tr>');
      echo('<tr>');
      echo('<td class="theadR">4&deg;</td>');
      echo('<td>'. ($idaepyGradeList[2][4] ? $idaepyGradeList[2][4] : ' 0 ') . '</td>');
      echo('<td>'. ($idaepyGradeList[1][4] ? $idaepyGradeList[1][4] : ' 0 ') . '</td>');
      echo('<td>'. $factorGradeStudents[4].'</td>');
      echo('</tr>');
      echo('<tr>');
      echo('<td class="theadR">5&deg;</td>');
      echo('<td>'. ($idaepyGradeList[2][5] ? $idaepyGradeList[2][5] : ' 0 ') . '</td>');
      echo('<td>'. ($idaepyGradeList[1][5] ? $idaepyGradeList[1][5] : ' 0 ') . '</td>');
      echo('<td>'. $factorGradeStudents[5].'</td>');
      echo('</tr>');
      echo('<tr>');
      echo('<td class="theadR">6&deg;</td>');
      echo('<td>'. ($idaepyGradeList[2][6] ? $idaepyGradeList[2][6] : ' 0 ') . '</td>');
      echo('<td>'. ($idaepyGradeList[1][6] ? $idaepyGradeList[1][6] : ' 0 ') . '</td>');
      echo('<td>'. $factorGradeStudents[6].'</td>');
      echo('</tr>');
      echo('<tr>');
      echo('<td>Total</td>');
      echo('<td>'. array_sum($idaepyGradeList[2]) . '</td>');
      echo('<td>'. array_sum($idaepyGradeList[1]) . '</td>');
      echo('<td>'. array_sum($factorGradeStudents) . '</td>');
      echo('</tr>');
     ?>
    </tbody>
  </table>
</div>
<?php } ?>
<div class="col-xs-12 col-md-12">
    <hr />
</div>

<?php
if($factor < 44 || $factor > 49){
/**
* Grafica - Media por estado
*/

$factorStateController = new FactorStateController();
$whereRegion = "factor LIKE :factor";
$factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

$factorZoneController = new FactorZoneController();
$where = "e.modality = :modality AND e.zone = :schoolZone AND e.factor = :factor AND
  e.school_region = :schoolRegion AND e.level = :schoolLevel";
$whereFields = array('factor' => $factor, 'schoolZone' => $schoolZone,
  'schoolRegion' => 18, 'schoolLevel' => $schoolLevel, 'modality' => $schoolMode);
$factorZoneList = $factorZoneController -> displayByAction($where, $whereFields);

$factorSchoolController = new FactorCctController();
$join = 'INNER JOIN school ON school.cct = e.cct';
$where = "e.factor = :factor AND school.zone = :schoolZone AND school.mode = :schoolMode AND school.level = :schoolLevel";
$whereFields = array('factor' => $factor, 'schoolZone' => $schoolZone, 'schoolLevel' => $schoolLevel, 'schoolMode' => $schoolMode);
$factorSchoolList = $factorSchoolController->displayByAction($where, $whereFields, $join);

$dataGeneral = array(); //Array grafica general

if($factorObject->getTrend() == 1){
    if($factorStateList[0]->getMedia() > 0){
        $colorGraphicState = '#3AC777';
    }else{
        $colorGraphicState = '#E9F26D';
    }
    if($factorZoneList[0]->getMedia() > 0){
        $colorGraphicZone = '#3AC777';
    }else{
        $colorGraphicZone = '#E9F26D';
    }
}else{
    if($factorStateList[0]->getMedia() > 0){
        $colorGraphicState = '#E9F26D';
    }else{
        $colorGraphicState = '#3AC777';
    }
    if($factorZoneList[0]->getMedia() > 0){
        $colorGraphicZone = '#E9F26D';
    }else{
        $colorGraphicZone = '#3AC777';
    }
}

// Generar formato para la grafica general

$dataGeneral = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
$dataGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
$dataGeneral .= "', '" . $colorGraphicState . "'],";
$dataGeneral .= "['Zona " . (str_pad($schoolZone,  3, "0", STR_PAD_LEFT)) . "'," . round($factorZoneList[0]->getMedia(), 2) . ",'";
$dataGeneral .= round($factorZoneList[0]->getMedia(), 2) . "', '" . $colorGraphicZone . "'],";
foreach($factorSchoolList as $factorSchool){
    if($factorObject->getTrend() == 1){
        if($factorSchool->getMedia() > 0){
            $colorGraphicSchool = '#3AC777';
        }else{
            $colorGraphicSchool = '#E9F26D';
        }
    }else{
        if($factorSchool->getMedia() > 0){
            $colorGraphicSchool = '#E9F26D';
        }else{
            $colorGraphicSchool = '#3AC777';
        }
    }
    $dataGeneral .= "['" . $factorSchool->getCct() . "'," . round($factorSchool -> getMedia(), 2);
    $dataGeneral .= ",'" . round($factorSchool -> getMedia(), 2) . "', '" . $colorGraphicSchool . "'],";
}
$dataGeneral .= ']';
}else{
  $dataGeneral = '["No data"]';
}

/**
* Grafica por pregunta
*/

$data = array(); //Array para las graficas por pregunta
$factorAnswers = array(); //Array de respuestas por pregunta para el factor.
$factorTotalAnswerStudents = array(); //Array del número de estudiantes para cada respuesta por pregunta.

// ListA de preguntas que conforman el factor
$questionsController = new QuestionsController();
$where = 'factor = :factor';
$whereFields = array('factor' => $factorObject->getId());
$questionsList = $questionsController -> displayByAction($where, $whereFields);
$questionsTotal = count($questionsList);

//Lista de respuestas para cada pregunta
$questionAnswerController = new QuestionAnswerController();
$showFields = 'e.question, e.answer, answers.name, answers.value, answers.color, answers.inverse_color, questions.question_number';
$join = ' INNER JOIN questions on questions.id = e.question
         INNER JOIN answers on answers.id = e.answer';
$where = 'questions.factor = :factor';
$whereFields = array('factor' => $factorObject->getId());
$questionAnswersList = $questionAnswerController->displayBy2Action($where, $whereFields, $join, $showFields);

//Generar array de las respuestas por pregunta
foreach ($questionAnswersList as $questionAnswersEntry) {
 $factorAnswers[$questionAnswersEntry['question_number']][$questionAnswersEntry['value']] = $questionAnswersEntry;
}
//Generar formato para la grafica de cada pregunta
$countQuest = 1;
$textJS = "";
$chartJS = "";
$drawChartJS = "";
$charts = '';

$chartsController = new ChartsController();

foreach ($questionsList as $key => $question) {
 $questionNumber = $question->getQuestionNumber();
 $totalAnswers = count($factorAnswers[$question->getQuestionNumber()]);
 $factorTotalAnswerStudents[$questionNumber] = array_count_values($factorAnswerList[$questionNumber]);
 $totalStudentAnswer = array_sum($factorTotalAnswerStudents[$questionNumber]);
 $slices = "";

 if($factor <= 11){
   $firstAnswer = 0;
   $totalAnswers = $totalAnswers - 1;
 }else{
   $firstAnswer = 1;
 }

 $data[$questionNumber] = "[";
 for ($i = $firstAnswer; $i <= $totalAnswers; $i++) {

   if($factor >= 40 && $factor < 43){
     if($i == 3){
       $numAnswer = 999;
     }elseif($i > 3){
       $numAnswer = $i-1;
     }else{
       $numAnswer = $i;
     }
   }else{
     if($i == $totalAnswers){
       $numAnswer = 999;
     }else{
       $numAnswer = $i;
     }
   }

   $numberFormat = number_format($factorTotalAnswerStudents[$questionNumber][$numAnswer]);
   $numberNotFormat = $factorTotalAnswerStudents[$questionNumber][$numAnswer];
   $factorPercent = round(($factorTotalAnswerStudents[$questionNumber][$numAnswer]/$totalStudentAnswer * 100), 2);
   switch ($question->getChart()) {
     case '3':
       $legendNumber = $factorPercent;
       break;
     case '6':
       $legendNumber = $numberNotFormat;
       break;
     default:
       $charts = 'Sin datos';
       break;
   }
   $funtionTooltip = "createCustomHTMLContent('" .$factorAnswers[$questionNumber][$numAnswer]['name']."', 'Frecuencia', '";
   $funtionTooltip .= $numberFormat . "')";
   if($factorObject->getTrend() == 1){
     $colorGraphic = $factorAnswers[$questionNumber][$numAnswer]['color'];
   }else{
     $colorGraphic = $factorAnswers[$questionNumber][$numAnswer]['inverse_color'];
   }
   $data[$questionNumber] .= "['" . $factorAnswers[$questionNumber][$numAnswer]['name'] . "'," . $legendNumber . ",'" . $factorPercent . "%', ";
   $data[$questionNumber] .=  $funtionTooltip . ", '". $colorGraphic ."'],";
   if($factor <= 11){
     $slices .= ($i).": { color: '$colorGraphic', offset: 0.1}, ";
   }else{
     $slices .= ($i-1).": { color: '$colorGraphic', offset: 0.1}, ";
   }
 }
 $data[$questionNumber] .= ']';

 switch ($question->getChart()) {
   case '3':
     $charts .= $chartsController->drawComboChart($question->getTitle(), $countQuest, $data[$questionNumber]);
     break;
   case '6':
     $charts .= $chartsController->drawPieChart($question->getTitle(), $countQuest, $data[$questionNumber], $slices);
     break;
   default:
     $charts .= 'Sin datos';
     break;
 }

 $countQuest = $countQuest + 1;
 }

?>
