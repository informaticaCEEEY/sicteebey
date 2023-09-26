<?php
function actualDate() {

	$actualDate;
	$timestamp = time();

	$dtzone = new DateTimeZone('America/Mexico_City');
	$time = date('r', $timestamp);

	$dtime = new DateTime($time);
	$dtime->setTimeZone($dtzone);
	$day = $dtime->format('D');
	$dayNumber = $dtime->format('j');
	$month = $dtime->format('m');
	$year = $dtime->format('Y');

	switch ($day) {
	case "Sun":
		$day = "Domingo";
		break;
	case "Mon":
		$day = "Lunes";
		break;
	case "Tue":
		$day = "Martes";
		break;
	case "Wed":
		$day = "Mi&eacute;rcoles";
		break;
	case "Thu":
		$day = "Jueves";
		break;
	case "Fri":
		$day = "Viernes";
		break;
	case "Sat":
		$day = "S&aacute;bado";
		break;
	}
	
	switch ($month) {
	case 1:
		$month = 'Enero';
		break;
	case 2:
		$month = 'Febrero';
		break;
	case 3:
		$month = 'Marzo';
		break;
	case 4:
		$month = 'Abril';
		break;
	case 5:
		$month = 'Mayo';
		break;
	case 6:
		$month = 'Junio';
		break;
	case 7:
		$month = 'Julio';
		break;
	case 8:
		$month = 'Agosto';
		break;
	case 9:
		$month = 'Septiembre';
		break;
	case 10:
		$month = 'Octubre';
		break;
	case 11:
		$month = 'Noviembre';
		break;
	case 12:
		$month = 'Diciembre';
		break;
	}
	
	$actualDate = 'Hoy es ' . $day . ' ' . $dayNumber . ' de ' . $month
			. ' del ' . $year;
	
	return $actualDate;
}
?>