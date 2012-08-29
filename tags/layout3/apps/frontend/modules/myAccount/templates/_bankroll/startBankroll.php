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
