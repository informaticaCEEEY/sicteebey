<?php
require ('../checkSession.php');

if (!isset($_POST['factor'])) {
    echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
} else {
    // Obtiene el objeto cohorte
    extract($_POST);
    $controller = new FactorController();
    $factorObject = $controller -> getEntityAction($factor);
}

if (!$factorObject) {
    echo('<form name="valid" id="valid" action="index.php" method="post"></form>');
    echo('<script>document.forms.valid.submit()</script>');
}
?>
<!doctype html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- html5.js for IE less than 9 -->
        <!--[if lt IE 9]>
        <script
        src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="Author" content="">
        <meta name="description" content="">
        <meta name="keywords" content="">
        <title>Cuestionarios de Contexto</title>
        <!--link href="../css/screen.../css" rel="stylesheet" type="text/../css" /-->
        <!--link rel="stylesheet" href="../css/jquery-ui-1.8.4.custom.../css" type="text/../css"/-->
        <link rel="icon" href="../img/favicon_.png">
        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/buttonTop.css" rel="stylesheet">
        <link href="../css/header.css" rel="stylesheet">
        <link href="../css/footer.css" rel="stylesheet">
        <!--link href="../css/jquery-confirm.../css" rel="stylesheet" type="text/../css"  /-->
        <script src="../lib/jquery/jquery.min.js"></script>
        <script src="../lib/bootstrap/bootstrap.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <link rel="stylesheet" href="../css/chart.css">
        <link rel="stylesheet" href="../css/factorTable.css">
        <link rel="stylesheet" href="../css/description.css">
    </head>
    <body>
        <?php
        include ('header.php');
 ?>
        <div class="container-fluid">
          <form role="form" name="backPage" id="backPage" action="context.php" method="post" accept-charset="UTF-8">
            <input type="hidden" id="year" name="year" value="<?php echo($factorObject->getYearApplication()); ?>"/>
          </form>
          <button class="buttonBack" type="button" onclick="document.forms.backPage.submit()"><span>Regresar</span></button>
          <div class='text-center'>
              <h2 class='form-signin-heading'><?php echo $factorObject->getName() ?></h2>
          </div>
          <hr />
          <?php

          $collaborativeWorkController = new CollaborativeWorkController();
          $collaborativeWorkList = $collaborativeWorkController -> display2Action();
          $collaborativeWorkTotal = count($collaborativeWorkList);

          $factorRegionController = new FactorRegionController();
          $whereRegion = "factor = :factor";
          $factorRegionList = $factorRegionController -> displayByAction($whereRegion, array('factor' => $factor));

          $factorStateController = new FactorStateController();
          $whereRegion = "factor LIKE :factor";
          $factorStateList = $factorStateController -> displayByAction($whereRegion, array('factor' => $factor));

          $collaborativeWorkArray1 = array();
          $collaborativeWorkArray2 = array();
          $collaborativeWorkArray3 = array();
          $collaborativeWorkArray4 = array();
          $collaborativeWorkName1 = array("1" => "Nunca o casi nunca", "2" => "Algunas veces", "3" => "Siempre o casi siempre", "999" => "Sin respuesta");
          $colorGraphic = array("1" => "#F04747", "2" => "#E9F26D", "3" => "#3AC777", "999" => "#B0B0B0");
          $collaborativeWorkListAnswers = array();

          foreach ($collaborativeWorkList as $collaborativeWorkEntry) {
              $collaborativeWorkListAnswers['P01'][] = $collaborativeWorkEntry['P01'];
              $collaborativeWorkListAnswers['P02'][] = $collaborativeWorkEntry['P02'];
              $collaborativeWorkListAnswers['P03'][] = $collaborativeWorkEntry['P03'];
              $collaborativeWorkListAnswers['P04'][] = $collaborativeWorkEntry['P04'];
          }



          $collaborativeWorkTotalAnswers[1] = array_count_values($collaborativeWorkListAnswers['P01']);
          $collaborativeWorkTotalAnswers[2] = array_count_values($collaborativeWorkListAnswers['P02']);
          $collaborativeWorkTotalAnswers[3] = array_count_values($collaborativeWorkListAnswers['P03']);
          $collaborativeWorkTotalAnswers[4] = array_count_values($collaborativeWorkListAnswers['P04']);

          $data1 = "[";
          for ($i = 1; $i <= count($collaborativeWorkName1); $i++) {
              if($i == count($collaborativeWorkName1)){
                  $i = 999;
              }
              $collaborativeWorkPercent1 = round(($collaborativeWorkTotalAnswers[1][$i] / $collaborativeWorkTotal * 100), 2);
              $funtionTooltip = "createCustomHTMLContent('" .$collaborativeWorkName1[$i]."', 'Frecuencia', '" . $collaborativeWorkTotalAnswers[1][$i] . "')";
              $data1 .= "['" . $collaborativeWorkName1[$i] . "'," . $collaborativeWorkPercent1 . ",'" . $collaborativeWorkPercent1 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
          }
          $data1 .= ']';

          $data2 = "[";
          for ($i = 1; $i <= count($collaborativeWorkName1); $i++) {
              if($i == count($collaborativeWorkName1)){
                  $i = 999;
              }
              $collaborativeWorkPercent2 = round(($collaborativeWorkTotalAnswers[2][$i] / $collaborativeWorkTotal * 100), 2);
              $funtionTooltip = "createCustomHTMLContent('" .$collaborativeWorkName1[$i]."', 'Frecuencia', '" . $collaborativeWorkTotalAnswers[2][$i] . "')";
              $data2 .= "['" . $collaborativeWorkName1[$i] . "'," . $collaborativeWorkPercent2 . ",'" . $collaborativeWorkPercent2 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
          }
          $data2 .= ']';

          $data3 = "[";
          for ($i = 1; $i <= count($collaborativeWorkName1); $i++) {
              if($i == count($collaborativeWorkName1)){
                  $i = 999;
              }
              $collaborativeWorkPercent3 = round(($collaborativeWorkTotalAnswers[3][$i] / $collaborativeWorkTotal * 100), 2);
              $funtionTooltip = "createCustomHTMLContent('" .$collaborativeWorkName1[$i]."', 'Frecuencia', '" . $collaborativeWorkTotalAnswers[3][$i] . "')";
              $data3 .= "['" . $collaborativeWorkName1[$i] . "'," . $collaborativeWorkPercent3 . ",'" . $collaborativeWorkPercent3 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
          }
          $data3 .= ']';

          $data4 = "[";
          for ($i = 1; $i <= count($collaborativeWorkName1); $i++) {
              if($i == count($collaborativeWorkName1)){
                  $i = 999;
              }
              $collaborativeWorkPercent4 = round(($collaborativeWorkTotalAnswers[4][$i] / $collaborativeWorkTotal * 100), 2);
              $funtionTooltip = "createCustomHTMLContent('" .$collaborativeWorkName1[$i]."', 'Frecuencia', '" . $collaborativeWorkTotalAnswers[4][$i] . "')";
              $data4 .= "['" . $collaborativeWorkName1[$i] . "'," . $collaborativeWorkPercent4 . ",'" . $collaborativeWorkPercent4 . "%', " . $funtionTooltip . ", '".$colorGraphic[$i]."'],";
          }
          $data4 .= ']';

          $dataRegion = "[['Valor', 'Media', { role: 'annotation' }, { role: 'style' }],";
          if($factorStateList[0]->getMedia() > 0){
              $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#3AC777'],";
          }else{
              $dataRegion .= "['Yucat\u00E1n'," . round($factorStateList[0]->getMedia(), 2) . ",'" . round($factorStateList[0]->getMedia(), 2) . "', '#E9F26D'],";
          }
          for ($i = 0; $i < count($factorRegionList); $i++) {
              if($factorRegionList[$i]->getMedia() > 0){
                  $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#3AC777'],";
              }else{
                  $dataRegion .= "['" . $factorRegionList[$i]->getRegionObject()->getName() . "'," . round($factorRegionList[$i]->getMedia(), 2) . ",'" . round($factorRegionList[$i]->getMedia(), 2) . "', '#E9F26D'],";
              }
          }
          $dataRegion .= ']';

          ?>
          <div class="row">
              <div class='col-xs-12 col-md-12 description' align="center">
                  <p>Texto
                  </p>
                  <p>
                      Texto
                  </p>
              </div>
              <div id="chartRegion" class="col-xs-12 col-md-12 chartCenter" align="center"><br /></div>
              <div class="col-xs-12 col-md-12 text-center"><br /><br /><p><b>Con qué frecuencia mi maestro(a) realiza lo
                  siguiente durante los trabajos grupales:</b></p><br /></div>
              <div id="chart1_collaborativeWork" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
              <div id="chart2_collaborativeWork" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
              <div id="chart3_collaborativeWork" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
              <div id="chart4_collaborativeWork" class="col-xs-12 col-md-6 factorGraph" align="center"></div>
          </div>
          <a class="go-top" href="#">Subir</a>
          <script src="../imports/js/buttonTop.js"></script>
          <script>

              var data1 = <?php echo $data1; ?>;
              var data2 = <?php echo $data2; ?>;
              var data3 = <?php echo $data3; ?>;
              var data4 = <?php echo $data4; ?>;
              var dataRegion = <?php echo $dataRegion; ?>;

              google.charts.load("current", {
                  packages : ['corechart']
              });
              google.charts.setOnLoadCallback(drawChart1);
              google.charts.setOnLoadCallback(drawChart2);
              google.charts.setOnLoadCallback(drawChart3);
              google.charts.setOnLoadCallback(drawChart4);
              google.charts.setOnLoadCallback(drawChartRegion);

              function drawChart1() {
                  var data = new google.visualization.DataTable();
                   data.addColumn('string', 'Valor');
                   data.addColumn('number', 'Frecuencia');
                   data.addColumn({'type': 'string', 'role': 'annotation'});
                   data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                   data.addColumn({'type': 'string', 'role': 'style'});
                   data.addRows(data1);

                  var options = {
                      height : 400,
                      width : 600,
                      title : 'Nos anima para que todos participemos en la actividad',
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
                              annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                          width: '75%',
                          height: '70%'
                      }
                  };

                  new google.visualization.ComboChart(document.getElementById('chart1_collaborativeWork')).draw(data, options);

              }

              function drawChart2() {
                  var data = new google.visualization.DataTable();
                   data.addColumn('string', 'Valor');
                   data.addColumn('number', 'Frecuencia');
                   data.addColumn({'type': 'string', 'role': 'annotation'});
                   data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                   data.addColumn({'type': 'string', 'role': 'style'});
                   data.addRows(data2);

                  var options = {
                      height : 400,
                      width : 600,
                      title : 'Nos pregunta sobre la responsabilidad que cada quien tendr\u00e1 en el equipo',
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
                              annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                          width: '75%',
                          height: '70%'
                      }
                  };

                  new google.visualization.ComboChart(document.getElementById('chart2_collaborativeWork')).draw(data, options);

              }

              function drawChart3() {
                  var data = new google.visualization.DataTable();
                   data.addColumn('string', 'Valor');
                   data.addColumn('number', 'Frecuencia');
                   data.addColumn({'type': 'string', 'role': 'annotation'});
                   data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                   data.addColumn({'type': 'string', 'role': 'style'});
                   data.addRows(data3);

                  var options = {
                      height : 400,
                      width : 600,
                      title : 'Vigila que nos hablemos con respeto y amabilidad',
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
                              annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                          width: '75%',
                          height: '70%'
                      }
                  };

                  new google.visualization.ComboChart(document.getElementById('chart3_collaborativeWork')).draw(data, options);

              }

              function drawChart4() {
                  var data = new google.visualization.DataTable();
                   data.addColumn('string', 'Valor');
                   data.addColumn('number', 'Frecuencia');
                   data.addColumn({'type': 'string', 'role': 'annotation'});
                   data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
                   data.addColumn({'type': 'string', 'role': 'style'});
                   data.addRows(data4);

                  var options = {
                      height : 400,
                      width : 600,
                      title : 'Nos anima para que compartamos la informaci\u00f3n sobre el tema con nuestros dem\u00e1s compa\u00f1eros',
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
                              annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                          width: '75%',
                          height: '70%'
                      }
                  };

                  new google.visualization.ComboChart(document.getElementById('chart4_collaborativeWork')).draw(data, options);

              }

              function drawChartRegion() {
                  var data = google.visualization.arrayToDataTable(dataRegion);

                  var options = {
                      height : 600,
                      width : 1000,
                      orientation: 'vertical',
                      title : 'Media por estado y regi\u00F3n',
                       bar: { groupWidth: '85%' },
                      legend : {
                          position : 'none',
                          alignment : 'left',
                          textStyle : {
                              fontSize : 12
                          }
                      },
                      hAxis : {
                          title : 'Valores',
                          titleTextStyle : {
                              color : 'black',
                              fontSize : 12,
                              bold : true,
                              italic : false
                          },
                          ticks : [-3, -2, -1, 0, 1, 2, 3]
                      },
                      vAxis : {
                          title : '',
                          textPosition: 'out',
                          titleTextStyle : {
                              color : 'black',
                              fontSize : 12,
                              bold : true,
                              italic : false
                          },
                          ticks : [0, 1, 2, 3, 4]
                      },
                      series : {
                          0 : {
                              type : 'bars',
                              color : '#A8FDCC',
                              annotations: {textStyle: {fontSize: 12, color: 'black' }}
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
                          width: '85%',
                          height: '80%'
                      },
                  };

                  var chart = new google.visualization.BarChart(document.getElementById("chartRegion"));
                  chart.draw(data, options);
              }

              function createCustomHTMLContent($category1, title1, frecuency1) {
                  return '<div><span cclass="tooltiptext"><b>' + $category1 + '</b></span><br />'
                       +    '<p>' + title1 + ': <b>' + frecuency1 + '</b></p>'
                       + '</div>';
              }
          </script>
          <script>
              var onResize = function() {
                // apply dynamic padding at the top of the body according to the fixed navbar height
                $("body").css("padding-top", $(".navbar-fixed-top").height());
              };

              // attach the function to the window resize event
              $(window).resize(onResize);

              // call it also when the page is ready after load or reload
              $(function() {
                onResize();
              });
          </script>
        </div>
        <?php include ('../footer.php'); ?>
    </body>
</html>
