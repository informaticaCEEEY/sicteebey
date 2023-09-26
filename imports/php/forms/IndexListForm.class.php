<?php
class IndexListForm extends AbstractForm{
    
    private function exploitIndex($array) {

        $exploit = array();
        array_push($exploit, array('value' => '', 'label' => 'Seleccione un &iacute;ndice'));
        foreach ($array as $entry) {
            array_push($exploit, array('value' => $entry -> getId(), 'label' => $entry->getName()));
        }
        return $exploit;
    }

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Name','name', '','');
		echo("</table>");
	}

	public function editForm(IndexList $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Name','name', '','');
		echo("</table>");
	}
    
    public function contextStateForm(){
        
        $controller = new IndexListController();
        $indexList = $this -> exploitIndex($controller -> displayByAction('', '', '', 'e.name'));

        $this -> hidden('action', 'view');
        echo("<table width='100%' border='0' class='tableForm'>");
        //$this -> formHeader('Reporte por Escuela');
        $this -> select2('Seleccione un &iacute;ndice', 'indexList', '', $indexList,'','','', 'required', 'Seleccione un &iacute;ndice');        
        echo("</table>");
    }
    
    public function contextSchoolForm($schoolCCT){
        
        $controller = new IndexListController();
        $indexList = $this -> exploitIndex($controller -> displayByAction('', '', '', 'e.name'));

        $this -> hidden('action', 'viewSchool');
        $this -> hidden('cct', $schoolCCT);
        echo("<table width='100%' border='0' class='tableForm'>");
        //$this -> formHeader('Reporte por Escuela');
        $this -> select2('Seleccione un &iacute;ndice', 'indexList', '', $indexList,'','','', 'required', 'Seleccione un &iacute;ndice');        
        echo("</table>");
    }
    
    public function contextSchoolZoneForm($schoolZone){
        
        $controller = new IndexListController();
        $indexList = $this -> exploitIndex($controller -> displayByAction('', '', '', 'e.name'));

        $this -> hidden('action', 'viewSchoolZone');
        $this -> hidden('schoolZone', $schoolZone);
        echo("<table width='100%' border='0' class='tableForm'>");
        //$this -> formHeader('Reporte por Escuela');
        $this -> select2('Seleccione un &iacute;ndice', 'indexList', '', $indexList,'','','', 'required', 'Seleccione un &iacute;ndice');        
        echo("</table>");
    }

}
?>