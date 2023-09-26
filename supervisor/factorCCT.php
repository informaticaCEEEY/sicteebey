<?php
require ('../checkSession.php');
?>
<!DOCTYPE html>
<html lang="es">
	<body>
		<?php include('header.php'); ?>

		<div class="container">
				<?php 

				$form = new FactorForm();

				echo('<form name="valid" id="valid" action="index.php" method="post">');
				//echo('<input type="hidden" name="project_id" id="project_id" value="'.$entity->getProject().'">');
				echo('</form>');
								
				$schoolController = new SchoolController();
				$school = $schoolController->getEntityByAction('cct', $_POST['cct']);
				
				$factorSchoolController = new FactorCctController();
				$where = 'cct LIKE :school';
				$whereFields = array('school' => $_POST['cct']);
				$factorSchoolList = $factorSchoolController -> displayByAction($where, $whereFields);
				
				$dataReportGeneral = "[['', 'Media', { role: 'annotation' }],";		
				for ($i = 0; $i < count($factorSchoolList); $i++) {				
					$dataReportGeneral .= "['" . $factorSchoolList[$i]->getFactorObject()->getName() . "'," . round($factorSchoolList[$i]->getMedia(), 4)
											 . ",'" . round($factorSchoolList[$i]->getMedia(), 4) . "'],";
				}
				$dataReportGeneral .= ']';
				
				?>
				<div class='text-center'>
					<h3 class='form-signin-heading'><?php echo $school[0]->getName(); ?></h3>
				</div><hr />
				<div class="row">
					<div id="chartState" class="col-xs-12 col-md-12 chartCenter" align="center"></div>
				</div>
				
				<form role="form" name="entry2" id="entry2" class="form-signin" action="dispatchers/factorDispatcher.php" method="post" accept-charset="UTF-8">
					<?php
					if (isset($_SESSION['flash'])) {
						echo('<label class="formError">' . $_SESSION['flash'] . '</label>');
						$_SESSION['flash'] = null;
					}
					$form -> contextFactorForm($school[0]->getCct());
					?>
					<br />
					
					<div class="text-center">
						<div class="col-xs-12 center-block" id="loading" style="display: none"><img src="../img/loading_spinner.gif" /><br /></div> 
						<button type="submit" class="btn btn-lg btn-primary" id="sendForm">Enviar</button>
						<button type="button" class="btn btn-lg btn-danger" onclick="document.forms.valid.submit()">Cancelar</button>
					</div>
				</form>
		</div>
		<script src="../imports/js/schoolValidate.js"></script>
		<script>
			var dataReportGeneral = <?php echo $dataReportGeneral; ?>;
			
				google.charts.setOnLoadCallback(drawChartState);
				
				
				function drawChartState() {
					var data = google.visualization.arrayToDataTable(dataReportGeneral);
			
					var options = {						
						height : 500,
						width : 1000,
						orientation: 'vertical',
						title : 'Media por escuela',	
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
								fontSize : 10,
								bold : true,
								italic : false
							}
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
							left : 150,
							top : 50,
							width: '75%', 
							height: '70%'
						},						
					};
			
					var chart = new google.visualization.BarChart(document.getElementById("chartState"));
					chart.draw(data, options);			
				}
			
		</script>
	</body>
</html>
