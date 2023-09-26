<?php

if($factorObject->getId() < 12){
  $year = 2015;
}else{
  $year = 2017;
}

//Programados y Evaluados IDAEPY
$idaepyController = new IdaepyController();
$join = 'INNER JOIN school ON school.cct = e.cct';
$where = 'school.id = :school AND e.year = :year AND e.grade >= 3 AND (e.type = 1 OR e.type = 2)';
$whereFields = array('school' => $schoolObject->getId(), 'year' => $year);
$idaepyList = $idaepyController -> displayByAction($where, $whereFields, $join);
$idaepySchoolGroupTotal = array(); // Total por grado - grupo
$schoolGroupList = array(); // Lista de grupos
$idaepyGradeTotal = array(); // Total por grado

foreach ($idaepyList as $idaepyEntry) {
    $schoolGroupList[$idaepyEntry->getGrade()][$idaepyEntry->getSchoolGroup()] = 1;
    $idaepySchoolGroupTotal[$idaepyEntry->getType()][$idaepyEntry->getGrade()][$idaepyEntry->getSchoolGroup()] = $idaepyEntry->getTotal();
    $idaepyGradeTotal[$idaepyEntry->getType()][$idaepyEntry->getGrade()] = $idaepyEntry->getTotal() + $idaepyGradeTotal[$idaepyEntry->getType()][$idaepyEntry->getGrade()];
}

// Evaluados Contexto - Lista de estudiantes que contestaro el factor
$factorStudentController = new FactorStudentController();
$join = 'INNER JOIN context ON context.student = e.student';
$showFields = 'e.student, context.grade, context.school_group, e.question, e.answer';
$where = "e.factor = :factor AND e.cct = :school AND context.year = :year";
$whereFields = array('factor' => $factorObject->getId(), 'school' => $schoolObject->getCct(), 'year' => $year);
$factorStudentList = $factorStudentController -> displayBy2Action($where, $whereFields, $join, '', $showFields);
$factorStudentTotal = count($factorStudentList);

$factorAnswerStudentsList = array(); //Array de respuestas por estudiante
$factorGradeStudentsList = array(); //Array de respuestas por estudiante

//Generar array de las respuestas por estudiante
foreach ($factorStudentList as $factorStudentEntry) {
    $factorAnswerStudentsList[$factorStudentEntry['question']][] = $factorStudentEntry['answer'];
    $factorGradeStudentsList[$factorStudentEntry['grade']][$factorStudentEntry['student']] = $factorStudentEntry['school_group'];
}

foreach ($factorGradeStudentsList as $key => $factorGradeEntry) {
    $factorGrade[$key] = array_count_values($factorGradeEntry);
    $factorGrade['total'][$key] = array_sum($factorGrade[$key]);
}
?>

