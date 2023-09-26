<?php
class IdaepyForm extends AbstractForm{

    private function exploitYear() {

        $exploit = array();

        array_push($exploit, array('value' => '', 'label' => 'Seleccione el año'));
        array_push($exploit, array('value' => 2016, 'label' => 2016));
        array_push($exploit, array('value' => 2017, 'label' => 2017));
		array_push($exploit, array('value' => 2018, 'label' => 2018));
        return $exploit;
    }

    public function idaepySchoolForm(){

        $year = $this -> exploitYear();

        $this -> hidden('action', 'reportSchoolIDAEPY');
        //$this -> hidden('year', '2016');
        echo("<table width='100%' border='0' class='tableForm'>");
        $this -> select2('IDAEPY', 'year', '', $year, '','','Seleccione el año', 'required', 'Seleccione el año del IDAEPY');
        $this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="alphanumeric" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
        echo("</table>");
    }

	public function idaepySchoolDirectorForm($cct){

        $year = $this -> exploitYear();

        $this -> hidden('action', 'reportSchoolIDAEPY');
        $this -> hidden('cct', $cct);
        echo("<table width='100%' border='0' class='tableForm'>");
        $this -> select2('IDAEPY', 'year', '', $year, '','','Seleccione el año', 'required', 'Seleccione el año del IDAEPY');
        //$this -> entryTextAutocomplete('CCT', 'cct', '', 'Clave del Centro de Trabajo', '', '', '', 'data-validation="alphanumeric" data-validation-error-msg="Ingrese la Clave del Centro de Trabajo"', 10);
        echo("</table>");
    }

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(Idaepy $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('Grade','grade', '','');
		$this -> entryText('GroupSchool','groupSchool', '','');
		$this -> entryText('Total','total', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>
