<?php
/**
* Datos region
*/

//Programados y Evaluados IDAEPY
$idaepyController = new IdaepyController();
$join = 'INNER JOIN school ON school.cct = e.cct';
$where = 'school.id = :school AND e.year = :year AND e.grade = :grade AND e.school_group = :schoolGroup AND (e.type = 1 OR e.type = 2)';
$whereFields = array('school' => $schoolObject->getId(), 'grade' => $schoolGroup->getGrade(),
    'schoolGroup' => $schoolGroup->getSchoolGroup(), 'year' => $year);
$idaepyList = $idaepyController -> displayByAction($where, $whereFields, $join);

$idaepySchoolGroupTotal = array(); // Total por grado - grupo

foreach ($idaepyList as $idaepyEntry) {
    $idaepySchoolGroupTotal[$idaepyEntry->getType()] = $idaepyEntry->getTotal();
}

// Evaluados Contexto - Lista de estudiantes que contestaro el factor
$factorStudentController = new FactorStudentController();
$join = 'INNER JOIN context ON context.student = e.student
         INNER JOIN idaepy_students ON idaepy_students.student = e.student';
$showFields = 'e.student, context.grade, context.school_group, e.question, e.answer';
$where = "e.factor = :factor AND idaepy_students.cct = :school AND idaepy_students.grade = :grade
  AND idaepy_students.school_group = :schoolGroup AND
  context.year = :year AND idaepy_students.year = :yearX";
$whereFields = array('factor' => $factorObject->getId(), 'school' => $schoolObject->getCct(),
  'grade' => $schoolGroup->getGrade(), 'schoolGroup' => $schoolGroup->getSchoolGroup(),
 'yearX' => $groupby, 'year' => $year);
$factorStudentList = $factorStudentController -> displayBy2Action($where, $whereFields, $join, '', $showFields);
$factorStudentTotal = count($factorStudentList);

$factorAnswerStudentsList = array(); //Array de respuestas por estudiante
$factorGradeStudentsList = array(); //Array de respuestas por estudiante

//Generar array de las respuestas por estudiante
foreach ($factorStudentList as $factorStudentEntry) {
    $factorAnswerStudentsList[$factorStudentEntry['question']][] = $factorStudentEntry['answer'];
    $factorGradeStudentsList[$factorStudentEntry['student']] = 1;
}

?>

