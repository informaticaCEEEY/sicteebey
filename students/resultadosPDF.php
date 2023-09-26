<?php

include_once('getInfoChart.php');
require '../lib/vendor/autoload.php';

// <link href="../css/idaepyResultPDF.css" rel="stylesheet">

$reportContent =
'<div id="pdfReport">';
$reportContent .=
'<div class="text-center">
	<h3>Resultados del Alumno</h3>
</div>
<table class="tableStudent">
	<tr>
		<td>
			<label><b>Folio IDAEPY:</b></label> '.str_pad($user->getFolio(), 6, "0", STR_PAD_LEFT).'
		</td>
	</tr>
</table>
<div class="divSchool">
	<h4>Datos Generales de la Escuela</h4>
	<div class="tableData">
	<table class="tableSchool">
		<tr>
			<td>
				<label><b>CCT:</b></label> '.$school->getCct().'
			</td>
			<td colspan="2">
				<label><b>Nombre de la Escuela: </b></label>'.mb_convert_case($school->getName(), MB_CASE_TITLE, "UTF-8").'
			</td>
		</tr>
		<tr>
			<td>
				<label><b>Nivel:</b></label> '.$school->getSchoolLevelObject()->getName().'
			</td>
			<td colspan="2">
				<label><b>Turno:</b></label> '.$school->getSchoolScheduleObject()->getName().'
			</td>
		</tr>
		<tr>
			<td>
				<label><b>Modalidad:</b></label> '.$school->getSchoolRegionZoneObject()->getSchoolModeObject()->getName().'
			</td>
			<td>
				<label><b>Región:</b></label> '.$school->getSchoolRegionZoneObject()->getSchoolRegionObject()->getName().'
			</td>
			<td>
				<label><b>Zona:</b></label> '.$school->getSchoolRegionZoneObject()->getZone().'
			</td>
		</tr>
		<tr>
			<td>
				<label><b>Municipio:</b></label> '.mb_convert_case($school->getTownObject()->getName(), MB_CASE_TITLE, "UTF-8").'
			</td>
			<td colspan="2">
				<label><b>Localidad:</b></label> '.mb_convert_case($school->getLocality(), MB_CASE_TITLE, "UTF-8").'
			</td>
		</tr>
		<tr>
			<td>
				<label><b>Grado de Marginación:</b></label> '.$school->getSchoolMarginalizationObject()->getName().'
			</td>
		</tr>
	</table>
	</div>
</div>';
$reportContent .=
'<div id="subjectDiv" class="divStudent col-xs-12 col-sm-12">
	<div class="tab-content col-xs-12 col-md-12">';
		foreach($subjectList as $subject){
			$reportContent .= '<pagebreak />';
			switch ($subject->getId()) {
				case 1:
					$subjectAchievement = $idaepyAchievement[0]->getAchievementMath();
					$imgContent = $_POST['urlmathsChart'];
					break;
				case 2:
					$subjectAchievement = $idaepyAchievement[0]->getAchievementSpanish();
					$imgContent = $_POST['urlspanishChart'];
					break;
				case 3:
					$subjectAchievement = $idaepyAchievement[0]->getAchievementScience();
					$imgContent = $_POST['urlsciencesChart'];
					break;
				default:
					$subjectAchievement = 0;
					$imgContent = 0;
					break;
			}

			$achievementDescriptionController = new AchievementDescriptionController();
			$where = 'e.achievement = :achievement AND e.subject = :subject AND e.grade = :grade AND e.year = 2019';
			$whereFields = array('achievement' => $subjectAchievement, 'grade' => $user->getGrade(),
				'subject' => $subject->getId());
			$achievementDescription = $achievementDescriptionController->displayByAction($where, $whereFields);

			$reportContent .= '<div id="'.$subject->getAlias().'" class="divState col-xs-12 col-md-12">';
			$reportContent .= '<h3>'.$subject->getName().'</h3>';
			$reportContent .= "<div class='text-center chartImg'>";
			$reportContent .= '<img class="imgData" src ="'.$imgContent.'" />';
			$reportContent .= '</div>';
			$reportContent .= '<div class="divStudent col-xs-12 col-md-12">';
			//echo('<h4>Resultados del Alumno</h4>');
			$reportContent .= '
			<table class="achievementTable">
				<tr>
					<td><b>Nivel de Logro: </b></td>
					<td id="achievement'.$subjectAchievement.'">'.$achievementDescription[0]->getAchievementObject()->getName().'</td>
				</tr>
			</table>
			<table class="achievementTable">
				<tr>
					<td><b>Habilidades del Alumno:</b></td>
				</tr>
			</table>';
			// $reportContent .= '<p><b>Nivel de Logro: </b>';
			// $reportContent .= '<a id="achievement'.$subjectAchievement.'">'.$achievementDescription[0]->getAchievementObject()->getName().'</a>';
			// $reportContent .= '<p/><br />';
			// $reportContent .= '<b>Habilidades del Alumno:</b>';
			$reportContent .= '<ul>';
			foreach($achievementDescription as $achievementD){
				$reportContent .= '<li>'. $achievementD->getDescription() .'</li>';
			}
			$reportContent .= '</ul>';
			$reportContent .= '</div>';
			$reportContent .= '</div>'; //Fin Div Subject
		}

$reportContent .=
	'</div>
</div>';

$reportContent .=
'</div>';
// print_r($reportContent);
// exit;
ob_start();
echo($reportContent);
$html = ob_get_contents();
ob_end_clean();

$mpdf = new \Mpdf\Mpdf([
	'tempDir' => '../lib/vendor/mpdf/tmp',
	'mode' => 'c',
	'margin_left' => 15,
	'margin_right' => 15,
	'margin_top' => 25,
	'margin_bottom' => 10,
	'margin_header' => 10,
	'margin_footer' => 10
]);
$stylesheet = file_get_contents('../css/idaepyResultPDF.css');
//$mpdf->WriteHTML($stylesheet, 1); // The parameter 1 tells that this is css/style only and no body/html/text
$mpdf->WriteHTML($stylesheet, 1);
$header = '
<table width="100%" style="vertical-align: middle; font-family: Lato; font-size: 10pt;"><tr>
<td width="33%"><img src="../img/Segey900.png" width="250px" /></td>
<td width="33%" align="center"></td>
<td width="33%" style="text-align: right;"><span style="font-weight: bold;">Centro de Evaluación Educativa del Estado de Yucatán</span></td>
</tr></table>';
$mpdf->SetHTMLHeader($header);
$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">{DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">Resultados IDAEPY 2019</td>
    </tr>
</table>');
$mpdf->WriteHTML($reportContent, 2);
$mpdf->Output('Resultados IDAEPY 2019.pdf', \Mpdf\Output\Destination::DOWNLOAD);

?>
