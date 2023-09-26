<?php
class ChartsController{

	private $model;

	function __construct(){

		$this->model=new ChartsModel();
	}

	public function displayAction(){

		return $this->model->listAll('', '', '', '', '', '', '', '');
	}

	public function displayByAction($where='', $whereFields='', $join='', $order=''){

		return $this->model->listAll('', '', '', '', $order, $where, $whereFields, $join);
	}

	public function displayBy2Action($where='', $whereFields='', $join='', $order='', $showFields=''){

		return $this->model->listAll2('', '', '', '', $order, $where, $whereFields, $join, $showFields);
	}

	public function getEntityAction($id){

		return $this->model->getEntity($id);
	}

	public function getEntityByAction($field, $search){

		return $this->model->getBy($field, $search);
	}

	public function createAction(){

		extract($_POST);
		try{
			$object= new Charts();
			$object->setName($name);
			$this -> model -> addCharts($object);
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function updateAction(){

		extract($_POST);
		if(isset($id)){

			$object= $this-> getEntityAction($id);
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		if(is_null($object)){

			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
		try{
			$object->setName($name);
			$this -> model -> updateCharts($object);
		}catch(Exception $e){
			$_SESSION['flash'] = $e->getMessage();
			echo('<script>javascript:history.go(-1)</script>');
		}
	}

	public function deleteAction(){

		extract($_POST);
		extract($_GET);
		if(isset($form_id) && isset($id) && is_numeric($form_id) && is_numeric($id) && $id==$form_id){

			$form_id = intval($form_id);
			$object = $this -> getEntityAction($form_id);
			if($object != null){

				$this -> model -> deleteCharts($object);
			}
		}else{
			echo('<form name="valid" id="valid" action="../index.php" method="post"></form>');
			echo('<script>document.forms.valid.submit()</script>');
		}
	}


	public function drawComboChart($title, $chartNumber, $chartData){

		//Generar el codigo javascript necesario para las graficas
		$drawChartJS .= "var data$chartNumber = $chartData;\n\n";
		$drawChartJS .= "google.charts.setOnLoadCallback(drawChart$chartNumber);\n\n";
		$drawChartJS .= "
			function drawChart$chartNumber() {
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Valor');
			data.addColumn('number', 'Frecuencia');
			data.addColumn({'type': 'string', 'role': 'annotation'});
			data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
			data.addColumn({'type': 'string', 'role': 'style'});
			data.addRows(data$chartNumber);

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
				new google.visualization.ComboChart(document.getElementById('chart$chartNumber')).draw(data, options);
		  }\n\n";

			return $drawChartJS;
	}

	public function drawPieChart($title, $chartNumber, $chartData, $slices){

		//Generar el codigo javascript necesario para las graficas
		$drawChartJS = "var data$chartNumber = $chartData;\n\n";
		$drawChartJS .= "google.charts.setOnLoadCallback(drawChart$chartNumber);\n\n";
    $drawChartJS .= "
      function drawChart$chartNumber() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Valor');
        data.addColumn('number', 'Frecuencia');
        data.addColumn({'type': 'string', 'role': 'annotation'});
        data.addColumn({'type': 'string', 'role': 'tooltip', 'p': {'html': true}});
        data.addColumn({'type': 'string', 'role': 'style'});
        data.addRows(data$chartNumber);

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
            top : 70,
            width: '70%',
            height: '70%'
          }
        };
        new google.visualization.PieChart(document.getElementById('chart$chartNumber')).draw(data, options);
      }\n\n";

			return $drawChartJS;
	}

		public function drawBarChart($title, $chartName, $chartData){

			//Generar el codigo javascript necesario para las graficas
			$drawChartJS = "const $chartName = new Chart(document.getElementById('$chartName'), {";
			$drawChartJS .= "type: 'bar',";
			$drawChartJS .= "
			  data: {
			    labels: ['Yucatán', 'Escuela', 'Grado', 'Grupo'],
			    $chartData
			  },";
			  $drawChartJS .= "options: {
					tooltips: {
			      callbacks: {
			        label: (tooltipItem, data) => {
			          const datasetIndex = tooltipItem.datasetIndex;
			          const datasetLabel = data.datasets[datasetIndex].label;
			          // You can use two type values.
			          // 'data.originalData' is raw values,
			          // 'data.calculatedData' is percentage values, e.g. 20.5 (The total value is 100.0)
			          const originalValue = data.originalData[datasetIndex][tooltipItem.index].toLocaleString();
			          const rateValue = data.calculatedData[datasetIndex][tooltipItem.index];
			          return `\${datasetLabel}: \${rateValue}% (\${originalValue})`;
			        }
			      }
					},
			    plugins: {
			      datalabels: {
			        formatter: (_value, context) => {
			          const data = context.chart.data;
			          const { datasetIndex, dataIndex } = context;
			          return data.calculatedData[datasetIndex][dataIndex] + '%';
			        }
			      },
			      stacked100: { enable: true, replaceTooltipLabel: false }
			    },
					animation: {
			      onComplete: done
			    }
			  },
			})";
			return $drawChartJS;
	}
}
?>
