<?php

/**
 * Contexto 2015
 * Grafica - Media por estado
 *
 *
 */

$factorSchoolController = new FactorCctController();
$contextController = new ContextController();

if($yearApplication == '2015'){
    $where = 'cct LIKE :school AND factor != :factor AND factor < 12';
    $whereFields = array('school' => $school->getCct(), 'factor' => 5);
    $dataReportGeneral = $factorSchoolController->chartSchool($where, $whereFields);

    //2015-2016
    $showFields = 'e.grade';
    $join = "INNER JOIN aprov15_16 ON aprov15_16.idStudent = e.student";
    $where = "e.cct like :cct AND e.year = 2016";
    $whereFields = array('cct' => $school -> getCct());
    $idaepyStudents16 = $contextController -> displayBy2Action($where, $whereFields, $join, $showFields);

    $count_values16 = array();
    foreach ($idaepyStudents16 as $a) {
        foreach ($a as $b) {
            $count_values16[$b]++;
        }
    }

    //agrupados por $groupby
    $showFields = 'idaepy_students.grade';
    $join = "INNER JOIN idaepy_students ON idaepy_students.student = e.student";
    $where = "idaepy_students.cct like :cct AND e.year = 2016 AND idaepy_students.year = :year";
    $whereFields = array('cct' => $school -> getCct(), 'year' => $groupby);
    $idaepyStudentsX = $contextController -> displayBy2Action($where, $whereFields, $join, $showFields);

    $count_valuesX = array();
    foreach ($idaepyStudentsX as $a) {
        foreach ($a as $b) {
            $count_valuesX[$b]++;
        }
    }

    $total16 = $count_values16[3] + $count_values16[4] + $count_values16[5];
    $totalX = $count_valuesX[3] + $count_valuesX[4] + $count_valuesX[5];

    if ($count_values16[6] == '') {
        $count_values16[6] = 0;
    }

    if ($count_valuesX[6] == '') {
        $count_valuesX[6] = 0;
    }

    //2014-2015
    $join = "INNER JOIN aprov14_15 ON aprov14_15.idStudent = e.student";
    $where = "e.cct like :cct AND e.year = 2015";
    $whereFields = array('cct' => $school -> getCct());
    $idaepyStudents15 = $contextController -> countActives($where, $whereFields, $join);

    //agrupados por $groupby
    $join = "INNER JOIN idaepy_students ON idaepy_students.student = e.student";
    $where = "idaepy_students.cct like :cct AND idaepy_students.year = :year AND e.year = 2015";
    $whereFields = array('cct' => $school -> getCct(), 'year' => $groupby);
    $idaepyStudentsX = $contextController -> countActives($where, $whereFields, $join);

}elseif($yearApplication == '2017'){
    //Grafica con los factores por escuela
    $where = 'cct LIKE :school AND factor >= :factor';
    $whereFields = array('school' => $school->getCct(), 'factor' => 38);
    $dataReportGeneral = $factorSchoolController->chartSchool($where, $whereFields);

    // Programados
    $idaepyController = new IdaepyController();
    $join = 'INNER JOIN school ON school.cct = e.cct';
    $where = 'school.id = :school AND e.year = 2017 AND e.grade >= 3 AND e.type = 2';
    $whereFields = array('school' => $school->getId());
    $idaepyList = $idaepyController -> displayByAction($where, $whereFields, $join);
    $idaepyGradeTotal = array(); // Total por grado
    foreach ($idaepyList as $idaepyEntry) {
        $idaepyGradeTotal[$idaepyEntry->getGrade()] = $idaepyEntry->getTotal() + $idaepyGradeTotal[$idaepyEntry->getGrade()];
    }

    //Evaluados agrupados por el año de $groupby
    $showFields = 'idaepy_students.grade';
    $join = "INNER JOIN idaepy_students ON idaepy_students.student = e.student";
    $where = "idaepy_students.cct like :cct AND idaepy_students.year = :year AND e.year = 2017";
    $whereFields = array('cct' => $school -> getCct(), 'year' => $groupby);
    $idaepyStudentsX = $contextController -> displayBy2Action($where, $whereFields, $join, $showFields);

    $count_valuesX = array();
    foreach ($idaepyStudentsX as $a) {
        foreach ($a as $b) {
            $count_valuesX[$b]++;
        }
    }

    for($x = 3; $x <= 6; $x++){
        if($count_valuesX[$x] == ''){
            $count_valuesX[$x] == 0;
        }
    }
}

$ticks = "[-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5]";

/*
 * Contexto 2016
 *
 * Ambiente escolar
 * Interaccion Maestro-Alumno
 *  */

