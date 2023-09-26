<?php
class IdaepyAchievementRegionZoneForm extends AbstractForm{

	public function addForm(){

		$this -> hidden('action', 'add');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Agregar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegionZone','schoolRegionZone', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('HitsPercentage','hitsPercentage', '','');
		$this -> entryText('MathPercentage','mathPercentage', '','');
		$this -> entryText('SciencePercentage','sciencePercentage', '','');
		$this -> entryText('SpanishPercentage','spanishPercentage', '','');
		$this -> entryText('MathAchievementBasic','mathAchievementBasic', '','');
		$this -> entryText('MathAchievementMedium','mathAchievementMedium', '','');
		$this -> entryText('MathAchievementAdvanced','mathAchievementAdvanced', '','');
		$this -> entryText('SpanishAchievementBasic','spanishAchievementBasic', '','');
		$this -> entryText('SpanishAchievementMedium','spanishAchievementMedium', '','');
		$this -> entryText('SpanishAchievementAdvanced','spanishAchievementAdvanced', '','');
		$this -> entryText('ScienceAchievementBasic','scienceAchievementBasic', '','');
		$this -> entryText('ScienceAchievementMedium','scienceAchievementMedium', '','');
		$this -> entryText('ScienceAchievementAdvanced','scienceAchievementAdvanced', '','');
		echo("</table>");
	}

	public function editForm(IdaepyAchievementRegionZone $entity){

		$this -> hidden('action', 'edit');
		echo("<table width='100%' border='0' class='tableForm'>");
		$this -> formHeader('Editar');
		$this -> entryText('Id','id', '','');
		$this -> entryText('SchoolRegionZone','schoolRegionZone', '','');
		$this -> entryText('Evaluated','evaluated', '','');
		$this -> entryText('HitsPercentage','hitsPercentage', '','');
		$this -> entryText('MathPercentage','mathPercentage', '','');
		$this -> entryText('SciencePercentage','sciencePercentage', '','');
		$this -> entryText('SpanishPercentage','spanishPercentage', '','');
		$this -> entryText('MathAchievementBasic','mathAchievementBasic', '','');
		$this -> entryText('MathAchievementMedium','mathAchievementMedium', '','');
		$this -> entryText('MathAchievementAdvanced','mathAchievementAdvanced', '','');
		$this -> entryText('SpanishAchievementBasic','spanishAchievementBasic', '','');
		$this -> entryText('SpanishAchievementMedium','spanishAchievementMedium', '','');
		$this -> entryText('SpanishAchievementAdvanced','spanishAchievementAdvanced', '','');
		$this -> entryText('ScienceAchievementBasic','scienceAchievementBasic', '','');
		$this -> entryText('ScienceAchievementMedium','scienceAchievementMedium', '','');
		$this -> entryText('ScienceAchievementAdvanced','scienceAchievementAdvanced', '','');
		echo("</table>");
	}

}
?>