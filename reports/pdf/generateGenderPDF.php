<?php
require ('../../checkSession.php');
require_once '../../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

if (!isset($_SESSION['user'])) {
  header('Location:../../login.php');
	exit;
}else{
  $user = unserialize($_SESSION['user']);
  $user = $userController->getEntityAction($user->getId());
}

if (!isset($_POST['cohorte']) || !isset($_POST['htmlContent1']) || !isset($_POST['htmlContent2'])) {
	echo('<form name="valid" id="valid" action="../../index.php" method="post"></form>');
	echo('<script>document.forms.valid.submit()</script>');
}else{
  extract($_POST);
	$controller = new CohorteController();
	$cohorte = $controller->getEntityAction($cohorte);
}

include('reportGenderPDF.php');

$tableContent = $table1;
$tableContent .= '
<div>
  <h4 class="modal-title" id="myModalLabel"><b>Flujo de los alumnos en educaci&oacute;n b&aacute;sica</b></h4>'
  . $_POST['htmlContent1'] . '
</div>';
$tableContent .= $table2;
$tableContent .= '
<div>
  <h4 class="modal-title" id="myModalLabel"><b>Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</b></h4>
  <h4 class="modal-title" id="myModalLabel">Hombres</h4>'
  . $_POST['htmlContent2'] . '
</div>';
$tableContent .= $table2a;
$tableContent .= '
<div>
  <h4 class="modal-title" id="myModalLabel"><b>Porcentaje de alumnos de la cohorte en el sistema educativo estatal por ciclo escolar</b></h4>
  <h4 class="modal-title" id="myModalLabel">Mujeres</h4>'
  . $_POST['htmlContent3'] . '
</div>';
$tableContent .= $table3;

//echo $tableContent;

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($tableContent);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('letter', 'landscape');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$fileName = 'Reporte por Sexo Cohorte ' . $cohorte->getName() . '.pdf';
$dompdf->stream($fileName);

?>
