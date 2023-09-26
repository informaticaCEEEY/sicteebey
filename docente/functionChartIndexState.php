<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$factorRegionController = new FactorRegionController();
$whereRegion = "factor = :factor";
$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

$factorStateController = new FactorStateController();
$whereState = "factor LIKE :factor";
$factorStateList = $factorStateController -> displayByAction($whereState, array('factor' => $factor));

$dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
if ($factorObject->getId() == 17 || $factorObject->getId() == 21 || $factorObject->getId() == 31 || $factorObject->getId() == 35) {
    if ($factorStateList[0] -> getMedia() > 0) {
        $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . 
            round($factorStateList[0] -> getMedia(), 2) . "', '#E9F26D'],";
    } else {
        $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . 
            round($factorStateList[0] -> getMedia(), 2) . "', '#3AC777'],";
    }

    for ($i = 0; $i < count($factorRegionList); $i++) {
        if ($factorRegionList[$i] -> getMedia() > 0) {
            $dataRegion .= "['" . $factorRegionList[$i] -> getRegionObject() -> getName() . "'," . 
                round($factorRegionList[$i] -> getMedia(), 2) . ",'" . round($factorRegionList[$i] -> getMedia(), 2) . 
                "', '#E9F26D'],";
        } else {
            $dataRegion .= "['" . $factorRegionList[$i] -> getRegionObject() -> getName() . "'," . 
                round($factorRegionList[$i] -> getMedia(), 2) . ",'" . round($factorRegionList[$i] -> getMedia(), 2) . 
                "', '#3AC777'],";
        }
    }

} else {
    if ($factorStateList[0] -> getMedia() > 0) {
        $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . 
            round($factorStateList[0] -> getMedia(), 2) . "', '#3AC777'],";
    } else {
        $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0] -> getMedia(), 2) . ",'" . 
            round($factorStateList[0] -> getMedia(), 2) . "', '#E9F26D'],";
    }

    for ($i = 0; $i < count($factorRegionList); $i++) {
        if ($factorRegionList[$i] -> getMedia() > 0) {
            $dataRegion .= "['" . $factorRegionList[$i] -> getRegionObject() -> getName() . "'," . 
                round($factorRegionList[$i] -> getMedia(), 2) . ",'" . round($factorRegionList[$i] -> getMedia(), 2) . 
                "', '#3AC777'],";
        } else {
            $dataRegion .= "['" . $factorRegionList[$i] -> getRegionObject() -> getName() . "'," . 
                round($factorRegionList[$i] -> getMedia(), 2) . ",'" . round($factorRegionList[$i] -> getMedia(), 2) . 
                "', '#E9F26D'],";
        }
    }

}
$dataRegion .= ']';

/* Graficas para preguntas */

$questionsController = new QuestionsController();
$where = "factor = :factor";
$whereFields = array('factor' => $factor);
$questionsList = $questionsController->displayByAction($where, $whereFields);
$totalQuestions = count($questionsList);

$questionsContextController = new QuestionsContextController();
$questionAnswersController = new QuestionAnswerController();
$whereQuestion = "question = :question";

$dataArray = array();
$countQuest = 1;
$textJS = "";
$chartJS = "";
$drawChartJS = "";
foreach($questionsList as $question){
            
    $whereFieldsQuestion = array('question' => $question->getId());
    $questionsContextList = $questionsContextController->displayByAction($whereQuestion, $whereFieldsQuestion);
    $questionAnswersList = $questionAnswersController->displayByAction($whereQuestion, $whereFieldsQuestion);
    
    $answerList = array();
    $answerColors = array();
    foreach($questionAnswersList as $questionAnswers){
        $answerList[$questionAnswers->getAnswerObject()->getValue()] = $questionAnswers->getAnswerObject()->getName();
        if($question->getFactor() == 17 || $question->getFactor() == 21 || $question->getFactor() == 31 || $question->getFactor() == 35){
            $answerColors[$questionAnswers->getAnswerObject()->getValue()] = $questionAnswers->getAnswerObject()->getInverseColor();
        }else{
            $answerColors[$questionAnswers->getAnswerObject()->getValue()] = $questionAnswers->getAnswerObject()->getColor();
        }
    }
    
    $questionAnswer = array();
    $totalQuestionAnswer = array();
    foreach($questionsContextList as $questionsContext){
        array_push($questionAnswer, $questionsContext->getAnswer());
    }
    $totalQuestionAnswer = array_count_values($questionAnswer);
    $totalAnswers = array_sum($totalQuestionAnswer);    
    
    $data = "[";
    foreach($answerList as $key => $answer) {
        $answerPercent = round(($totalQuestionAnswer[$key] / $totalAnswers * 100), 2);
        $funtionTooltip = "createCustomHTMLContent('" .$answer."', 'Frecuencia', '" . $totalQuestionAnswer[$key] . "')";
        $data .= "['" . $answer . "'," . $answerPercent . ",'" . $answerPercent . "%', " . 
            $funtionTooltip . ", '" . $answerColors[$key] . "'],";              
    }
    $data .= ']';
    $title = $question->getTitle();
    $textJS .= "var data$countQuest = $data\n";
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
                legend : {
                    position : 'none',
                    alignment : 'left',
                    textStyle : {
                        fontSize : 12
                    }
                },
                tooltip: {
                    isHtml: true
                },
                hAxis : {
                    title : 'Categor\u00EDa',
                    titleTextStyle : {
                        color : 'black',
                        fontSize : 14,
                        bold : true,
                        italic : false
                    }
                },
                vAxis : {
                    title : 'Porcentaje',
                    titleTextStyle : {
                        color : 'black',
                        fontSize : 14,
                        bold : true,
                        italic : false
                    },
                    ticks : [{v:0, f:'0%'}, {v:25, f:'25%'}, {v:50, f:'50%'}, {v:75, f:'75%'}, {v:100, f:'100%'}]
                },
                series : {
                    0 : {
                        type : 'bars',
                        color : '#A8FDCC',
                        annotations: {textStyle: {color: 'black' }}
                    }
                },
                animation : {
                    startup : true,
                    duration : 2500,
                    easing : 'linear'
                },
                chartArea : {
                    left : 100,
                    top : 50,
                    width: '70%', 
                    height: '70%'
                }
            };                    
            
            new google.visualization.ComboChart(document.getElementById('chart$countQuest')).draw(data, options);            
        }";
        
    $countQuest = $countQuest + 1;
    
}

?>