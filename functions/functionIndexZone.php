<?php

/**
 * Contexto 2015
 * Grafica - Media por escuela
 *
 *
 */

$factorZoneController = new FactorZoneController();
$whereZone = "zone LIKE :zone AND factor = :factor AND modality = :modality AND
    school_region = :schoolRegion";
$whereFieldsZone = array('zone' => $schoolZoneObject->getZone(),'factor' => $factor,
    'modality' => $schoolZoneObject->getMode(),
    'schoolRegion' => $schoolZoneObject->getSchoolRegion());
$factorZoneList = $factorZoneController->displayByAction($whereZone, $whereFieldsZone);

if(empty($factorZoneList)){
    $_SESSION['flash'] = 'El factor no se encuentra disponible por falta de datos';
    echo('<script>document.forms.schoolIndex.submit()</script>');
}

$factorRegionController = new FactorRegionController();
$whereRegion = "factor = :factor";
$factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

$factorStateController = new FactorStateController();
$whereState = "factor LIKE :factor";
$factorStateList = $factorStateController -> displayByAction($whereState, array('factor' => $factor));

$schoolController = new SchoolController();
$join = 'INNER JOIN factor_cct ON factor_cct.cct = e.cct
         INNER JOIN school_region_zone ON school_region_zone.id = e.school_region_zone';
$where = "school_region_zone.id = :schoolZone AND school_region_zone.level = 2 AND factor = :factor";
$whereFields = array('factor' => $factor, 'schoolZone' => $schoolZoneObject->getId());
$schoolList = $schoolController->displayByAction($where, $whereFields, $join);

$factorSchoolController = new FactorCctController();
$join = 'INNER JOIN school ON school.cct = e.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$factorSchoolList = $factorSchoolController->displayByAction($where, $whereFields, $join);

$dataReportGeneral = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
if($factorObject->getTrend() == 2){
    if($factorStateList[0]->getMedia() > 0){
        $dataReportGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" .
            round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
    }else{
        $dataReportGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" .
        round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
    }

    if($factorRegionList[0]->getMedia() > 0){
        $dataReportGeneral .= "['" . $factorRegionList[0]->getRegionObject()->getName() . "'," .
            round($factorRegionList[0]->getMedia(), 2) . ",'" . round($factorRegionList[0]->getMedia(), 2) .
            "', '#E9F26D'],";
    }else{
        $dataReportGeneral .= "['" . $factorRegionList[0]->getRegionObject()->getName() . "'," .
            round($factorRegionList[0]->getMedia(), 2) . ",'" . round($factorRegionList[0]->getMedia(), 2) .
            "', '#3AC777'],";
    }
    if($factorZoneList[0]->getMedia() != 999){
        if($factorZoneList[0]->getMedia() > 0){
            $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," .
                round($factorZoneList[0]->getMedia(), 2) . ",'" . round($factorZoneList[0]->getMedia(), 2) .
                "', '#E9F26D'],";
        }else{
            $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," .
                round($factorZoneList[0]->getMedia(), 2) . ",'" . round($factorZoneList[0]->getMedia(), 2) .
                "', '#3AC777'],";
        }
    }else{
        $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
        $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," . 0 . ",'" . $messageMediaNull . "', ''],";
    }
    $schoolNum = 0;
    foreach($factorSchoolList as $factorSchool){
        if($factorSchool->getFactorCount() != 0){
            if($factorSchool->getMedia() > 0){
                $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "'," . round($factorSchool -> getMedia(), 2)
                    . ",'" . round($factorSchool -> getMedia(), 2) . "', '#E9F26D'],";
            }else{
                $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "'," . round($factorSchool -> getMedia(), 2)
                    . ",'" . round($factorSchool -> getMedia(), 2) . "', '#3AC777'],";
            }
        }else{
            $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
            $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "', 0,'" . $messageMediaNull . "', ''],";
        }
        $schoolNum = $schoolNum + 1;
    }

}else{
    if($factorStateList[0]->getMedia() > 0){
        $dataReportGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" .
            round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
    }else{
        $dataReportGeneral .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" .
            round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
    }

    if($factorRegionList[0]->getMedia() > 0){
        $dataReportGeneral .= "['" . $factorRegionList[0]->getRegionObject()->getName() . "'," .
            round($factorRegionList[0]->getMedia(), 2) . ",'" . round($factorRegionList[0]->getMedia(), 2) .
            "', '#3AC777'],";
    }else{
        $dataReportGeneral .= "['" . $factorRegionList[0]->getRegionObject()->getName() . "'," .
            round($factorRegionList[0]->getMedia(), 2) . ",'" . round($factorRegionList[0]->getMedia(), 2) .
            "', '#E9F26D'],";
    }

    if($factorZoneList[0]->getMedia() != 999){
        if($factorZoneList[0]->getMedia() > 0){
            $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," .
                round($factorZoneList[0]->getMedia(), 2) . ",'" . round($factorZoneList[0]->getMedia(), 2) .
                "', '#3AC777'],";
        }else{
            $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," .
                round($factorZoneList[0]->getMedia(), 2) . ",'" . round($factorZoneList[0]->getMedia(), 2) .
                "', '#E9F26D'],";
        }
    }else{
        $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
        $dataReportGeneral .= "['Zona " . (str_pad($factorZoneList[0]->getZone(),  3, "0", STR_PAD_LEFT)) . "'," . 0 . ",'" . $messageMediaNull . "', ''],";
    }
    $schoolNum = 0;
    foreach($factorSchoolList as $factorSchool){
        if($factorSchool->getFactorCount() != 0){
            if($factorSchool->getMedia() > 0){
                $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "'," . round($factorSchool -> getMedia(), 2)
                    . ",'" . round($factorSchool -> getMedia(), 2) . "', '#3AC777'],";
            }else{
                $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "'," . round($factorSchool -> getMedia(), 2)
                    . ",'" . round($factorSchool -> getMedia(), 2) . "', '#E9F26D'],";
            }
        }else{
            $messageMediaNull = "La media del factor no se encuentra disponible por falta de datos.";
            $dataReportGeneral .= "['" . $schoolList[$schoolNum]->getCct() . "', 0,'" . $messageMediaNull . "', ''],";
        }
        $schoolNum = $schoolNum + 1;
    }
}
$dataReportGeneral .= ']';

