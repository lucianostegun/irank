<?php
	$className = ($startBankroll<0?'negative':'positive');
?>
<h1 class="startBankroll">
	Bankroll inicial: <span class="<?php echo $className ?>"><?php echo Util::formatFloat($startBankroll, true) ?></span>
	
	<?php if( $edit ): ?>
		<span class="a"><?php echo link_to('[editar]', 'myAccount/index') ?></span>
		<?php echo button_tag('exportBankroll', 'Exportar em PDF', array('image'=>'pdf', 'style'=>'float: right', 'onclick'=>'exportBankroll("pdf")')) ?>
	<?php else: ?>
	<img src="[webDir]/images/logo/pdf.png">
	<?php endif; ?>
</h1>
<?php
	if( $edit ):
	
		$firstYear = Util::executeOne("SELECT COALESCE(MIN(EXTRACT(YEAR FROM event_date)), EXTRACT(YEAR FROM current_date)) FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) LIMIT 1");
		$lastYear  = Util::executeOne("SELECT COALESCE(MAX(EXTRACT(YEAR FROM event_date)), EXTRACT(YEAR FROM current_date)) FROM bankroll WHERE (people_id = $peopleId OR user_site_id = $userSiteId) LIMIT 1");
?>
<h1 class="startBankroll filter">
	<label>Período:</label>
	<?php
		$optionList = array(''=>'Todos');
		for($year=$firstYear; $year <= $lastYear; $year++)
			$optionList[$year] = $year;
		
		echo select_tag('year', options_for_select($optionList), array('id'=>'bankrollYear'));
		
		echo button_tag('updateBankroll', 'Atualizar', array('image'=>'refresh', 'style'=>'position: absolute; left: 130px; top: 3px;', 'onclick'=>'updateBankroll()'))
	?>
</h1>
<?php endif; ?>