<div class="col-xs-12 col-md-5">
    <div><h4 class='form-signin-heading'>CCT: <?php echo($schoolObject -> getCct()); ?></h4></div>
    <div><h4 class='form-signin-heading'>Escuela: <?php echo($schoolObject -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Nivel: <?php echo($schoolObject -> getSchoolLevelObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Modalidad: <?php echo($schoolObject -> getSchoolModeObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Marginación: <?php echo($schoolObject->getSchoolMarginalizationObject()->getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($schoolObject -> getSchoolRegionZoneObject() -> getSchoolRegionObject() -> getName()); ?> </h4></div>
    <div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($schoolObject->getSchoolRegionZoneObject()->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
</div>
<div class="col-xs-12 col-md-7">
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>Grado</th>
                <th>Grupo</th>
                <th>Programados IDAEPY <?php echo($year); ?></th>
                <th>Evaluados IDAEPY <?php echo($year); ?></th>
                <th>Cursando <?php echo(($groupby-1).'-'.$groupby); ?></th>
            </tr>
        </thead>
        <tbody>
        <?php
        echo('<td class="theadR">' . $schoolGroup->getGrade() . '&deg;</td>');
        echo('  <td class="theadR">' . $schoolGroup->getSchoolGroup() . '</td>');
        echo('  <td class="theadR">' . $idaepySchoolGroupTotal[2] . '</td>');
        echo('  <td class="theadR">' . $idaepySchoolGroupTotal[1] . '</td>');
        echo('  <td class="theadR">' . count($factorGradeStudentsList) . '</td>');
        echo('</tr>');
         ?>
        </tbody>
    </table>
	<p><b>Nota: Los grupos se escuentran conformados de acuerdo al ciclo escolar <?php echo(($groupby-1).'-'.$groupby); ?></b></p>
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

  $factorClassroomController = new FactorClassroomController();
  $where = "e.factor = :factor AND e.cct = :school AND e.grade = :grade AND e.school_group = :schoolGroup AND
    e.year = :groupby";
  $whereFields = array('factor' => $factor, 'school' => $schoolObject->getCct(), 'grade' => $schoolGroup->getGrade(),
      'schoolGroup' => $schoolGroup->getSchoolGroup(), 'groupby' => $groupby);
  $factorSchoolGroupList = $factorClassroomController->displayByAction($where, $whereFields);

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
      if($factorSchoolGroupList[0]->getMedia() > 0){
          $colorGraphicSchoolGroup = '#3AC777';
      }else{
          $colorGraphicSchoolGroup = '#E9F26D';
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
      if($factorSchoolGroupList[0]->getMedia() > 0){
          $colorGraphicSchoolGroup = '#E9F26D';
      }else{
          $colorGraphicSchoolGroup = '#3AC777';
      }
  }

  // Generar formato para la grafica general
  $schoolGroupName = $schoolGroup->getGrade() . '° ' . $schoolGroup->getSchoolGroup();

  $dataGeneral = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
  $dataGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
  $dataGeneral .= "', '" . $colorGraphicState . "'],";
  $dataGeneral .= "['". $schoolRegionZone -> getSchoolRegionObject() -> getName() . "'," . round($factorRegionList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorRegionList[0]->getMedia(), 2) . "', '" . $colorGraphicZone . "'],";
  $dataGeneral .= "['Zona " . (str_pad($schoolObject->getZone(),  3, "0", STR_PAD_LEFT)) . "'," . round($factorZoneList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorZoneList[0]->getMedia(), 2) . "', '" . $colorGraphicZone . "'],";
  $dataGeneral .= "['" . (str_pad($schoolObject->getCct(),  3, "0", STR_PAD_LEFT)) . "'," . round($factorSchoolList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorSchoolList[0]->getMedia(), 2) . "', '" . $colorGraphicSchool . "'],";
  $dataGeneral .= "['" . (str_pad($schoolGroupName,  3, "0", STR_PAD_LEFT)) . "'," . round($factorSchoolGroupList[0]->getMedia(), 2) . ",'";
  $dataGeneral .= round($factorSchoolGroupList[0]->getMedia(), 2) . "', '" . $colorGraphicSchoolGroup . "'],";
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
$where = 'e.factor = :factor AND question_grade.grade = :grade';
$join = "INNER JOIN question_grade ON question_grade.question = e.id";
$whereFields = array('factor' => $factorObject->getId(), 'grade' => $schoolGroup->getGrade());
$questionsList = $questionsController -> displayByAction($where, $whereFields, $join);
$questionsTotal = count($questionsList);

//Lista de respuestas para cada pregunta
$questionAnswerController = new QuestionAnswerController();
$showFields = 'e.question, e.answer, answers.name, answers.value, answers.color, answers.inverse_color, questions.question_number';
$join = 'INNER JOIN questions on questions.id = e.question
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
 $factorTotalAnswerStudents[$countQuest] = array_count_values($factorAnswerStudentsList[$questionNumber]);
 $totalStudentAnswer = array_sum($factorTotalAnswerStudents[$countQuest]);
 $slices = "";

 if($factor <= 11){
   $firstAnswer = 0;
   $totalAnswers = $totalAnswers - 1;
 }else{
   $firstAnswer = 1;
 }

 $data[$countQuest] = "[";
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
   $factorPercent = round(($factorTotalAnswerStudents[$countQuest][$numAnswer]/$totalStudentAnswer * 100), 2);
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
   $data[$countQuest] .= "['" . $factorAnswers[$questionNumber][$numAnswer]['name'] . "'," . $legendNumber . ",'" . $factorPercent . "%', ";
   $data[$countQuest] .=  $funtionTooltip . ", '". $colorGraphic ."'],";
   $slices .= ($i-1).": { color: '$colorGraphic', offset: 0.05}, ";
 }
 $data[$countQuest] .= ']';

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
