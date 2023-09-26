<br />
<div class="col-xs-12 col-md-5">
  <div><h4 class='form-signin-heading'>CCT: <?php echo($school -> getCct()); ?></h4></div>
  <div><h4 class='form-signin-heading'>Escuela: <?php echo($school -> getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Nivel: <?php echo($school -> getSchoolLevelObject() -> getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Modalidad: <?php echo($school -> getSchoolModeObject() -> getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Marginación: <?php echo($school->getSchoolMarginalizationObject()->getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Regi&oacute;n: <?php echo($school -> getSchoolRegionObject() -> getName()); ?> </h4></div>
  <div><h4 class='form-signin-heading'>Zona Escolar: <?php echo(str_pad($school->getZone(),  3, "0", STR_PAD_LEFT)); ?> </h4></div>
</div>
<div class="col-xs-12 col-md-7">
  <table class="table table-condensed">
    <thead>
      <tr>
        <th>Grado</th>
        <th>Grupo</th>
        <th>Total alumnos (<?php echo(($groupby-1).'-'.$groupby); ?>)</th>
        <th>Programados Contexto (2014-2015)</th>
        <th>Evaluados Contexto (2014-2015)</th>
      </tr>
    </thead>
    <tbody>
    <?php
      echo('<tr>');
      echo('<td>'.$idaepyScheduled->getGrade().'</td>');
      echo('<td>'.$idaepyScheduled->getSchoolGroup().'</td>');
	    echo('<td>'.$idaepyScheduled->getTotal().'</td>');
      echo('<td>'.$factorTotal.'</td>');
      echo('<td>'.$totalContext.'</td>');
      echo('</tr>');
     ?>
    </tbody>
  </table>
</div>
<hr />
