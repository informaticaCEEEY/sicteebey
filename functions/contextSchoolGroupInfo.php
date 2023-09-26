<?php
if($_POST['year'] == '2015'){
?>
<div class="col-xs-12 col-md-7">
  <table class="table table-condensed">
      <caption>Cuestionarios de Contexto 2015</caption>
      <thead>
          <tr>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Total Alumnos</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <th><?php echo($idaepyScheduled->getGrade()); ?></th>
              <th><?php echo($idaepyScheduled->getSchoolGroup()); ?></th>
              <th><?php echo( $idaepyStudents15); ?></th>
          </tr>
      </tbody>
  </table>
  <table class="table table-condensed">
      <caption>Cuestionarios de Contexto 2016</caption>
      <thead>
          <tr>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Total Alumnos</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <th><?php echo($idaepyScheduled->getGrade()); ?></th>
              <th><?php echo($idaepyScheduled->getSchoolGroup()); ?></th>
              <th><?php echo( $idaepyStudents16); ?></th>
          </tr>
      </tbody>
  </table>
  <p><b>Nota: Los grupos se escuentran conformados de acuerdo al ciclo escolar <?php echo(($groupby-1).'-'.$groupby); ?></b></p>
</div>
<?php
}else{
?>
<div class="col-xs-12 col-md-7">
  <table class="table table-condensed">
      <caption>Cuestionarios de Contexto <?php echo $year; ?></caption>
      <thead>
          <tr>
              <th>Grado</th>
              <th>Grupo</th>
              <th>Evaluados Contexto</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <th><?php echo($idaepyScheduled->getGrade()); ?></th>
              <th><?php echo($idaepyScheduled->getSchoolGroup()); ?></th>
              <th><?php echo( $idaepyStudents17); ?></th>
          </tr>
      </tbody>
  </table>
  <p><b>Nota: Los grupos se escuentran conformados de acuerdo al ciclo escolar <?php echo(($groupby-1).'-'.$groupby); ?></b></p>
</div>
<?php
}
?>
