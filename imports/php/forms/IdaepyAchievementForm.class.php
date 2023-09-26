<?php
class IdaepyAchievementForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('PercentageMath','percentageMath', '','');
		$this -> entryText('PercentageScience','percentageScience', '','');
		$this -> entryText('PercentageSpanish','percentageSpanish', '','');
		$this -> entryText('AchievementMath','achievementMath', '','');
		$this -> entryText('AchievementScience','achievementScience', '','');
		$this -> entryText('AchievementSpanish','achievementSpanish', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

	public function editForm(IdaepyAchievement $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('Student','student', '','');
		$this -> entryText('PercentageMath','percentageMath', '','');
		$this -> entryText('PercentageScience','percentageScience', '','');
		$this -> entryText('PercentageSpanish','percentageSpanish', '','');
		$this -> entryText('AchievementMath','achievementMath', '','');
		$this -> entryText('AchievementScience','achievementScience', '','');
		$this -> entryText('AchievementSpanish','achievementSpanish', '','');
		$this -> entryText('Year','year', '','');
		echo("</table>");
	}

}
?>