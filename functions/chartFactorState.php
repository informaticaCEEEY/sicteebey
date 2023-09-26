<?php

/**
* Grafica - Media por estado
*/
if($factor < 44){
  $factorRegionController = new FactorRegionController();
  $where = "factor = :factor";
  $whereFields = array('factor' => $factor);
  $factorRegionList = $factorRegionController -> displayByAction($where, $whereFields);

  $factorStateController = new FactorStateController();
  $where = "factor LIKE :factor";
  $whereFields = array('factor' => $factor);
  $factorStateList = $factorStateController -> displayByAction($where, $whereFields);

  $dataRegion = array(); //Array grafica general

  if($factorObject->getTrend() == 1){
    $colorGraphicState[0] = '#3AC777';
    $colorGraphicState[1] = '#E9F26D';
  }else{
    $colorGraphicState[1] = '#3AC777';
    $colorGraphicState[0] = '#E9F26D';
  }
  // Generar formato para la grafica general
  $dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
  if($factorStateList[0]->getMedia() > 0){
   $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
   $dataRegion .= "', '" . $colorGraphicState[0] . "'],";
  }else{
   $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
   $dataRegion .= "', '" . $colorGraphicState[1] . "'],";
  }
  for ($i = 0; $i < count($factorRegionList); $i++) {
   if($factorRegionList[$i]->getMedia() > 0){
     $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2);
     $dataRegion .= ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '" . $colorGraphicState[0] . "'],";
   }else{
     $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2);
     $dataRegion .= ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '" . $colorGraphicState[1] . "'],";
   }
  }
  $dataRegion .= ']';
}else{
  $dataRegion = '["No data"]';
}

/**
* Grafica por pregunta
*/

$data = array(); //Array para las graficas por pregunta
$factorAnswers = array(); //Array de respuestas por pregunta para el factor.
$factorAnswerStudentsList = array(); //Array de respuestas por estudiante
$factorTotalAnswerStudents = array(); //Array del número de estudiantes para cada respuesta por pregunta.

$contextResultsController = new ContextResultsController();
$where = "factor = :factor";
$whereFields = array('factor' => $factor);
$contextResultList = $contextResultsController->displayByAction($where, $whereFields);

foreach($contextResultList as $key => $contextResult) {
  $factorAnswerStudentsList[$contextResult->getQuestion()][$contextResult->getAnswer()] = $contextResult->getTotal();
}

// ListA de preguntas que conforman el factor
$questionsController = new QuestionsController();
$where = 'factor = :factor';
$whereFields = array('factor' => $factorObject->getId());
$order = 'e.question_number';
$questionsList = $questionsController -> displayByAction($where, $whereFields, '', $order);
$questionsTotal = count($questionsList);

//Lista de respuestas para cada pregunta
$questionAnswerController = new QuestionAnswerController();
$showFields = 'e.question, e.answer, answers.name, answers.value, answers.color, answers.inverse_color, questions.question_number';
$join = ' INNER JOIN questions on questions.id = e.question
         INNER JOIN answers on answers.id = e.answer';
$where = 'questions.factor = :factor';
$whereFields = array('factor' => $factorObject->getId());
$questionAnswersList = $questionAnswerController->displayBy2Action($where, $whereFields, $join, $showFields);

//Generar array de las respuestas por estudiante
/*foreach ($factorStudentList as $factorStudentEntry) {
 $factorAnswerStudentsList[$factorStudentEntry['question']][] = $factorStudentEntry['answer'];
}*/

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
 //$factorTotalAnswerStudents[$questionNumber] = array_count_values($factorAnswerStudentsList[$questionNumber]);
 $totalStudentAnswer = array_sum($factorAnswerStudentsList[$questionNumber]);
 $slices = "";

 $data[$questionNumber] = "[";
 for ($i = 1; $i <= $totalAnswers; $i++) {
    if($factor >= 40 && $factor < 43){
      if($i == 3){
        $numAnswer = 999;
      }elseif($i > 3){
        $numAnswer = $i-1;
      }else{
        $numAnswer = $i;
      }
    }elseif($factor >= 1 && $factor <= 11){
      if($i == $totalAnswers){
        $numAnswer = 999;
      }else{
        $numAnswer = $i-1;
      }
    }else{
      if($i == $totalAnswers){
        $numAnswer = 999;
      }else{
        $numAnswer = $i;
      }
    }
    $numberFormat = number_format($factorAnswerStudentsList[$questionNumber][$numAnswer]);
    $numberNotFormat = $factorAnswerStudentsList[$questionNumber][$numAnswer];
    $factorPercent = round(($factorAnswerStudentsList[$questionNumber][$numAnswer]/$totalStudentAnswer * 100), 2);
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
    $charts = 'Sin datos';
    break;
}

$countQuest = $countQuest + 1;
}

?>
