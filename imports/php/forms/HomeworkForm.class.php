<?php
class HomeworkForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R51_R73','R51_R73', '','');
		$this -> entryText('R52_R74','R52_R74', '','');
		$this -> entryText('R53_R75','R53_R75', '','');
		$this -> entryText('R54_R76','R54_R76', '','');
		$this -> entryText('R55_R77','R55_R77', '','');
		$this -> entryText('R56_R78','R56_R78', '','');
		echo("</table>");
	}

	public function editForm(Homework $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('Cct','cct', '','');
		$this -> entryText('R51_R73','R51_R73', '','');
		$this -> entryText('R52_R74','R52_R74', '','');
		$this -> entryText('R53_R75','R53_R75', '','');
		$this -> entryText('R54_R76','R54_R76', '','');
		$this -> entryText('R55_R77','R55_R77', '','');
		$this -> entryText('R56_R78','R56_R78', '','');
		echo("</table>");
	}

}
?>