<?php
if($yearApplication == '2015'){
?>
<div class="col-xs-12 col-md-7">
    <table class="table table-condensed">
        <caption>Cuestionarios de Contexto 2015</caption>
        <thead>
            <tr>
                <th>Programados (2014-2015)</th>
                <th>Cursando (<?php echo(($groupby-1).'-'.$groupby); ?>)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th><?php echo( $idaepyStudents15); ?></th>
                <th><?php echo( $idaepyStudentsX); ?></th>
            </tr>
        </tbody>
    </table>
    <table class="table table-condensed">
        <caption>Cuestionarios de Contexto 2016</caption>
        <thead>
            <tr>
                <th>Grado</th>
                <th>Programados (2015-2016)</th>
                <th>Cursando (<?php echo(($groupby-1).'-'.$groupby); ?>)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>3 a 5</th>
                <th><?php echo( $total16); ?></th>
                <th><?php echo( $totalX); ?></th>
            </tr>
            <tr>
                <th>6</th>
                <th><?php echo( $count_values16[6]); ?></th>
                <th><?php echo( $count_valuesX[6]); ?></th>
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
        <caption>Cuestionarios de Contexto <?php echo $yearApplication; ?></caption>
        <thead>
            <tr>
                <th>Grado</th>
                <th>Programados (<?php echo(($yearApplication-1).'-'.$yearApplication); ?>)</th>
                <th>Cursando (<?php echo(($groupby-1).'-'.$groupby); ?>)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>3</th>
                <th><?php echo($idaepyGradeTotal[3] ? $idaepyGradeTotal[3] : '0' ) ?></th>
                <th><?php echo($count_valuesX[3]); ?></th>
            </tr>
            <tr>
                <th>4</th>
                <th><?php echo($idaepyGradeTotal[4] ? $idaepyGradeTotal[4] : '0' ) ?></th>
                <th><?php echo($count_valuesX[4]); ?></th>
            </tr>
            <tr>
                <th>5</th>
                <th><?php echo($idaepyGradeTotal[5] ? $idaepyGradeTotal[5] : '0' ) ?></th>
                <th><?php echo($count_valuesX[5]); ?></th>
            </tr>
            <tr>
                <th>6</th>
                <th><?php echo($idaepyGradeTotal[6] ? $idaepyGradeTotal[6] : '0' ) ?></th>
                <th><?php echo($count_valuesX[6]); ?></th>
            </tr>
        </tbody>
    </table>
    <p><b>Nota: Los grupos se escuentran conformados de acuerdo al ciclo escolar <?php echo(($groupby-1).'-'.$groupby); ?></b></p>
</div>
<?php
}
?>