<div class="col-xs-12 col-md-5">
    <div><h4 class='form-signin-heading'>CCT: <?php echo($schoolObject -> getCct()); ?></h4></div>
    <div><h4 class='form-signin-heading'>Escuela: <?php echo($schoolObject -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Nivel: <?php echo($schoolObject -> getSchoolLevelObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Modalidad: <?php echo($schoolObject -> getSchoolModeObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Marginación: <?php echo($schoolObject->getSchoolMarginalizationObject()->getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($schoolObject -> getSchoolRegionZoneObject() -> getSchoolRegionObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($schoolObject->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
</div>
<div class="col-xs-12 col-md-7">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Programados IDAEPY</th>
                <th>Evaluados IDAEPY</th>
                <th>Evaluados Contexto</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($schoolGroupList as $keyGrade => $valueGrade) {
            $countgroup = 1;
            foreach ($valueGrade as $keyGroup => $valueGroup) {
                echo('<tr>');
                if($countgroup == 1){
                    echo('<td class="theadR" rowspan="' . count($valueGrade) . '">' . $keyGrade . '&deg;</td>');
                }
                echo('  <td class="theadR">' . $keyGroup . '</td>');
                echo('  <td class="theadR">' . $idaepySchoolGroupTotal[2][$keyGrade][$keyGroup] . '</td>');
                echo('  <td class="theadR">' . $idaepySchoolGroupTotal[1][$keyGrade][$keyGroup] . '</td>');
                echo('  <td class="theadR">' . $factorGrade[$keyGrade][$keyGroup] . '</td>');
                echo('</tr>');
                $countgroup = 1 + $countgroup;
            }
        }
            echo('<tr>');
            echo('<td colspan="2">Total</td>');
            echo('<td>' . array_sum($idaepyGradeTotal[2]) . '</td>');
            echo('<td>' . array_sum($idaepyGradeTotal[1]) . '</td>');
            echo('<td>' . array_sum($factorGrade['total']) . '</td>');
            echo('</tr>');
         ?>
        </tbody>
    </table>
</div>
<div class="col-xs-12 col-md-12">
    <hr />
</div>

<?php
if($factor < 44){
  /**
  * Grafica - Media por estado
  */
  $factorRegionController = new FactorRegionController();
  $whereRegion = "factor = :factor AND e.region = :schoolRegion";
  $whereFields = array('factor' => $factor, 'schoolRegion' => $schoolObject -> getSchoolRegionObject() -> getId());
  $factorRegionList = $factorRegionController -> displayByAction($whereRegion, $whereFields);

  $factorStateController = new FactorStateController();
  $whereRegion = "factor LIKE :factor";
  $factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

  $factorZoneController = new FactorZoneController();
  $where = "e.modality = :modality AND e.level = :schoolLevel AND e.zone = :schoolZone AND
    e.factor = :factor";
  $schoolRegionZone = $schoolObject->getSchoolRegionZoneObject();
  $whereFields = array('factor' => $factor, 'schoolZone' => $schoolObject->getZone(),    
    'schoolLevel' => $schoolObject->getLevel(),
    'modality' => $schoolObject->getMode());
  $factorZoneList = $factorZoneController -> displayByAction($where, $whereFields);


  $factorSchoolController = new FactorCctController();
  $where = "e.factor = :factor AND e.cct = :school";
  $whereFields = array('factor' => $factor, 'school' => $schoolObject->getCct());
  $factorSchoolList = $factorSchoolController->displayByAction($where, $whereFields);

  $dataGeneral = array(); //Array grafica general

  if($factorObject->getTrend() == 1){
      if($factorStateList[0]->getMedia() > 0){
          $colorGraphicState = '#3AC777';
      }else{
          $colorGraphicState = '#E9F26D';
      }
      if($factorRegionList[0]->getMedia() > 0){
          $colorGraphicRegion = '#3AC777';
      }else{
          $colorGraphicRegion = '#E9F26D';
      }
      if($factorZoneList[0]->getMedia() > 0){
          $colorGraphicZone = '#3AC777';
      }else{
          $colorGraphicZone = '#E9F26D';
      }
      if($factorSchoolList[0]->getMedia() > 0){
          $colorGraphicSchool = '#3AC777';
      }else{
          $colorGraphicSchool = '#E9F26D';
      }
  }else{
      if($factorStateList[0]->getMedia() > 0){
          $colorGraphicState = '#E9F26D';
      }else{
          $colorGraphicState = '#3AC777';
      }
      if($factorRegionList[0]->getMedia() > 0){
          $colorGraphicRegion = '#E9F26D';
      }else{
          $colorGraphicRegion = '#3AC777';
      }
      if($factorZoneList[0]->getMedia() > 0){
          $colorGraphicZone = '#E9F26D';
      }else{
          $colorGraphicZone = '#3AC777';
      }
      if($factorSchoolList[0]->getMedia() > 0){
          $colorGraphicSchool = '#E9F26D';
      }else{
          $colorGraphicSchool = '#3AC777';
      }
  }

  // Generar formato para la grafica general

  $dataGeneral = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
  $dataGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
  $dataGeneral .= "', '" . $colorGraphicState . "'],";
  $dataGeneral .= "['". $schoolRegionZone -> getSchoolRegionObject() -> getName() . "'," . round($factorRegionList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorRegionList[0]->getMedia(), 2) . "', '" . $colorGraphicZone . "'],";
  $dataGeneral .= "['Zona " . (str_pad($schoolRegionZone->getZone(),  3, "0", STR_PAD_LEFT)) . "'," . round($factorZoneList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorZoneList[0]->getMedia(), 2) . "', '" . $colorGraphicZone . "'],";
  $dataGeneral .= "['" . (str_pad($schoolObject->getCct(),  3, "0", STR_PAD_LEFT)) . "'," . round($factorSchoolList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorSchoolList[0]->getMedia(), 2) . "', '" . $colorGraphicSchool . "'],";
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
 $factorTotalAnswerStudents[$questionNumber] = array_count_values($factorAnswerStudentsList[$questionNumber]);
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
   $slices .= ($i-1).": { color: '$colorGraphic', offset: 0.1}, ";
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