if($yearApplication == '2015'){

    $where = 'cct LIKE :school';
    $whereFields = array('school' => $school->getCct());

    $join = 'INNER JOIN idaepy_students on idaepy_students.student = e.student ';
    $where = 'idaepy_students.cct LIKE :school AND idaepy_students.year = :year';
    $whereFields = array('school' => $school->getCct(), 'year' => $groupby);

    $teacherInteractionController = new TeacherInteractionController();
    $teacherInteractionList = $teacherInteractionController -> displayByAction($where, $whereFields, $join);
    $teacherInteractionTotal = count($teacherInteractionList);

    $teacherInteractionArray = array();
    $teacherInteractionName = array("0" => "No", "1" => "Si", "2" => "Sin respuesta");

    $teacherInteractionQuestions = array(1 => 'Tu maestro,  \u00BFte cae bien?', 2 => 'Tu maestro,  \u00BFte trata bien?',
        3 => 'Tu maestro,  \u00BFte felicita cuando te portas bien?', 4 => 'Tu maestro,  \u00BFte felicita cuando respondes bien?',
        5 => 'Tu maestro,  \u00BFte anima para hacer la tarea?');

    foreach ($teacherInteractionList as $teacherInteraction) {
        switch($teacherInteraction->getR8_R8()) {
            case 0 :
                ++$teacherInteractionArray[1][0];
                break;
            case 1 :
                ++$teacherInteractionArray[1][1];
                break;
            case 999 :
                ++$teacherInteractionArray[1][2];
                break;
        }

        switch($teacherInteraction->getR9_R9()) {
            case 0 :
                ++$teacherInteractionArray[2][0];
                break;
            case 1 :
                ++$teacherInteractionArray[2][1];
                break;
            case 999 :
                ++$teacherInteractionArray[2][2];
                break;
        }

        switch($teacherInteraction->getR10_R12()) {
            case 0 :
                ++$teacherInteractionArray[3][0];
                break;
            case 1 :
                ++$teacherInteractionArray[3][1];
                break;
            case 999 :
                ++$teacherInteractionArray[3][2];
                break;
        }

        switch($teacherInteraction->getR11_R17()) {
            case 0 :
                ++$teacherInteractionArray[4][0];
                break;
            case 1 :
                ++$teacherInteractionArray[4][1];
                break;
            case 999 :
                ++$teacherInteractionArray[4][2];
                break;
        }

        switch($teacherInteraction->getR12_R19()) {
            case 0 :
                ++$teacherInteractionArray[5][0];
                break;
            case 1 :
                ++$teacherInteractionArray[5][1];
                break;
            case 999 :
                ++$teacherInteractionArray[5][2];
                break;
        }
    }

    /*
     *Preguntas 8 - 12
     *
     */

    $dataInteractionTeacher = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    foreach($teacherInteractionQuestions as $key => $value){

        if($teacherInteractionArray[$key][0] == ''){
            $teacherInteractionArray[$key][0] = 0;
        }
        if($teacherInteractionArray[$key][1] == ''){
            $teacherInteractionArray[$key][1] = 0;
        }
        if($teacherInteractionArray[$key][2] == ''){
            $teacherInteractionArray[$key][2] = 0;
        }

        $dataInteractionTeacher .= "['" . $teacherInteractionQuestions[$key] . "'," . $teacherInteractionArray[$key][2] . "," .
            $teacherInteractionArray[$key][0] . "," . $teacherInteractionArray[$key][1] . "],";

    }
    $dataInteractionTeacher .= ']';

    /* Ambiente escolar
     * Ambiente escolar
     *  */

    $schoolEnvironmentController = new SchoolEnvironmentController();
    $schoolEnvironmentList = $schoolEnvironmentController -> displayByAction($where, $whereFields, $join);
    $schoolEnvironmentTotal = count($schoolEnvironmentList);

    $schoolEnvironmentArray = array();
    $schoolEnvironmentName = array("0" => "No", "1" => "Si", "2" => "Sin respuesta");

    $schoolEnvironmentQuestions = array(1 => '\u00BFTe gusta ir a la escuela?', 2 => '\u00BFTienes amigos en la escuela?',
        3 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFse han burlado de ti?',
        4 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFte han golpeado?',
        5 => 'Algunos de tus compa\u00F1eros en la escuela \u00BFte han amenazado?');

    $schoolEnvironmentColor = array(0 => '#B0B0B0', 1 => '#3AC777', 2 =>'#EAD72A');

    foreach ($schoolEnvironmentList as $schoolEnvironment) {
        switch($schoolEnvironment->getR3_R3()) {
            case 0 :
                ++$schoolEnvironmentArray[1][0];
                break;
            case 1 :
                ++$schoolEnvironmentArray[1][1];
                break;
            case 999 :
                ++$schoolEnvironmentArray[1][2];
                break;
        }

        switch($schoolEnvironment->getR4_R4()) {
            case 0 :
                ++$schoolEnvironmentArray[2][0];
                break;
            case 1 :
                ++$schoolEnvironmentArray[2][1];
                break;
            case 999 :
                ++$schoolEnvironmentArray[2][2];
                break;
        }

        switch($schoolEnvironment->getR5_R5()) {
            case 0 :
                ++$schoolEnvironmentArray[3][0];
                break;
            case 1 :
                ++$schoolEnvironmentArray[3][1];
                break;
            case 999 :
                ++$schoolEnvironmentArray[3][2];
                break;
        }

        switch($schoolEnvironment->getR6_R6()) {
            case 0 :
                ++$schoolEnvironmentArray[4][0];
                break;
            case 1 :
                ++$schoolEnvironmentArray[4][1];
                break;
            case 999 :
                ++$schoolEnvironmentArray[4][2];
                break;
        }

        switch($schoolEnvironment->getR7_R7()) {
            case 0 :
                ++$schoolEnvironmentArray[5][0];
                break;
            case 1 :
                ++$schoolEnvironmentArray[5][1];
                break;
            case 999 :
                ++$schoolEnvironmentArray[5][2];
                break;
        }
    }

    /*
     *Preguntas 3 - 7
     *
     */

    $dataSchoolEnvironment1 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    $dataSchoolEnvironment2 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    foreach($schoolEnvironmentQuestions as $key => $value){

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
    }
    $dataSchoolEnvironment1 .= ']';
    $dataSchoolEnvironment2 .= ']';

    /*
     *
     * Consumo de alimentos
     *
     */

    $foodConsumptionController = new FoodConsumptionController();
    $foodConsumptionList = $foodConsumptionController -> displayByAction($where, $whereFields, $join);

    $foodConsumptionArray = array();
    $foodConsumptionName = array("0" => "Ninguno", "1" => "1", "2" => "2", "3" => "3", "4" => "4", "5" => "5", "6" => "6",
        "7" => "7", "8" => "Sin respuesta");
    $foodConsumptionQuestions = array(1 => 'Cu\u00E1ntas veces comes al d\u00EDa?', 2 => 'Frutas o verduras', 3 => 'Huevo',
        4 => 'Tortilla o pan', 5 => 'Carne (pollo, puerco o res)', 6 => 'Pescado',
        7 => 'Frituras (sabritas, chicharrones, palomitas, etc.)', 8 => 'Dulces o golosinas (chocollates, paletas, gomitas, etc.)');

    foreach ($foodConsumptionList as $foodConsumption) {
        switch($foodConsumption->getR17_R26()) {
            case 0 :
                ++$foodConsumptionArray[1][0];
                break;
            case 1 :
                ++$foodConsumptionArray[1][1];
                break;
            case 2 :
                ++$foodConsumptionArray[1][2];
                break;
            case 3 :
                ++$foodConsumptionArray[1][3];
                break;
            case 4 :
                ++$foodConsumptionArray[1][4];
                break;
            case 999 :
                ++$foodConsumptionArray[1][5];
                break;
        }

        switch($foodConsumption->getR18_R27()) {
            case 0 :
                ++$foodConsumptionArray[2][0];
                break;
            case 1 :
                ++$foodConsumptionArray[2][1];
                break;
            case 2 :
                ++$foodConsumptionArray[2][2];
                break;
            case 3 :
                ++$foodConsumptionArray[2][3];
                break;
            case 4 :
                ++$foodConsumptionArray[2][4];
                break;
            case 5 :
                ++$foodConsumptionArray[2][5];
                break;
            case 6 :
                ++$foodConsumptionArray[2][6];
                break;
            case 7 :
                ++$foodConsumptionArray[2][7];
                break;
            case 999 :
                ++$foodConsumptionArray[2][8];
                break;
        }

        switch($foodConsumption->getR19_R28()) {
            case 0 :
                ++$foodConsumptionArray[3][0];
                break;
            case 1 :
                ++$foodConsumptionArray[3][1];
                break;
            case 2 :
                ++$foodConsumptionArray[3][2];
                break;
            case 3 :
                ++$foodConsumptionArray[3][3];
                break;
            case 4 :
                ++$foodConsumptionArray[3][4];
                break;
            case 5 :
                ++$foodConsumptionArray[3][5];
                break;
            case 6 :
                ++$foodConsumptionArray[3][6];
                break;
            case 7 :
                ++$foodConsumptionArray[3][7];
                break;
            case 999 :
                ++$foodConsumptionArray[3][8];
                break;
        }

        switch($foodConsumption->getR20_R29()) {
            case 0 :
                ++$foodConsumptionArray[4][0];
                break;
            case 1 :
                ++$foodConsumptionArray[4][1];
                break;
            case 2 :
                ++$foodConsumptionArray[4][2];
                break;
            case 3 :
                ++$foodConsumptionArray[4][3];
                break;
            case 4 :
                ++$foodConsumptionArray[4][4];
                break;
            case 5 :
                ++$foodConsumptionArray[4][5];
                break;
            case 6 :
                ++$foodConsumptionArray[4][6];
                break;
            case 7 :
                ++$foodConsumptionArray[4][7];
                break;
            case 999 :
                ++$foodConsumptionArray[4][8];
                break;
        }

        switch($foodConsumption->getR21_R30()) {
            case 0 :
                ++$foodConsumptionArray[5][0];
                break;
            case 1 :
                ++$foodConsumptionArray[5][1];
                break;
            case 2 :
                ++$foodConsumptionArray[5][2];
                break;
            case 3 :
                ++$foodConsumptionArray[5][3];
                break;
            case 4 :
                ++$foodConsumptionArray[5][4];
                break;
            case 5 :
                ++$foodConsumptionArray[5][5];
                break;
            case 6 :
                ++$foodConsumptionArray[5][6];
                break;
            case 7 :
                ++$foodConsumptionArray[5][7];
                break;
            case 999 :
                ++$foodConsumptionArray[5][8];
                break;
        }

        switch($foodConsumption->getR22_R31()) {
            case 0 :
                ++$foodConsumptionArray[6][0];
                break;
            case 1 :
                ++$foodConsumptionArray[6][1];
                break;
            case 2 :
                ++$foodConsumptionArray[6][2];
                break;
            case 3 :
                ++$foodConsumptionArray[6][3];
                break;
            case 4 :
                ++$foodConsumptionArray[6][4];
                break;
            case 5 :
                ++$foodConsumptionArray[6][5];
                break;
            case 6 :
                ++$foodConsumptionArray[6][6];
                break;
            case 7 :
                ++$foodConsumptionArray[6][7];
                break;
            case 999 :
                ++$foodConsumptionArray[6][8];
                break;
        }

        switch($foodConsumption->getR23_R32()) {
            case 0 :
                ++$foodConsumptionArray[7][0];
                break;
            case 1 :
                ++$foodConsumptionArray[7][1];
                break;
            case 2 :
                ++$foodConsumptionArray[7][2];
                break;
            case 3 :
                ++$foodConsumptionArray[7][3];
                break;
            case 4 :
                ++$foodConsumptionArray[7][4];
                break;
            case 5 :
                ++$foodConsumptionArray[7][5];
                break;
            case 6 :
                ++$foodConsumptionArray[7][6];
                break;
            case 7 :
                ++$foodConsumptionArray[7][7];
                break;
            case 999 :
                ++$foodConsumptionArray[7][8];
                break;
        }

        switch($foodConsumption->getR24_R33()) {
            case 0 :
                ++$foodConsumptionArray[8][0];
                break;
            case 1 :
                ++$foodConsumptionArray[8][1];
                break;
            case 2 :
                ++$foodConsumptionArray[8][2];
                break;
            case 3 :
                ++$foodConsumptionArray[8][3];
                break;
            case 4 :
                ++$foodConsumptionArray[8][4];
                break;
            case 5 :
                ++$foodConsumptionArray[8][5];
                break;
            case 6 :
                ++$foodConsumptionArray[8][6];
                break;
            case 7 :
                ++$foodConsumptionArray[8][7];
                break;
            case 999 :
                ++$foodConsumptionArray[8][8];
                break;
        }
    }

    $foodConsumptionWeek = array();
    $foodConsumptionTotal = array();
    for ($i = 2; $i < 9; $i++) {

        for ($day = 1; $day < 8; $day++) {
            $foodConsumptionWeek[$i][$day] = $foodConsumptionArray[$i][$day] * $day;
        }

        $foodConsumptionTotal[$i] = array_sum($foodConsumptionWeek[$i]);
        /*
         *Ordenar de mayora menor
         *
         */
        arsort($foodConsumptionTotal);
    }

    /*
     *Preguntas 18 - 24
     *
     */

    $dataFoodConsumption = "[['Categoria', 'Sin respuesta', 'Ninguno', '1', '2', '3', '4', '5', '6', '7'],";
    foreach ($foodConsumptionTotal as $key => $value) {

        for($i=0; $i<9; $i++){
            if($foodConsumptionArray[$key][$i] == ''){
                $foodConsumptionArray[$key][$i] = 0;
            }
        }


        $dataFoodConsumption .= "['" . $foodConsumptionQuestions[$key] . "'," . $foodConsumptionArray[$key][8] . "," .
        $foodConsumptionArray[$key][0] . "," . $foodConsumptionArray[$key][1] . "," . $foodConsumptionArray[$key][2] . "," .
        $foodConsumptionArray[$key][3] . "
            ," . $foodConsumptionArray[$key][4] . "," . $foodConsumptionArray[$key][5] . "," . $foodConsumptionArray[$key][6] . "
            ," . $foodConsumptionArray[$key][7] . "],";
    }
    $dataFoodConsumption .= ']';

    /*
     *Pregunta 17
     *
     */

    for($i=0; $i<6; $i++){
        if($foodConsumptionArray[1][$i] == ''){
            $foodConsumptionArray[1][$i] = 0;
        }
    }

    $dataFoodConsumption1 = "[['Categoria', 'Sin respuesta', 'Ninguna', '1', '2', '3', '4 o m\u00E1s'],";
    $dataFoodConsumption1 .= "['" . $foodConsumptionQuestions[1] . "'," . $foodConsumptionArray[1][5] . "," .
        $foodConsumptionArray[1][0] . "," . $foodConsumptionArray[1][1] . "," . $foodConsumptionArray[1][2] . "," .
        $foodConsumptionArray[1][3] . "," . $foodConsumptionArray[1][4] . "],";
    $dataFoodConsumption1 .= ']';

    /*
     *Consumo de bebidas
     *
     */

    $drinksConsumptionController = new DrinksConsumptionController();
    $drinksConsumptionList = $drinksConsumptionController -> displayByAction($where, $whereFields, $join);

    $drinksConsumptionArray = array();
    $drinksConsumptionName = array("0" => "Ninguno", "1" => "1 a 2", "2" => "3 a 4", "3" => "5 a 6", "4" => "7 o m\u00E1s",
        "5" => "Sin respuesta");
    $drinksConsumptionQuestions = array(1 => 'Agua', 2 => 'Jugo de botella', 3 => 'Refrescos', 4 => 'Jugo natural', 5 => 'Leche');

    foreach ($drinksConsumptionList as $drinksConsumption) {
        switch($drinksConsumption->getR25_R34()) {
            case 0 :
                ++$drinksConsumptionArray[1][0];
                break;
            case 1 :
                ++$drinksConsumptionArray[1][1];
                break;
            case 2 :
                ++$drinksConsumptionArray[1][2];
                break;
            case 3 :
                ++$drinksConsumptionArray[1][3];
                break;
            case 4 :
                ++$drinksConsumptionArray[1][4];
                break;
            case 999 :
                ++$drinksConsumptionArray[1][5];
                break;
        }

        switch($drinksConsumption->getR26_R35()) {
            case 0 :
                ++$drinksConsumptionArray[2][0];
                break;
            case 1 :
                ++$drinksConsumptionArray[2][1];
                break;
            case 2 :
                ++$drinksConsumptionArray[2][2];
                break;
            case 3 :
                ++$drinksConsumptionArray[2][3];
                break;
            case 4 :
                ++$drinksConsumptionArray[2][4];
                break;
            case 999 :
                ++$drinksConsumptionArray[2][5];
                break;
        }

        switch($drinksConsumption->getR27_R36()) {
            case 0 :
                ++$drinksConsumptionArray[3][0];
                break;
            case 1 :
                ++$drinksConsumptionArray[3][1];
                break;
            case 2 :
                ++$drinksConsumptionArray[3][2];
                break;
            case 3 :
                ++$drinksConsumptionArray[3][3];
                break;
            case 4 :
                ++$drinksConsumptionArray[3][4];
                break;
            case 999 :
                ++$drinksConsumptionArray[3][5];
                break;
        }

        switch($drinksConsumption->getR28_R37()) {
            case 0 :
                ++$drinksConsumptionArray[4][0];
                break;
            case 1 :
                ++$drinksConsumptionArray[4][1];
                break;
            case 2 :
                ++$drinksConsumptionArray[4][2];
                break;
            case 3 :
                ++$drinksConsumptionArray[4][3];
                break;
            case 4 :
                ++$drinksConsumptionArray[4][4];
                break;
            case 999 :
                ++$drinksConsumptionArray[4][5];
                break;
        }

        switch($drinksConsumption->getR29_R38()) {
            case 0 :
                ++$drinksConsumptionArray[5][0];
                break;
            case 1 :
                ++$drinksConsumptionArray[5][1];
                break;
            case 2 :
                ++$drinksConsumptionArray[5][2];
                break;
            case 3 :
                ++$drinksConsumptionArray[5][3];
                break;
            case 4 :
                ++$drinksConsumptionArray[5][4];
                break;
            case 999 :
                ++$drinksConsumptionArray[5][5];
                break;
        }
    }

    $drinksConsumptionWeek = array();
    $drinksConsumptionTotal = array();
    $dayOfWeek = array(1 => 1, 2 => 3, 3 => 5, 4 => 7);
    for ($i = 1; $i < 6; $i++) {

        for ($day = 1; $day < 5; $day++) {
            $drinksConsumptionWeek[$i][$day] = $drinksConsumptionArray[$i][$day] * $dayOfWeek[$day];
        }

        $drinksConsumptionTotal[$i] = array_sum($drinksConsumptionWeek[$i]);

        arsort($drinksConsumptionTotal);
    }

    /*
     *Preguntas 25 - 29
     *
     */

    $dataDrinksConsumption = "[['Categoria', 'Sin respuesta', 'Ninguno', '1 a 2', '3 a 4', '5 a 6', '7 o m\u00E1s'],";
    foreach ($drinksConsumptionTotal as $key => $value) {

        for($i=0; $i<6; $i++){
            if($drinksConsumptionArray[$key][$i] == ''){
                $drinksConsumptionArray[$key][$i] = 0;
            }
        }

        $dataDrinksConsumption .= "['" . $drinksConsumptionQuestions[$key] . "'," . $drinksConsumptionArray[$key][5] . "," .
            $drinksConsumptionArray[$key][0] . "," . $drinksConsumptionArray[$key][1] . "," . $drinksConsumptionArray[$key][2] .
            "," . $drinksConsumptionArray[$key][3] . " ," . $drinksConsumptionArray[$key][4] . "],";
    }
    $dataDrinksConsumption .= ']';

    /*
     * Contexto familiar
     *
     */

    $familyContextController = new FamilyContextController();
    $familyContextList = $familyContextController -> displayByAction($where, $whereFields, $join);
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
    $affectiveEnvironmentList = $affectiveEnvironmentController -> displayByAction($where, $whereFields, $join);

    $affectiveEnvironmentArray = array();
    $affectiveEnvironmentQuestions = array(1 => 'Te abrazan', 2 => 'Te dicen que te quieren', 3 => 'Juegan contigo',
        4 => 'Te besan', 5 => 'Te dan regalos');

    $affectiveEnvironmentName1 = array("1" => "Pap\u00E1", "2" => "Mam\u00E1", "3" => "Hermanos", "4" => "Abuelos",
        "5" => "T\u00EDos", "6" => "Amigos", "7" => "Nadie", "8" => "Otro", "9" => "Sin respuesta");

    $affectiveEnvironmentName2 = array("1" => "Hablan contigo", "2" => "Te gritan", "3" => "Te golpean",
        "4" => "Te amenazan", "5" => "Te castigan", "6" => "No te corrigen", "7" => "Otro", "8" => "Sin respuesta");

    foreach ($affectiveEnvironmentList as $affectiveEnvironment) {
        switch($affectiveEnvironment->getR43_R64()) {
            case 0 :
                ++$affectiveEnvironmentArray[1][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[1][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[1][2];
                break;
        }

        switch($affectiveEnvironment->getR44_R65()) {
            case 0 :
                ++$affectiveEnvironmentArray[2][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[2][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[2][2];
                break;
        }

        switch($affectiveEnvironment->getR45_R66()) {
            case 0 :
                ++$affectiveEnvironmentArray[3][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[3][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[3][2];
                break;
        }

        switch($affectiveEnvironment->getR46_R67()) {
            case 0 :
                ++$affectiveEnvironmentArray[4][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[4][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[4][2];
                break;
        }

        switch($affectiveEnvironment->getR47_R68()) {
            case 0 :
                ++$affectiveEnvironmentArray[5][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[5][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[5][2];
                break;
        }

        switch($affectiveEnvironment->getR48_R69()) {
            case 0 :
                ++$affectiveEnvironmentArray[6][0];
                break;
            case 1 :
                ++$affectiveEnvironmentArray[6][1];
                break;
            case 999 :
                ++$affectiveEnvironmentArray[6][2];
                break;
        }

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
    $dataAffectiveEnvironment1 .= ']';

    /*
     *Preguntas 44-48
     *
     */

    $dataAffectiveEnvironment2 = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    foreach ($affectiveEnvironmentQuestions as $key => $value) {

        for($i=0; $i<3; $i++){
            if($affectiveEnvironmentArray[$key+1][$i] == ''){
                $affectiveEnvironmentArray[$key+1][$i] = 0;
            }
        }

        $dataAffectiveEnvironment2 .= "['" . $affectiveEnvironmentQuestions[$key] . "'," .
            $affectiveEnvironmentArray[$key + 1][2] . "," . $affectiveEnvironmentArray[$key + 1][0] . "," .
            $affectiveEnvironmentArray[$key + 1][1] . "],";
    }
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

    $homeworkController = new HomeworkController();
    $homeworkList = $homeworkController -> displayByAction($where, $whereFields, $join);

    $homeworkArray = array();
    $homeworkQuestions = array(1 => 'Lavar la ropa', 2 => 'Cuidar a mis hermanitos u otros familiares', 3 => 'Limpiar la casa',
        4 => 'Ayudar a cocinar', 5 => 'Ayudar en el trabajo a mis padres o familiares', "6" => "Otra");
    $homeworkName = array("0" => "No", "1" => "S\u00ED", "2" => "Sin respuesta");

    foreach ($homeworkList as $homework) {
        switch($homework->getR51_R73()) {
            case 0 :
                ++$homeworkArray[1][0];
                break;
            case 1 :
                ++$homeworkArray[1][1];
                break;
            case 999 :
                ++$homeworkArray[1][2];
                break;
        }

        switch($homework->getR52_R74()) {
            case 0 :
                ++$homeworkArray[2][0];
                break;
            case 1 :
                ++$homeworkArray[2][1];
                break;
            case 999 :
                ++$homeworkArray[2][2];
                break;
        }

        switch($homework->getR53_R75()) {
            case 0 :
                ++$homeworkArray[3][0];
                break;
            case 1 :
                ++$homeworkArray[3][1];
                break;
            case 999 :
                ++$homeworkArray[3][2];
                break;
        }

        switch($homework->getR54_R76()) {
            case 0 :
                ++$homeworkArray[4][0];
                break;
            case 1 :
                ++$homeworkArray[4][1];
                break;
            case 999 :
                ++$homeworkArray[4][2];
                break;
        }

        switch($homework->getR55_R77()) {
            case 0 :
                ++$homeworkArray[5][0];
                break;
            case 1 :
                ++$homeworkArray[5][1];
                break;
            case 999 :
                ++$homeworkArray[5][2];
                break;
        }

        switch($homework->getR56_R78()) {
            case 0 :
                ++$homeworkArray[6][0];
                break;
            case 1 :
                ++$homeworkArray[6][1];
                break;
            case 999 :
                ++$homeworkArray[6][2];
                break;
        }
    }

    /*
     *Preguntas 51-56
     *
     */

    $dataHomework = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    foreach ($homeworkQuestions as $key => $value) {

        for($i=0; $i<3; $i++){
            if($homeworkArray[$key][$i] == ''){
                $homeworkArray[$key][$i] = 0;
            }
        }

        $dataHomework .= "['" . $homeworkQuestions[$key] . "'," . $homeworkArray[$key][2] . "," . $homeworkArray[$key][0] . "," .
            $homeworkArray[$key][1] . "],";
    }
    $dataHomework .= ']';

    /*
     *
     * Lengua Maya
     *
     */

    $mayanLanguageController = new MayanLanguageController();
    $mayanLanguageList = $mayanLanguageController -> displayByAction($where, $whereFields, $join);

    $mayanLanguageArray = array();
    $mayanLanguageQuestions = array(1 => '\u00BFTus pap\u00E1s hablan maya?', 2 => '\u00BFTus abuelos hablan maya?',
        3 => '\u00BFSabes hablar maya?', 4 => '\u00BFEl maestro(a) habla en maya en el sal\u00F3n de clases?',
        5 => '\u00BFHablas en maya con tus compa\u00F1eros?');
    $mayanLanguageName = array("0" => "No", "1" => "S\u00ED", "2" => "Sin respuesta");

    foreach ($mayanLanguageList as $mayanLanguage) {
        switch($mayanLanguage->getR57_R79()) {
            case 0 :
                ++$mayanLanguageArray[1][0];
                break;
            case 1 :
                ++$mayanLanguageArray[1][1];
                break;
            case 999 :
                ++$mayanLanguageArray[1][2];
                break;
        }

        switch($mayanLanguage->getR58_R80()) {
            case 0 :
                ++$mayanLanguageArray[2][0];
                break;
            case 1 :
                ++$mayanLanguageArray[2][1];
                break;
            case 999 :
                ++$mayanLanguageArray[2][2];
                break;
        }

        switch($mayanLanguage->getR59_R81()) {
            case 0 :
                ++$mayanLanguageArray[3][0];
                break;
            case 1 :
                ++$mayanLanguageArray[3][1];
                break;
            case 999 :
                ++$mayanLanguageArray[3][2];
                break;
        }

        switch($mayanLanguage->getR60_R84()) {
            case 0 :
                ++$mayanLanguageArray[4][0];
                break;
            case 1 :
                ++$mayanLanguageArray[4][1];
                break;
            case 999 :
                ++$mayanLanguageArray[4][2];
                break;
        }

        switch($mayanLanguage->getR61_R85()) {
            case 0 :
                ++$mayanLanguageArray[5][0];
                break;
            case 1 :
                ++$mayanLanguageArray[5][1];
                break;
            case 999 :
                ++$mayanLanguageArray[5][2];
                break;
        }
    }

    /*
     *Preguntas 51-56
     *
     */

    $dataMayanLanguage = "[['Categoria', 'Sin respuesta', 'No', 'Si'],";
    foreach ($mayanLanguageQuestions as $key => $value) {

        for($i=0; $i<3; $i++){
            if($mayanLanguageArray[$key][$i] == ''){
                $mayanLanguageArray[$key][$i] = 0;
            }
        }

        $dataMayanLanguage .= "['" . $mayanLanguageQuestions[$key] . "'," . $mayanLanguageArray[$key][2] . "," .
            $mayanLanguageArray[$key][0] . "," . $mayanLanguageArray[$key][1] . "],";
    }
    $dataMayanLanguage .= ']';


    /* Alumnos IMC  */

    $join = 'INNER JOIN idaepy_students on idaepy_students.student = e.student ';
    $where = 'idaepy_students.cct LIKE :school AND idaepy_students.year = :year';
    $whereFields = array('school' => $school->getCct(), 'year' => $groupby);

    $studentsImcController = new StudentsImcController();
    $studentsImcList = $studentsImcController -> displayByAction($where, $whereFields, $join);

    $studentsIMCQuestions = array(1 => 'Niños', 2 => 'Niñas');
    $studentsIMCName = array("1" => "Muy delgado", "2" => "Delgado", "3" => "Normal", "4" => "Sobrepeso", "5" => "Obesidad");
    $studentsImcArray = array();
    foreach ($studentsImcList as $studentsImc) {
        $studentsImcArray[$studentsImc->getGender()][] = $studentsImc->getDescription();
    }

    $studentsIMCTotalGender[1] = array_count_values($studentsImcArray[1]);
    $studentsIMCTotalGender[2] = array_count_values($studentsImcArray[2]);

    $studentsIMCTotal[1]= $studentsIMCTotalGender[1][1] + $studentsIMCTotalGender[1][2] + $studentsIMCTotalGender[1][3] +
        $studentsIMCTotalGender[1][4] + $studentsIMCTotalGender[1][5] + $studentsIMCTotalGender[1][6];
    $studentsIMCTotal[2]= $studentsIMCTotalGender[2][1] + $studentsIMCTotalGender[2][2] + $studentsIMCTotalGender[2][3] +
        $studentsIMCTotalGender[2][4] + $studentsIMCTotalGender[2][5] + $studentsIMCTotalGender[2][6];

    $dataStudentsIMC = "[";
    foreach ($studentsIMCName as $key => $value) {

        if($key == 5){

            $studentsIMCArray[1][$key] = $studentsIMCTotalGender[1][5] + $studentsIMCTotalGender[1][6];
            $studentsIMCArray[2][$key] = $studentsIMCTotalGender[2][5] + $studentsIMCTotalGender[2][6];

            $studentsIMCPercent1 = round(($studentsIMCTotalGender[1][$key] / $studentsIMCTotal[1] * 100), 2);
            $studentsIMCPercent2 = round(($studentsIMCTotalGender[2][$key] / $studentsIMCTotal[2] * 100), 2);
            $funtionTooltip1 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCArray[1][$key] . "')";
            $funtionTooltip2 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCArray[2][$key] . "')";
        }else{

            $studentsIMCPercent1 = round(($studentsIMCTotalGender[1][$key] / $studentsIMCTotal[1] * 100), 2);
            $studentsIMCPercent2 = round(($studentsIMCTotalGender[2][$key] / $studentsIMCTotal[2] * 100), 2);
            $funtionTooltip1 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCTotalGender[1][$key] . "')";
            $funtionTooltip2 = "createCustomHTMLContent('" .$studentsIMCName[$key]."', 'Frecuencia', '" . $studentsIMCTotalGender[2][$key] . "')";
        }

        /*$dataStudentsIMC .= "['" . $studentsIMCName[$key] . "'," . $studentsIMCArray[1][$key] . "," .
            $studentsIMCArray[2][$key] . "],";*/
        $dataStudentsIMC .= "['" . $studentsIMCName[$key] . "'," . $studentsIMCPercent1 . ",'" . $studentsIMCPercent1 . "%', " .
            $funtionTooltip1  . ", '#E4ED47' ," . $studentsIMCPercent2 . ",'" . $studentsIMCPercent2 . "%', " .
            $funtionTooltip2 . ", '#72AD66'],";
    }
    $dataStudentsIMC .= ']';

    $healthContextController = new HealthController();
    $healthContextList = $healthContextController -> displayByAction($where, $whereFields, $join);
    $healthContextTotal = count($healthContextList);
    $healthContextName = array("1" => "Enfermedades respiratorias (gripe, tos, dolor de garganta, alergias)",
    	"2" => "Enfermedades estomacales(diarrea, vómitos, dolor de barriga)", "3" => "Calentura o fiebre.",
        "4" => "Lesiones (fracturas, golpes, accidentes)", "5" => "Operaciones", "999" => "Sin respuesta");
    $healthContextArray = array();

    foreach($healthContextList as $healthContext){
    	$healthContextArray[] = $healthContext->getR40();
    }

    $healthContextTotal = array_count_values($healthContextArray);

    $dataStudentsHealth = "[['Valor', 'Frecuencia'],";
    //for ($i = 0; $i < count($familyContextArray[1]); $i++) {
    foreach ($healthContextTotal as $key => $value) {

        if ($healthContextTotal[$key] == '') {
            $dataStudentsHealth .= "['" . $healthContextName[$key] . "'," . 0 . "],";
        } else {
            $dataStudentsHealth .= "['" . $healthContextName[$key] . "'," . $healthContextTotal[$key] . "],";
        }
    }
    $dataStudentsHealth .= ']';
?>
<script>
    var dataReportGeneral = <?php echo $dataReportGeneral; ?>;
    var dataInteractionTeacher = <?php echo $dataInteractionTeacher; ?>;
    var dataSchoolEnvironment1 = <?php echo $dataSchoolEnvironment1; ?>;
    var dataSchoolEnvironment2 = <?php echo $dataSchoolEnvironment2; ?>;
    var dataFoodConsumption1 = <?php echo $dataFoodConsumption1; ?>;
    var dataFoodConsumption = <?php echo $dataFoodConsumption; ?>;
    var dataDrinksConsumption = <?php echo $dataDrinksConsumption; ?>;
    var dataFamilyContext1 = <?php echo $dataFamilyContext1; ?>;
    var dataFamilyContext2 = <?php echo $dataFamilyContext2; ?>;
    var dataFamilyContext3 = <?php echo $dataFamilyContext3; ?>;
    var dataFamilyContext4 = <?php echo $dataFamilyContext4; ?>;
    var dataFamilyContext5 = <?php echo $dataFamilyContext5; ?>;
    var dataAffectiveEnvironment1 = <?php echo $dataAffectiveEnvironment1; ?>;
    var dataAffectiveEnvironment2 = <?php echo $dataAffectiveEnvironment2; ?>;
    var dataAffectiveEnvironment3 = <?php echo $dataAffectiveEnvironment3; ?>;
    var dataAffectiveEnvironment4 = <?php echo $dataAffectiveEnvironment4; ?>;
    var dataHomework = <?php echo $dataHomework; ?>;
    var dataMayanLanguage = <?php echo $dataMayanLanguage; ?>;
    var dataStudentsIMC = <?php echo $dataStudentsIMC; ?>;
    var dataStudentsHealth = <?php echo $dataStudentsHealth; ?>;
    var ticks = <?php echo $ticks; ?>;
</script>
<?php
}elseif($yearApplication == '2017'){
?>
<script>
    var dataReportGeneral = <?php echo $dataReportGeneral; ?>;
    var ticks = <?php echo $ticks; ?>;
</script>
<?php
}
?>