/* Graficas para preguntas */

$questionsController = new QuestionsController();
$where = "factor = :factor";
$whereFields = array('factor' => $factor);
$questionsList = $questionsController->displayByAction($where, $whereFields);
$totalQuestions = count($questionsList);

$questionsContextController = new QuestionsContextController();
$questionAnswersController = new QuestionAnswerController();
$whereQuestion = "e.question = :question AND school_region_zone.id = :schoolZone AND school_region_zone.level = 2 ";
$join = 'INNER JOIN school ON school.cct = e.cct
         INNER JOIN school_region_zone ON school_region_zone.id = school.school_region_zone';
$whereAnswer = "question = :question";

$dataArray = array();
$countQuest = 1;
$textJS = "";
$chartJS = "";
$drawChartJS = "";
foreach($questionsList as $question){

    $whereFieldsQuestion = array('question' => $question->getId(), 'schoolZone' => $schoolZoneObject->getId());
    $whereFieldsAnswer = array('question' => $question->getId());
    $joinC = 'INNER JOIN answers on answers.id = e.answer';
    $showFields = 'e.id, e.question, e.answer, answers.name, answers.value, answers.color, answers.inverse_color';
    $questionsContextList = $questionsContextController->displayBy2Action($whereQuestion, $whereFieldsQuestion, $join);
    
    $questionAnswersList = $questionAnswersController->displayBy2Action($whereAnswer, $whereFieldsAnswer, $joinC, $showFields);

    $answerList = array();
    $answerColors = array();
    foreach($questionAnswersList as $questionAnswers){
        $answerList[$questionAnswers['value']] = $questionAnswers['name'];
        if($question->getFactor() == 17 || $question->getFactor() == 21 || $question->getFactor() == 31 || $question->getFactor() == 35){
            $answerColors[$questionAnswers['value']] = $questionAnswers['inverse_color'];
        }else{
            $answerColors[$questionAnswers['value']] = $questionAnswers['color'];
        }
    }

    $questionAnswer = array();
    $totalQuestionAnswer = array();
    foreach($questionsContextList as $questionsContext){
        array_push($questionAnswer, $questionsContext['answer']);
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
