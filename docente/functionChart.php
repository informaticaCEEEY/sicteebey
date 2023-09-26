<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 * 
 * 
 */

$factorStateController = new FactorStateController();
$where = 'factor != :factor AND factor < 12';
$dataReportGeneral = $factorStateController->chartState($where);
$ticks = "[-3, -2, -1, 0, 1, 2, 3]";

/*
 * Contexto 2016
 *
 * Ambiente escolar
 * Interaccion Maestro-Alumno
 *  */
  
$contextStateController = new ContextStateController();
$contextStateList = $contextStateController->getEntityByAction('category', '2');

$teacherInteractionArray = array();
$teacherInteractionName = array("0" => "No", "1" => "Si", "999" => "Sin respuesta");

$teacherInteractionQuestions = array(6 => 'Tu maestro,  \u00BFte cae bien?', 7 => 'Tu maestro,  \u00BFte trata bien?', 
    8 => 'Tu maestro,  \u00BFte felicita cuando te portas bien?', 9 => 'Tu maestro,  \u00BFte felicita cuando respondes bien?', 
    10 => 'Tu maestro,  \u00BFte anima para hacer la tarea?');

/*
 *Preguntas 8 - 12
 *
 */
foreach($contextStateList as $contextState){
    foreach($teacherInteractionName as $key => $value){
        if($key == $contextState->getAnswer()){
            $teacherInteractionArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }     
}
$dataInteractionTeacher = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
foreach($teacherInteractionQuestions as $key => $value){
    $dataInteractionTeacher .= "['" . $teacherInteractionQuestions[$key] . "'," . $teacherInteractionArray[$key][999] . "," . 
        $teacherInteractionArray[$key][0] . "," . $teacherInteractionArray[$key][1] . "],";
}
$dataInteractionTeacher .= '    ]';

/* Ambiente escolar
 * Ambiente escolar
 *  */

$contextStateList = $contextStateController->getEntityByAction('category', '1');

$schoolEnvironmentArray = array();
$schoolEnvironmentName = array("0" => "No", "1" => "Si", "999" => "Sin respuesta");

$schoolEnvironmentQuestions = array(1 => '\u00BFTe gusta ir a la escuela?', 2 => '\u00BFTienes amigos en la escuela?', 
    3 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFse han burlado de ti?', 
    4 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFte han golpeado?', 
    5 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFte han amenazado?');
    
$schoolEnvironmentColor = array(0 => '#B0B0B0', 1 => '#3AC777', 2 =>'#EAD72A');
/*
 *Preguntas 3 - 7
 *
 */
 
foreach($contextStateList as $contextState){
    foreach($schoolEnvironmentName as $key => $value){
        if($key == $contextState->getAnswer()){
            $schoolEnvironmentArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }     
}

$dataSchoolEnvironment1 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
$dataSchoolEnvironment2 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
foreach($schoolEnvironmentQuestions as $key => $value){
    if($key < 3){
        $dataSchoolEnvironment1 .= "['" . $schoolEnvironmentQuestions[$key] . "'," . $schoolEnvironmentArray[$key][999] . "," . 
            $schoolEnvironmentArray[$key][0] . "," . $schoolEnvironmentArray[$key][1] . "],";     
    }else{
        $dataSchoolEnvironment2 .= "['" . $schoolEnvironmentQuestions[$key] . "'," . $schoolEnvironmentArray[$key][999] . "," . 
            $schoolEnvironmentArray[$key][0] . "," . $schoolEnvironmentArray[$key][1] . "],";     
    }
   
}

/*foreach($schoolEnvironmentQuestions as $key => $value){
    
    for($i=0; $i<3; $i++){
        if($schoolEnvironmentArray[$key][$i] == ''){
            $schoolEnvironmentArray[$key][$i] = 0;
        }
    }
    
    if($key < 3){
        $dataSchoolEnvironment1 .= "['" . $schoolEnvironmentQuestions[$key] . "'," . $schoolEnvironmentArray[$key][2] . ", " . 
            $schoolEnvironmentArray[$key][0] . ", " . $schoolEnvironmentArray[$key][1] . "],";
    }else{
        $dataSchoolEnvironment2 .= "['" . $schoolEnvironmentQuestions[$key] . "'," . $schoolEnvironmentArray[$key][2] . ", " . 
            $schoolEnvironmentArray[$key][0] . ", " . $schoolEnvironmentArray[$key][1] . "],"; 
    }
}*/
$dataSchoolEnvironment1 .= ']';
$dataSchoolEnvironment2 .= ']';


/*
 *
 * Consumo de alimentos
 *
 */

$contextStateList = $contextStateController->getEntityByAction('category', '3');

$foodConsumptionArray = array();
$foodConsumptionArray1 = array();
$foodConsumptionName = array("0" => "Ninguno", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6", 
    "7" => "7", "999" => "Sin respuesta");
$foodConsumptionName1 = array("0" => "Ninguno", "1" => "1", "2" => "2", "3" => "3", "4" => "4 o m\u00E1s",
    "999" => "Sin respuesta");
$foodConsumptionQuestions = array(11 => 'Cu\u00E1ntas veces comes al d\u00EDa?', 14 => 'Tortilla o pan', 
    12 => 'Frutas o verduras', 15 => 'Carne (pollo, puerco o res)', 17 => 'Frituras (sabritas, chicharrones, palomitas, etc.)', 
    18 => 'Dulces o golosinas (chocollates, paletas, gomitas, etc.)', 13 => 'Huevo', 16 => 'Pescado');


$foodConsumptionWeek = array();
$foodConsumptionTotal = array();

foreach($contextStateList as $contextState){
    foreach($foodConsumptionName as $key => $value){
        if($key == $contextState->getAnswer() && $contextState->getQuestion() > 11){
            $foodConsumptionArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }    
}

foreach($contextStateList as $contextState){
    foreach($foodConsumptionName1 as $key => $value){
        if($key == $contextState->getAnswer() && $contextState->getQuestion() == 11){
            $foodConsumptionArray1[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }    
}

/*
 *Preguntas 18 - 24
 *
 */
$dataFoodConsumption = "[['Categoria', 'Sin respuesta', 'Ninguno', '1', '2', '3', '4', '5', '6', '7'],";
$dataFoodConsumption1 = "[['Categoria', 'Sin respuesta', 'Ninguna', '1', '2', '3', '4 o m\u00E1s'],";
foreach($foodConsumptionQuestions as $key => $value){
    if($key < 12){
        $dataFoodConsumption1 .= "['" . $foodConsumptionQuestions[$key] . "'," . $foodConsumptionArray1[$key][999] . "," . 
            $foodConsumptionArray1[$key][0] . "," . $foodConsumptionArray1[$key][1] . "," . $foodConsumptionArray1[$key][2] . "," . 
            $foodConsumptionArray1[$key][3] . "," . $foodConsumptionArray1[$key][4] . "],";    
    }else{
        $dataFoodConsumption .= "['" . $foodConsumptionQuestions[$key] . "'," . $foodConsumptionArray[$key][999] . "," . 
            $foodConsumptionArray[$key][0] . "," . $foodConsumptionArray[$key][1] . "," . $foodConsumptionArray[$key][2] . "," . 
            $foodConsumptionArray[$key][3] . " ," . $foodConsumptionArray[$key][4] . "," . $foodConsumptionArray[$key][5] . 
            "," . $foodConsumptionArray[$key][6] . " ," . $foodConsumptionArray[$key][7] . "],";
    }
   
}
$dataFoodConsumption .= ']';
$dataFoodConsumption1 .= ']';


/*
 *Consumo de bebidas
 *
 */

$contextStateList = $contextStateController->getEntityByAction('category', '4');

$drinksConsumptionArray = array();
$drinksConsumptionName = array("0" => "Ninguno", "1" => "1 a 2", "2" => "3 a 4", "3" => "5 a 6", "4" => "7 o m\u00E1s", 
    "999" => "Sin respuesta");
$drinksConsumptionQuestions = array(19 => 'Agua', 22 => 'Jugo natural', 23 => 'Leche', 21 => 'Refrescos', 20 => 'Jugo de botella');

foreach($contextStateList as $contextState){
    foreach($drinksConsumptionName as $key => $value){
        if($key == $contextState->getAnswer()){
            $drinksConsumptionArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }    
}

/*
 *Preguntas 25 - 29
 *
 */

$dataDrinksConsumption = "[['Categoria', 'Sin respuesta', 'Ninguno', '1 a 2', '3 a 4', '5 a 6', '7 o m\u00E1s'],";
foreach ($drinksConsumptionQuestions as $key => $value) { 
    $dataDrinksConsumption .= "['" . $drinksConsumptionQuestions[$key] . "'," . $drinksConsumptionArray[$key][999] . "," . 
        $drinksConsumptionArray[$key][0] . "," . $drinksConsumptionArray[$key][1] . "," . $drinksConsumptionArray[$key][2] . 
        "," . $drinksConsumptionArray[$key][3] . " ," . $drinksConsumptionArray[$key][4] . "],";
}
$dataDrinksConsumption .= ']';

/*
 * Contexto familiar
 *
 */

$familyContextController = new FamilyContextController();
$familyContextList = $familyContextController -> displayAction();
$familyContextTotal = count($familyContextList);

$familyContextName1 = array("0" => "Pap\u00E1 y mam\u00E1", "1" => "Solo pap\u00E1", "2" => "Solo mam\u00E1", 
    "3" => "Con otros familiares (abuelos, t\u00EDos)", "4" => "Sin respuesta");

$familyContextName2 = array("0" => "Nadie", "1" => "Mam\u00E1", "2" => "Pap\u00E1", "3" => "Abuelo(a)", 
    "4" => "Hermanos(as)", "5" => "T\u00EDo(a)", "6" => "Otro", "7" => "Sin respuesta");

$familyContextName3 = array("0" => "No", "1" => "S\u00ED", "2" => "Sin respuesta");

$familyContextName4 = array("0" => "Con alg\u00FAn familiar", "1" => "Con alguien que no es de mi familia", 
    "2" => "Sin respuesta");

$familyContextName5 = array("1" => "Auto", "2" => "Bicicleta o triciclo", "3" => "Transporte publico (cami\u00F3n o combi)", 
    "4" => "Caminando", "5" => "Sin respuesta");

$familyContextArray = array();

foreach ($familyContextList as $familyContext) {
    switch($familyContext->getR13_R20()) {
        case 0 :
            ++$familyContextArray[1][0];
            break;
        case 1 :
            ++$familyContextArray[1][1];
            break;
        case 2 :
            ++$familyContextArray[1][2];
            break;
        case 3 :
            ++$familyContextArray[1][3];
            break;
        case 999 :
            ++$familyContextArray[1][4];
            break;
    }

    switch($familyContext->getR14_R21()) {
        case 0 :
            ++$familyContextArray[2][0];
            break;
        case 1 :
            ++$familyContextArray[2][1];
            break;
        case 2 :
            ++$familyContextArray[2][2];
            break;
        case 3 :
            ++$familyContextArray[2][3];
            break;
        case 4 :
            ++$familyContextArray[2][4];
            break;
        case 5 :
            ++$familyContextArray[2][5];
            break;
        case 6 :
            ++$familyContextArray[2][6];
            break;
        case 999 :
            ++$familyContextArray[2][7];
            break;
    }

    switch($familyContext->getR15_R24()) {
        case 0 :
            ++$familyContextArray[3][0];
            break;
        case 1 :
            ++$familyContextArray[3][1];
            break;
        case 999 :
            ++$familyContextArray[3][2];
            break;
    }

    if ($familyContext -> getR15_R24() == 1) {
        switch($familyContext->getR16_R25()) {
            case 0 :
                ++$familyContextArray[4][0];
                break;
            case 1 :
                ++$familyContextArray[4][1];
                break;
            case 999 :
                ++$familyContextArray[4][2];
                break;
        }
    }

    switch($familyContext->getR40_R62()) {
        case 1 :
            ++$familyContextArray[5][1];
            break;
        case 2 :
            ++$familyContextArray[5][2];
            break;
        case 3 :
            ++$familyContextArray[5][3];
            break;
        case 4 :
            ++$familyContextArray[5][4];
            break;
        case 999 :
            ++$familyContextArray[5][5];
            break;
    }
}

/*
 *Ordenar de mayora menor
 *
 */

arsort($familyContextArray[1]);
arsort($familyContextArray[2]);
arsort($familyContextArray[3]);
arsort($familyContextArray[4]);
arsort($familyContextArray[5]);

/*
 *Pregunta 13
 *
 */

$dataFamilyContext1 = "[['Valor', 'Frecuencia'],";
//for ($i = 0; $i < count($familyContextArray[1]); $i++) {
foreach ($familyContextArray[1] as $key => $value) {
    
    if ($familyContextArray[1][$key] == '') {
        $dataFamilyContext1 .= "['" . $familyContextName1[$key] . "'," . 0 . "],";
    } else {
        $dataFamilyContext1 .= "['" . $familyContextName1[$key] . "'," . $familyContextArray[1][$key] . "],";
    }
}
$dataFamilyContext1 .= ']';
/*
 *Pregunta 14
 *
 */

$dataFamilyContext2 = "[['Valor', 'Frecuencia'],";
foreach ($familyContextArray[2] as $key => $value) {
    
    if ($familyContextArray[2][$key] == '') {
        $dataFamilyContext2 .= "['" . $familyContextName2[$key] . "'," . 0 . "],";
    } else {
        $dataFamilyContext2 .= "['" . $familyContextName2[$key] . "'," . $familyContextArray[2][$key] . "],";
    }
}
$dataFamilyContext2 .= ']';

/*
 *Pregunta 15
 *
 */

 
if($familyContextArray[3][0] == ''){
    $familyContextArray[3][0] = 0;
}
if($familyContextArray[3][1] == ''){
    $familyContextArray[3][1] = 0;
}
if($familyContextArray[3][2] == ''){
    $familyContextArray[3][2] = 0;
}
 
$dataFamilyContext3 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
$dataFamilyContext3 .= "['" . '\u00BFTu trabajas?' . "'," . $familyContextArray[3][2] . "," . $familyContextArray[3][0] . 
    "," . $familyContextArray[3][1] . "]";
$dataFamilyContext3 .= ']';

/*
 *Pregunta 16
 *
 */

 
if(empty($familyContextArray[4])){
    $dataFamilyContext4 = "[['Valor', 'Frecuencia', { role: 'style' }],";
    foreach ($familyContextName4 as $key => $value) {
        if($key == 2){
            $dataFamilyContext4 .= "['" . $familyContextName4[$key] . "'," . $familyContextTotal . ", '#B0B0B0'],";   
        }else{
            $dataFamilyContext4 .= "['" . $familyContextName4[$key] . "', 0, '#B0B0B0'],";
        }
    }    
    $dataFamilyContext4 .= ']';
}else{
    $dataFamilyContext4 = "[['Valor', 'Frecuencia'],";
    foreach ($familyContextArray[4] as $key => $value) {
        if ($familyContextArray[4][$key] == '') {
            $dataFamilyContext4 .= "['" . $familyContextName4[$key] . "'," . 0 . "],";
        } else {
            $dataFamilyContext4 .= "['" . $familyContextName4[$key] . "'," . $familyContextArray[4][$key] . "],";
        }
    }
    $dataFamilyContext4 .= ']';
}

/*
 *Pregunta 40
 *
 */

$dataFamilyContext5 = "[['Valor', 'Frecuencia'],";
//for ($i = 0; $i < count($familyContextArray[1]); $i++) {
foreach ($familyContextArray[5] as $key => $value) {
    if ($familyContextArray[5][$key] == '') {
        $dataFamilyContext5 .= "['" . $familyContextName5[$key] . "'," . 0 . "],";
    } else {
        $dataFamilyContext5 .= "['" . $familyContextName5[$key] . "'," . $familyContextArray[5][$key] . "],";
    }
}
$dataFamilyContext5 .= ']';

/*
 *
 * Ambiente afectivo
 *
 */

$affectiveEnvironmentController = new AffectiveEnvironmentController();
$affectiveEnvironmentList = $affectiveEnvironmentController -> displayAction();
$contextStateList = $contextStateController->getEntityByAction('category', '6');

$affectiveEnvironmentArray = array();
$affectiveEnvironmentQuestions = array(29 => '\u00BFTe sientes a gusto en casa?', 30 => 'Te abrazan', 
    31 => 'Te dicen que te quieren', 32 => 'Juegan contigo', 33 => 'Te besan', 34 => 'Te dan regalos');

$affectiveEnvironmentName1 = array("1" => "Pap\u00E1", "2" => "Mam\u00E1", "3" => "Hermanos", "4" => "Abuelos", 
    "5" => "T\u00EDos", "6" => "Amigos", "7" => "Nadie", "8" => "Otro", "9" => "Sin respuesta");

$affectiveEnvironmentName2 = array("1" => "Hablan contigo", "2" => "Te gritan", "3" => "Te golpean", 
    "4" => "Te amenazan", "5" => "Te castigan", "6" => "No te corrigen", "7" => "Otro", "8" => "Sin respuesta");
    
$affectiveEnvironmentName = array("0" => "No", "1" => "S\u00ED", "999" => "Sin respuesta");

foreach ($affectiveEnvironmentList as $affectiveEnvironment) {
    switch($affectiveEnvironment->getR49_R71()) {
        case 1 :
            ++$affectiveEnvironmentArray[7][1];
            break;
        case 2 :
            ++$affectiveEnvironmentArray[7][2];
            break;
        case 3 :
            ++$affectiveEnvironmentArray[7][3];
            break;
        case 4 :
            ++$affectiveEnvironmentArray[7][4];
            break;
        case 5 :
            ++$affectiveEnvironmentArray[7][5];
            break;
        case 6 :
            ++$affectiveEnvironmentArray[7][6];
            break;
        case 7 :
            ++$affectiveEnvironmentArray[7][7];
            break;
        case 8 :
            ++$affectiveEnvironmentArray[7][8];
            break;
        case 999 :
            ++$affectiveEnvironmentArray[7][9];
            break;
    }

    switch($affectiveEnvironment->getR50_R72()) {
        case 1 :
            ++$affectiveEnvironmentArray[8][1];
            break;
        case 2 :
            ++$affectiveEnvironmentArray[8][2];
            break;
        case 3 :
            ++$affectiveEnvironmentArray[8][3];
            break;
        case 4 :
            ++$affectiveEnvironmentArray[8][4];
            break;
        case 5 :
            ++$affectiveEnvironmentArray[8][5];
            break;
        case 6 :
            ++$affectiveEnvironmentArray[8][6];
            break;
        case 7 :
            ++$affectiveEnvironmentArray[8][7];
            break;
        case 999 :
            ++$affectiveEnvironmentArray[8][8];
            break;
    }
}

/*
 *Ordenar de mayora menor
 *
 */

arsort($affectiveEnvironmentArray[7]);
arsort($affectiveEnvironmentArray[8]);

/*
 *Pregunta 43
 *
 */
 /*
if($affectiveEnvironmentArray[1][0] == ''){
    $affectiveEnvironmentArray[1][0] = 0;
}
if($affectiveEnvironmentArray[1][1] == ''){
    $affectiveEnvironmentArray[1][1] = 0;
}
if($affectiveEnvironmentArray[1][2] == ''){
    $affectiveEnvironmentArray[1][2] = 0;
}
$dataAffectiveEnvironment1 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
$dataAffectiveEnvironment1 .= "['" . '\u00BFTe sientes a gusto en casa?' . "'," . $affectiveEnvironmentArray[1][2] . "," . 
    $affectiveEnvironmentArray[1][0] . "," . $affectiveEnvironmentArray[1][1] . "]";
$dataAffectiveEnvironment1 .= ']';*/

foreach($contextStateList as $contextState){
    foreach($affectiveEnvironmentName as $key => $value){
        if($key == $contextState->getAnswer()){
            $affectiveEnvironmentArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }     
}

/*
 *Preguntas 44-48
 *
 */

$dataAffectiveEnvironment1 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
$dataAffectiveEnvironment2 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
foreach ($affectiveEnvironmentQuestions as $key => $value) {
    if($key == 29){
        $dataAffectiveEnvironment1 .= "['" . $affectiveEnvironmentQuestions[$key] . "'," . 
            $affectiveEnvironmentArray[$key][999] . "," . $affectiveEnvironmentArray[$key][0] . "," . 
            $affectiveEnvironmentArray[$key][1] . "],";   
    }else{
        $dataAffectiveEnvironment2 .= "['" . $affectiveEnvironmentQuestions[$key] . "'," . 
            $affectiveEnvironmentArray[$key][999] . "," . $affectiveEnvironmentArray[$key][0] . "," . 
            $affectiveEnvironmentArray[$key][1] . "],";   
    }
}
$dataAffectiveEnvironment1 .= ']';
$dataAffectiveEnvironment2 .= ']';

/*
 *Pregunta 49
 *
 */

$dataAffectiveEnvironment3 = "[['Valor', 'Frecuencia'],";
//for ($i = 0; $i < count($familyContextArray[1]); $i++) {
foreach ($affectiveEnvironmentArray[7] as $key => $value) {
    if ($affectiveEnvironmentArray[7][$key] == '') {
        $dataAffectiveEnvironment3 .= "['" . $affectiveEnvironmentName1[$key] . "'," . 0 . "],";
    } else {
        $dataAffectiveEnvironment3 .= "['" . $affectiveEnvironmentName1[$key] . "'," . $affectiveEnvironmentArray[7][$key] . "],";
    }
}
$dataAffectiveEnvironment3 .= ']';

/*
 *Pregunta 50
 *
 */

$dataAffectiveEnvironment4 = "[['Valor', 'Frecuencia'],";
//for ($i = 0; $i < count($familyContextArray[1]); $i++) {
foreach ($affectiveEnvironmentArray[8] as $key => $value) {
    if ($affectiveEnvironmentArray[8][$key] == '') {
        $dataAffectiveEnvironment4 .= "['" . $affectiveEnvironmentName2[$key] . "'," . 0 . "],";
    } else {
        $dataAffectiveEnvironment4 .= "['" . $affectiveEnvironmentName2[$key] . "'," . $affectiveEnvironmentArray[8][$key] . "],";
    }
}
$dataAffectiveEnvironment4 .= ']';

/*
 *
 * Responsabilidades de la casa
 *
 */

$contextStateList = $contextStateController->getEntityByAction('category', '7');

$homeworkArray = array();
$homeworkQuestions = array(37 => 'Lavar la ropa', 38 => 'Cuidar a mis hermanitos u otros familiares', 39 => 'Limpiar la casa', 
    40 => 'Ayudar a cocinar', 41 => 'Ayudar en el trabajo a mis padres o familiares', 42 => "Otra");
$homeworkName = array("0" => "No", "1" => "S\u00ED", "999" => "Sin respuesta");

foreach($contextStateList as $contextState){
    foreach($homeworkName as $key => $value){
        if($key == $contextState->getAnswer()){
            $homeworkArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }     
}
/*
 *Preguntas 51-56
 *
 */

$dataHomework = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
foreach ($homeworkQuestions as $key => $value) {
    
    $dataHomework .= "['" . $homeworkQuestions[$key] . "'," . $homeworkArray[$key][999] . "," . $homeworkArray[$key][0] . "," . 
        $homeworkArray[$key][1] . "],";
}
$dataHomework .= ']';

/*
 *
 * Lengua Maya
 *
 */

$contextStateList = $contextStateController->getEntityByAction('category', '8');

$mayanLanguageArray = array();
$mayanLanguageQuestions = array(43 => '\u00BFTus pap\u00E1s hablan maya?', 44 => '\u00BFTus abuelos hablan maya?', 
    45 => '\u00BFSabes hablar maya?', 46 => '\u00BFEl maestro(a) habla en maya en el sal\u00F3n de clases?', 
    47 => '\u00BFHablas en maya con tus compa\u00F1eros?');
$mayanLanguageName = array("0" => "No", "1" => "S\u00ED", "999" => "Sin respuesta");

foreach($contextStateList as $contextState){
    foreach($mayanLanguageName as $key => $value){
        if($key == $contextState->getAnswer()){
            $mayanLanguageArray[$contextState->getQuestion()][$key] = $contextState->getTotal();   
        }           
    }     
}
/*
 *Preguntas 51-56
 *
 */

$dataMayanLanguage = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
foreach ($mayanLanguageQuestions as $key => $value) {
    
    $dataMayanLanguage .= "['" . $mayanLanguageQuestions[$key] . "'," . $mayanLanguageArray[$key][999] . "," . 
        $mayanLanguageArray[$key][0] . "," . $mayanLanguageArray[$key][1] . "],";
}
$dataMayanLanguage .= ']';


/*
 *
 * Alumnos IMC
 *
 */

$contextStateList = $contextStateController->getEntityByAction('category', '9');
$studentsIMCArray = array();
$studentsIMCQuestions = array(1 => 'Niños', 2 => 'Niñas');
$studentsIMCName = array("1" => "Muy delgado", "2" => "Delgado", "3" => "Normal", "4" => "Sobrepeso", "5" => "Obesidad");
$studentsIMCTotal = array();

foreach($contextStateList as $contextState){
    if($contextState->getAnswer() == 5 || $contextState->getAnswer() == 6){
        $studentsIMCArray[$contextState->getQuestion()][5] = $contextState->getTotal() + $studentsIMCArray[$contextState->getQuestion()][5];   
    }else{
        $studentsIMCArray[$contextState->getQuestion()][$contextState->getAnswer()] = $contextState->getTotal();
    }
    if($contextState->getAnswer() == 5 || $contextState->getAnswer() == 6){
        $studentsIMCTotal[5] = $studentsIMCTotal[5] + $contextState->getTotal();
    }else{
        $studentsIMCTotal[$contextState->getAnswer()] = $studentsIMCTotal[$contextState->getAnswer()] + $contextState->getTotal();
    }    
}

$dataStudentsIMC = "[";
foreach ($studentsIMCName as $key => $value) {
    $studentsIMCPercent1 = round(($studentsIMCArray[1][$key] / $studentsIMCTotal[$key] * 100), 2);
    $studentsIMCPercent2 = round(($studentsIMCArray[2][$key] / $studentsIMCTotal[$key] * 100), 2);
    $funtionTooltip1 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCArray[1][$key] . "')";
    $funtionTooltip2 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCArray[2][$key] . "')";
    /*$dataStudentsIMC .= "['" . $studentsIMCName[$key] . "'," . $studentsIMCArray[1][$key] . "," . 
        $studentsIMCArray[2][$key] . "],";*/
    $dataStudentsIMC .= "['" . $studentsIMCName[$key] . "'," . $studentsIMCPercent1 . ",'" . $studentsIMCPercent1 . "%', " . 
        $funtionTooltip1  . ", '#E4ED47' ," . $studentsIMCPercent2 . ",'" . $studentsIMCPercent2 . "%', " . 
        $funtionTooltip2 . ", '#62ED47'],";
}
$dataStudentsIMC .= ']';
?>