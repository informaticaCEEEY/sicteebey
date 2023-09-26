<?php

include ('../checkSession.php');
include ('../lib/fpdf/mc_table.php');
//include ('idaepyData.php');

if(!isset($_POST['year']) && is_int($_POST['year'])){
  $_SESSION['message'] = 'El año es incorrecto';
  header('location:index.php');
  exit;
}

if($_POST['year'] == '2016'){
  include ('idaepy2016PDF.php');
}elseif($_POST['year'] == '2017'){
  include ('idaepy2017PDF.php');
}elseif($_POST['year'] == '2018'){
  include ('idaepyPDFReport.php');
}else{
  header('location:index.php');
  exit;
}

if(!isset($_POST['cct'])){
  $_SESSION['message'] = 'La escuela no existe';
  header('location:index.php');
  exit;
}

if(!$school){
  $_SESSION['message'] = 'La escuela no existe';
  header('location:index.php');
  exit;
}


?>
