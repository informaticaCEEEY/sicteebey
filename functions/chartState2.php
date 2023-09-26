<?php

/**
* Grafica - Media por estado
*/
if($factor < 44){
  $factorRegionController = new FactorRegionController();
  $whereRegion = "factor = :factor";
  $factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

  $factorStateController = new FactorStateController();
  $whereRegion = "factor LIKE :factor";
  $factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

  $dataRegion = array(); //Array grafica general

  if($factorObject->getTrend() == 1){
   if($factorStateList[0]->getMedia() > 0){
     $colorGraphicState = '#3AC777';
   }else{
     $colorGraphicState = '#E9F26D';
   }
  }else{
   if($factorStateList[0]->getMedia() > 0){
     $colorGraphicState = '#E9F26D';
   }else{
     $colorGraphicState = '#3AC777';
   }
  }

  // Generar formato para la grafica general

  $dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
  if($factorStateList[0]->getMedia() > 0){
   $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2);
   $dataRegion .= "', '" . $colorGraphicState . "'],";
  }else{
   $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '" . $colorGraphicState . "'],";
  }
  for ($i = 0; $i < count($factorRegionList); $i++) {
   if($factorRegionList[$i]->getMedia() > 0){
     $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2);
     $dataRegion .= ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '" . $colorGraphicState . "'],";
   }else{
     $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2);
     $dataRegion .= ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '" . $colorGraphicState . "'],";
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

// Lista de estudiantes que contestaro el factor
$factorStudentController = new FactorStudentController();
$showFields = 'e.student, e.question, e.answer';
$where = 'factor = :factor';
$whereFields = array('factor' => $factorObject->getId());
$factorStudentList = $factorStudentController -> displayBy2Action($where, $whereFields, '', '', $showFields);
$factorStudentTotal = count($factorStudentList);

// Lista de preguntas que conforman el factor
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
foreach ($factorStudentList as $factorStudentEntry) {
 $factorAnswerStudentsList[$factorStudentEntry['question']][] = $factorStudentEntry['answer'];
}
//Generar array de las respuestas por pregunta
foreach ($questionAnswersList as $questionAnswersEntry) {
 $factorAnswers[$questionAnswersEntry['question_number']][$questionAnswersEntry['value']] = $questionAnswersEntry;
}
//Generar formato para la grafica de cada pregunta
$countQuest = 1;
$textJS = "";
$chartJS = "";
$drawChartJS = "";

foreach ($questionsList as $key => $question) {
 $questionNumber = $question->getQuestionNumber();
 $totalAnswers = count($factorAnswers[$question->getQuestionNumber()]);
 $factorTotalAnswerStudents[$questionNumber] = array_count_values($factorAnswerStudentsList[$questionNumber]);
 $totalStudentAnswer = array_sum($factorTotalAnswerStudents[$questionNumber]);

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
    }else{
      if($i == $totalAnswers){
        $numAnswer = 999;
      }else{
        $numAnswer = $i;
      }
    }
   $totaltotalAnswers = $factorTotalAnswerStudents[$questionNumber][$numAnswer];
   $factorPercent = round(($factorTotalAnswerStudents[$questionNumber][$numAnswer]/$totalStudentAnswer * 100), 2);
   $funtionTooltip = "createCustomHTMLContent('" .$factorAnswers[$questionNumber][$numAnswer]['name']."', 'Frecuencia', '";
   $funtionTooltip .= $factorTotalAnswerStudents[$questionNumber][$numAnswer] . "')";
   if($factorObject->getTrend() == 1){
     $colorGraphic = $factorAnswers[$questionNumber][$numAnswer]['color'];
   }else{
     $colorGraphic = $factorAnswers[$questionNumber][$numAnswer]['inverse_color'];
   }
   $data[$questionNumber] .= "['" . $factorAnswers[$questionNumber][$numAnswer]['name'] . "'," . $totaltotalAnswers . ",'" . $factorPercent . "%', ";
   $data[$questionNumber] .=  $funtionTooltip . ", '". $colorGraphic ."'],";
   $slices .= ($i-1).": { color: '$colorGraphic', offset: 0.1}, ";
 }
 $data[$questionNumber] .= ']';

//Generar el codigo javascript necesario para las graficas
$title = $question->getTitle();
$textJS .= "var data$countQuest = $data[$questionNumber];\n\n";
$chartJS .= "google.charts.setOnLoadCallback(drawChart$countQuest);\n";
    $drawChartJS .= "
      function drawChart$countQuest() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Valor');
        data.addColumn('number', 'Frecuencia');
        data.addColumn({'type': 'string', 'role': 'annotation'});
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
        data.addColumn({'type': 'string', 'role': 'style'});
        data.addRows(data$countQuest);

        var options = {
          height : 400,
          width : 700,
          title : '$title',
          is3D: false,
      		pieStartAngle: 120,
          pieSliceText : 'none',
          legend : {
            position : 'labeled' ,
            alignment : 'end',
            textStyle : {
              fontSize : 12
            }
          },
          tooltip: {
            isHtml: true
          },
          animation : {
            startup : true,
            duration : 2500,
            easing : 'linear'
          },
          slices: {
            $slices
          },
          chartArea : {
            left : 100,
            top : 50,
            width: '70%',
            height: '70%'
          }
        };
        new google.visualization.PieChart(document.getElementById('chart$countQuest')).draw(data, options);
      }\n\n";

$countQuest = $countQuest + 1;
}

?>
